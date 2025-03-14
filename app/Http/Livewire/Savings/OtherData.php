<?php

namespace App\Http\Livewire\Savings;

use Livewire\Component;

use App\Models\AccountsModel;
use App\Models\sub_products;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\Session;
use App\Models\search;

class OtherData extends LivewireDatatable
{

    protected $listeners = ['refreshSavingsComponent' => '$refresh'];
    public $exportable = true;


    public function builder()
    {
        //dd(Session::get('sharesViewItem'));


        if (Session::get('savingsViewItem') == '3') {
            return AccountsModel::query()->where('account_status', 'Active')->where('product_number', '12');
        }
        if (Session::get('savingsViewItem') == '7') {
            return AccountsModel::query()->where('account_status', 'Inactive')->where('product_number', '12');
        }
        if (Session::get('savingsViewItem') == '4') {
            return AccountsModel::query()->where('account_status', 'Blocked')->where('product_number', '12');
        }
        if (Session::get('savingsViewItem') == '5') {
            return AccountsModel::query()->where('account_status', 'Pending')->where('product_number', '12');
        }
        if (Session::get('savingsViewItem') == '6') {
            return AccountsModel::query()->where('account_status', 'Closed')->where('product_number', '12');
        }
        if (Session::get('savingsViewItem') == '8') {
            return AccountsModel::query();
        }
        return AccountsModel::query();


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

            Column::name('account_name')
                ->label('Client Name'),

            Column::name('sub_product_number')
                ->label('Product Name'),

            Column::name('account_number')
                ->label('Account number'),

            Column::name('balance')
                ->label('Available balance'),

            Column::name('account_use')
                ->label('Usage'),

            Column::name('account_status')
                ->label('Status'),

        ];


    }


}
