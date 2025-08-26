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
            $this->debugInfo = 'Valuation completed successfully';
        } catch (\Exception $e) {
            $this->handleError('Valuation failed', $e);
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
        $response = $this->createHttpClient()->get(self::BASE_URL);
        
        if (!$response->successful()) {
            throw new \Exception('Failed to load TRA page: HTTP ' . $response->status());
        }

        $html = $response->body();
        
        if (!$this->isValidTraPage($html)) {
            throw new \Exception('Invalid TRA page response');
        }

        return $this->extractSessionState($html, $response->headers());
    }

    /**
     * Load dropdown data methods
     */
    private function loadModels()
    {

        // dd( $this->selectedMake);
        $this->executeWithLoading(function () {
            $options = $this->makeAjaxRequest('ctl00$MainContent$ddlMake', [
                'ctl00$MainContent$ddlMake' => $this->selectedMake
            ], 'MainContent_ddlModel');
            
            $this->models = $options ?: [];
            
            if (empty($this->models)) {
                $this->error = 'No models found for the selected make.';
                Log::warning('No models found', [
                    'make' => $this->selectedMake,
                    'response_debug' => 'Check AJAX response parsing'
                ]);
            } else {
                $this->error = null; // Clear any previous errors
            }
           
        });
    }

    private function loadYears()
    {
        $this->executeWithLoading(function () {
            $options = $this->makeAjaxRequest('ctl00$MainContent$ddlModel', [
                'ctl00$MainContent$ddlMake' => $this->selectedMake,
                'ctl00$MainContent$ddlModel' => $this->selectedModel
            ], 'MainContent_ddlYear');
            
            $this->years = $options ?: [];
            
            if (empty($this->years) || count($this->years) <= 1) {
                $this->error = 'No years found for the selected model.';
            }
            
            Log::info('Loaded years', [
                'model' => $this->selectedModel,
                'years_count' => count($this->years)
            ]);
        });
    }

    private function loadCountries()
    {
        $this->executeWithLoading(function () {
            $options = $this->makeAjaxRequest('ctl00$MainContent$ddlYear', [
                'ctl00$MainContent$ddlMake' => $this->selectedMake,
                'ctl00$MainContent$ddlModel' => $this->selectedModel,
                'ctl00$MainContent$ddlYear' => $this->selectedYear
            ], 'MainContent_ddlCountry');
            
            $this->countries = $options ?: [];
            
            Log::info('Loaded countries', [
                'year' => $this->selectedYear,
                'countries_count' => count($this->countries)
            ]);
        });
    }

    private function loadFuelTypes()
    {
        $this->executeWithLoading(function () {
            $options = $this->makeAjaxRequest('ctl00$MainContent$ddlCountry', [
                'ctl00$MainContent$ddlMake' => $this->selectedMake,
                'ctl00$MainContent$ddlModel' => $this->selectedModel,
                'ctl00$MainContent$ddlYear' => $this->selectedYear,
                'ctl00$MainContent$ddlCountry' => $this->selectedCountry
            ], 'MainContent_ddlFuel');
            
            $this->fuelTypes = $options ?: [];
            
            Log::info('Loaded fuel types', [
                'country' => $this->selectedCountry,
                'fuel_types_count' => count($this->fuelTypes)
            ]);
        });
    }

    private function loadEngines()
    {
        $this->executeWithLoading(function () {
            $options = $this->makeAjaxRequest('ctl00$MainContent$ddlFuel', [
                'ctl00$MainContent$ddlMake' => $this->selectedMake,
                'ctl00$MainContent$ddlModel' => $this->selectedModel,
                'ctl00$MainContent$ddlYear' => $this->selectedYear,
                'ctl00$MainContent$ddlCountry' => $this->selectedCountry,
                'ctl00$MainContent$ddlFuel' => $this->selectedFuelType
            ], 'MainContent_ddlEngine');
            
            $this->engines = $options ?: [];
            
            Log::info('Loaded engines', [
                'fuel_type' => $this->selectedFuelType,
                'engines_count' => count($this->engines)
            ]);
        });
    }

    /**
     * Execute AJAX request with retry logic
     */
    private function makeAjaxRequest(string $eventTarget, array $fieldUpdates, string $targetDropdownId = null): array
    {
        return $this->executeWithRetry(function () use ($eventTarget, $fieldUpdates, $targetDropdownId) {
            $this->ensureValidSession();
            
            $postData = $this->buildAjaxPostData($eventTarget, $fieldUpdates);
            $response = $this->sendAjaxRequest($postData);
            
            $this->updateSessionFromResponse($response->body());
            
            return $this->parseAjaxResponse($response->body(), $targetDropdownId);
        });
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
     */
    private function buildAjaxPostData(string $eventTarget, array $fieldUpdates): array
    {
        $postData = $this->sessionState['formInputs'] ?? [];
        $postData['__EVENTTARGET'] = $eventTarget;
        $postData['__EVENTARGUMENT'] = '';
        $postData['__ASYNCPOST'] = 'true';
        
        // Add the panel update target
        $postData['ctl00$ctl08'] = 'ctl00$MainContent$ddlPanel|' . $eventTarget;
        
        foreach ($fieldUpdates as $field => $value) {
            $postData[$field] = $value;
        }
        
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
     */
    private function sendAjaxRequest(array $postData)
    {
        $response = $this->createHttpClient()
            ->withHeaders([
                'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
                'X-Requested-With' => 'XMLHttpRequest',
                'Origin' => 'https://umvvs.tra.go.tz',
                'Referer' => self::BASE_URL,
            ])
            ->withCookies($this->sessionState['cookies'] ?? [], 'umvvs.tra.go.tz')
            ->asForm()
            ->post(self::BASE_URL, $postData);

        if (!$response->successful()) {
            throw new \Exception('AJAX request failed: HTTP ' . $response->status());
        }

        return $response;
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
     * Parse AJAX response and extract options for specific dropdown
     */
    private function parseAjaxResponse(string $responseBody, string $targetDropdownId = null): array
    {
        $options = [];
        
        try {
            // Parse ASP.NET AJAX response format: length|type|id|content|...
            $parts = explode('|', $responseBody);
            
            for ($i = 0; $i < count($parts); $i += 4) {
                if (isset($parts[$i + 1], $parts[$i + 2], $parts[$i + 3]) && 
                    $parts[$i + 1] === 'updatePanel') {
                    
                    $panelId = $parts[$i + 2];
                    $html = $parts[$i + 3];
                    
                    // Extract options from the target dropdown if specified
                    if ($targetDropdownId) {
                        $options = $this->extractDropdownOptions($html, $targetDropdownId);
                        if (!empty($options)) {
                            break;
                        }
                    } else {
                        // Fallback: extract from any select element
                        $options = $this->extractSelectOptionsFromHtml($html);
                        if (!empty($options)) {
                            break;
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            Log::warning('Failed to parse AJAX response', [
                'error' => $e->getMessage(),
                'target_dropdown' => $targetDropdownId
            ]);
        }
        
        return $options;
    }

    /**
     * Extract options from specific dropdown by ID
     */
    private function extractDropdownOptions(string $html, string $dropdownId): array
    {
        $options = [];
        
        // Look for the specific dropdown by ID
        $pattern = '/<select[^>]*id\s*=\s*["\']' . preg_quote($dropdownId, '/') . '["\'][^>]*>(.*?)<\/select>/s';
        
        if (preg_match($pattern, $html, $selectMatch)) {
            preg_match_all('/<option[^>]*value\s*=\s*["\']([^"\']*)["\'][^>]*>([^<]*)<\/option>/i', 
                $selectMatch[1], $optionMatches, PREG_SET_ORDER);
            
            foreach ($optionMatches as $match) {
                $value = html_entity_decode(trim($match[1]));
                $text = html_entity_decode(trim($match[2]));
                
                if (!empty($text) && $value !== '0') {
                    $options[] = ['value' => $value, 'text' => $text];
                }
            }
        }
        
        return $options;
    }

    /**
     * Extract select options from HTML (fallback method)
     */
    private function extractSelectOptionsFromHtml(string $html): array
    {
        $options = [];
        
        if (preg_match('/<select[^>]*>(.*?)<\/select>/s', $html, $selectMatch)) {
            preg_match_all('/<option[^>]*value\s*=\s*["\']([^"\']*)["\'][^>]*>([^<]*)<\/option>/i', 
                $selectMatch[1], $optionMatches, PREG_SET_ORDER);
            
            foreach ($optionMatches as $match) {
                $value = html_entity_decode(trim($match[1]));
                $text = html_entity_decode(trim($match[2]));
                
                if (!empty($text) && $value !== '0') {
                    $options[] = ['value' => $value, 'text' => $text];
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
                $results[$label] = $value;
            }
            
            return [
                'status' => 'success',
                'data' => $results,
                'reference' => $results['Reference Number:'] ?? null,
                'total_taxes' => $results['TOTAL TAXES (TSHS):'] ?? null
            ];
        }
        
        // Check for error messages
        if (preg_match('/<span[^>]*class="[^"]*error[^"]*"[^>]*>([^<]+)<\/span>/i', $html, $errorMatch)) {
            return [
                'status' => 'error',
                'message' => trim(strip_tags($errorMatch[1]))
            ];
        }
        
        return [
            'status' => 'error',
            'message' => 'Unable to extract valuation results from response'
        ];
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

        // Extract all form inputs
        preg_match_all('/<input[^>]*name\s*=\s*["\']([^"\']+)["\'][^>]*value\s*=\s*["\']([^"\']*)["\'][^>]*>/i', 
            $html, $inputMatches, PREG_SET_ORDER);
        
        foreach ($inputMatches as $match) {
            $state['formInputs'][$match[1]] = html_entity_decode($match[2]);
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

        // Extract cookies
        $cookieHeaders = $headers['Set-Cookie'] ?? [];
        if (!is_array($cookieHeaders)) {
            $cookieHeaders = [$cookieHeaders];
        }
        
        foreach ($cookieHeaders as $cookie) {
            if (is_string($cookie) && strpos($cookie, '=') !== false) {
                [$name, $value] = explode('=', explode(';', $cookie)[0], 2);
                $state['cookies'][trim($name)] = trim($value);
            }
        }

        return $state;
    }

    /**
     * Update session state from response
     */
    private function updateSessionFromResponse(string $responseBody)
    {
        try {
            // For AJAX responses, parse the pipe-delimited format
            if (strpos($responseBody, '|') !== false) {
                $parts = explode('|', $responseBody);
                
                for ($i = 0; $i < count($parts); $i += 4) {
                    if (isset($parts[$i + 1], $parts[$i + 2], $parts[$i + 3]) && 
                        $parts[$i + 1] === 'hiddenField') {
                        $fieldName = $parts[$i + 2];
                        $fieldValue = $parts[$i + 3];
                        $this->sessionState['formInputs'][$fieldName] = $fieldValue;
                    }
                }
            } else {
                // For regular responses, extract updated form fields
                $this->updateFormFieldsFromHtml($responseBody);
            }
            
            $this->sessionState['timestamp'] = time();
            $this->saveSessionToCache();
            
        } catch (\Exception $e) {
            Log::warning('Failed to update session from response', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Update form fields from HTML response
     */
    private function updateFormFieldsFromHtml(string $html)
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
            'Accept' => '*/*',
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
     * Render the component view
     */
    public function render()
    {
        return view('livewire.vehicle-valuation');
    }
}