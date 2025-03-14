<?php

namespace App\Http\Livewire\Reconciliation\Order;

use Carbon\Carbon;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;
use Session;



use App\Models\nmbtransactionsnonmatchingstore;
use App\Models\NmbMatchingStore;
use App\Models\NmbNonMatching;
use App\Models\NmbMatching;
use App\Models\Uchumi;
use App\Models\UchumiNonMatching;
use App\Models\UchumiMatching;
use App\Models\Balances;
use App\Models\CrdbMatchingStore;
use App\Models\CashBookMatchingStore;
use App\Models\CrdbMatching;
use App\Models\CashBookMatching;
use App\Models\crdbtransactionsnonmatchingstore;
use App\Models\cashbooknonmatchingstore;
use App\Models\uchumitransactionsnonmatchingstore;
use App\Models\uchumitransactionsmatchingstore;
use App\Models\Crdb;
use App\Models\Nmb;
use App\Models\Cashbook;
use App\Models\Audit;
use App\Models\CashBookNonMatching;
use App\Models\CrdbNonMatching;
use App\Models\Processes;
use App\Models\Transactions;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Orders;
use App\Models\RecoSessions;
use Livewire\WithFileUploads;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportTransactions;
use App\Imports\ImportTransactions;


class CreateOrder extends Component
{

    use WithFileUploads;
    public $css;
    public $oneIsSetClicked = true;
    public $twoIsSetClicked = false;
    public $threeIsSetClicked = false;
    public $ordernumber = '';
    public $ordernumberissaved = false;
    public $selectedDestination = '';
    public $amountOfTransactions = '';
    public $amountOfTransactionsDisplay = '';
    public $selectedBank = '';
    public $recipientName = '';
    public $sourceAccount = '';
    public $description = '';
    public $amount = '';
    public $accountNumber = '';
    public $fromDB = false;
    public $showSaveButton = false;
    public $xx = 'Select';
    public $accounts;
    public $selectedMno = '';
    public $mobileNumber = '';

    public $monthOnFocus = 'April';
    public $yearOnFocus = '2022';
    public $theselected;
    public $permissionId = [];
    public $Amountpending;
    public $level = [];
    public $ProcessExists;
    public $ProcessStatus;
    public $ProcessPaymentStatus;
    public $excelFile;
    public $excelFileTp;
    public $showSendButton = false;
    public $bname;
    public $typeOfTransfer;
    public $banks;
    public $startdate = '';
    public $enddate = '';
    public $openingbalance = '';
    public $closingbalance = '';
    public $wait = false;
    public $showThirdPartSelector = false;
    public $cbGo = false;
    public $running = false;
    public $inputterrors = '';
    public $isSessionReady = false;
    public $iteration = 0;
    public $disableTpButton = '';
    public $disableCbButton = '';


    protected $listeners = ['uploadDone' => 'uploadDoneAction'];


    public function uploadDoneAction()
    {
        $this->wait = false;
    }

    #[NoReturn] public function createOrder(){

