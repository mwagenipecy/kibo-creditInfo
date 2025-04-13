<?php

namespace App\Http\Livewire\Loans;

use App\Models\ClientsModel;
use App\Models\loans_schedules;
use Carbon\Carbon;
use Livewire\Component;


use App\Models\issured_shares;
use App\Models\LoansModel;
use App\Models\BranchesModel;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use App\Models\Clients;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\Session;
use App\Models\search;

class LoansTable extends LivewireDatatable
{

    protected $listeners = [
        'refreshSavingsComponent' => '$refresh',
        'sortByBranchChanged' => 'updateSortByBranch',
        'filterLoanOfficerChanged' => 'updateFilterLoanOfficer'
    ];
    public $exportable = true;
    public $receivedSortByBranch;
    public $receivedFilterLoanOfficer;

    public function updateSortByBranch($value)
    {
        $this->receivedSortByBranch = $value;
    }

    public function updateFilterLoanOfficer($value)
    {
        $this->receivedFilterLoanOfficer = $value;
    }





    public function builder()
    {
        return LoansModel::query()->where('lender_id',auth()->user()->institution_id);
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

        $html =null;
            return [

                Column::callback(['client_id'], function ($member_number) {

                    return ClientsModel::where('id',$member_number)->value('first_name').' '.ClientsModel::where('id',$member_number)->value('middle_name').' '.ClientsModel::where('id',$member_number)->value('last_name');
                })->label('Client name'),





                Column::callback('principle',function ($principle){
                    if($principle){
                        return number_format($principle,2);
                    }else{
                        return '0.00';
                    }

                })
                    ->label('Amount Requested (TZS)')->searchable(),

                Column::callback(['id'],function ($id){
                    //return LoansModel::where('id',$loan_id)->value('client_id');
                    return DB::table('items')->where('id',LoansModel::where('id',$id)->value('item_id'))->value('make_and_model').' '.
                        DB::table('items')->where('id',LoansModel::where('id',$id)->value('item_id'))->value('color').' '.
                        DB::table('items')->where('id',LoansModel::where('id',$id)->value('item_id'))->value('year_of_manufacture');
                    //return $id;
                })->label('Item'),

                Column::callback('status',function ($status){

                    return view('livewire.branches.table-status', ['status' => $status, 'move' => false]);
                })->label('Status')->searchable(),


            ];


    }





    public function viewloan($id,$member_number,$status){

        $member_number = LoansModel::where('id',$id)->value('client_number');
        $loanType = LoansModel::where('id',$id)->value('loan_type');
//

        Session::forget('currentloanClient');
        Session::forget('currentloanID');

        if($status == 1){
            Session::put('loanStatus','ONPROGRESS');
        }elseif ($status == 2){
            Session::put('loanStatus','AWAITING APPROVAL');
        }
        elseif ($status == 9){
            Session::put('loanStatus','AWAITING DISBURSEMENT');
        }elseif($status ==10){
            Session::put('loanStatus','CLOSED');
        }
        elseif ($status == 3){
            Session::put('loanStatus','APPROVED');
        }
        elseif ($status == 4){
            Session::put('loanStatus','RESTRUCTURED');
        }
        elseif ($status == 5){
            Session::put('loanStatus','TOP UP');
        }
        elseif ($status == 6){
            Session::put('loanStatus','ACTIVE');
        }
        elseif ($status == 7){
            Session::put('loanStatus','REJECTED');
        }
        elseif ($status == 8){
            Session::put('loanStatus','RECOVERY');
        }else{
            Session::put('loanStatus','PENDING');
        }
        if ($status == 1){
            Session::put('disableInputs',false);
        }else{
            Session::put('disableInputs',true);
        }

        Session::put('currentloanClient',$member_number);
        Session::put('currentloanID',$id);

        $this->emit('currentloanID');
        session()->put('loan_type',$loanType);
        $this->emit('viewClientDetails');
    }


    public function deleteLoanModal($id,$member_number){
        $member_number = LoansModel::where('id',$id)->value('client_number');
        session::forget('loanAccountID');
        session::forget('currentloanClientDeleteModal');
        session::put('loanAccountID',$id);
        session::put('currentloanClientDeleteModal',$member_number);
        $this->emit('deleteLoan');

    }




}
