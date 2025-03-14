<?php

namespace App\Http\Livewire\Reconciliation\Reports;

use App\Models\NmbNonMatching;
use App\Models\NmbMatching;
use App\Models\nmbtransactionsnonmatchingstore;
use App\Models\NmbMatchingStore;

use Illuminate\Contracts\View\Factory;
use Livewire\Component;
use App\Models\Balances;
use App\Models\cashbooknonmatchingstore;
use App\Models\CashBookMatchingStore;
use App\Exports\ExportTransactions;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Vtiful\Kernel\Excel;
use App\Exports\fullReportExport;

class Nmb extends Component
{


    public $CashBookNonMatchingSum;
    public $CashBookMatchingSum;
    public $uchumiNonMatchingSumCredit;
    public $uchumiMatchingSumCredit;
    public $uchumiNonMatchingSumDebit;
    public $uchumiMatchingSumDebit;
    public $startDate;
    public $endDatex;
    public $running_balance;
    public $bankCharges;
    public $taxes;
    public $CashInTransit;
    public $UncreditedCheque;
    public $directDeposit;
    public $StandingOrder;
    public $UpresentedCheque;
    public $SuspenseAccount;
    public $opening_balance;
    public $lessTotal = 0;
    public $addTotal = 0;
    public $directPayments = 0;
    public $UncreditedChequexx = 0;
    public $matched_amount_credit = 0;
    public $matched_amount_debit = 0;


    public function boot()
    {
        $this->startDate = '2022-05-31';
        $this->endDatex = '2022-06-30';
    }

    public function render(): Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $this->CashInTransit = 0;
        $this->UncreditedCheque = 0;
        $this->UpresentedCheque = 0;
        $this->SuspenseAccount = 0;
        $this->running_balance = 0;
        $this->opening_balance = 0;
        $this->directPayments = 0;
        $this->directDeposit = 0;
        $this->UncreditedChequexx = 0;
        $this->matched_amount_credit = 0;
        $this->matched_amount_debit = 0;
        $this->StandingOrder = 0;
        $this->bankCharges = 0;
        $this->taxes = 0;


        $this->running_balance = DB::table('reco_sessions')
            ->where('third_part', 'NMB')
            ->where('start_date', $this->startDate)
            ->where('end_date', $this->endDatex)->value('closing_balance');


        $this->UpresentedCheque = cashbooknonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where('transaction_amount', '>', 0)
            ->where('institution', '=', 'NMB')
            ->sum('transaction_amount');


        $this->StandingOrder = nmbtransactionsnonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where('details',  'like', '%Standing Instruction Transfer%')
            ->sum('credit');

        $this->SuspenseAccount = nmbtransactionsnonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where('credit', '>', 0)
            ->where('details',  'not like', '%Cash Deposit%')
            ->where('details',  'not like', '%Standing Instruction Transfer%')
            ->where('details',  'not like', '%Account to Account Transfer%')
            ->where('details',  'not like', '%Funds Transfer%')
            ->where('details',  'not like', '%TIPS Payments%')
            ->sum('credit');

        $this->directDeposit = nmbtransactionsnonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where('credit', '>', 0)
            ->where(function($q) {
                $q->where('details', 'like', '%Cash Deposit%')
                    ->orWhere('details', 'like', '%Standing Instruction Transfer%')
                    ->orWhere('details', 'like', '%Account to Account Transfer%')
                    ->orWhere('details', 'like', '%Funds Transfer%')
                    ->orWhere('details', 'like', '%TIPS Payments%');
            })
            ->sum('credit');


        $this->UncreditedCheque = cashbooknonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where('transaction_amount', '<', 0)
            ->where('institution', '=', 'NMB')
            ->sum('transaction_amount');
        $this->UncreditedCheque = $this->UncreditedCheque * -1;




        $this->bankCharges = nmbtransactionsnonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where(function($q) {
                $q->where('details', 'like', '%fees%')
                    ->orWhere('details', 'like', '%Charge%')
                    ->orWhere('details', 'like', '%Commission%');
            })
            ->sum('debit');

        $this->taxes = nmbtransactionsnonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where('details', 'like', '%VAT Payable on Comm and Fees%')
            ->sum('debit');
        /////////
        $this->directPayments = nmbtransactionsnonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where(function($q) {
                $q->where('details', 'like', '%Cash Cheque%')
                    ->orWhere('details', 'like', '%Cheque Deposit%')
                    ->orWhere('details', 'like', '%Account to Account Transfer%')
                    ->orWhere('details', 'like', '%Incoming EFT%');
            })
            ->sum('debit');

        $this->CashInTransit = nmbtransactionsnonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where('debit', '>', 0)
            ->where('details', 'not like', '%Cash Cheque%')
            ->where('details', 'not like', '%Cheque Deposit%')
            ->where('details', 'not like', '%fees%')
            ->where('details', 'not like', '%Charge%')
            ->where('details', 'not like', '%Commission%')
            ->where('details', 'not like', '%VAT Payable on Comm and Fees%')
            ->where('details', 'not like', '%Account to Account Transfer%')
            ->where('details', 'not like', '%Incoming EFT%')
            ->sum('debit');


        $this->lessTotal = (float)$this->UpresentedCheque  + (float)$this->directDeposit + (float)$this->StandingOrder + (float)$this->SuspenseAccount ;

        $this->addTotal= (float)$this->UncreditedCheque + (float)$this->bankCharges + (float)$this->taxes + (float)$this->CashInTransit + (float)$this->directPayments;

        $this->mainTotal = $this->running_balance - $this->lessTotal + $this->addTotal;


        return view('livewire.reconciliation.reports.nmb');
    }


    public function downloadFullReport()
    {

        return (new fullReportExport($this->startDate, $this->endDatex, 'NMB'))->download($this->startDate . '_' . $this->endDatex . '_nmb_detailed_report.xlsx');
        //return (new fullReportExport($this->startDate,$this->endDatex,'uchumi'))->download('invoices.html',  \Maatwebsite\Excel\Excel::TCPDF);

    }

}
