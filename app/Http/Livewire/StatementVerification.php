<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StatementVerification extends Component
{
    public $statement;
    public $showModal = false;
    public $isVerified = false;

    public function mount($statement = null)
    {
        $this->statement = $statement;
        
        // Check if statement is verified based on JSON data
        if (isset($this->statement['1d_analysis']['statement_check']['isvalid'])) {
            $this->isVerified = $this->statement['1d_analysis']['statement_check']['isvalid'];
        }
    }

    public function toggleModal()
    {
        $this->showModal = !$this->showModal;
    }

    public function render()
    {
        return view('livewire.statement-verification');
    }
}