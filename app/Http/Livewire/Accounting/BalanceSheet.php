<?php

namespace App\Http\Livewire\Accounting;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BalanceSheet extends Component
{
    public $asset_accounts;
    public $liability_accounts;
    public $capital_accounts;


    public function render()
    {
        $this->asset_accounts = DB::table('asset_accounts')->get();
        $this->liability_accounts = DB::table('liability_accounts')->get();
        $this->capital_accounts = DB::table('capital_accounts')->get();
        return view('livewire.accounting.balance-sheet');
    }
}
