<?php

namespace App\Http\Livewire\Reconciliation\Reports;


use App\Models\UchumiNonMatching;
use App\Models\UchumiMatching;
use App\Models\uchumitransactionsnonmatchingstore;
use App\Models\uchumitransactionsmatchingstore;

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

class Uchumi extends Component
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
    public $directPayments =0;
    public $UncreditedChequexx=0;
    public $matched_amount_credit =0;
    public $matched_amount_debit = 0;



    public function boot(){
        $this->startDate = '2022-04-01';
        $this->endDatex = '2022-04-30';
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




        $this->running_balance  = DB::table('reco_sessions')
            ->where('third_part','UCHUMI')
            ->where('start_date',$this->startDate)
            ->where('end_date',$this->endDatex)->value('closing_balance');

        //// Un presented Cheque

        $this->UpresentedCheque = cashbooknonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where('transaction_amount', '>', 0)
            ->where('institution', '=', 'UCHUMI')
            ->sum('transaction_amount');

        //// directDeposit

        $this->directDeposit = uchumitransactionsnonmatchingstore::select('order_number','reference_number','value_date','credit','debit','details','institution','created_at')
            ->where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where('credit', '>', 0)
            ->where(function($q) {
                $q->where('details', 'like', '%CASH DEPOSIT-BY%')
                    ->orWhere('details', 'like', '%Standing Instruction%')
                    ->orWhere('details', 'like', '%REVERSAL%');
            })
            ->sum('credit');

        //// Standing order

        $this->StandingOrder = uchumitransactionsnonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where('details',  'like', '%Standing Instruction%')
            ->sum('credit');

        //// Suspense account
        $this->SuspenseAccount = uchumitransactionsnonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where('credit', '>', 0)
            ->where('details',  'not like', '%CASH DEPOSIT-BY%')
            ->where('details',  'not like', '%Standing Instruction%')
            ->where('details',  'not like', '%REVERSAL%')
            ->sum('credit');

        //// Uncredited cheque

        $this->UncreditedCheque = cashbooknonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where('transaction_amount', '<', 0)
            ->where('institution', '=', 'UCHUMI')
            ->sum('transaction_amount');
        $this->UncreditedCheque = $this->UncreditedCheque * -1;

        //// Bank charges
        $this->bankCharges = uchumitransactionsnonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where(function($q) {
                $q->where('details', 'like', '%Monthly Service Charge%')
                    ->orWhere('details', 'like', '%charges%');
            })
            ->sum('debit');

        //// Taxes
        $this->taxes = uchumitransactionsnonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where('details', 'like', '%Vat&Excise%')
            ->sum('debit');

        //// Direct payments
        $this->directPayments = uchumitransactionsnonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where(function($q) {
                $q->where('details', 'like', '%CASH WITHDRAWAL-Cheque%')
                    ->orWhere('details', 'like', '%FUND TRANSFER%')
                    ->orWhere('details', 'like', '%EFT%')
                    ->orWhere('details', 'like', '%Current Accounts Periodic Interest%')
                    ->orWhere('details', 'like', '%TISS:%');
            })
            ->sum('debit');

        //// Cash in transit

        $this->CashInTransit = uchumitransactionsnonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where('debit', '>', 0)
            ->where('details', 'not like', '%CASH WITHDRAWAL-Cheque%')
            ->where('details', 'not like', '%FUND TRANSFER%')
            ->where('details', 'not like', '%EFT%')
            ->where('details', 'not like', '%Current Accounts Periodic Interest%')
            ->where('details', 'not like', '%charges%')
            ->where('details', 'not like', '%Monthly Service Charge%')
            ->where('details', 'not like', '%Vat&Excise%')
            ->where('details', 'not like', '%TISS:%')
            ->sum('debit');


        $this->lessTotal = (float)$this->UpresentedCheque  + (float)$this->directDeposit + (float)$this->StandingOrder + (float)$this->SuspenseAccount ;

        $this->addTotal= (float)$this->UncreditedCheque + (float)$this->bankCharges + (float)$this->taxes + (float)$this->CashInTransit + (float)$this->directPayments;

        $this->mainTotal = $this->running_balance - $this->lessTotal + $this->addTotal;

        return view('livewire.reconciliation.reports.uchumi');
    }



    public function downloadFullReport()
    {

        return (new fullReportExport($this->startDate,$this->endDatex,'UCHUMI'))->download($this->startDate.'_'.$this->endDatex.'_detailed_report.xlsx');
        //return (new fullReportExport($this->startDate,$this->endDatex,'uchumi'))->download('invoices.html',  \Maatwebsite\Excel\Excel::TCPDF);

    }

}
