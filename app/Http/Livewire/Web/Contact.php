<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;

class Contact extends Component
{

    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $phone = '';
    public $subject = '';
    public $message = '';
    public $success_message = '';

    protected $rules = [
        'first_name' => 'required|min:2',
        'last_name' => 'required|min:2',
        'email' => 'required|email',
        'phone' => 'required|min:10',
        'subject' => 'required|min:5',
        'message' => 'required|min:10',
    ];

    public function submitForm()
    {
        $this->validate();

        // Here you would typically save to database or send email
        // For now, we'll just show a success message
        
        $this->success_message = 'Thank you for your message! We will get back to you within 24 hours.';
        
        // Reset form
        $this->reset(['first_name', 'last_name', 'email', 'phone', 'subject', 'message']);
    }

    
    public function render()
    {
        return view('livewire.web.contact');
    }
}
