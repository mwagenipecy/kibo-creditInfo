<?php

namespace App\Http\Livewire\Shares;


use Livewire\Component;

use App\Models\issured_shares;
use App\Models\sub_products;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\Session;
use App\Models\search;

class NumberOfProducts extends LivewireDatatable
{

    protected $listeners = ['refreshShareComponent' => '$refresh'];
    public $exportable = true;


    public function builder()
    {
        //dd(Session::get('sharesViewItem'));

        return sub_products::query()->where('product_id', '11');


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


        return  [

            Column::name('sub_product_name')
                ->label('Product Name'),

            Column::name('total_shares')
                ->label('Shares allocated'),

            Column::name('shares_per_member')
                ->label('Shares Per Client'),

            Column::name('nominal_price')
                ->label('Price per share'),

            Column::name('notes')
                ->label('Description')

        ];


    }


}
