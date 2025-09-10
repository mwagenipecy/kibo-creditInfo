<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CarListingExtractor
{
    /**
     * Extract car image and details from a listing URL
     */
    public function extractFromUrl(string $url): array
    {
        try {
            // Fetch the webpage content
            $response = Http::timeout(30)->get($url);
            
            if (!$response->successful()) {
                throw new \Exception('Failed to fetch URL content');
            }
            
            $html = $response->body();
            
            // Extract car details
            $carDetails = $this->extractCarDetails($html, $url);
            
            // Extract and download car image
            $imagePath = $this->extractAndDownloadImage($html, $url);
            
            return [
                'success' => true,
                'car_details' => $carDetails,
                'image_path' => $imagePath,
                'source_url' => $url
            ];
            
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'car_details' => null,
                'image_path' => null,
                'source_url' => $url
            ];
        }
    }
    
    /**
     * Extract car details from HTML content
     */
    private function extractCarDetails(string $html, string $url): array
    {
        $details = [
            'title' => $this->extractTitle($html),
            'price' => $this->extractPrice($html),
            'year' => $this->extractYear($html),
            'make' => $this->extractMake($html),
            'model' => $this->extractModel($html),
            'mileage' => $this->extractMileage($html),
            'color' => $this->extractColor($html),
            'engine_size' => $this->extractEngineSize($html),
            'transmission' => $this->extractTransmission($html),
            'fuel_type' => $this->extractFuelType($html),
            'description' => $this->extractDescription($html),
            'location' => $this->extractLocation($html),
        ];
        
        return array_filter($details); // Remove null/empty values
    }
    
    /**
     * Extract and download car image
     */
    private function extractAndDownloadImage(string $html, string $url): ?string
    {
        // Common image selectors for car listing sites
        $imageSelectors = [
            'img[data-src*="car"]',
            'img[alt*="car"]',
            'img[class*="main"]',
            'img[class*="primary"]',
            'img[class*="hero"]',
            '.car-image img',
            '.vehicle-image img',
            '.listing-image img',
            '.main-image img',
            'img[src*="car"]',
            'img[src*="vehicle"]',
            'img[src*="auto"]'
        ];
        
        $imageUrl = null;
        
        // Try to find image using various selectors
        foreach ($imageSelectors as $selector) {
            if (preg_match('/<img[^>]+' . preg_quote($selector, '/') . '[^>]*src=["\']([^"\']+)["\'][^>]*>/i', $html, $matches)) {
                $imageUrl = $matches[1];
                break;
            }
        }
        
        // Fallback: look for any img tag with src
        if (!$imageUrl && preg_match('/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/i', $html, $matches)) {
            $imageUrl = $matches[1];
        }
        
        if (!$imageUrl) {
            return null;
        }
        
        // Convert relative URLs to absolute
        if (strpos($imageUrl, 'http') !== 0) {
            $parsedUrl = parse_url($url);
            $baseUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];
            if (strpos($imageUrl, '/') === 0) {
                $imageUrl = $baseUrl . $imageUrl;
            } else {
                $imageUrl = $baseUrl . '/' . $imageUrl;
            }
        }
        
        // Download and store the image
        try {
            $imageResponse = Http::timeout(30)->get($imageUrl);
            
            if ($imageResponse->successful()) {
                $extension = $this->getImageExtension($imageResponse->header('Content-Type'));
                $filename = 'car-listing-' . Str::random(20) . '.' . $extension;
                $path = 'import-duty/car-listings/' . $filename;
                
                Storage::disk('public')->put($path, $imageResponse->body());
                
                return $path;
            }
        } catch (\Exception $e) {
            \Log::error('Failed to download car image: ' . $e->getMessage());
        }
        
        return null;
    }
    
    /**
     * Extract page title
     */
    private function extractTitle(string $html): ?string
    {
        if (preg_match('/<title[^>]*>([^<]+)<\/title>/i', $html, $matches)) {
            return trim($matches[1]);
        }
        return null;
    }
    
    /**
     * Extract price information
     */
    private function extractPrice(string $html): ?string
    {
        $pricePatterns = [
            '/\$[\d,]+/',
            '/USD[\s\$]?[\d,]+/',
            '/Price[:\s]*[\$]?[\d,]+/i',
            '/[\$]?[\d,]+[\s]*(?:USD|dollars?)/i'
        ];
        
        foreach ($pricePatterns as $pattern) {
            if (preg_match($pattern, $html, $matches)) {
                return trim($matches[0]);
            }
        }
        
        return null;
    }
    
    /**
     * Extract year
     */
    private function extractYear(string $html): ?string
    {
        if (preg_match('/(?:19|20)\d{2}/', $html, $matches)) {
            $year = (int)$matches[0];
            if ($year >= 1990 && $year <= (date('Y') + 1)) {
                return $matches[0];
            }
        }
        return null;
    }
    
    /**
     * Extract make
     */
    private function extractMake(string $html): ?string
    {
        $commonMakes = ['Toyota', 'Honda', 'BMW', 'Mercedes', 'Audi', 'Nissan', 'Ford', 'Chevrolet', 'Hyundai', 'Kia', 'Mazda', 'Subaru', 'Volkswagen', 'Lexus', 'Infiniti', 'Acura', 'Cadillac', 'Lincoln', 'Buick', 'Chrysler', 'Dodge', 'Jeep', 'Ram', 'GMC'];
        
        foreach ($commonMakes as $make) {
            if (stripos($html, $make) !== false) {
                return $make;
            }
        }
        
        return null;
    }
    
    /**
     * Extract model
     */
    private function extractModel(string $html): ?string
    {
        // This is more complex and would need specific patterns for each make
        // For now, we'll return null and let the user fill it manually
        return null;
    }
    
    /**
     * Extract mileage
     */
    private function extractMileage(string $html): ?string
    {
        if (preg_match('/(\d{1,3}(?:,\d{3})*)\s*(?:miles?|km|kilometers?)/i', $html, $matches)) {
            return $matches[1];
        }
        return null;
    }
    
    /**
     * Extract color
     */
    private function extractColor(string $html): ?string
    {
        $commonColors = ['White', 'Black', 'Silver', 'Gray', 'Red', 'Blue', 'Green', 'Yellow', 'Orange', 'Brown', 'Gold', 'Beige', 'Purple', 'Pink'];
        
        foreach ($commonColors as $color) {
            if (stripos($html, $color) !== false) {
                return $color;
            }
        }
        
        return null;
    }
    
    /**
     * Extract engine size
     */
    private function extractEngineSize(string $html): ?string
    {
        if (preg_match('/(\d+\.?\d*)\s*L/i', $html, $matches)) {
            return $matches[1] . 'L';
        }
        return null;
    }
    
    /**
     * Extract transmission
     */
    private function extractTransmission(string $html): ?string
    {
        if (preg_match('/(Automatic|Manual|CVT)/i', $html, $matches)) {
            return $matches[1];
        }
        return null;
    }
    
    /**
     * Extract fuel type
     */
    private function extractFuelType(string $html): ?string
    {
        if (preg_match('/(Gasoline|Petrol|Diesel|Electric|Hybrid|Gas)/i', $html, $matches)) {
            return $matches[1];
        }
        return null;
    }
    
    /**
     * Extract description
     */
    private function extractDescription(string $html): ?string
    {
        if (preg_match('/<meta[^>]+name=["\']description["\'][^>]+content=["\']([^"\']+)["\'][^>]*>/i', $html, $matches)) {
            return trim($matches[1]);
        }
        return null;
    }
    
    /**
     * Extract location
     */
    private function extractLocation(string $html): ?string
    {
        if (preg_match('/(?:Location|Located)[:\s]*([^<\n]+)/i', $html, $matches)) {
            return trim($matches[1]);
        }
        return null;
    }
    
    /**
     * Get image extension from content type
     */
    private function getImageExtension(string $contentType): string
    {
        $mimeTypes = [
            'image/jpeg' => 'jpg',
            'image/jpg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp'
        ];
        
        return $mimeTypes[$contentType] ?? 'jpg';
    }
}
