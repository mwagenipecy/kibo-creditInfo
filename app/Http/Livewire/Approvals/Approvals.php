<?php

namespace App\Http\Livewire\Approvals;

use Livewire\Component;
use Illuminate\Support\Facades\Session;


class Approvals extends Component
{


    public $tab_id = '1';
    public $title = 'Savings report';


    public function menuItemClicked($tabId)
    {
        $this->tab_id = $tabId;
        if ($tabId == '1') {
            $this->title = 'Internal accounts';
        }
        if ($tabId == '2') {
            $this->title = 'Enter new shares details';
        }
        if ($tabId == '3') {
            $this->title = 'External accounts';
        }
        if ($tabId == '4') {
            $this->title = 'Loan Disbursements';
            Session::put('viewLoansWithCategory','Accounting');

            Session::put('currentloanID',null);
            Session::put('currentloanClient',null);
            Session::put('disableInputs',true);
        }

        if ($tabId == '5') {
            $this->title = 'PO / Invoices';
            Session::put('viewLoansWithCategory','AccountingPO');
            Session::put('currentloanID',null);
            Session::put('currentloanClient',null);
            Session::put('disableInputs',true);
        }
    }


    public function render()
    {
        return view('livewire.approvals.approvals');
    }
}

