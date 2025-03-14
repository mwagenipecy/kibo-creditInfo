<?php

namespace App\Http\Livewire\Expenses;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Expense extends Component
{
    public $selected;
    public $unusedBudget;





    
    public function render()
    {
        return view('livewire.expenses.expense');
    }
}
