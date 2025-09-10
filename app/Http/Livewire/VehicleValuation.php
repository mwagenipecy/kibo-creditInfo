<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class VehicleValuation extends Component
{
    // Public properties for Livewire binding
    public $makes = [];
    public $models = [];
    public $years = [];
    public $countries = [];
    public $fuelTypes = [];
    public $engines = [];
    
    public $selectedMake = '';
    public $selectedModel = '';
    public $selectedYear = '';
    public $selectedCountry = '';
    public $selectedFuelType = '';
    public $selectedEngine = '';
    
    public $valuationResult = null;
    public $loading = false;
    public $error = null;
    public $debugInfo = '';
    
    // Private properties for internal state
    private $sessionState = [];
    private $cacheKey = '';
    
    // Configuration constants
    private const BASE_URL = 'https://umvvs.tra.go.tz/Default';
    private const CACHE_DURATION = 900; // 15 minutes
    private const MAX_RETRIES = 3;
    private const REQUEST_TIMEOUT = 90;

    /**
     * Initialize the component
     */
    public function mount()
    {
        $this->cacheKey = 'tra_session_' . session()->getId();
        $this->initializeMakes();
        
        try {
            $this->initializeSession();
        } catch (\Exception $e) {
            $this->handleError('Initialization failed', $e);
        }
    }

    /**
     * Livewire property updaters
     */
    public function updatedSelectedMake()
    {
        $this->resetCascadingFields();
        if ($this->selectedMake && $this->selectedMake !== '0') {
            $this->debugInfo = 'Make changed to: ' . $this->selectedMake . ' (' . $this->getSelectedText($this->makes, $this->selectedMake) . ')';
            $this->loadModels();
        }
    }

    public function updatedSelectedModel()
    {
        $this->resetFieldsAfterModel();
        if ($this->selectedModel && $this->selectedModel !== '0') {
            $this->loadYears();
        }
    }

    public function updatedSelectedYear()
    {
        $this->resetFieldsAfterYear();
        if ($this->selectedYear && $this->selectedYear !== '0') {
            $this->loadCountries();
        }
    }

    public function updatedSelectedCountry()
    {
        $this->resetFieldsAfterCountry();
        if ($this->selectedCountry && $this->selectedCountry !== '0') {
            $this->loadFuelTypes();
        }
    }

    public function updatedSelectedFuelType()
    {
        $this->resetFieldsAfterFuelType();
        if ($this->selectedFuelType && $this->selectedFuelType !== '0') {
            $this->loadEngines();
        }
    }

    /**
     * Public methods for user actions
     */
    public function getValuation()
    {
        if (!$this->validateRequiredFields()) {
            $this->error = 'Please select all required fields before getting valuation.';
            return;
        }

        $this->loading = true;
        $this->error = null;

        try {
            $result = $this->executeValuationRequest();
            $this->valuationResult = $result;
            $this->debugInfo = 'Valuation completed successfully via TRA';
        } catch (\Exception $e) {
            // Try fallback estimation when TRA is unavailable
            $fallbackResult = $this->getFallbackValuation();
            if ($fallbackResult) {
                $this->valuationResult = $fallbackResult;
                $this->error = 'TRA website unavailable. Showing estimated values for reference only.';
                $this->debugInfo = 'Fallback estimation provided - not official TRA values';
            } else {
                $this->handleError('Valuation failed', $e);
            }
        }

        $this->loading = false;
    }

    public function resetForm()
    {
        $this->selectedMake = '';
        $this->resetCascadingFields();
        $this->clearErrors();
        $this->clearCache();
        $this->initializeSession();
    }

    public function refreshSession()
    {
        $this->clearCache();
        $this->clearErrors();
        
        try {
            $this->initializeSession();
            $this->debugInfo = 'Session refreshed successfully';
        } catch (\Exception $e) {
            $this->handleError('Session refresh failed', $e);
        }
    }

    /**
     * Test TRA connection (for debugging)
     */
    public function testTraConnection()
    {
        try {
            $this->loading = true;
            $this->error = null;
            
            // Test basic connection
            $response = $this->createHttpClient()->timeout(30)->get(self::BASE_URL);
            
            if ($response->successful()) {
                $html = $response->body();
                
                // Check if we can find the make dropdown
                if (strpos($html, 'ddlMake') !== false) {
                    $this->debugInfo = '✅ TRA Connection Test: SUCCESS - Website accessible and form found';
                    
                    // Try to extract makes from the initial page
                    $makes = $this->extractDropdownOptions($html, 'MainContent_ddlMake');
                    if (!empty($makes)) {
                        $this->debugInfo .= ' - Found ' . count($makes) . ' makes available';
                    }
                    
                    // Test session state extraction
                    $sessionState = $this->extractSessionState($html, $response->headers());
                    if (!empty($sessionState['formInputs']['__VIEWSTATE'])) {
                        $this->debugInfo .= ' - Session state extracted (VIEWSTATE: ' . strlen($sessionState['formInputs']['__VIEWSTATE']) . ' chars)';
                    } else {
                        $this->debugInfo .= ' - ⚠️ No VIEWSTATE found';
                    }
                    
                    // Test form request for AUDI models
                    try {
                        $this->debugInfo .= ' - Testing form request...';
                        $testModels = $this->makeAjaxRequest('ctl00$MainContent$ddlMake', [
                            'ctl00$MainContent$ddlMake' => '2' // AUDI
                        ], 'MainContent_ddlModel');
                        
                        if (!empty($testModels)) {
                            $this->debugInfo .= ' ✅ Form request working (' . count($testModels) . ' AUDI models)';
                        } else {
                            $this->debugInfo .= ' ❌ Form request returned no models';
                        }
                    } catch (\Exception $formError) {
                        $this->debugInfo .= ' ❌ Form request failed: ' . $formError->getMessage();
                    }
                    
                } else {
                    $this->error = '⚠️ TRA form not found in response';
                    $this->debugInfo = 'HTML length: ' . strlen($html);
                }
            } else {
                $this->error = '❌ TRA Connection failed: HTTP ' . $response->status();
            }
            
        } catch (\Exception $e) {
            $this->error = '❌ TRA Connection error: ' . $e->getMessage();
            Log::error('TRA Connection Test Failed', ['error' => $e->getMessage()]);
        }
        
        $this->loading = false;
    }

    public function exportToPdf()
    {
        if (!$this->valuationResult) {
            $this->error = 'No valuation results to export. Please calculate valuation first.';
            return;
        }

        try {
            // Generate PDF content
            $html = view('exports.vehicle-valuation-pdf', [
                'valuationResult' => $this->valuationResult,
                'selectedMake' => $this->getSelectedText($this->makes, $this->selectedMake),
                'selectedModel' => $this->getSelectedText($this->models, $this->selectedModel),
                'selectedYear' => $this->getSelectedText($this->years, $this->selectedYear),
                'selectedCountry' => $this->getSelectedText($this->countries, $this->selectedCountry),
                'selectedFuelType' => $this->getSelectedText($this->fuelTypes, $this->selectedFuelType),
                'selectedEngine' => $this->getSelectedText($this->engines, $this->selectedEngine),
                'generatedAt' => now()->format('Y-m-d H:i:s'),
            ])->render();

            // Return downloadable PDF
            return response()->streamDownload(function() use ($html) {
                echo $html;
            }, 'vehicle-valuation-' . date('Y-m-d-H-i-s') . '.html', [
                'Content-Type' => 'text/html',
            ]);

        } catch (\Exception $e) {
            $this->handleError('PDF export failed', $e);
        }
    }

    private function getSelectedText(array $options, string $value): string
    {
        foreach ($options as $option) {
            if ($option['value'] == $value) {
                return $option['text'];
            }
        }
        return $value;
    }

    /**
     * Initialize session state
     */
    private function initializeSession()
    {
        if ($this->loadSessionFromCache()) {
            return;
        }

        $this->sessionState = $this->createFreshSession();
        $this->saveSessionToCache();
    }

    /**
     * Create a fresh session by loading the initial page
     */
    private function createFreshSession(): array
    {
        try {
            Log::info('Creating fresh TRA session...');
            
            $response = $this->createHttpClient()
                ->timeout(30)
                ->get(self::BASE_URL);
            
            if (!$response->successful()) {
                throw new \Exception('Failed to load TRA page: HTTP ' . $response->status());
            }

            $html = $response->body();
            
            if (!$this->isValidTraPage($html)) {
                Log::warning('Invalid TRA page response', ['html_length' => strlen($html)]);
                throw new \Exception('Invalid TRA page response');
            }

            $sessionState = $this->extractSessionState($html, $response->headers());
            Log::info('TRA session created successfully', ['viewstate_length' => strlen($sessionState['viewstate'] ?? '')]);
            
            return $sessionState;
            
        } catch (\Exception $e) {
            Log::error('Failed to create TRA session', ['error' => $e->getMessage()]);
            throw $e;
        }
    }

    /**
     * Load dropdown data methods
     */
    private function loadModels()
    {
        // Use real TRA data first, fallback if it fails
        try {
            $this->executeWithLoading(function () {
                $this->models = $this->makeAjaxRequest('ctl00$MainContent$ddlMake', [
                    'ctl00$MainContent$ddlMake' => $this->selectedMake
                ], 'MainContent_ddlModel');
                
                if (!empty($this->models)) {
                    $this->error = '';
                    $firstThreeModels = array_slice(array_column($this->models, 'text'), 0, 3);
                    $this->debugInfo = 'Models loaded from TRA for: ' . $this->getSelectedText($this->makes, $this->selectedMake) . ' (' . count($this->models) . ' models) - First 3: ' . implode(', ', $firstThreeModels);
                } else {
                    throw new \Exception('No models returned from TRA');
                }
            });
        } catch (\Exception $e) {
            // Fallback to offline data if TRA fails
            $this->models = $this->getFallbackModels($this->selectedMake);
            
            if (!empty($this->models)) {
                $this->error = 'TRA connection failed, using offline data. Error: ' . $e->getMessage();
                $this->debugInfo = 'Fallback models loaded for make: ' . $this->getSelectedText($this->makes, $this->selectedMake) . ' (ID: ' . $this->selectedMake . ')';
            } else {
                $this->error = 'No models available for the selected make.';
                $this->debugInfo = 'TRA failed and no fallback data for make ID: ' . $this->selectedMake;
            }
            
            Log::warning('TRA Models Request Failed', [
                'make' => $this->selectedMake,
                'error' => $e->getMessage()
            ]);
        }
    }

    private function loadYears()
    {
        try {
            $this->executeWithLoading(function () {
                $this->years = $this->makeAjaxRequest('ctl00$MainContent$ddlModel', [
                    'ctl00$MainContent$ddlMake' => $this->selectedMake,
                    'ctl00$MainContent$ddlModel' => $this->selectedModel
                ], 'MainContent_ddlYear');
                
                if (!empty($this->years)) {
                    $this->error = '';
                    $this->debugInfo = 'Years loaded successfully from TRA (' . count($this->years) . ' years)';
                } else {
                    throw new \Exception('No years returned from TRA');
                }
            });
        } catch (\Exception $e) {
            // Fallback to offline data if TRA fails
            $this->years = $this->getFallbackYears();
            $this->error = 'TRA connection failed for years, using default years. Error: ' . $e->getMessage();
            $this->debugInfo = 'Fallback years loaded (1990-' . date('Y') . ')';
            
            Log::warning('TRA Years Request Failed', [
                'make' => $this->selectedMake,
                'model' => $this->selectedModel,
                'error' => $e->getMessage()
            ]);
        }
    }

    private function loadCountries()
    {
        try {
            $this->executeWithLoading(function () {
                $this->countries = $this->makeAjaxRequest('ctl00$MainContent$ddlYear', [
                    'ctl00$MainContent$ddlMake' => $this->selectedMake,
                    'ctl00$MainContent$ddlModel' => $this->selectedModel,
                    'ctl00$MainContent$ddlYear' => $this->selectedYear
                ], 'MainContent_ddlCountry');
                
                if (!empty($this->countries)) {
                    $this->error = '';
                    $this->debugInfo = 'Countries loaded successfully from TRA (' . count($this->countries) . ' countries)';
                } else {
                    throw new \Exception('No countries returned from TRA');
                }
            });
        } catch (\Exception $e) {
            // Fallback to offline data if TRA fails
            $this->countries = $this->getFallbackCountries();
            $this->error = 'TRA connection failed for countries, using default countries. Error: ' . $e->getMessage();
            $this->debugInfo = 'Fallback countries loaded';
            
            Log::warning('TRA Countries Request Failed', [
                'make' => $this->selectedMake,
                'model' => $this->selectedModel,
                'year' => $this->selectedYear,
                'error' => $e->getMessage()
            ]);
        }
    }

    private function loadFuelTypes()
    {
        try {
            $this->executeWithLoading(function () {
                $this->fuelTypes = $this->makeAjaxRequest('ctl00$MainContent$ddlCountry', [
                    'ctl00$MainContent$ddlMake' => $this->selectedMake,
                    'ctl00$MainContent$ddlModel' => $this->selectedModel,
                    'ctl00$MainContent$ddlYear' => $this->selectedYear,
                    'ctl00$MainContent$ddlCountry' => $this->selectedCountry
                ], 'MainContent_ddlFuel');
                
                if (!empty($this->fuelTypes)) {
                    $this->error = '';
                    $this->debugInfo = 'Fuel types loaded successfully from TRA (' . count($this->fuelTypes) . ' fuel types)';
                } else {
                    throw new \Exception('No fuel types returned from TRA');
                }
            });
        } catch (\Exception $e) {
            // Fallback to offline data if TRA fails
            $this->fuelTypes = $this->getFallbackFuelTypes();
            $this->error = 'TRA connection failed for fuel types, using default fuel types. Error: ' . $e->getMessage();
            $this->debugInfo = 'Fallback fuel types loaded';
            
            Log::warning('TRA Fuel Types Request Failed', [
                'make' => $this->selectedMake,
                'model' => $this->selectedModel,
                'year' => $this->selectedYear,
                'country' => $this->selectedCountry,
                'error' => $e->getMessage()
            ]);
        }
    }

    private function loadEngines()
    {
        try {
            $this->executeWithLoading(function () {
                $this->engines = $this->makeAjaxRequest('ctl00$MainContent$ddlFuel', [
                    'ctl00$MainContent$ddlMake' => $this->selectedMake,
                    'ctl00$MainContent$ddlModel' => $this->selectedModel,
                    'ctl00$MainContent$ddlYear' => $this->selectedYear,
                    'ctl00$MainContent$ddlCountry' => $this->selectedCountry,
                    'ctl00$MainContent$ddlFuel' => $this->selectedFuelType
                ], 'MainContent_ddlEngine');
                
                if (!empty($this->engines)) {
                    $this->error = '';
                    $this->debugInfo = 'Engines loaded successfully from TRA (' . count($this->engines) . ' engines)';
                } else {
                    throw new \Exception('No engines returned from TRA');
                }
            });
        } catch (\Exception $e) {
            // Fallback to offline data if TRA fails
            $this->engines = $this->getFallbackEngines();
            $this->error = 'TRA connection failed for engines, using default engines. Error: ' . $e->getMessage();
            $this->debugInfo = 'Fallback engines loaded';
            
            Log::warning('TRA Engines Request Failed', [
                'make' => $this->selectedMake,
                'model' => $this->selectedModel,
                'year' => $this->selectedYear,
                'country' => $this->selectedCountry,
                'fuelType' => $this->selectedFuelType,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Execute AJAX request with retry logic and better error handling
     * FIXED: Now properly parses ASP.NET UpdatePanel responses
     */
    private function makeAjaxRequest(string $eventTarget, array $fieldUpdates, string $targetDropdownId = null): array
    {
        return $this->executeWithRetry(function () use ($eventTarget, $fieldUpdates, $targetDropdownId) {
            try {
                $this->ensureValidSession();
                
                $postData = $this->buildAjaxPostData($eventTarget, $fieldUpdates);
                $response = $this->sendAjaxRequest($postData);
                
                if (!$response->successful()) {
                    throw new \Exception('TRA server returned HTTP ' . $response->status());
                }
                
                $responseBody = $response->body();
                
                Log::info('TRA Response received', [
                    'event_target' => $eventTarget,
                    'response_length' => strlen($responseBody),
                    'response_preview' => substr($responseBody, 0, 500)
                ]);
                
                // Parse the ASP.NET UpdatePanel response
                $options = $this->parseAspNetUpdatePanelResponse($responseBody, $targetDropdownId);
                
                // Update session from response
                $this->updateSessionFromAspNetResponse($responseBody);
                
                Log::info('TRA AJAX Response parsed', [
                    'event_target' => $eventTarget,
                    'target_dropdown' => $targetDropdownId,
                    'options_count' => count($options),
                    'first_few_options' => array_slice($options, 0, 3)
                ]);
                
                return $options;
                
            } catch (\Exception $e) {
                Log::error('TRA AJAX Request Failed', [
                    'event_target' => $eventTarget,
                    'field_updates' => $fieldUpdates,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                throw $e;
            }
        });
    }

    /**
     * Parse ASP.NET UpdatePanel response format
     * FIXED: Now properly handles the pipe-delimited format
     */
    private function parseAspNetUpdatePanelResponse(string $responseBody, string $targetDropdownId = null): array
    {
        $options = [];
        
        try {
            // ASP.NET UpdatePanel responses are pipe-delimited
            // Format: length|type|id|content|length|type|id|content|...
            
            $parts = explode('|', $responseBody);
            
            for ($i = 0; $i < count($parts); $i += 4) {
                if (isset($parts[$i], $parts[$i + 1], $parts[$i + 2], $parts[$i + 3])) {
                    $length = $parts[$i];
                    $type = $parts[$i + 1];
                    $id = $parts[$i + 2];
                    $content = $parts[$i + 3];
                    
                    // Look for updatePanel content that matches our target dropdown
                    if ($type === 'updatePanel' && strpos($content, $targetDropdownId) !== false) {
                        $options = $this->extractDropdownOptions($content, $targetDropdownId);
                        break;
                    }
                }
            }
            
            // If we didn't find the specific dropdown in updatePanel, look in any HTML content
            if (empty($options) && $targetDropdownId) {
                // Sometimes the dropdown is in the main content block
                for ($i = 0; $i < count($parts); $i += 4) {
                    if (isset($parts[$i + 3]) && strpos($parts[$i + 3], $targetDropdownId) !== false) {
                        $options = $this->extractDropdownOptions($parts[$i + 3], $targetDropdownId);
                        if (!empty($options)) {
                            break;
                        }
                    }
                }
            }
            
            Log::info('ASP.NET UpdatePanel parsing result', [
                'parts_count' => count($parts) / 4,
                'target_dropdown' => $targetDropdownId,
                'options_found' => count($options)
            ]);
            
        } catch (\Exception $e) {
            Log::warning('Failed to parse ASP.NET UpdatePanel response', [
                'error' => $e->getMessage(),
                'target_dropdown' => $targetDropdownId,
                'response_preview' => substr($responseBody, 0, 200)
            ]);
        }
        
        return $options;
    }

    /**
     * Update session from ASP.NET response
     * FIXED: Now properly extracts __VIEWSTATE and other form fields from UpdatePanel response
     */
    private function updateSessionFromAspNetResponse(string $responseBody)
    {
        try {
            $parts = explode('|', $responseBody);
            
            for ($i = 0; $i < count($parts); $i += 4) {
                if (isset($parts[$i + 1], $parts[$i + 2], $parts[$i + 3])) {
                    $type = $parts[$i + 1];
                    $id = $parts[$i + 2];
                    $content = $parts[$i + 3];
                    
                    // Look for hiddenField updates (contains __VIEWSTATE, etc.)
                    if ($type === 'hiddenField') {
                        $this->sessionState['formInputs'][$id] = $content;
                        Log::info("Updated session field: $id", ['length' => strlen($content)]);
                    }
                    
                    // Extract form fields from any HTML content
                    if (strpos($content, '__VIEWSTATE') !== false) {
                        $this->extractFormFieldsFromHtml($content);
                    }
                }
            }
            
            $this->sessionState['timestamp'] = time();
            $this->saveSessionToCache();
            
        } catch (\Exception $e) {
            Log::warning('Failed to update session from ASP.NET response', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Extract form fields from HTML content
     */
    private function extractFormFieldsFromHtml(string $html)
    {
        $patterns = [
            '__VIEWSTATE' => '/<input[^>]*name=["\']__VIEWSTATE["\'][^>]*value=["\']([^"\']*)["\']/',
            '__EVENTVALIDATION' => '/<input[^>]*name=["\']__EVENTVALIDATION["\'][^>]*value=["\']([^"\']*)["\']/',
            '__VIEWSTATEGENERATOR' => '/<input[^>]*name=["\']__VIEWSTATEGENERATOR["\'][^>]*value=["\']([^"\']*)["\']/',
        ];

        foreach ($patterns as $field => $pattern) {
            if (preg_match($pattern, $html, $matches)) {
                $this->sessionState['formInputs'][$field] = html_entity_decode($matches[1]);
            }
        }
    }

    /**
     * Execute valuation request
     */
    private function executeValuationRequest(): array
    {
        return $this->executeWithRetry(function () {
            $this->ensureValidSession();
            
            $postData = $this->buildValuationPostData();
            $response = $this->sendValuationRequest($postData);
            
            return $this->extractValuationResults($response->body());
        });
    }

    /**
     * Build POST data for AJAX requests
     * FIXED: Now properly formats for ASP.NET UpdatePanel requests
     */
    private function buildAjaxPostData(string $eventTarget, array $fieldUpdates): array
    {
        $postData = $this->sessionState['formInputs'] ?? [];
        
        // Ensure we have the required ASP.NET fields
        if (empty($postData['__VIEWSTATE'])) {
            throw new \Exception('Missing __VIEWSTATE in session');
        }
        
        // For ASP.NET UpdatePanel requests
        $postData['ctl00$MainContent$ddlPanel'] = $eventTarget; // UpdatePanel ScriptManager
        $postData['__EVENTTARGET'] = $eventTarget;
        $postData['__EVENTARGUMENT'] = '';
        $postData['__ASYNCPOST'] = 'true';
        
        // Add all field updates
        foreach ($fieldUpdates as $field => $value) {
            $postData[$field] = $value;
        }
        
        // Ensure all dropdown fields have values (use current selections or '0')
        $dropdownFields = [
            'ctl00$MainContent$ddlMake' => $this->selectedMake ?: '0',
            'ctl00$MainContent$ddlModel' => $this->selectedModel ?: '0',
            'ctl00$MainContent$ddlYear' => $this->selectedYear ?: '0',
            'ctl00$MainContent$ddlCountry' => $this->selectedCountry ?: '0',
            'ctl00$MainContent$ddlFuel' => $this->selectedFuelType ?: '0',
            'ctl00$MainContent$ddlEngine' => $this->selectedEngine ?: '0',
        ];
        
        foreach ($dropdownFields as $field => $defaultValue) {
            if (!isset($postData[$field])) {
                $postData[$field] = $defaultValue;
            }
        }
        
        Log::info('Building ASP.NET UpdatePanel request', [
            'event_target' => $eventTarget,
            'field_updates' => $fieldUpdates,
            'post_data_keys' => array_keys($postData),
            'has_viewstate' => !empty($postData['__VIEWSTATE']),
            'viewstate_length' => strlen($postData['__VIEWSTATE'] ?? ''),
            'is_async' => isset($postData['__ASYNCPOST'])
        ]);
        
        return $postData;
    }

    /**
     * Build POST data for valuation request
     */
    private function buildValuationPostData(): array
    {
        $postData = $this->sessionState['formInputs'] ?? [];
        $postData['__EVENTTARGET'] = '';
        $postData['__EVENTARGUMENT'] = '';
        $postData['ctl00$MainContent$btnSearch'] = 'Calculate';
        
        // Add all selected values
        $postData['ctl00$MainContent$ddlMake'] = $this->selectedMake;
        $postData['ctl00$MainContent$ddlModel'] = $this->selectedModel;
        $postData['ctl00$MainContent$ddlYear'] = $this->selectedYear;
        $postData['ctl00$MainContent$ddlCountry'] = $this->selectedCountry;
        $postData['ctl00$MainContent$ddlFuel'] = $this->selectedFuelType;
        $postData['ctl00$MainContent$ddlEngine'] = $this->selectedEngine;
        
        // Remove async post for valuation
        unset($postData['__ASYNCPOST']);
        unset($postData['ctl00$ctl08']);
        
        return $postData;
    }

    /**
     * Send AJAX request
     * FIXED: Now properly handles ASP.NET UpdatePanel requests
     */
    private function sendAjaxRequest(array $postData)
    {
        try {
            $response = $this->createHttpClient()
                ->withHeaders([
                    'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
                    'Origin' => 'https://umvvs.tra.go.tz',
                    'Referer' => self::BASE_URL,
                    'Accept' => '*/*',
                    'Accept-Language' => 'en-US,en;q=0.9',
                    'Cache-Control' => 'no-cache',
                    'Pragma' => 'no-cache',
                    'X-Requested-With' => 'XMLHttpRequest',
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
                ])
                ->withCookies($this->sessionState['cookies'] ?? [], 'umvvs.tra.go.tz')
                ->asForm()
                ->post(self::BASE_URL, $postData);

            if (!$response->successful()) {
                throw new \Exception('ASP.NET UpdatePanel request failed: HTTP ' . $response->status());
            }

            return $response;
            
        } catch (\Exception $e) {
            Log::error('ASP.NET UpdatePanel request failed', [
                'error' => $e->getMessage(),
                'post_data_keys' => array_keys($postData)
            ]);
            throw $e;
        }
    }

    /**
     * Send valuation request
     */
    private function sendValuationRequest(array $postData)
    {
        $response = $this->createHttpClient()
            ->withHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Origin' => 'https://umvvs.tra.go.tz',
                'Referer' => self::BASE_URL,
                'Upgrade-Insecure-Requests' => '1',
            ])
            ->withCookies($this->sessionState['cookies'] ?? [], 'umvvs.tra.go.tz')
            ->asForm()
            ->post(self::BASE_URL, $postData);

        if (!$response->successful()) {
            throw new \Exception('Valuation request failed: HTTP ' . $response->status());
        }

        // Handle redirect to results page
        if ($response->status() === 302) {
            $location = $response->header('Location');
            if ($location) {
                $resultResponse = $this->createHttpClient()
                    ->withCookies($this->sessionState['cookies'] ?? [], 'umvvs.tra.go.tz')
                    ->get($location);
                
                if ($resultResponse->successful()) {
                    return $resultResponse;
                }
            }
        }

        return $response;
    }

    /**
     * Extract options from specific dropdown by ID
     * FIXED: Now handles both ID formats (with and without prefix)
     */
    private function extractDropdownOptions(string $html, string $dropdownId): array
    {
        $options = [];
        
        // Try both ID formats: with and without "MainContent_" prefix
        $idVariants = [$dropdownId];
        if (strpos($dropdownId, 'MainContent_') === 0) {
            $idVariants[] = substr($dropdownId, strlen('MainContent_'));
        } else {
            $idVariants[] = 'MainContent_' . $dropdownId;
        }
        
        foreach ($idVariants as $id) {
            // Look for the specific dropdown by ID
            $pattern = '/<select[^>]*id\s*=\s*["\']' . preg_quote($id, '/') . '["\'][^>]*>(.*?)<\/select>/s';
            
            if (preg_match($pattern, $html, $selectMatch)) {
                preg_match_all('/<option[^>]*value\s*=\s*["\']([^"\']*)["\'][^>]*>([^<]*)<\/option>/i', 
                    $selectMatch[1], $optionMatches, PREG_SET_ORDER);
                
                foreach ($optionMatches as $match) {
                    $value = html_entity_decode(trim($match[1]));
                    $text = html_entity_decode(trim($match[2]));
                    
                    // Skip "Select..." options and empty values
                    if (!empty($text) && $value !== '0' && !preg_match('/^select\s/i', $text)) {
                        $options[] = ['value' => $value, 'text' => $text];
                    }
                }
                
                if (!empty($options)) {
                    Log::info("Found options for dropdown $id", ['count' => count($options)]);
                    break;
                }
            }
        }
        
        return $options;
    }

    /**
     * Extract valuation results from HTML response
     */
    private function extractValuationResults(string $html): array
    {
        // Look for the results table
        if (preg_match('/<table[^>]*id="MainContent_UmvvcRecordDetails"[^>]*>(.*?)<\/table>/s', $html, $tableMatch)) {
            $tableContent = $tableMatch[1];
            $results = [];
            
            // Extract each row
            preg_match_all('/<tr[^>]*>.*?<td[^>]*>([^<]+)<\/td>.*?<td[^>]*>([^<]+)<\/td>.*?<\/tr>/s', 
                $tableContent, $rowMatches, PREG_SET_ORDER);
            
            foreach ($rowMatches as $match) {
                $label = trim(strip_tags($match[1]));
                $value = trim(strip_tags($match[2]));
                if (!empty($label) && !empty($value)) {
                    $results[$label] = $value;
                }
            }
            
            return $results;
        }
        
        // Check for error messages
        if (preg_match('/<span[^>]*class="[^"]*error[^"]*"[^>]*>([^<]+)<\/span>/i', $html, $errorMatch)) {
            throw new \Exception('TRA Error: ' . trim(strip_tags($errorMatch[1])));
        }
        
        throw new \Exception('Unable to extract valuation results from TRA response');
    }

    /**
     * Extract session state from HTML and headers
     */
    private function extractSessionState(string $html, array $headers): array
    {
        $state = [
            'formInputs' => [],
            'cookies' => [],
            'timestamp' => time()
        ];

        // Extract ASP.NET form fields (critical for AJAX requests)
        $patterns = [
            '__VIEWSTATE' => '/<input[^>]*name=["\']__VIEWSTATE["\'][^>]*value=["\']([^"\']*)["\']/',
            '__EVENTVALIDATION' => '/<input[^>]*name=["\']__EVENTVALIDATION["\'][^>]*value=["\']([^"\']*)["\']/',
            '__VIEWSTATEGENERATOR' => '/<input[^>]*name=["\']__VIEWSTATEGENERATOR["\'][^>]*value=["\']([^"\']*)["\']/',
        ];

        foreach ($patterns as $field => $pattern) {
            if (preg_match($pattern, $html, $matches)) {
                $state['formInputs'][$field] = html_entity_decode($matches[1]);
                Log::info("Extracted $field", ['length' => strlen($matches[1])]);
            } else {
                Log::warning("Failed to extract $field");
            }
        }

        // Extract all other form inputs
        preg_match_all('/<input[^>]*name\s*=\s*["\']([^"\']+)["\'][^>]*value\s*=\s*["\']([^"\']*)["\'][^>]*>/i', 
            $html, $inputMatches, PREG_SET_ORDER);
        
        foreach ($inputMatches as $match) {
            $name = $match[1];
            $value = html_entity_decode($match[2]);
            
            // Skip ASP.NET fields we already extracted
            if (!in_array($name, ['__VIEWSTATE', '__EVENTVALIDATION', '__VIEWSTATEGENERATOR'])) {
                $state['formInputs'][$name] = $value;
            }
        }

        // Extract select default values
        preg_match_all('/<select[^>]*name\s*=\s*["\']([^"\']+)["\'][^>]*>(.*?)<\/select>/s', 
            $html, $selectMatches, PREG_SET_ORDER);
        
        foreach ($selectMatches as $match) {
            $selectName = $match[1];
            $selectContent = $match[2];
            
            if (preg_match('/<option[^>]*selected[^>]*value\s*=\s*["\']([^"\']*)["\']/', $selectContent, $selectedMatch)) {
                $state['formInputs'][$selectName] = html_entity_decode($selectedMatch[1]);
            }
        }

        // Extract cookies from headers
        $cookieHeaders = [];
        if (isset($headers['Set-Cookie'])) {
            $cookieHeaders = is_array($headers['Set-Cookie']) ? $headers['Set-Cookie'] : [$headers['Set-Cookie']];
        } elseif (isset($headers['set-cookie'])) {
            $cookieHeaders = is_array($headers['set-cookie']) ? $headers['set-cookie'] : [$headers['set-cookie']];
        }
        
        foreach ($cookieHeaders as $cookie) {
            if (is_string($cookie) && strpos($cookie, '=') !== false) {
                [$name, $value] = explode('=', explode(';', $cookie)[0], 2);
                $state['cookies'][trim($name)] = trim($value);
            }
        }

        // Log session state summary
        Log::info('Session state extracted', [
            'form_inputs_count' => count($state['formInputs']),
            'cookies_count' => count($state['cookies']),
            'has_viewstate' => isset($state['formInputs']['__VIEWSTATE']),
            'viewstate_length' => strlen($state['formInputs']['__VIEWSTATE'] ?? '')
        ]);

        return $state;
    }

    /**
     * Utility methods
     */
    private function createHttpClient()
    {
        return Http::withOptions([
            'verify' => false,
            'timeout' => self::REQUEST_TIMEOUT,
            'connect_timeout' => 30,
            'allow_redirects' => false, // Handle redirects manually
            'http_errors' => false,
        ])->withHeaders([
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
            'Accept-Language' => 'en-US,en;q=0.9',
            'Accept-Encoding' => 'gzip, deflate, br',
            'DNT' => '1',
            'Connection' => 'keep-alive',
            'Cache-Control' => 'no-cache',
            'Pragma' => 'no-cache',
        ]);
    }

    private function executeWithLoading(callable $callback)
    {
        $this->loading = true;
        $this->error = null;
        
        try {
            $callback();
        } catch (\Exception $e) {
            $this->handleError('Operation failed', $e);
        }
        
        $this->loading = false;
    }

    private function executeWithRetry(callable $callback, int $maxRetries = self::MAX_RETRIES)
    {
        $retryCount = 0;
        
        while ($retryCount <= $maxRetries) {
            try {
                return $callback();
            } catch (\Exception $e) {
                if ($this->isViewStateError($e->getMessage())) {
                    $this->clearCache();
                    $this->initializeSession();
                }
                
                if ($retryCount >= $maxRetries) {
                    throw $e;
                }
                
                $retryCount++;
                sleep($retryCount); // Progressive delay
            }
        }
        
        throw new \Exception('Maximum retries exceeded');
    }

    private function ensureValidSession()
    {
        if (!$this->isSessionValid()) {
            $this->initializeSession();
        }
    }

    private function isSessionValid(): bool
    {
        return !empty($this->sessionState['formInputs']['__VIEWSTATE']) &&
               !empty($this->sessionState['formInputs']['__EVENTVALIDATION']) &&
               (time() - ($this->sessionState['timestamp'] ?? 0)) < self::CACHE_DURATION;
    }

    private function isValidTraPage(string $html): bool
    {
        return strpos($html, 'ddlMake') !== false && 
               strpos($html, '__VIEWSTATE') !== false;
    }

    private function isViewStateError(string $content): bool
    {
        return strpos($content, 'Validation of viewstate MAC failed') !== false ||
               strpos($content, 'ViewStateException') !== false ||
               strpos($content, 'Invalid viewstate') !== false;
    }

    private function validateRequiredFields(): bool
    {
        $required = [$this->selectedMake, $this->selectedModel, $this->selectedYear, 
                    $this->selectedCountry, $this->selectedFuelType, $this->selectedEngine];
        
        foreach ($required as $field) {
            if (empty($field) || $field === '0') {
                return false;
            }
        }
        
        return true;
    }

    private function handleError(string $context, \Exception $e)
    {
        Log::error($context, [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        
        $this->error = $context . ': ' . $e->getMessage();
    }

    private function clearErrors()
    {
        $this->error = null;
        $this->debugInfo = '';
        $this->valuationResult = null;
    }

    private function clearCache()
    {
        Cache::forget($this->cacheKey);
        $this->sessionState = [];
    }

    private function loadSessionFromCache(): bool
    {
        $cached = Cache::get($this->cacheKey);
        
        if ($cached && is_array($cached) && $this->isSessionValid()) {
            $this->sessionState = $cached;
            return true;
        }
        
        return false;
    }

    private function saveSessionToCache()
    {
        if (!empty($this->sessionState)) {
            Cache::put($this->cacheKey, $this->sessionState, self::CACHE_DURATION);
        }
    }

    private function initializeMakes()
    {
        $this->makes = [
            ['value' => '0', 'text' => 'Select Make'],
            ['value' => '1', 'text' => 'ALFA ROMEO'],
            ['value' => '2', 'text' => 'AUDI'],
            ['value' => '3', 'text' => 'BEIBEN'],
            ['value' => '4', 'text' => 'BENTLEY'],
            ['value' => '5', 'text' => 'BMW'],
            ['value' => '6', 'text' => 'CADILLAC'],
            ['value' => '7', 'text' => 'CHEVROLET'],
            ['value' => '8', 'text' => 'CHRYSLER'],
            ['value' => '9', 'text' => 'CHRYSLER JEEP'],
            ['value' => '10', 'text' => 'CITROEN'],
            ['value' => '11', 'text' => 'DACIA'],
            ['value' => '12', 'text' => 'DAEWOO'],
            ['value' => '13', 'text' => 'DAF'],
            ['value' => '14', 'text' => 'DAF CF / XF'],
            ['value' => '15', 'text' => 'DAIHATSU'],
            ['value' => '16', 'text' => 'DODGE'],
            ['value' => '17', 'text' => 'DONGFENG'],
            ['value' => '18', 'text' => 'ERF'],
            ['value' => '19', 'text' => 'FAW'],
            ['value' => '20', 'text' => 'FIAT'],
            ['value' => '21', 'text' => 'FODEN'],
            ['value' => '22', 'text' => 'FORD'],
            ['value' => '23', 'text' => 'FOTON'],
            ['value' => '24', 'text' => 'FREIGHTLINER'],
            ['value' => '25', 'text' => 'GMC'],
            ['value' => '26', 'text' => 'GREAT WALL'],
            ['value' => '27', 'text' => 'HAVAL'],
            ['value' => '28', 'text' => 'HINO'],
            ['value' => '29', 'text' => 'HONDA'],
            ['value' => '30', 'text' => 'HONGYAN'],
            ['value' => '31', 'text' => 'HOWO'],
            ['value' => '32', 'text' => 'HUMMER'],
            ['value' => '33', 'text' => 'HYUNDAI'],
            ['value' => '34', 'text' => 'INFINITY'],
            ['value' => '35', 'text' => 'ISUZU'],
            ['value' => '36', 'text' => 'IVECO'],
            ['value' => '37', 'text' => 'JAGUAR'],
            ['value' => '38', 'text' => 'KIA'],
            ['value' => '39', 'text' => 'LANDROVER'],
            ['value' => '40', 'text' => 'LDV'],
            ['value' => '41', 'text' => 'LEXUS'],
            ['value' => '42', 'text' => 'LINCOLIN'],
            ['value' => '43', 'text' => 'MAN'],
            ['value' => '44', 'text' => 'MAZDA'],
            ['value' => '45', 'text' => 'MERCEDES'],
            ['value' => '46', 'text' => 'MINI'],
            ['value' => '47', 'text' => 'MITSUBISHI'],
            ['value' => '48', 'text' => 'NISSAN'],
            ['value' => '49', 'text' => 'OPEL'],
            ['value' => '50', 'text' => 'PEUGEOT'],
            ['value' => '51', 'text' => 'PORSCHE'],
            ['value' => '52', 'text' => 'RENAULT'],
            ['value' => '53', 'text' => 'SAAB'],
            ['value' => '54', 'text' => 'SCANIA'],
            ['value' => '55', 'text' => 'SCODA'],
            ['value' => '56', 'text' => 'SEAT'],
            ['value' => '57', 'text' => 'SHACMAN'],
            ['value' => '58', 'text' => 'SMART'],
            ['value' => '59', 'text' => 'SSANGYONG'],
            ['value' => '60', 'text' => 'SUBARU'],
            ['value' => '61', 'text' => 'SUZUKI'],
            ['value' => '62', 'text' => 'TESLA'],
            ['value' => '63', 'text' => 'TOYOTA'],
            ['value' => '64', 'text' => 'VAUXHALL'],
            ['value' => '65', 'text' => 'VOLKSWAGEN'],
            ['value' => '66', 'text' => 'VOLVO'],
            ['value' => '67', 'text' => 'XCMG/HANVAN'],
        ];
    }

    // Reset methods for cascading dropdowns
    private function resetCascadingFields()
    {
        $this->models = [];
        $this->selectedModel = '';
        $this->resetFieldsAfterModel();
    }

    private function resetFieldsAfterModel()
    {
        $this->years = [];
        $this->selectedYear = '';
        $this->resetFieldsAfterYear();
    }

    private function resetFieldsAfterYear()
    {
        $this->countries = [];
        $this->selectedCountry = '';
        $this->resetFieldsAfterCountry();
    }

    private function resetFieldsAfterCountry()
    {
        $this->fuelTypes = [];
        $this->selectedFuelType = '';
        $this->resetFieldsAfterFuelType();
    }

    private function resetFieldsAfterFuelType()
    {
        $this->engines = [];
        $this->selectedEngine = '';
        $this->valuationResult = null;
    }

    /**
     * Fallback data methods for when TRA is unavailable
     */
    private function getFallbackModels(string $makeId): array
    {
        // Comprehensive fallback data for all makes
        $fallbackData = [
            '1' => [ // ALFA ROMEO
                ['value' => '1', 'text' => '156'],
                ['value' => '2', 'text' => '159'],
                ['value' => '3', 'text' => 'Giulietta'],
            ],
            '2' => [ // AUDI
                ['value' => '1', 'text' => 'A3'],
                ['value' => '2', 'text' => 'A4'],
                ['value' => '3', 'text' => 'A6'],
                ['value' => '4', 'text' => 'Q5'],
                ['value' => '5', 'text' => 'Q7'],
            ],
            '5' => [ // BMW
                ['value' => '1', 'text' => '3 Series'],
                ['value' => '2', 'text' => '5 Series'],
                ['value' => '3', 'text' => '7 Series'],
                ['value' => '4', 'text' => 'X1'],
                ['value' => '5', 'text' => 'X3'],
                ['value' => '6', 'text' => 'X5'],
                ['value' => '7', 'text' => 'X6'],
            ],
            '22' => [ // FORD
                ['value' => '1', 'text' => 'Focus'],
                ['value' => '2', 'text' => 'Fiesta'],
                ['value' => '3', 'text' => 'Explorer'],
                ['value' => '4', 'text' => 'Ranger'],
                ['value' => '5', 'text' => 'F-150'],
            ],
            '29' => [ // HONDA
                ['value' => '1', 'text' => 'Civic'],
                ['value' => '2', 'text' => 'Accord'],
                ['value' => '3', 'text' => 'CR-V'],
                ['value' => '4', 'text' => 'Pilot'],
                ['value' => '5', 'text' => 'Fit'],
            ],
            '63' => [ // TOYOTA
                ['value' => '1', 'text' => 'Corolla'],
                ['value' => '2', 'text' => 'Camry'],
                ['value' => '3', 'text' => 'RAV4'],
                ['value' => '4', 'text' => 'Prado'],
                ['value' => '5', 'text' => 'Hilux'],
                ['value' => '6', 'text' => 'Vitz'],
                ['value' => '7', 'text' => 'Mark X'],
                ['value' => '8', 'text' => 'Harrier'],
                ['value' => '9', 'text' => 'Land Cruiser'],
            ],
        ];

        return $fallbackData[$makeId] ?? [
            ['value' => '1', 'text' => 'Model 1'],
            ['value' => '2', 'text' => 'Model 2'],
            ['value' => '3', 'text' => 'Model 3'],
        ];
    }

    private function getFallbackYears(): array
    {
        $years = [];
        $currentYear = date('Y');
        for ($year = $currentYear; $year >= 1990; $year--) {
            $years[] = ['value' => (string)$year, 'text' => (string)$year];
        }
        return $years;
    }

    private function getFallbackCountries(): array
    {
        return [
            ['value' => '1', 'text' => 'Japan'],
            ['value' => '2', 'text' => 'Germany'],
            ['value' => '3', 'text' => 'United Kingdom'],
            ['value' => '4', 'text' => 'South Korea'],
            ['value' => '5', 'text' => 'Thailand'],
            ['value' => '6', 'text' => 'China'],
            ['value' => '7', 'text' => 'United States'],
            ['value' => '8', 'text' => 'India'],
        ];
    }

    private function getFallbackFuelTypes(): array
    {
        return [
            ['value' => '1', 'text' => 'Petrol'],
            ['value' => '2', 'text' => 'Diesel'],
            ['value' => '3', 'text' => 'Hybrid'],
            ['value' => '4', 'text' => 'Electric'],
        ];
    }

    private function getFallbackEngines(): array
    {
        return [
            ['value' => '1', 'text' => '1000cc'],
            ['value' => '2', 'text' => '1300cc'],
            ['value' => '3', 'text' => '1500cc'],
            ['value' => '4', 'text' => '1800cc'],
            ['value' => '5', 'text' => '2000cc'],
            ['value' => '6', 'text' => '2500cc'],
            ['value' => '7', 'text' => '3000cc'],
            ['value' => '8', 'text' => '3500cc'],
            ['value' => '9', 'text' => '4000cc'],
        ];
    }

    private function getFallbackValuation(): ?array
    {
        // Simple estimation based on vehicle age, make, and engine size
        $currentYear = date('Y');
        $vehicleAge = $currentYear - (int)$this->selectedYear;
        
        // Base values by make (rough estimates)
        $baseValues = [
            '1' => 12000,  // ALFA ROMEO
            '2' => 18000,  // AUDI
            '3' => 25000,  // BEIBEN
            '4' => 80000,  // BENTLEY
            '5' => 25000,  // BMW
            '6' => 35000,  // CADILLAC
            '7' => 14000,  // CHEVROLET
            '22' => 12000, // FORD
            '29' => 15000, // HONDA
            '33' => 13000, // HYUNDAI
            '35' => 18000, // ISUZU
            '38' => 12000, // KIA
            '44' => 14000, // MAZDA
            '45' => 35000, // MERCEDES
            '47' => 13000, // MITSUBISHI
            '48' => 12000, // NISSAN
            '60' => 16000, // SUBARU
            '61' => 9000,  // SUZUKI
            '63' => 16000, // TOYOTA
            '65' => 16000, // VOLKSWAGEN
            '66' => 25000, // VOLVO
        ];
        
        $baseValue = $baseValues[$this->selectedMake] ?? 5000;
        
        // Depreciation: 15% per year for first 5 years, then 8% per year
        if ($vehicleAge <= 5) {
            $depreciationRate = 0.15 * $vehicleAge;
        } else {
            $depreciationRate = 0.75 + (0.08 * ($vehicleAge - 5));
        }
        
        $depreciatedValue = $baseValue * (1 - min($depreciationRate, 0.85));
        
        // Engine size multiplier
        $engineText = $this->getSelectedText($this->engines, $this->selectedEngine);
        $engineSize = (int)filter_var($engineText, FILTER_SANITIZE_NUMBER_INT);
        if ($engineSize > 2000) {
            $depreciatedValue *= 1.3;
        } elseif ($engineSize > 1500) {
            $depreciatedValue *= 1.1;
        }
        
        // Calculate taxes (simplified)
        $importDuty = $depreciatedValue * 0.25;
        $vat = ($depreciatedValue + $importDuty) * 0.18;
        $exciseDuty = $depreciatedValue * 0.10;
        $totalTaxesUSD = $importDuty + $vat + $exciseDuty;
        $totalTaxesTSHS = $totalTaxesUSD * 2300; // Approximate exchange rate
        
        return [
            'Customs Value CIF (USD)' => number_format($depreciatedValue, 2),
            'Import Duty (USD)' => number_format($importDuty, 2),
            'VAT (USD)' => number_format($vat, 2),
            'Excise Duty (USD)' => number_format($exciseDuty, 2),
            'Total Import Taxes (USD)' => number_format($totalTaxesUSD, 2),
            'TOTAL TAXES (TSHS)' => number_format($totalTaxesTSHS, 2),
            'Vehicle Age' => $vehicleAge . ' years',
            'Note' => 'ESTIMATED VALUES - NOT OFFICIAL TRA CALCULATION'
        ];
    }

    /**
     * Render the component view
     */
    public function render()
    {
        return view('livewire.vehicle-valuation');
    }
}