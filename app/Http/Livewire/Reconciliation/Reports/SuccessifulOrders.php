<?php

namespace App\Http\Livewire\Reconciliation\Reports;



use App\Models\Balances;
use App\Models\cashbooknonmatchingstore;
use App\Models\CashBookMatchingStore;
use App\Models\crdbtransactionsnonmatchingstore;
use App\Models\CrdbMatchingStore;
use App\Exports\ExportTransactions;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Vtiful\Kernel\Excel;
use App\Exports\fullReportExport;

class SuccessifulOrders extends Component
{


    public $CashBookNonMatchingSum;
    public $CashBookMatchingSum;
    public $CrdbNonMatchingSumCredit;
    public $CrdbMatchingSumCredit;
    public $CrdbNonMatchingSumDebit;
    public $CrdbMatchingSumDebit;
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
    public $mainTotal;


    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
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
        $this->mainTotal = 0;

        if ($this->startDate == null){

            //////////////////////////////////////////////START DATE////////////////////////////////////////////////////////////////////////////////
            $start_date_1  = CrdbMatchingStore::orderBy('posting_date', 'asc')->skip(0)->take(1)->value('posting_date');

            //31.05.2022 21:22:30
            $start_date_2  = crdbtransactionsnonmatchingstore::orderBy('posting_date', 'asc')->skip(0)->take(1)->value('posting_date');
            //31.05.2022 22:24:35


            if(Carbon::parse($start_date_1) > Carbon::parse($start_date_2)){
                $this->startDate = Carbon::parse($start_date_1)->format('Y-m-d');
                $owee = Carbon::parse($start_date_1)->format('Y-m-d H:i:s');
                $this->opening_balance = DB::table('crdb_transactions_matching_store')
                    ->where('new_posting_date',"=", $owee)
                    ->value('book_balance');

            }else{

                $this->startDate = Carbon::parse($start_date_2)->format('Y-m-d');
                $owee = Carbon::parse($start_date_2)->format('Y-m-d H:i:s');
                $this->opening_balance = DB::table('crdb_transactions_non_matching_store')
                    ->where('new_posting_date',"=", $owee)
                    ->value('book_balance');
            }

        }else{

            $owee = Carbon::parse($this->startDate)->format('Y-m-d H:i:s');

            $start_date_1 = DB::table('crdb_transactions_matching_store')
                ->orderBy('new_posting_date', 'asc')
                ->where('new_posting_date',">=", $owee)
                ->skip(0)
                ->take(1)
                ->value('posting_date');

            $start_date_2 = DB::table('crdb_transactions_non_matching_store')
                ->orderBy('new_posting_date', 'asc')
                ->where('new_posting_date',">=", $owee)
                ->skip(0)
                ->take(1)
                ->value('posting_date');


            if(Carbon::parse($start_date_1) > Carbon::parse($start_date_2)){

                $owee = Carbon::parse($start_date_2)->format('Y-m-d H:i:s');
                $this->opening_balance = DB::table('crdb_transactions_non_matching_store')
                    ->where('new_posting_date',"=", $owee)
                    ->value('book_balance');

            }else{

                $owee = Carbon::parse($start_date_1)->format('Y-m-d H:i:s');
                $this->opening_balance = DB::table('crdb_transactions_matching_store')
                    ->where('new_posting_date',"=", $owee)
                    ->value('book_balance');


            }


        }






        if ($this->endDatex == null){
            $this->running_balance = 0;
            //////////////////////////////////////////////END DATE////////////////////////////////////////////////////////////////////////////////
            $end_date_1  = CrdbMatchingStore::orderBy('posting_date', 'desc')->skip(0)->take(1)->value('posting_date');
            //31.05.2022 21:22:30

            $end_date_2  = crdbtransactionsnonmatchingstore::orderBy('posting_date', 'desc')->skip(0)->take(1)->value('posting_date');
            //31.05.2022 22:24:35


            if(Carbon::parse($end_date_1) > Carbon::parse($end_date_2)){

                $this->endDatex = Carbon::parse($end_date_1)->format('Y-m-d');
                $owee = Carbon::parse($end_date_1)->format('Y-m-d H:i:s');
                $this->running_balance = DB::table('crdb_transactions_matching_store')
                    ->where('new_posting_date',"=", $owee)
                    ->value('book_balance');

            }else{

                $this->endDatex = Carbon::parse($end_date_2)->format('Y-m-d');
                $owee = Carbon::parse($end_date_2)->format('Y-m-d H:i:s');
                $this->running_balance = DB::table('crdb_transactions_non_matching_store')
                    ->where('new_posting_date',"=", $owee)
                    ->value('book_balance');
            }



        }else{
            $this->running_balance = 0;
            $owee = Carbon::parse($this->endDatex)->format('Y-m-d H:i:s');

            $end_date_1 = DB::table('crdb_transactions_matching_store')
                ->orderBy('new_posting_date', 'desc')
                ->where('new_posting_date',"<=", $owee)
                ->skip(0)
                ->take(1)
                ->value('posting_date');


            $end_date_2 = DB::table('crdb_transactions_non_matching_store')
                ->orderBy('new_posting_date', 'desc')
                ->where('new_posting_date',"<=", $owee)
                ->skip(0)
                ->take(1)
                ->value('posting_date');


            if(Carbon::parse($end_date_1) > Carbon::parse($end_date_2)){

                $owee = Carbon::parse($end_date_1)->format('Y-m-d H:i:s');
                $this->running_balance = DB::table('crdb_transactions_matching_store')
                    ->where('new_posting_date',"=", $owee)
                    ->value('book_balance');

            }else{

                $owee = Carbon::parse($end_date_2)->format('Y-m-d H:i:s');
                $this->running_balance = DB::table('crdb_transactions_non_matching_store')
                    ->where('new_posting_date',"=", $owee)
                    ->value('book_balance');

            }


        }


