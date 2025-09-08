<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AiChatService
{
    private string $endpoint = 'https://openrouter.ai/api/v1/chat/completions';
    private string $model = 'google/gemini-2.5-flash-image-preview:free';

    public function chat(string $language, string $userMessage): string
    {
        $apiKey = config('services.openrouter.key', env('OPENROUTER_API_KEY'));
        if (!$apiKey) {
            return $this->getFallbackMessage($language, 'no_config');
        }

        // Enhanced system prompts with more context
        $systemPromptEn = 'You are KiboAuto AI Assistant, a helpful chatbot for the KiboAuto platform. You help users with:

1. Vehicle marketplace - finding, buying, selling vehicles
2. Vehicle rentals - short and long term rentals
3. Spare parts - finding and purchasing vehicle parts
4. Garage services - maintenance and repair services
5. Insurance services - vehicle insurance options
6. Loan services - vehicle financing and import duty loans
7. Account management - user accounts, applications, and support
8. General platform guidance

Guidelines:
- Be friendly, helpful, and professional
- Provide specific, actionable advice when possible
- If you don\'t know something, suggest contacting KiboAuto support
- Keep responses concise but informative
- Use emojis sparingly and appropriately
- For complex issues, direct users to human support

Current time: ' . now()->format('Y-m-d H:i:s') . ' EAT';

        $systemPromptSw = 'Wewe ni Msaidizi wa KiboAuto AI, chatbot wa kusaidia kwa jukwaa la KiboAuto. Unasaidia watumiaji kwa:

1. Soko la magari - kutafuta, kununua, kuuza magari
2. Kukodi magari - kukodi kwa muda mfupi na mrefu
3. Vipuri - kutafuta na kununua vipuri vya magari
4. Huduma za gereji - matengenezo na huduma za magari
5. Huduma za bima - chaguzi za bima ya magari
6. Huduma za mkopo - ufadhili wa magari na mikopo ya ushuru wa magari
7. Usimamizi wa akaunti - akaunti za watumiaji, maombi, na msaada
8. Mwongozo wa jukwaa kwa ujumla

Miongozo:
- Kuwa mwenye urafiki, msaada, na mwenye kiprofesheni
- Toa ushauri maalum na wa vitendo iwezekanavyo
- Ikiwa haujui kitu, pendekeza kuwasiliana na msaada wa KiboAuto
- Weka majibu mafupi lakini ya kufahamisha
- Tumia emoji kidogo na kwa kufaa
- Kwa masuala magumu, mwelekeze watumiaji kwa msaada wa binadamu

Muda wa sasa: ' . now()->format('Y-m-d H:i:s') . ' EAT';

        $system = $language === 'sw' ? $systemPromptSw : $systemPromptEn;

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => config('app.url', url('/')),
                'X-Title' => config('app.name', 'KiboAuto'),
            ])->timeout(30)->post($this->endpoint, [
                'model' => $this->model,
                'messages' => [
                    ['role' => 'system', 'content' => $system],
                    ['role' => 'user', 'content' => $userMessage],
                ],
                'temperature' => 0.7,
                'max_tokens' => 500,
            ]);

            if (!$response->ok()) {
                \Log::error('AI Chat API Error', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                    'user_message' => $userMessage
                ]);
                return $this->getFallbackMessage($language, 'api_error');
            }

            $data = $response->json();
            $text = $data['choices'][0]['message']['content'] ?? '';
            
            if (!is_string($text) || trim($text) === '') {
                return $this->getFallbackMessage($language, 'empty_response');
            }

            // Log successful interactions for monitoring
            \Log::info('AI Chat Success', [
                'language' => $language,
                'user_message_length' => strlen($userMessage),
                'response_length' => strlen($text)
            ]);

            return trim($text);
        } catch (\Throwable $e) {
            \Log::error('AI Chat Exception', [
                'message' => $e->getMessage(),
                'user_message' => $userMessage,
                'language' => $language
            ]);
            return $this->getFallbackMessage($language, 'network_error');
        }
    }

    private function getFallbackMessage(string $language, string $errorType): string
    {
        $messages = [
            'en' => [
                'no_config' => 'Sorry, AI service is not configured. Please contact the KiboAuto team at support@kiboauto.co.tz or call +255 XXX XXX XXX.',
                'api_error' => 'Sorry, the AI service encountered an issue. Please try again in a moment or contact our support team.',
                'empty_response' => 'I apologize, but I couldn\'t generate a response. Please rephrase your question or contact our support team.',
                'network_error' => 'Sorry, a network error occurred. Please check your internet connection and try again, or contact our support team.'
            ],
            'sw' => [
                'no_config' => 'Samahani, huduma ya AI haijasanidiwa. Tafadhali wasiliana na timu ya KiboAuto kwa support@kiboauto.co.tz au piga +255 XXX XXX XXX.',
                'api_error' => 'Samahani, huduma ya AI imekumbana na tatizo. Tafadhali jaribu tena baada ya muda au wasiliana na timu yetu ya msaada.',
                'empty_response' => 'Ninasikitika, lakini sikuweza kutoa jibu. Tafadhali eleza swali lako kwa njia nyingine au wasiliana na timu yetu ya msaada.',
                'network_error' => 'Samahani, hitilafu ya mtandao imetokea. Tafadhali angalia muunganisho wako wa mtandao na jaribu tena, au wasiliana na timu yetu ya msaada.'
            ]
        ];

        return $messages[$language][$errorType] ?? $messages['en'][$errorType];
    }
}



