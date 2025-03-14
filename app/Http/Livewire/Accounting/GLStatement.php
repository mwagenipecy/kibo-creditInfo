<?php

namespace App\Http\Livewire\Accounting;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GLStatement extends Component
{
    public $start_date_input;
    public $end_date_input;

  

    public function daterange($data)
    {
        $this->start_date_input = $data['start_date_input'];
        $this->end_date_input = $data['end_date_input'];
        dd($this->start_date_input, $this->end_date_input);
    }


    public function render()
    {
        return view('livewire.accounting.g-l-statement');
    }
}
