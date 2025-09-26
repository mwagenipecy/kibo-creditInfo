<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NidaNumberRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Remove any spaces or special characters except hyphens
        $cleaned = preg_replace('/[^0-9-]/', '', $value);
        
        // Check if the value is empty after cleaning
        if (empty($cleaned)) {
            return false;
        }
        
        // Check if the value contains only digits and hyphens
        if (!preg_match('/^[0-9-]+$/', $cleaned)) {
            return false;
        }
        
        // Check if the value is exactly 23 characters (YYYYMMDD-XXXXX-XXXXX-XX)
        if (strlen($cleaned) !== 23) {
            return false;
        }
        
        // Check if the value starts with a year greater than 1900
        $year = substr($cleaned, 0, 4);
        if (!is_numeric($year) || $year < 1900) {
            return false;
        }
        
        // Check if the value follows the format: YYYYMMDD-XXXXX-XXXXX-XX
        // This is a more flexible check that allows for the format but doesn't enforce strict structure
        $parts = explode('-', $cleaned);
        
        // Should have 4 parts separated by hyphens
        if (count($parts) !== 4) {
            return false;
        }
        
        // First part should be 8 digits (YYYYMMDD)
        if (!preg_match('/^\d{8}$/', $parts[0])) {
            return false;
        }
        
        // Second part should be 5 digits
        if (!preg_match('/^\d{5}$/', $parts[1])) {
            return false;
        }
        
        // Third part should be 5 digits
        if (!preg_match('/^\d{5}$/', $parts[2])) {
            return false;
        }
        
        // Fourth part should be 2 digits
        if (!preg_match('/^\d{2}$/', $parts[3])) {
            return false;
        }
        
        // Validate the date part (YYYYMMDD)
        $year = substr($parts[0], 0, 4);
        $month = substr($parts[0], 4, 2);
        $day = substr($parts[0], 6, 2);
        
        if (!checkdate($month, $day, $year)) {
            return false;
        }
        
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The NIDA number must be in the format: YYYYMMDD-XXXXX-XXXXX-XX and start with a year greater than 1900.';
    }
}