<?php

namespace App\Http\Livewire\Shares;


use App\Models\Clients;
use Illuminate\Support\Facades\DB;
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

class ActiveShares extends LivewireDatatable
{

    protected $listeners = ['refreshShareComponent' => '$refresh'];
    public $exportable = true;


    public function builder()
    {
        //dd(Session::get('sharesViewItem'));


        if (Session::get('sharesViewItem') == '2') {
            return issured_shares::query()->where('status', 'Active');
        }
        if (Session::get('sharesViewItem') == '3') {
            return issured_shares::query()->where('status', 'Awaiting approval');
        }
        if (Session::get('sharesViewItem') == '4') {
            return issured_shares::query()->where('status', 'Awaiting activation');
        }
        if (Session::get('sharesViewItem') == '5') {
            return issured_shares::query()->where('status', 'Declined');
        }
        if (Session::get('sharesViewItem') == '6') {
            return issured_shares::query()->where('status', 'Closed');
        }
        if (Session::get('sharesViewItem') == '7') {
            return issured_shares::query();
        }
        return issured_shares::query();


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

            Column::callback('member',function($id){
                return Clients::where('id',$id)->value('first_name').'   '.Clients::where('id',$id)->value('middle_name').'   '.Clients::where('id',$id)->value('last_name') ;
            })
                ->label('Client Name'),

                Column::callback('product',function($productId){

                    return DB::table('sub_products')->where('sub_product_id',$productId)->value('sub_product_name');
                })
                ->label('Product Name'),

                Column::name('number_of_shares')
                ->label('Number of shares'),

            Column::name('price')
                ->label('Price'),

            Column::name('account_number')
                ->label('Account'),

            Column::name('status')
                ->label('Status')

        ];


    }


}

