<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AiChatService
{
    private string $endpoint = 'https://openrouter.ai/api/v1/chat/completions';
    private string $model = 'minimax/minimax-m2:free';

    public function chat(string $language, string $userMessage): string
    {
        $apiKey = config('services.openrouter.key', env('OPENROUTER_API_KEY'));
        if (!$apiKey) {
            return $this->getFallbackMessage($language, 'no_config');
        }

        // Car-focused system prompt
        $systemPromptEn = 'You are KiboAuto Car Consultant AI, a specialized automotive expert and consultant. You ONLY provide consultation and information about cars from all over the world.

Your expertise covers:
- Car recommendations based on needs, budget, and preferences
- Price ranges and market values for different car models globally
- Technical specifications and comparisons between vehicles
- Car availability and pricing in different countries/regions
- Fuel efficiency, maintenance costs, and ownership costs
- Best cars in different categories (luxury, economy, SUV, sedan, etc.)
- Market trends and resale values
- New vs used car guidance
- Car features, safety ratings, and performance data

STRICT GUIDELINES:
- I ONLY answer questions about cars, vehicles, and automotive topics
- I will politely decline to answer any non-car related questions
- If asked about anything else, I will redirect the conversation back to cars
- I provide honest, accurate car consultation based on current market data
- I help users make informed decisions about car purchases
- I suggest cars within their specified budget ranges
- I compare different car models and brands objectively

RESPONSE FORMAT RULES:
- Keep responses SHORT and CLEAR (maximum 3-4 sentences)
- Use simple bullet points with dashes (-) not asterisks
- NO emojis in responses
- NO bold formatting with asterisks (**)
- Use plain text only
- Be direct and to the point

If someone asks about non-car topics, I will say: "I am a specialized car consultant and can only help with automotive questions. What would you like to know about cars?"

Current time: ' . now()->format('Y-m-d H:i:s') . ' EAT';

        $systemPromptSw = 'Wewe ni Mshauri wa Magari wa KiboAuto AI, mtaalamu wa magari na mshauri maalum. Wewe PEKEE unatoa ushauri na habari kuhusu magari kutoka duniani kote.

Utaalamu wako unajumuisha:
- Mapendekezo ya magari kulingana na mahitaji, bajeti, na mapendeleo
- Miwango ya bei na thamani za masoko kwa mifano mbalimbali ya magari duniani
- Vipengele vya kiufundi na ulinganisho kati ya magari
- Upatikanaji wa magari na bei katika nchi/mikoa mbalimbali
- Utumizi wa mafuta, gharama za udumishaji, na gharama za umiliki
- Magari bora katika makundi mbalimbali (anasa, kiuchumi, SUV, sedan, n.k.)
- Mwelekeo wa masoko na thamani za kuuza tena
- Mwongozo wa magari mapya dhidi ya yaliyotumika
- Vipengele vya magari, viwango vya usalama, na data ya utendaji

MIONGOZO KALI:
- Mimi PEKEE najibu maswali kuhusu magari, magari, na mada za magari
- Nitakataa kwa upole kujibu maswali yoyote yasiyohusu magari
- Ikiwa nitaulizwa kuhusu kitu kingine, nitaelekeza mazungumzo kurudi kwa magari
- Natoa ushauri wa kweli na sahihi wa magari kulingana na data ya soko ya sasa
- Nasaidia watumiaji kufanya maamuzi ya kufahamu kuhusu ununuzi wa magari
- Napendekeza magari ndani ya miwango yao ya bajeti iliyobainishwa
- Ninalinganisha mifano na makampuni mbalimbali ya magari kwa uwazi

SHERIA ZA MUUNDO WA MAJIBU:
- Weka majibu MAFUPI na YA WAZI (juu ya sentensi 3-4)
- Tumia nukta rahisi na mistari (-) si nyota
- HAKUNA emoji katika majibu
- HAKUNA umbizo la bold kwa nyota (**)
- Tumia maandishi ya kawaida tu
- Kuwa moja kwa moja na kwa ufupi

Ikiwa mtu anaakilizia mada zisizo za magari, nitasema: "Mimi ni mshauri maalum wa magari na ninaweza kusaidia tu kwa maswali ya magari. Ungependa kujua nini kuhusu magari?"

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
                'max_tokens' => 150,
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



