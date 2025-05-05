<?php

namespace App\Services;

use GuzzleHttp\Client;

class SMSService
{
    protected $client;
    protected $apiKey;
    protected $sender;
    
    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.sms.api_key');
        $this->sender = config('services.sms.sender');
    }
    
    public function send($phoneNumber, $message)
    {
        try {
            // This is just an example, replace with your actual SMS provider's API
            $response = $this->client->post('https://api.yoursmsservice.com/send', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'to' => $phoneNumber,
                    'from' => $this->sender,
                    'message' => $message,
                ]
            ]);
            
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            \Log::error('SMS sending failed: ' . $e->getMessage());
            return false;
        }
    }
}