        ////Un presented Cheque
        $this->UpresentedCheque = cashbooknonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where('transaction_amount', '>', 0)
            ->where('order_number', 'like', '%CRDB%')
            ->sum('transaction_amount');

        //// directDeposit
        $this->directDeposit = crdbtransactionsnonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where('credit', '>', 0)
            ->where(function($q) {
                $q->where('details', 'like', '%CASH DEPOSIT%')
                    ->orWhere('details', 'like', '%CASH DEPOSITS%')
                    ->orWhere('details', 'like', '%TRANSFER%')
                    ->orWhere('details', 'like', '%ELCT SAVINGS%')
                    ->orWhere('details', 'like', '%AIRTEL MONEY DEPOSIT%')
                    ->orWhere('details', 'like', '%OMNFT%')
                    ->orWhere('details', 'like', '%CHQ. NO.%')
                    ->orWhere('details', 'like', '%From 0%')
                    ->orWhere('details', 'like', '%FUND TRANS FROM%')
                    ->orWhere('details', 'like', '%TIGOPESA C2B%')
                    ->orWhere('details', 'like', '%M PESA DEPOSIT%')
                    ->orWhere('details', 'like', '%REVERSAL%');
            })
            ->sum('credit');

        //// Standing order
        $this->StandingOrder = crdbtransactionsnonmatchingstore::where('value_date', '>=', $this->startDate)
                              ->where('value_date', '<=', $this->endDatex)
                              ->where('details',  'like', '%From 0%')
                              ->sum('credit');

        //// Suspense account
        $this->SuspenseAccount = crdbtransactionsnonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where('credit', '>', 0)
            ->where('details',  'not like', '%CASH DEPOSIT%')
            ->where('details',  'not like', '%CASH DEPOSITS%')
            ->where('details',  'not like', '%OMNFT%')
            ->where('details',  'not like', '%CHQ. NO.%')
            ->where('details',  'not like', '%From 0%')
            ->where('details',  'not like', '%FUND TRANS FROM%')
            ->where('details',  'not like', '%TIGOPESA C2B%')
            ->where('details',  'not like', '%M PESA DEPOSIT%')
            ->where('details',  'not like', '%REVERSAL%')
            ->where('details', 'not like', '%TRANSFER%')
            ->where('details', 'not like', '%ELCT SAVINGS%')
            ->where('details', 'not like', '%AIRTEL MONEY DEPOSIT%')
            ->sum('credit');

        //// Uncredited cheque
        $this->UncreditedCheque = cashbooknonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where('transaction_amount', '<', 0)
            ->where('order_number', 'like', '%CRDB%')
            ->sum('transaction_amount');

        $this->UncreditedCheque = $this->UncreditedCheque *-1;

        //// Bank charges
        $this->bankCharges = crdbtransactionsnonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where(function($q) {
                $q->where('details', 'like', '%Cash withdrawal charges%')
                    ->orWhere('details', 'like', '%Monthly Maintenance Fee%');
            })
            ->sum('debit');

        //// Taxes
        $this->taxes = crdbtransactionsnonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where(function($q) {
                $q->where('details', 'like', '%VAT%')
                    ->orWhere('details', 'like', '%GOVERNMENT%');
            })
            ->sum('debit');

        //// Direct payments
        $this->directPayments = crdbtransactionsnonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where('debit', '>', 0)
            ->where(function($q) {
                $q->where('details', 'like', '%FUND TRANS TO%')
                    ->orWhere('details', 'like', '%GePG%');
            })
            ->sum('debit');

        //// Cash in transit
        $this->CashInTransit = crdbtransactionsnonmatchingstore::where('value_date', '>=', $this->startDate)
            ->where('value_date', '<=', $this->endDatex)
            ->where('debit', '>', 0)
            ->where('details', 'not like', '%FUND TRANS TO%')
            ->where('details', 'not like', '%GePG%')
            ->where('details', 'not like', '%VAT%')
            ->where('details', 'not like', '%Cash withdrawal charges%')
            ->where('details', 'not like', '%Monthly Maintenance Fee%')
            ->where('details', 'not like', '%GOVERNMENT%')
            ->sum('debit');

        $this->lessTotal = (float)$this->UpresentedCheque  + (float)$this->directDeposit + (float)$this->StandingOrder + (float)$this->SuspenseAccount ;

        $this->addTotal= (float)$this->UncreditedCheque + (float)$this->bankCharges + (float)$this->taxes + (float)$this->CashInTransit + (float)$this->directPayments;

        $this->mainTotal = $this->running_balance - $this->lessTotal + $this->addTotal;

        return view('livewire.reconciliation.reports.successiful-orders');
    }



    public function downloadFullReport()
    {

        return (new fullReportExport($this->startDate,$this->endDatex,'CRDB'))->download($this->startDate.'_'.$this->endDatex.'_detailed_report.xlsx');
        //return (new fullReportExport($this->startDate,$this->endDatex,'CRDB'))->download('invoices.html',  \Maatwebsite\Excel\Excel::TCPDF);

    }


}
