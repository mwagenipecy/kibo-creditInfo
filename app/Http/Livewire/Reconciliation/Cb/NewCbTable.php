<?php

namespace App\Http\Livewire\Reconciliation\Cb;

use App\Models\CashBookMatchingStore;
use App\Models\cashbooknonmatchingstore;
use Illuminate\Support\Facades\Session;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class NewCbTable extends LivewireDatatable
{
    protected $listeners = ['refreshTables' => '$refresh'];

    public $exportable = true;

    public $ordernumber;

    public function builder()
    {
        $this->ordernumber = Session::get('orderNumber');

        return cashbooknonmatchingstore::query()->where('order_number', $this->ordernumber);

    }

    public function viewClient($memberId)
    {
        Session::put('memberToViewId', $memberId);
        $this->emit('refreshClientsListComponent');
    }

    public function editClient($memberId, $name)
    {
        Session::put('memberToEditId', $memberId);
        Session::put('memberToEditName', $name);
        $this->emit('refreshClientsListComponent');
    }

    public function resolve($value)
    {

        $transactions = cashbooknonmatchingstore::where('id', $value)->get();
        foreach ($transactions as $transaction) {

            $CashBookNonMatching = new CashBookMatchingStore;
            $CashBookNonMatching->team_id = $transaction->team_id;
            $CashBookNonMatching->value_date = $transaction->value_date;
            $CashBookNonMatching->transaction_amount = $transaction->transaction_amount;
            $CashBookNonMatching->description = $transaction->description;
            $CashBookNonMatching->reference_number = $transaction->reference_number;
            $CashBookNonMatching->order_number = $transaction->order_number;
            $CashBookNonMatching->institution = $transaction->institution;
            $CashBookNonMatching->save();

        }

        cashbooknonmatchingstore::where('id', $value)->delete();

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

            Column::callback(['id'], function ($id) {

                return view('livewire.reconciliation.cb.action', ['id' => $id, 'user' => '22']);
            })->unsortable(),

            Column::name('reference_number')
                ->label('Reference Number'),

            Column::name('description')
                ->label('Description'),

            Column::name('value_date')
                ->label('Value Date'),

            Column::callback(['id', 'transaction_amount'], function ($id, $transaction_amount) {
                if ($transaction_amount > 0) {
                    return number_format($transaction_amount, 2);
                } else {
                    return '0.00';
                }

            })->label('Debit')
                ->alignRight(),

            Column::callback(['transaction_amount'], function ($transaction_amount) {
                if ($transaction_amount > 0) {
                    return '0.00';
                } else {
                    return number_format($transaction_amount * -1, 2);
                }

            })->label('Credit')
                ->alignRight(),

        ];
    }
}
