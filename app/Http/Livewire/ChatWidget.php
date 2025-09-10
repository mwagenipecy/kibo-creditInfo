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
                'help' => 'I need help with my account',
                'loan' => 'Tell me about loan services',
                'vehicle' => 'I want to buy a vehicle',
                'spare' => 'I need spare parts',
                'contact' => 'How can I contact support?'
            ],
            'sw' => [
                'help' => 'Nahitaji msaada kuhusu akaunti yangu',
                'loan' => 'Nieleze kuhusu huduma za mkopo',
                'vehicle' => 'Nataka kununua gari',
                'spare' => 'Nahitaji vipuri',
                'contact' => 'Nawezaje kuwasiliana na msaada?'
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
                'text' => 'Hello! I\'m KiboAuto AI Assistant. How can I help you today?',
                'quick_actions' => [
                    'help' => 'Account Help',
                    'loan' => 'Loan Services',
                    'vehicle' => 'Find Vehicle',
                    'spare' => 'Spare Parts',
                    'contact' => 'Contact Support'
                ]
            ],
            'sw' => [
                'text' => 'Hujambo! Mimi ni Msaidizi wa KiboAuto AI. Ninaweza kukusaidiaje leo?',
                'quick_actions' => [
                    'help' => 'Msaada wa Akaunti',
                    'loan' => 'Huduma za Mkopo',
                    'vehicle' => 'Tafuta Gari',
                    'spare' => 'Vipuri',
                    'contact' => 'Msaada wa Mawasiliano'
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


