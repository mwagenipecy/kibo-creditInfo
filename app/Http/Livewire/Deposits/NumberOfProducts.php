<?php

namespace App\Http\Livewire\Deposits;

use App\Models\sub_products;
use Illuminate\Support\Facades\Session;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class NumberOfProducts extends LivewireDatatable
{
    protected $listeners = ['refreshSavingsComponent' => '$refresh'];

    public $exportable = true;

    public function builder()
    {
        // dd(Session::get('sharesViewItem'));

        return sub_products::query()->where('product_id', '13');

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

            Column::name('sub_product_name')
                ->label('Product Name'),

            Column::name('withdraw_charge')
                ->label('Withdraw charges'),

            Column::name('interest_value')
                ->label('Annual interest'),

            Column::name('notes')
                ->label('Notes'),

            Column::name('sub_product_status')
                ->label('Status'),

        ];

    }
}
