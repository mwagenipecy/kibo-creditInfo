<?php

namespace App\Http\Livewire\Loans;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ClientHistory extends Component
{




    public function render()
    {
        return view('livewire.loans.client-history');
    }
}
