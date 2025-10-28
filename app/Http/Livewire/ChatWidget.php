<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\AiChatService;
use Illuminate\Support\Facades\Auth;

class ChatWidget extends Component
{
    public bool $isOpen = false;
    public string $language = 'en';
    public string $currentMessage = '';
    public bool $isLoading = false;
    public bool $isMinimized = false;
    public string $quickAction = '';
    public bool $showQuickActions = true;
    public int $unreadCount = 0;
    
    /**
     * @var array<int, array{text:string,sender:string,timestamp:string,id:string}>
     */
    public array $messages = [];

    protected $rules = [
        'currentMessage' => 'required|string|min:1|max:1000',
        'language' => 'required|in:en,sw',
    ];

    protected $listeners = ['focusInput'];

    public function mount(): void
    {
        // Add welcome message
        $this->addWelcomeMessage();
    }

    public function toggle(): void
    {
        $this->isOpen = !$this->isOpen;
        if ($this->isOpen) {
            $this->unreadCount = 0;
            $this->isMinimized = false;
            $this->emit('scrollToBottom');
        }
    }

    public function minimize(): void
    {
        $this->isMinimized = true;
    }

    public function maximize(): void
    {
        $this->isMinimized = false;
        $this->unreadCount = 0;
        $this->emit('scrollToBottom');
    }

    public function setLanguage(string $lang): void
    {
        if (in_array($lang, ['en', 'sw'], true)) {
            $this->language = $lang;
            $this->addWelcomeMessage();
        }
    }

    public function sendMessage(AiChatService $aiChatService): void
    {
        $this->validate();

        $messageText = trim($this->currentMessage);
        $this->addMessage($messageText, 'user');
        $this->isLoading = true;
        $this->currentMessage = '';

        try {
            $reply = $aiChatService->chat($this->language, $messageText);
            $this->addMessage($reply, 'bot');
        } finally {
            $this->isLoading = false;
        }
    }

    public function sendQuickAction(string $action): void
    {
        $quickMessages = [
            'en' => [
                'recommend' => 'What car would you recommend for me?',
                'budget' => 'What are good cars under $20,000?',
                'compare' => 'Compare Toyota Camry vs Honda Accord',
                'fuel' => 'Which cars have the best fuel efficiency?',
                'luxury' => 'What are the best luxury cars in 2024?'
            ],
            'sw' => [
                'recommend' => 'Ni gari gani ungependa kunipendekeza?',
                'budget' => 'Ni magari gani mazuri chini ya dola 20,000?',
                'compare' => 'Linganisha Toyota Camry na Honda Accord',
                'fuel' => 'Ni magari gani yanayotumia mafuta vizuri?',
                'luxury' => 'Ni magari gani bora ya anasa mwaka 2024?'
            ]
        ];

        $message = $quickMessages[$this->language][$action] ?? $action;
        $this->currentMessage = $message;
        $this->sendMessage(app(AiChatService::class));
    }

    public function clearChat(): void
    {
        $this->messages = [];
        $this->addWelcomeMessage();
    }

    public function focusInput(): void
    {
        $this->emit('focusChatInput');
    }

    private function addMessage(string $text, string $sender): void
    {
        $this->messages[] = [
            'id' => uniqid(),
            'text' => $text,
            'sender' => $sender,
            'timestamp' => now()->format('H:i'),
        ];

        if ($sender === 'bot' && !$this->isOpen) {
            $this->unreadCount++;
        }

        $this->emit('scrollToBottom');
    }

    private function addWelcomeMessage(): void
    {
        $welcomeMessages = [
            'en' => [
                'text' => 'Hello! I am KiboAuto Car Consultant AI. I specialize in car consultation worldwide. What car question can I help you with today?',
                'quick_actions' => [
                    'recommend' => 'Car Recommendations',
                    'budget' => 'Budget Cars',
                    'compare' => 'Compare Cars',
                    'fuel' => 'Fuel Efficient',
                    'luxury' => 'Luxury Cars'
                ]
            ],
            'sw' => [
                'text' => 'Hujambo! Mimi ni Mshauri wa Magari wa KiboAuto AI. Ninatoa ushauri wa magari duniani kote. Ni swali gani la magari ninaweza kukusaidia leo?',
                'quick_actions' => [
                    'recommend' => 'Mapendekezo ya Magari',
                    'budget' => 'Magari ya Bajeti',
                    'compare' => 'Linganisha Magari',
                    'fuel' => 'Yanayotumia Mafuta Vizuri',
                    'luxury' => 'Magari ya Anasa'
                ]
            ]
        ];

        $welcome = $welcomeMessages[$this->language];
        
        if (empty($this->messages)) {
            $this->addMessage($welcome['text'], 'bot');
        }
    }

    public function render()
    {
        return view('livewire.chat-widget');
    }
}


