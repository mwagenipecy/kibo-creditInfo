<?php

namespace App\Http\Livewire\Expenses;

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
