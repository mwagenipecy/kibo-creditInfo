<?php

namespace App\Http\Livewire\Accounting;

use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class IncomeAndExpenditure extends Component
{

    public $income_accounts;

  

    public function downloadPdf(){


    }

    public function render()
    {
        $this->income_accounts = DB::table('income_accounts')->get();
        $this->expense_accounts = DB::table('expense_accounts')->get();
        return view('livewire.accounting.income-and-expenditure');
    }
}
