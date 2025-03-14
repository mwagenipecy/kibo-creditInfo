<?php

namespace App\Http\Livewire\Reconciliation\Crdb;

use Livewire\Component;


use App\Models\uchumitransactionsnonmatchingstore;
use App\Models\uchumitransactionsmatchingstore;
use App\Models\crdbtransactionsnonmatchingstore;
use App\Models\CrdbMatchingStore;
use App\Models\nmbtransactionsnonmatchingstore;
use App\Models\NmbMatchingStore;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\Session;

class NewCrdbTable extends LivewireDatatable
{
    protected $listeners = ['refreshTables' => '$refresh'];
    public $exportable = true;
    public $ordernumber;


    public function builder()
    {
        $this->ordernumber = Session::get('orderNumber');
        if(Session::get('typeOfTransfer') =='CRDB') {
            return crdbtransactionsnonmatchingstore::query()->where('order_number', $this->ordernumber);
        }
        if(Session::get('typeOfTransfer') =='NMB') {
            return nmbtransactionsnonmatchingstore::query()->where('order_number', $this->ordernumber);
        }
        if(Session::get('typeOfTransfer') =='UCHUMI') {
            return uchumitransactionsnonmatchingstore::query()->where('order_number', $this->ordernumber);
        }

        return null;

    }

    public function viewClient($memberId){
        Session::put('memberToViewId',$memberId);
        $this->emit('refreshClientsListComponent');
    }
    public function editClient($memberId,$name){
        Session::put('memberToEditId',$memberId);
        Session::put('memberToEditName',$name);
        $this->emit('refreshClientsListComponent');
    }


    public function resolve($value){



        if(Session::get('typeOfTransfer') =='CRDB') {

            $transactions = crdbtransactionsnonmatchingstore::where('id',$value)->get();
            foreach ($transactions as $transaction){

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
                $CashBookNonMatching->save();


            }

            crdbtransactionsnonmatchingstore::where('id',$value)->delete();
        }
        if(Session::get('typeOfTransfer') =='NMB') {

            $transactions = nmbtransactionsnonmatchingstore::where('id',$value)->get();
            foreach ($transactions as $transaction){

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
                $CashBookNonMatching->save();


            }

            nmbtransactionsnonmatchingstore::where('id',$value)->delete();
        }
        if(Session::get('typeOfTransfer') =='UCHUMI') {

            $transactions = uchumitransactionsnonmatchingstore::where('id',$value)->get();
            foreach ($transactions as $transaction){

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
                $CashBookNonMatching->save();


            }

            uchumitransactionsnonmatchingstore::where('id',$value)->delete();
        }




        $this->emit('refreshSideInfo');

    }



    /**
     * Write code on Method
     *
     * @return array()
     */
    public function columns(): array
    {
        return [

            Column::callback(['id', 'credit'], function ($id, $credit) {
                return number_format(floatval($credit), 2);
            })->label('credit')->alignRight(),

            Column::callback(['id', 'debit'], function ($id, $debit) {
                return number_format(floatval($debit), 2);
            })->label('debit')->alignRight(),

            Column::name('value_date')
                ->label('Value Date'),

            Column::name('details')
                ->label('details'),


            Column::name('reference_number')
                ->label('Reference number'),


            Column::callback(['id'], function ($id) {

                return view('livewire.reconciliation.cb.action', ['id' => $id, 'user' => '22']);
            })->unsortable(),


        ];
    }


}
