<?php

namespace App\Http\Livewire\Accounting;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CashAccountsTableActions extends Component
{


    public function render()
    {
        return view('livewire.accounting.cash-accounts-table-actions');
    }
}
