<?php

namespace App\Http\Livewire\Payments;

use App\Models\Transactions;
use Illuminate\Support\Facades\Session;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ManageOrdersTable extends LivewireDatatable
{
    protected $listeners = ['viewOrder' => '$refresh'];

    public $exportable = true;

    public function builder()
    {

        return Transactions::query()->where('order_number', Session::get('orderNumber'));
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

    /**
     * Write code on Method
     *
     * @return array()
     */
    public function columns(): array
    {
        return [

            Column::name('typeOfTransfer')
                ->label('Type'),

            Column::raw('issuer_name')
                ->label('Sender'),

            Column::raw('beneficiary_nane')
                ->label('Beneficiary Name'),

            Column::raw('source_branch_account_number')
                ->label('Debit AC'),

            Column::name('destination_branch_account_number')
                ->label('Credit AC'),

            Column::name('destination_bank_name')
                ->label('Institution'),

            Column::name('transaction_amount')
                ->label('Amount'),

            Column::name('description')
                ->label('Description'),

            Column::name('trans_status')
                ->label('Progress'),

            Column::name('payment_status')
                ->label('Status'),
        ];
    }
}
