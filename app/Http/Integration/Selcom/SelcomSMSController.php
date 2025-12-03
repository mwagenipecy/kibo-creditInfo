<?php

namespace App\Http\Integration\Selcom;

use App\Http\Integration\Selcom\Constants;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SelcomSMSController
{
    /**
     * Send SMS to a single recipient
     * 
     * @param string $phone Phone number (format: 255XXXXXXXXX)
     * @param string $message Message content
     * @param int|null $client_id Optional client ID for logging
     * @param int|null $report_id Optional report ID for logging
     * @return array
     */
    static function send($phone, $message, $client_id = null, $report_id = null)
    {
        // Validate credentials
        $username = Constants::getSmsUsername();
        $password = Constants::getSmsPassword();
        
        // Store original phone for logging
        $originalPhone = $phone;
        
        if (!$username || !$password) {
            $error = 'Selcom SMS credentials not configured properly';
            Log::error($error);
            // Log validation failure to database
            self::logToDatabase($originalPhone, $message ?? '', 'failed', $error, null, null, $client_id, $report_id);
            return [
                'success' => false,
                'error' => $error,
                'message' => 'SMS configuration error'
            ];
        }

        // Clean phone number
        $phone = self::cleanPhoneNumber($phone);
        
        // Validate phone number after cleaning
        if (!$phone || !preg_match('/^255[6-9]\d{8}$/', $phone)) {
            $error = 'Invalid phone number format: ' . ($phone ?? 'null');
            Log::error($error, ['original_phone' => $originalPhone]);
            // Log validation failure to database
            self::logToDatabase($originalPhone, $message ?? '', 'failed', $error, null, null, $client_id, $report_id);
            return [
                'success' => false,
                'error' => $error,
                'message' => 'Invalid phone number'
            ];
        }

        // Validate message
        if (empty(trim($message))) {
            $error = 'Message cannot be empty';
            Log::error($error);
            // Log validation failure to database
            self::logToDatabase($phone, '', 'failed', $error, null, null, $client_id, $report_id);
            return [
                'success' => false,
                'error' => $error,
                'message' => 'Empty message'
            ];
        }

        Log::info('Attempting to send SMS via Selcom', [
            'phone' => $phone,
            'client_id' => $client_id,
            'report_id' => $report_id,
            'message_length' => strlen($message)
        ]);

        try {
            // Build URL with query parameters
            $params = [
                'USERNAME' => Constants::getSmsUsername(),
                'PASSWORD' => Constants::getSmsPassword(),
                'DESTADDR' => $phone,
                'MESSAGE' => urlencode(trim($message))
            ];

            $url = Constants::getSmsEndpoint() . '?' . http_build_query($params);

            // Initialize cURL with error handling
            $ch = @curl_init();
            
            if ($ch === false) {
                throw new \Exception('Failed to initialize cURL');
            }
            
            // Set cURL options
            $curlOptions = [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_CONNECTTIMEOUT => 10,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_HTTPHEADER => [
                    'Accept: application/json'
                ]
            ];
            
            $curlResult = @curl_setopt_array($ch, $curlOptions);
            
            if ($curlResult === false) {
                @curl_close($ch);
                throw new \Exception('Failed to set cURL options');
            }

            $response = @curl_exec($ch);
            $httpCode = $ch ? curl_getinfo($ch, CURLINFO_HTTP_CODE) : 0;
            $curlError = $ch ? curl_error($ch) : 'cURL handle not available';
            @curl_close($ch);
            
            // Handle cURL errors
            if ($curlError) {
                $errorMsg = "cURL Error: $curlError";
                Log::error("SMS cURL failed for {$phone}", [
                    'curl_error' => $curlError,
                    'phone' => $phone
                ]);

                // Log to database
                try {
                    self::logToDatabase($phone, $message, 'failed', $errorMsg, null, null, $client_id, $report_id);
                } catch (\Exception $logException) {
                    // Even database logging failure shouldn't stop the process
                    Log::warning('Failed to log SMS to database', ['error' => $logException->getMessage()]);
                }

                return [
                    'success' => false,
                    'error' => $errorMsg,
                    'message' => 'Network error occurred'
                ];
            }

            // Parse response
            $responseData = json_decode($response, true);
            
            // Enhanced logging
            Log::info('Selcom SMS API Response', [
                'phone' => $phone,
                'http_code' => $httpCode,
                'response_data' => $responseData,
                'raw_response' => $response
            ]);

            // Handle different HTTP status codes
            if ($httpCode == 200) {
                $isSuccess = self::isResponseSuccessful($responseData);
                
                if ($isSuccess) {
                    Log::info("SMS sent successfully to {$phone}", [
                        'response' => $responseData,
                        'client_id' => $client_id,
                        'report_id' => $report_id
                    ]);

                    // Log to database
                    try {
                        self::logToDatabase(
                            $phone, 
                            $message, 
                            'success', 
                            null, 
                            $httpCode, 
                            $responseData, 
                            $client_id, 
                            $report_id,
                            $responseData['request_id'] ?? null
                        );
                    } catch (\Exception $logException) {
                        // Even database logging failure shouldn't stop the process
                        Log::warning('Failed to log SMS to database', ['error' => $logException->getMessage()]);
                    }

                    return [
                        'success' => true,
                        'response' => $responseData,
                        'message' => 'SMS sent successfully',
                        'request_id' => $responseData['request_id'] ?? null
                    ];
                } else {
                    $errorMessage = self::extractErrorMessage($responseData);
                    Log::error("SMS API returned error for {$phone}", [
                        'error_message' => $errorMessage,
                        'response' => $responseData
                    ]);

                    // Log to database
                    try {
                        self::logToDatabase(
                            $phone, 
                            $message, 
                            'failed', 
                            $errorMessage, 
                            $httpCode, 
                            $responseData, 
                            $client_id, 
                            $report_id
                        );
                    } catch (\Exception $logException) {
                        Log::warning('Failed to log SMS to database', ['error' => $logException->getMessage()]);
                    }

                    return [
                        'success' => false,
                        'error' => $errorMessage,
                        'response' => $responseData,
                        'message' => 'SMS sending failed'
                    ];
                }
            } else {
                $errorMsg = "HTTP Error: {$httpCode}";
                if ($responseData) {
                    $errorMsg .= " - " . self::extractErrorMessage($responseData);
                }

                Log::error("SMS failed to send to {$phone}", [
                    'error' => $errorMsg,
                    'http_code' => $httpCode,
                    'response' => $responseData
                ]);

                // Log to database
                try {
                    self::logToDatabase(
                        $phone, 
                        $message, 
                        'failed', 
                        $errorMsg, 
                        $httpCode, 
                        $responseData, 
                        $client_id, 
                        $report_id
                    );
                } catch (\Exception $logException) {
                    Log::warning('Failed to log SMS to database', ['error' => $logException->getMessage()]);
                }

                return [
                    'success' => false,
                    'error' => $errorMsg,
                    'http_code' => $httpCode,
                    'response' => $responseData,
                    'message' => 'SMS sending failed'
                ];
            }
            
        } catch (\Exception $e) {
            // Log and return error response instead of throwing
            Log::error('Exception in SMS sending process', [
                'phone' => $phone,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Log to database with error - wrapped in try-catch
            try {
                self::logToDatabase($phone, $message, 'failed', $e->getMessage(), null, null, $client_id, $report_id);
            } catch (\Exception $logException) {
                Log::warning('Failed to log SMS exception to database', ['error' => $logException->getMessage()]);
            }
            
            return [
                'success' => false,
                'error' => 'SMS sending failed: ' . $e->getMessage(),
                'message' => 'Network error occurred'
            ];
        }
    }

    /**
     * Log SMS attempt to database
     */
    private static function logToDatabase(
        $phone, 
        $message, 
        $status, 
        $errorMessage = null, 
        $httpCode = null, 
        $responseData = null, 
        $clientId = null, 
        $campaignId = null,
        $requestId = null
    ) {
        try {
            // Check if table exists first
            if (!DB::getSchemaBuilder()->hasTable('selcom_sms_logs')) {
                Log::error('selcom_sms_logs table does not exist in database', [
                    'phone' => $phone,
                    'status' => $status
                ]);
                return;
            }

            // Prepare data
            $logData = [
                'phone' => $phone,
                'message' => $message,
                'status' => $status,
                'error_message' => $errorMessage,
                'http_code' => $httpCode,
                'response_data' => $responseData ? json_encode($responseData, JSON_UNESCAPED_UNICODE) : null,
                'client_id' => $clientId,
                'campaign_id' => $campaignId,
                'request_id' => $requestId,
                'sent_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Log attempt
            Log::info('Attempting to log SMS to database', [
                'phone' => $phone,
                'status' => $status,
                'client_id' => $clientId
            ]);

            // Insert record
            $inserted = DB::table('selcom_sms_logs')->insert($logData);
            
            if ($inserted) {
                Log::info('SMS logged to database successfully', [
                    'phone' => $phone,
                    'status' => $status,
                    'client_id' => $clientId
                ]);
            } else {
                Log::error('Failed to log SMS to database - insert returned false', [
                    'phone' => $phone,
                    'status' => $status,
                    'client_id' => $clientId
                ]);
            }

        } catch (\Illuminate\Database\QueryException $e) {
            // Database query exception (table missing, column issues, etc.)
            Log::error('Database query exception while logging SMS', [
                'error' => $e->getMessage(),
                'sql_state' => $e->getSqlState() ?? 'N/A',
                'error_code' => $e->getCode(),
                'phone' => $phone,
                'status' => $status,
                'query' => $e->getSql() ?? 'N/A',
                'bindings' => $e->getBindings() ?? []
            ]);
        } catch (\PDOException $e) {
            // PDO exception
            Log::error('PDO exception while logging SMS', [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'phone' => $phone,
                'status' => $status
            ]);
        } catch (\Exception $e) {
            // General exception
            Log::error('Exception while logging SMS to database', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'phone' => $phone,
                'status' => $status,
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    /**
     * Send SMS to multiple recipients (batch)
     * 
     * @param string $message Message content
     * @param array $recipients Array of phone numbers or array of ['phone' => '...', 'client_id' => ...]
     * @param int|null $campaign_id Optional campaign ID for logging
     * @return array
     */
    static function sendToMany($message, $recipients, $campaign_id = null)
    {
        if (empty($recipients)) {
            Log::warning('No recipients provided for batch SMS');
            return [
                'success' => false,
                'error' => 'No recipients provided',
                'summary' => [
                    'total_recipients' => 0,
                    'total_sent' => 0,
                    'total_failed' => 0
                ]
            ];
        }

        $results = [];
        $totalSent = 0;
        $totalFailed = 0;

        Log::info('Starting batch SMS sending via Selcom', [
            'total_recipients' => count($recipients),
            'campaign_id' => $campaign_id
        ]);

        // Process each recipient individually (Selcom API requires individual calls)
        foreach ($recipients as $index => $recipient) {
            $phone = is_array($recipient) ? $recipient['phone'] : $recipient;
            $client_id = is_array($recipient) ? ($recipient['client_id'] ?? ($index + 1)) : ($index + 1);
            
            $result = self::send($phone, $message, $client_id, $campaign_id);
            
            if ($result['success']) {
                $totalSent++;
            } else {
                $totalFailed++;
            }
            
            $results[] = [
                'phone' => $phone,
                'success' => $result['success'],
                'error' => $result['error'] ?? null
            ];

            // Small delay to avoid rate limiting (adjust as needed)
            if ($index < count($recipients) - 1) {
                usleep(200000); // 0.2 seconds delay
            }
        }

        Log::info('Batch SMS sending completed', [
            'total_sent' => $totalSent,
            'total_failed' => $totalFailed,
            'campaign_id' => $campaign_id
        ]);

        return [
            'success' => $totalSent > 0,
            'results' => $results,
            'summary' => [
                'total_recipients' => count($recipients),
                'total_sent' => $totalSent,
                'total_failed' => $totalFailed,
                'success_rate' => count($recipients) > 0 ? round(($totalSent / count($recipients)) * 100, 2) : 0
            ]
        ];
    }

    /**
     * Check if API response indicates success
     */
    private static function isResponseSuccessful($responseData)
    {
        if (!is_array($responseData)) {
            return false;
        }

        // Check for common success indicators
        if (isset($responseData['status']) && strtolower($responseData['status']) === 'success') {
            return true;
        }
        
        if (isset($responseData['success']) && $responseData['success'] === true) {
            return true;
        }

        // Check for error indicators
        if (isset($responseData['status']) && strtolower($responseData['status']) === 'error') {
            return false;
        }
        
        if (isset($responseData['error']) && !empty($responseData['error'])) {
            return false;
        }

        // If no clear error, assume success for 200 response
        return true;
    }

    /**
     * Extract error message from response
     */
    private static function extractErrorMessage($responseData)
    {
        if (!is_array($responseData)) {
            return 'Unknown error - Invalid response format';
        }

        // Try different possible error message fields
        $errorFields = ['message', 'error', 'error_message', 'description', 'detail', 'status'];
        
        foreach ($errorFields as $field) {
            if (isset($responseData[$field]) && !empty($responseData[$field])) {
                return is_string($responseData[$field]) ? $responseData[$field] : json_encode($responseData[$field]);
            }
        }

        return 'Unknown API error';
    }

    /**
     * Clean and format phone number
     */
    private static function cleanPhoneNumber($phone)
    {
        if (empty($phone)) {
            return null;
        }

        // Remove all non-numeric characters except +
        $phone = preg_replace('/[^0-9+]/', '', $phone);
        
        // Handle different Tanzanian number formats
        if (preg_match('/^0[6-9]\d{8}$/', $phone)) {
            // Convert 0XXXXXXXXX to 255XXXXXXXXX
            $phone = '255' . substr($phone, 1);
        } elseif (preg_match('/^[6-9]\d{8}$/', $phone)) {
            // Convert XXXXXXXXX to 255XXXXXXXXX
            $phone = '255' . $phone;
        } elseif (preg_match('/^255[6-9]\d{8}$/', $phone)) {
            // Already in correct format 255XXXXXXXXX
            // Keep as is
        } elseif (preg_match('/^\+255[6-9]\d{8}$/', $phone)) {
            // Convert +255XXXXXXXXX to 255XXXXXXXXX (remove +)
            $phone = substr($phone, 1);
        } else {
            // Try to extract valid number pattern
            if (preg_match('/255([6-9]\d{8})/', $phone, $matches)) {
                $phone = '255' . $matches[1];
            } elseif (preg_match('/([6-9]\d{8})/', $phone, $matches)) {
                $phone = '255' . $matches[1];
            }
        }
        
        // Final validation
        if (!preg_match('/^255[6-9]\d{8}$/', $phone)) {
            Log::warning('Invalid phone number format after cleaning', [
                'original' => func_get_args()[0],
                'cleaned' => $phone
            ]);
            return null;
        }
        
        return $phone;
    }
}

