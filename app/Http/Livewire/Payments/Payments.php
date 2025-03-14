<?php

namespace App\Http\Livewire\Payments;

use Livewire\Component;



class Payments extends Component
{


    public $tab_id = '1';
    public $title = 'Create new order';


    public function menuItemClicked($tabId)
    {
        $this->tab_id = $tabId;
        if ($tabId == '1') {
            $this->title = 'Create new order';
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

        //$this->activeLoansCount = LoansModel::where('status', 'Active')->count();
        //$this->inactiveLoansCount = LoansModel::where('status', 'Pending')->count();
        //$this->LoansList = LoansModel::get();
        return view('livewire.payments.payments');
    }
}