        if($this->running){
            $this->inputterrors = 'PLEASE WAIT, PREVIOUS SESSION IS STILL RUNNING...';
        }else{
            if(Session::get('cbfileisset') && Session::get('tpfileisset') ){


                $this->running = true;
                $transactions = DB::table('cashbook')->get();
                foreach ($transactions as $transaction){
                    $reference_number=$transaction->reference_number;
                    if($reference_number === null){

                    }else{
                        $reference_number = strtoupper($reference_number);
                        if(Session::get('typeOfTransfer') =='CRDB') {
                            $crdb_transaction = DB::table('crdb_transactions')->where('reference_number', '=', $reference_number)->first();

                        }elseif (Session::get('typeOfTransfer') =='NMB'){
                            $crdb_transaction = DB::table('nmb_transactions')->where('reference_number', '=', $reference_number)->first();
                        }elseif (Session::get('typeOfTransfer') =='UCHUMI')
                        {


                            if($transaction->transaction_amount > 0){
                                $crdb_transaction = DB::table('uchumi_transactions')
                                    //->where('value_date', '=', $transaction->value_date)
                                    ->where('debit', '=', $transaction->transaction_amount)
                                    ->first();
                                //$theWord =
                                if($crdb_transaction){
                                    $a = array('CASH','DEPOSIT','BY',':','.');
                                    $var = $this->clean(trim($crdb_transaction->details));
                                    $var =  str_replace($a, '',$var);
                                    $wordsToCheck = explode(" ",  trim($var));

                                    $stringToCheckAgainst = $transaction->description.' '.$transaction->reference_number;
                                    $stringToCheckAgainst = $this->clean(trim($stringToCheckAgainst));

                                    // dd($stringToCheckAgainst.' '.json_encode($wordsToCheck));


                                    $check = $this->CheckStringForWords($stringToCheckAgainst, $wordsToCheck);
                                    if($check){
                                        $crdb_transaction = 'ok';
                                    }else{
                                        $crdb_transaction = null;
                                    }
                                }else{
                                    $crdb_transaction = null;
                                }

                                //dd($crdb_transaction);
                            }else{
                                $crdb_transaction = DB::table('uchumi_transactions')
                                    //->where('value_date', '=', $transaction->value_date)
                                    ->where('credit', '=', ($transaction->transaction_amount * -1))
                                    ->first();


                                if($crdb_transaction){
                                    $a = array('CASH','DEPOSIT','BY',':','.');
                                    $var = $this->clean(trim($crdb_transaction->details));
                                    $var =  str_replace($a, '',$var);
                                    $wordsToCheck = explode(" ",  trim($var));

                                    $stringToCheckAgainst = $transaction->description.' '.$transaction->reference_number;
                                    $stringToCheckAgainst = $this->clean(trim($stringToCheckAgainst));

                                   // dd($stringToCheckAgainst.' '.json_encode($wordsToCheck));


                                    $check = $this->CheckStringForWords($stringToCheckAgainst, $wordsToCheck);
                                    if($check){
                                        $crdb_transaction = 'ok';
                                    }else{
                                        $crdb_transaction = null;
                                    }

                                }else{
                                    $crdb_transaction = null;
                                }

                                //dd($crdb_transaction);
                            }





                        }else{
                            $crdb_transaction = null;
                        }

                        if ($crdb_transaction === null) {



                            $CashBookNonMatching= new CashBookNonMatching();
                            $CashBookNonMatching->team_id = $transaction->team_id;
                            $CashBookNonMatching->value_date = $transaction->value_date;
                            $CashBookNonMatching->transaction_amount = $transaction->transaction_amount;
                            $CashBookNonMatching->description = $transaction->description;
                            $CashBookNonMatching->reference_number = $transaction->reference_number;
                            $CashBookNonMatching->order_number = $transaction->order_number;
                            $CashBookNonMatching->institution = $transaction->institution;
                            $CashBookNonMatching->save();


                        }else{

                            $CashBookNonMatching= new CashBookMatching();
                            $CashBookNonMatching->team_id = $transaction->team_id;
                            $CashBookNonMatching->value_date = $transaction->value_date;
                            $CashBookNonMatching->transaction_amount = $transaction->transaction_amount;
                            $CashBookNonMatching->description = $transaction->description;
                            $CashBookNonMatching->reference_number = $transaction->reference_number;
                            $CashBookNonMatching->order_number = $transaction->order_number;
                            $CashBookNonMatching->institution = $transaction->institution;
                            $CashBookNonMatching->save();
                        }


                    }

                }




                if(Session::get('typeOfTransfer') =='CRDB'){

                    $transactions = DB::table('crdb_transactions')->get();
                    foreach ($transactions as $transaction){
                        $reference_number=$transaction->reference_number;
                        if($reference_number === null){

                        }else{
                            $reference_number = strtoupper($reference_number);
                            $cashbook_transaction = DB::table('cashbook')->where('reference_number', '=', $reference_number)->first();
                            if ($cashbook_transaction === null) {



                                $CashBookNonMatching= new CrdbNonMatching();
                                $CashBookNonMatching->team_id = $transaction->team_id;
                                $CashBookNonMatching->posting_date = $transaction->posting_date;
                                $CashBookNonMatching->details = $transaction->details;
                                $CashBookNonMatching->value_date = $transaction->value_date;
                                $CashBookNonMatching->debit = $transaction->debit;
                                $CashBookNonMatching->reference_number = $transaction->reference_number;
                                $CashBookNonMatching->credit = $transaction->credit;
                                $CashBookNonMatching->book_balance = $transaction->book_balance;
                                $CashBookNonMatching->order_number = $transaction->order_number;
                                $CashBookNonMatching->institution = $transaction->institution;
                                $CashBookNonMatching->save();



                            }else{
                                $CashBookNonMatching= new CrdbMatching();
                                $CashBookNonMatching->team_id = $transaction->team_id;
                                $CashBookNonMatching->posting_date = $transaction->posting_date;
                                $CashBookNonMatching->details = $transaction->details;
                                $CashBookNonMatching->value_date = $transaction->value_date;
                                $CashBookNonMatching->debit = $transaction->debit;
                                $CashBookNonMatching->reference_number = $transaction->reference_number;
                                $CashBookNonMatching->credit = $transaction->credit;
                                $CashBookNonMatching->book_balance = $transaction->book_balance;
                                $CashBookNonMatching->order_number = $transaction->order_number;
                                $CashBookNonMatching->institution = $transaction->institution;
                                $CashBookNonMatching->save();

                            }
                        }

                    }

                }

                if(Session::get('typeOfTransfer') =='NMB'){

                    $transactions = DB::table('nmb_transactions')->get();
                    foreach ($transactions as $transaction){
                        $reference_number=$transaction->reference_number;
                        if($reference_number === null){

                        }else{
                            $reference_number = strtoupper($reference_number);
                            $cashbook_transaction = DB::table('cashbook')->where('reference_number', '=', $reference_number)->first();
                            if ($cashbook_transaction === null) {


                                $CashBookNonMatching= new NmbNonMatching();
                                $CashBookNonMatching->team_id = $transaction->team_id;
                                $CashBookNonMatching->posting_date = $transaction->posting_date;
                                $CashBookNonMatching->details = $transaction->details;
                                $CashBookNonMatching->value_date = $transaction->value_date;
                                $CashBookNonMatching->debit = $transaction->debit;
                                $CashBookNonMatching->reference_number = $transaction->reference_number;
                                $CashBookNonMatching->credit = $transaction->credit;
                                $CashBookNonMatching->book_balance = $transaction->book_balance;
                                $CashBookNonMatching->order_number = $transaction->order_number;
                                $CashBookNonMatching->institution = $transaction->institution;
                                $CashBookNonMatching->save();


                            }else{
                                $CashBookNonMatching= new NmbMatching();
                                $CashBookNonMatching->team_id = $transaction->team_id;
                                $CashBookNonMatching->posting_date = $transaction->posting_date;
                                $CashBookNonMatching->details = $transaction->details;
                                $CashBookNonMatching->value_date = $transaction->value_date;
                                $CashBookNonMatching->debit = $transaction->debit;
                                $CashBookNonMatching->reference_number = $transaction->reference_number;
                                $CashBookNonMatching->credit = $transaction->credit;
                                $CashBookNonMatching->book_balance = $transaction->book_balance;
                                $CashBookNonMatching->order_number = $transaction->order_number;
                                $CashBookNonMatching->institution = $transaction->institution;
                                $CashBookNonMatching->save();

                            }
                        }

                    }

                }


                if(Session::get('typeOfTransfer') =='UCHUMI'){

                    $transactions = DB::table('uchumi_transactions')->get();
                    foreach ($transactions as $transaction){

                        if((int)$transaction->debit > 0){
                            $crdb_transaction = DB::table('cashbook')
                                //->where('value_date', '=', $transaction->value_date)
                                ->where('transaction_amount', '=', $transaction->debit)
                                ->first();
                        }else{
                            $crdb_transaction = DB::table('cashbook')
                                //->where('value_date', '=', $transaction->value_date)
                                ->where('transaction_amount', '=', (int)$transaction->credit * -1)
                                ->first();
                        }


                        //$theWord =
                        if($crdb_transaction){

                            $a = array('CASH','DEPOSIT','BY',':','.');
                            $var = $this->clean(trim($transaction->details));
                            $var =  str_replace($a, '',$var);
                            $wordsToCheck = explode(" ",  trim($var));

                            $stringToCheckAgainst = $crdb_transaction->description.' '.$crdb_transaction->reference_number;
                            $stringToCheckAgainst = $this->clean(trim($stringToCheckAgainst));

                            // dd($stringToCheckAgainst.' '.json_encode($wordsToCheck));


                            $check = $this->CheckStringForWords($stringToCheckAgainst, $wordsToCheck);

                            if($check){
                                $cashbook_transaction = 'ok';
                            }else{
                                $cashbook_transaction = null;
                            }
                        }else{
                            $cashbook_transaction = null;
                        }


                            if ($cashbook_transaction === null) {



                                $CashBookNonMatching= new UchumiNonMatching();
                                $CashBookNonMatching->team_id = $transaction->team_id;
                                $CashBookNonMatching->posting_date = $transaction->posting_date;
                                $CashBookNonMatching->details = $transaction->details;
                                $CashBookNonMatching->value_date = $transaction->value_date;
                                $CashBookNonMatching->debit = $transaction->debit;
                                $CashBookNonMatching->reference_number = $transaction->reference_number;
                                $CashBookNonMatching->credit = $transaction->credit;
                                $CashBookNonMatching->book_balance = $transaction->book_balance;
                                $CashBookNonMatching->order_number = $transaction->order_number;
                                $CashBookNonMatching->institution = $transaction->institution;
                                $CashBookNonMatching->save();



                            }else{
                                $CashBookNonMatching= new UchumiMatching();
                                $CashBookNonMatching->team_id = $transaction->team_id;
                                $CashBookNonMatching->posting_date = $transaction->posting_date;
                                $CashBookNonMatching->details = $transaction->details;
                                $CashBookNonMatching->value_date = $transaction->value_date;
                                $CashBookNonMatching->debit = $transaction->debit;
                                $CashBookNonMatching->reference_number = $transaction->reference_number;
                                $CashBookNonMatching->credit = $transaction->credit;
                                $CashBookNonMatching->book_balance = $transaction->book_balance;
                                $CashBookNonMatching->order_number = $transaction->order_number;
                                $CashBookNonMatching->institution = $transaction->institution;
                                $CashBookNonMatching->save();

                            }


                    }

                }

                if(Session::get('typeOfTransfer') =='UCHUMI') {

                    $start_date_1 = DB::table('uchumi_transactions')->orderBy('id', 'asc')->skip(0)->take(1)->value('posting_date');
                    $end_date_1 = DB::table('uchumi_transactions')->orderBy('id', 'desc')->skip(0)->take(1)->value('posting_date');

                    $start_book_balance = DB::table('uchumi_transactions')->orderBy('id', 'asc')->skip(0)->take(1)->value('book_balance');
                    $end_book_balance = DB::table('uchumi_transactions')->orderBy('id', 'desc')->skip(0)->take(1)->value('book_balance');

                }elseif(Session::get('typeOfTransfer') =='NMB'){

                    $start_date_1 = DB::table('nmb_transactions')->orderBy('id', 'asc')->skip(0)->take(1)->value('value_date');
                    $end_date_1 = DB::table('nmb_transactions')->orderBy('id', 'desc')->skip(0)->take(1)->value('value_date');

                    $start_book_balance = DB::table('nmb_transactions')->orderBy('id', 'asc')->skip(0)->take(1)->value('book_balance');
                    $end_book_balance = DB::table('nmb_transactions')->orderBy('id', 'desc')->skip(0)->take(1)->value('book_balance');

                }else{
                    $start_date_1 = "";
                    $end_date_1 = "";
                    $start_book_balance = "";
                    $end_book_balance = "";
                }


                $CashBookNonMatching= new RecoSessions();

                $CashBookNonMatching->session_id = $this->ordernumber;
                $CashBookNonMatching->session_status = 'Unreconciled';
                $CashBookNonMatching->non_matching_transactions_cb_count = '';
                $CashBookNonMatching->non_matching_transactions_thirdpart_count =  '';
                $CashBookNonMatching->third_part = $this->typeOfTransfer;
                $CashBookNonMatching->start_date = $start_date_1;
                $CashBookNonMatching->end_date = $end_date_1;
                $CashBookNonMatching->opening_balance =  $start_book_balance;
                $CashBookNonMatching->closing_balance =  $end_book_balance;
                $CashBookNonMatching->cashbook_file = '';
                $CashBookNonMatching->third_part_file = '';
                $CashBookNonMatching->save();


                $this->showThirdPartSelector = false;
                $this->inputterrors = '';

                $this->emit('refreshTables');
                $this->isSessionReady = true;

            }else{

                //&& Session::get('tpfileisset')
                $this->inputterrors = 'PLEASE UPLOAD FILES...';
                $this->running = false;
            }

        }

    }


    function clean($string): array|string|null
    {
        $string = str_replace('  ', ' ', $string);
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return str_replace('-',' ',preg_replace('/[^A-Za-z0-9\-]/', '', $string)); // Removes special chars.
    }

    function CheckStringForWords($stringToCheckAgainst, $wordsToCheck){

        $words = $wordsToCheck;
//$words array can come out from a file or even database.



        $matches = array();
        $matchFound = preg_match_all(
            "/\b(" . implode("|", $words) . ")\b/i",
            $stringToCheckAgainst,
            $matches
        );

        if ($matchFound) {
            $words = array_unique($matches[0]);
            foreach($words as $word) {
                return true;
                //returns true if $text contains any of the words in $words array.
            }
            return false;
            //returns false if $text does not contain any of the words in $words array.
        }
    }


    #[NoReturn] public function commitData()
    {

        if ($this->isSessionReady) {

            $transactions = DB::table('cashbook_non_matching')->get();
            foreach ($transactions as $transaction) {

                $CashBookNonMatching = new cashbooknonmatchingstore();
                $CashBookNonMatching->team_id = $transaction->team_id;
                $CashBookNonMatching->value_date = $transaction->value_date;
                $CashBookNonMatching->transaction_amount = $transaction->transaction_amount;
                $CashBookNonMatching->description = $transaction->description;
                $CashBookNonMatching->reference_number = $transaction->reference_number;
                $CashBookNonMatching->order_number = $transaction->order_number;
                $CashBookNonMatching->institution = $transaction->institution;
                $CashBookNonMatching->save();


            }
            $transactions = DB::table('cashbook_matching')->get();
            foreach ($transactions as $transaction) {

                $CashBookNonMatching = new CashBookMatchingStore();
                $CashBookNonMatching->team_id = $transaction->team_id;
                $CashBookNonMatching->value_date = $transaction->value_date;
                $CashBookNonMatching->transaction_amount = $transaction->transaction_amount;
                $CashBookNonMatching->description = $transaction->description;
                $CashBookNonMatching->reference_number = $transaction->reference_number;
                $CashBookNonMatching->order_number = $transaction->order_number;
                $CashBookNonMatching->institution = $transaction->institution;
                $CashBookNonMatching->save();


            }

            if(Session::get('typeOfTransfer') =='CRDB') {

                $transactions = DB::table('crdb_transactions_non_matching')->get();
                foreach ($transactions as $transaction) {


                    $CashBookNonMatching = new crdbtransactionsnonmatchingstore();
                    $CashBookNonMatching->team_id = $transaction->team_id;
                    $CashBookNonMatching->posting_date = $transaction->posting_date;
                    $CashBookNonMatching->details = $transaction->details;
                    $CashBookNonMatching->value_date = $transaction->value_date;
                    $CashBookNonMatching->debit = $transaction->debit;
                    $CashBookNonMatching->reference_number = $transaction->reference_number;
                    $CashBookNonMatching->credit = $transaction->credit;
                    $CashBookNonMatching->book_balance = $transaction->book_balance;
                    $CashBookNonMatching->order_number = $transaction->order_number;
                    $CashBookNonMatching->institution = $transaction->institution;
                    $CashBookNonMatching->new_posting_date = Carbon::parse($transaction->posting_date)->format('Y-m-d H:i:s');
                    $CashBookNonMatching->save();


                }


                $transactions = DB::table('crdb_transactions_matching')->get();
                foreach ($transactions as $transaction) {


                    $CashBookNonMatching = new CrdbMatchingStore();
                    $CashBookNonMatching->team_id = $transaction->team_id;
                    $CashBookNonMatching->posting_date = $transaction->posting_date;
                    $CashBookNonMatching->details = $transaction->details;
                    $CashBookNonMatching->value_date = $transaction->value_date;
                    $CashBookNonMatching->debit = $transaction->debit;
                    $CashBookNonMatching->reference_number = $transaction->reference_number;
                    $CashBookNonMatching->credit = $transaction->credit;
                    $CashBookNonMatching->book_balance = $transaction->book_balance;
                    $CashBookNonMatching->order_number = $transaction->order_number;
                    $CashBookNonMatching->institution = $transaction->institution;
                    $CashBookNonMatching->new_posting_date = Carbon::parse($transaction->posting_date)->format('Y-m-d H:i:s');
                    $CashBookNonMatching->save();


                }


            }

            if(Session::get('typeOfTransfer') =='NMB') {

                $transactions = DB::table('nmb_transactions_non_matching')->get();
                foreach ($transactions as $transaction) {



                    $CashBookNonMatching = new nmbtransactionsnonmatchingstore();
                    $CashBookNonMatching->team_id = $transaction->team_id;
                    $CashBookNonMatching->posting_date = $transaction->posting_date;
                    $CashBookNonMatching->details = $transaction->details;
                    $CashBookNonMatching->value_date = $transaction->value_date;
                    $CashBookNonMatching->debit = $transaction->debit;
                    $CashBookNonMatching->reference_number = $transaction->reference_number;
                    $CashBookNonMatching->credit = $transaction->credit;
                    $CashBookNonMatching->book_balance = $transaction->book_balance;
                    $CashBookNonMatching->order_number = $transaction->order_number;
                    $CashBookNonMatching->institution = $transaction->institution;
                    $CashBookNonMatching->new_posting_date = Carbon::parse($transaction->posting_date)->format('Y-m-d H:i:s');
                    $CashBookNonMatching->save();


                }


                $transactions = DB::table('nmb_transactions_matching')->get();
                foreach ($transactions as $transaction) {


                    $CashBookNonMatching = new NmbMatchingStore();
                    $CashBookNonMatching->team_id = $transaction->team_id;
                    $CashBookNonMatching->posting_date = $transaction->posting_date;
                    $CashBookNonMatching->details = $transaction->details;
                    $CashBookNonMatching->value_date = $transaction->value_date;
                    $CashBookNonMatching->debit = $transaction->debit;
                    $CashBookNonMatching->reference_number = $transaction->reference_number;
                    $CashBookNonMatching->credit = $transaction->credit;
                    $CashBookNonMatching->book_balance = $transaction->book_balance;
                    $CashBookNonMatching->order_number = $transaction->order_number;
                    $CashBookNonMatching->institution = $transaction->institution;
                    $CashBookNonMatching->new_posting_date = Carbon::parse($transaction->posting_date)->format('Y-m-d H:i:s');
                    $CashBookNonMatching->save();


                }


            }


            if(Session::get('typeOfTransfer') =='UCHUMI') {

                $transactions = DB::table('uchumi_transactions_non_matching')->get();
                foreach ($transactions as $transaction) {


                    $CashBookNonMatching = new uchumitransactionsnonmatchingstore();
                    $CashBookNonMatching->team_id = $transaction->team_id;
                    $CashBookNonMatching->posting_date = $transaction->posting_date;
                    $CashBookNonMatching->details = $transaction->details;
                    $CashBookNonMatching->value_date = $transaction->value_date;
                    $CashBookNonMatching->debit = $transaction->debit;
                    $CashBookNonMatching->reference_number = $transaction->reference_number;
                    $CashBookNonMatching->credit = $transaction->credit;
                    $CashBookNonMatching->book_balance = $transaction->book_balance;
                    $CashBookNonMatching->order_number = $transaction->order_number;
                    $CashBookNonMatching->institution = $transaction->institution;
                    $CashBookNonMatching->new_posting_date = Carbon::parse($transaction->posting_date)->format('Y-m-d H:i:s');
                    $CashBookNonMatching->save();


                }

                $transactions = DB::table('uchumi_transactions_matching')->get();
                foreach ($transactions as $transaction) {


                    $CashBookNonMatching = new uchumitransactionsmatchingstore();
                    $CashBookNonMatching->team_id = $transaction->team_id;
                    $CashBookNonMatching->posting_date = $transaction->posting_date;
                    $CashBookNonMatching->details = $transaction->details;
                    $CashBookNonMatching->value_date = $transaction->value_date;
                    $CashBookNonMatching->debit = $transaction->debit;
                    $CashBookNonMatching->reference_number = $transaction->reference_number;
                    $CashBookNonMatching->credit = $transaction->credit;
                    $CashBookNonMatching->book_balance = $transaction->book_balance;
                    $CashBookNonMatching->order_number = $transaction->order_number;
                    $CashBookNonMatching->institution = $transaction->institution;
                    $CashBookNonMatching->new_posting_date = Carbon::parse($transaction->posting_date)->format('Y-m-d H:i:s');
                    $CashBookNonMatching->save();


                }


            }

            $res = CashBookNonMatching::truncate();
            $res = CrdbNonMatching::truncate();
            $res = NmbNonMatching::truncate();
            $res = Crdb::truncate();
            $res = Nmb::truncate();
            $res = Cashbook::truncate();
            $res = CrdbNonMatching::truncate();
            $res = NmbNonMatching::truncate();
            $res = CashBookNonMatching::truncate();
            $res = CrdbMatching::truncate();
            $res = NmbMatching::truncate();
            $res = CashBookMatching::truncate();
            $res=Uchumi::truncate();
            $res = UchumiNonMatching::truncate();
            $res = UchumiMatching::truncate();



            $this->typeOfTransfer = '';
            $this->ordernumber = '';
            Session::put('orderNumber', '');
            Session::put('typeOfTransfer', '');
            $this->showThirdPartSelector = false;
            Session::put('cbfileisset', false);
            Session::put('tpfileisset', false);
            $this->running = false;
            $this->disableTpButton ='';
            $this->disableCbButton ='';

            $this->emit('refreshTables');
            $this->isSessionReady = false;
       }

    }




    public function importData(){
        if($this->excelFileTp == null){
            $this->inputterrors = 'PLEASE SELECT A THIRD PART FILE TO UPLOAD...';
        }else{

            $this->inputterrors = '';
            if($this->ordernumber == ''){
                $this->ordernumber = sprintf("%06d", mt_rand(1, 999999));
            }

            Session::put('orderNumber', $this->ordernumber);
            Session::put('typeOfTransfer', $this->typeOfTransfer);

            Excel::import(new ImportTransactions, $this->excelFileTp->store('files'));

            //$this->excelFileTp = null;
            $this->iteration++;
            $this->disableTpButton = 'disabled';
        }
    }


    public function importDataCb(){
        if($this->excelFile == null){
            $this->inputterrors = 'PLEASE SELECT A CASH BOOK FILE TO UPLOAD...';
        }else{

            Session::put('uploadCBDone', false);
            $this->inputterrors = '';

            if($this->ordernumber == ''){
                $this->ordernumber = sprintf("%06d", mt_rand(1, 999999));
            }



            Session::put('orderNumber', $this->ordernumber);
            Session::put('typeOfTransfer', 'CB');
            Session::put('thirdPart', $this->typeOfTransfer);
            Excel::import(new ImportTransactions, $this->excelFile->store('files'));

            $this->disableCbButton ='disabled';


        }


    }


    public function clearData(){
        $this->showThirdPartSelector = false;
        $this->inputterrors = '';
        $res=CashBookNonMatching::truncate();
        $res=CrdbNonMatching::truncate();
        $res=NmbNonMatching::truncate();
        $res=RecoSessions::where('session_id',$this->ordernumber)->delete();
        $res=Crdb::truncate();
        $res=Nmb::truncate();
        $res=Cashbook::truncate();
        $res=Uchumi::truncate();
        $res=CrdbNonMatching::truncate();
        $res=NmbNonMatching::truncate();
        $res=CashBookNonMatching::truncate();
        $res=CrdbMatching::truncate();
        $res=NmbMatching::truncate();
        $res=CashBookMatching::truncate();
        $res = UchumiNonMatching::truncate();
        $res = UchumiMatching::truncate();

        $this->typeOfTransfer = '';
        $this->ordernumber = '';
        Session::put('orderNumber', '');
        Session::put('typeOfTransfer', '');
        $this->showThirdPartSelector = false;
        Session::put('cbfileisset',false);
        Session::put('tpfileisset',false);
        $this->running = false;
        $this->disableTpButton ='';
        $this->disableCbButton ='';
        $this->emit('refreshTables');


    }
    public function newSession(){

        $res=CashBookNonMatching::truncate();
        $res=CrdbNonMatching::truncate();
        $res=NmbNonMatching::truncate();
        //$res=RecoSessions::where('session_id',$this->ordernumber)->delete();
        $res=Crdb::truncate();
        $res=Nmb::truncate();
        $res=Cashbook::truncate();
        $res=Uchumi::truncate();
        $res=CrdbNonMatching::truncate();
        $res=NmbNonMatching::truncate();
        $res=CashBookNonMatching::truncate();
        $res=CrdbMatching::truncate();
        $res=NmbMatching::truncate();
        $res=CashBookMatching::truncate();
        $res = UchumiNonMatching::truncate();
        $res = UchumiMatching::truncate();
        $this->inputterrors = '';
        $this->typeOfTransfer = '';
        $this->ordernumber = "ELCT-".sprintf("%06d", mt_rand(1, 999999));
        Session::put('orderNumber', $this->ordernumber);
        Session::put('typeOfTransfer', '');
        $this->showThirdPartSelector = true;
        Session::put('cbfileisset',false);
        Session::put('tpfileisset',false);
        $this->running = false;
        $this->disableTpButton ='';
        $this->emit('refreshTables');





    }
    public function exportUsers(){

        Session::put('fileToDownload', 'CB');
        Session::put('committed', false);
        return Excel::download(new ExportTransactions, 'Cashbook_non_matched_transactions.xlsx');
    }
    public function exportUsersx(){
        Session::put('committed', false);
        Session::put('fileToDownload', $this->typeOfTransfer);
        return Excel::download(new ExportTransactions, $this->typeOfTransfer.'_non_matched_transactions.xlsx');
    }


    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        Session::put('uploadCBDone', true);

        return view('livewire.reconciliation.order.create-order');
    }
}