<?php

namespace App\Http\Livewire\Reports;

use App\Models\loans_schedules;
use App\Models\LoansModel;
use Carbon\Carbon;
use Livewire\Component;

class DailyReport extends Component
{
    public $tab_id;

    public $total_principle;

    public $total_disbursement_amount;

    public $total_repayment;

    public $loan_applications;

    public $day_date;

    public function boot()
    {
        $this->day_date = Carbon::today();
    }

    public function selectedBranch($id)
    {

        $this->tab_id = $id;

        //
        $this->total_principle = LoansModel::where('created_at', $this->day_date)->where('branch_id', $id)->sum('principle');
        // get first the loan id
        $loan_id = loans_schedules::where('created_at', $this->day_date)->distinct('loan_id')->pluck('loan_id');
        $this->total_disbursement_amount = LoansModel::whereIn('loan_id', $loan_id)->where('branch_id', $id)->sum('principle');

        $loan_id_repayment = loans_schedules::where('created_at', $this->day_date)->where('completion_status', 'CLOSED')->pluck('loan_id');

        $this->loan_applications = LoansModel::where('created_at', $this->day_date)->count();

        //   dd($this->total_disbursement_amount, $this->total_principle,$this->day_date);

    }

    public function render()
    {
        return view('livewire.reports.daily-report');
    }
}
