<?php

namespace App\Http\Livewire\Clients;

use App\Models\Application;
use App\Models\BranchesModel;
use App\Models\Employee;
use App\Models\LoansModel;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


use App\Models\ClientsModel;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\Session;
use App\Models\search;

class ClientsTable extends LivewireDatatable
{

    protected $listeners = ['refreshClientsTable' => '$refresh'];
    public $exportable = true;


    public function builder()
    {


        return Application::query()->where('lender_id',auth()->user()->institution_id)->where('application_status','ACCEPTED');
    }

    public function viewClient($memberId){
        Session::put('memberToViewId',$memberId);
        dd(Session::get('memberToViewId'));

        $this->emit('refreshClientsListComponent');
    }
    public function editClient($memberId,$name){
        Session::put('memberToEditId',$memberId);
        Session::put('memberToEditName',$name);
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

            Column::callback(['first_name','middle_name','last_name'],function($first_name,$middle_name,$last_name){

                return $first_name.' '.$middle_name.' '.$last_name;
            })
                ->label('client name')->searchable(),

            Column::callback('phone_number',function($phone_number){
                return $phone_number;
            })->label('phone number'),

            Column::callback('national_id',function($national_id){
                return $national_id;
            })->label('nida'),

            Column::callback('region',function($region){
                return $region;
            })->label('region'),

            Column::callback('email',function($region){
                return $region;
            })->label('email'),


            Column::name('created_at')->label('report date'),

            Column::callback(['make_and_model','year_of_manufacture'],function($make, $model){

                return $make.' '.$model;
            })->label('Car Info')->searchable(),


           

            Column::callback(['down_payment'],function($amount){

                return $amount ? number_format($amount,2).' TZS' : '0.00 TZS';
            })->label('Down payment Price')->searchable(),



            Column::callback(['loan_amount'],function($amount){

                return $amount ? number_format($amount,2).' TZS' : '0.00 TZS';
            })->label('Loan Amount')->searchable(),



            // Column::callback(['branch','client_number'],function ($branch,$client_number){
            //     return LoansModel::where('client_number',$client_number)->where('status','ACTIVE')->count();
            // })->label('active Car loans'),

                Column::callback(['purchase_price'], function ($id) {
                    return number_format($id,2). ' TZS';
                })->unsortable()->label('Total Price'),



        ];
    }


    public function viewLoans($client_number){

        $this->emit('viewClientLoans',$client_number);
    }


    public function edit($id){
        $this->emitUp('editClient',$id);
        }
        public function block($id){
        $this->emitUp('blockClient',$id);
        }
        public function viewClientes($id){

        $this->emitUp('viewClientDetails',$id);
        }


}
