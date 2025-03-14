<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;

class LoanDelinquencyReport extends Component
{
    public $startDate;
    public $endDate;
    public $PAR;
    public $startRange;
    public $endRange;

    public $branch;



    

    public function render()
    {
        if($this->startRange && $this->endRange){
            $this->emit('daysRange', $this->startRange,$this->endRange);
        }elseif($this->startRange){
            $this->emit('daysIN',$this->startRange);
        }

        return view('livewire.reports.loan-delinquency-report');
    }
}
