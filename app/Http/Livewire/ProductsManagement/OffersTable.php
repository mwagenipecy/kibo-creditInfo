<?php

namespace App\Http\Livewire\ProductsManagement;

use App\Models\ClientsModel;
use App\Models\LoansModel;
use App\Models\OffersModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class OffersTable extends LivewireDatatable
{
    protected $listeners = ['refreshOffersTable' => '$refresh'];

    public $exportable = true;

    public function builder()
    {

        return OffersModel::query();
    }

    public function viewOffer($memberId)
    {
        Session::put('memberToViewId', $memberId);
        dd(Session::get('memberToViewId'));

        $this->emit('refreshOffersListComponent');
    }

    public function editOffer($memberId, $name)
    {
        Session::put('memberToEditId', $memberId);
        Session::put('memberToEditName', $name);
        $this->emit('refreshOffersListComponent');
    }

    /**
     * Write code on Method
     *
     * @return array()
     */
    public function columns(): array
    {

        return [
            Column::callback(['loan_id'], function ($loan_id) {
                // return LoansModel::where('id',$loan_id)->value('client_id');
                return ClientsModel::where('id', LoansModel::where('id', $loan_id)->value('client_id'))->value('first_name').' '.
                    ClientsModel::where('id', LoansModel::where('id', $loan_id)->value('client_id'))->value('middle_name').' '.
                    ClientsModel::where('id', LoansModel::where('id', $loan_id)->value('client_id'))->value('last_name');
                // return $loan_id;
            })->label('Client'),

            Column::callback(['loan_id', 'id'], function ($loan_id, $id) {
                // return LoansModel::where('id',$loan_id)->value('client_id');
                return DB::table('items')->where('id', LoansModel::where('id', $loan_id)->value('item_id'))->value('make_and_model').' '.
                    DB::table('items')->where('id', LoansModel::where('id', $loan_id)->value('item_id'))->value('color').' '.
                    DB::table('items')->where('id', LoansModel::where('id', $loan_id)->value('item_id'))->value('year_of_manufacture');
                // return $loan_id;
            })->label('Item'),

            Column::callback(['offer_status'], function ($offer_status) {
                return $offer_status;
            })->label('Status'),

            Column::callback(['id'], function ($id) {
                return '<div class="flex items-center space-x-4 flex-lg-row">
                                 
                             <svg xmlns="http://www.w3.org/2000/svg" wire:click="viewOfferes('.$id.')"  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
    
                         </div>';
            })->label('offer'),

        ];
    }

    public function viewLoans($offer_number)
    {
        dd($offer_number);
        $this->emit('viewOfferLoans', $offer_number);
    }

    public function edit($id)
    {
        $this->emitUp('editOffer', $id);
    }

    public function block($id)
    {
        $this->emitUp('blockOffer', $id);
    }

    public function viewOfferes($id)
    {

        $this->emitUp('viewOfferDetails',$id);
    }
}
