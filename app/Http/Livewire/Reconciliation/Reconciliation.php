<?php

namespace App\Http\Livewire\Reconciliation;

use Livewire\Component;



class Reconciliation extends Component
{


    public $tab_id = '1';
    public $title = 'New reconciliation session';


    public function menuItemClicked($tabId)
    {
        $this->tab_id = $tabId;
        if ($tabId == '1') {
            $this->title = 'New reconciliation session';
        }
        if ($tabId == '2') {
            $this->title = 'Loans Committee';
        }
        if ($tabId == '3') {
            $this->title = 'Loans Status';
        }
    }


    public function render()
    {
        return view('livewire.reconciliation.reconciliation');
    }
}

