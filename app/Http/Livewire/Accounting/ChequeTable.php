<?php

namespace App\Http\Livewire\Accounting;

use App\Http\Livewire\Branches\Branches;
use App\Models\BranchesModel;
use App\Models\ChequeModel;
use App\Models\Employee;
use App\Models\LoansModel;
use App\Models\Members;
use App\Models\MembersModel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ChequeTable extends LivewireDatatable
{

    public  $exportable=true;




    public function builder()
    {




        return ChequeModel::query(); // You can modify the ordering as per your requirement

    }


    public function columns(): array
    {
        return [

            Column::callback('customer_account',function($account_number){
                $client_number=LoansModel::where('loan_account_number',$account_number)->value('client_number');

                $clients=DB::table('clients')->where('client_number',$client_number)->first();
                return $clients->first_name.' '.$clients->middle_name.' '.$clients->last_name;
            })->label('client Name'),
            Column::name('customer_account')->label('account number'),
            Column::callback('branch',function($branch_id){
                return BranchesModel::where('id',$branch_id)->value('name').'('.BranchesModel::where('id',$branch_id)->value('region').','.BranchesModel::where('id',$branch_id)->value('wilaya').')';
            })->label('branch'),
            Column::callback('amount',function ($amount){
                return number_format($amount,2);
            })->label('amount (TZS)')->searchable(),
            Column::name('created_at')->label('issued date')->searchable(),
            Column::callback('finance_approver',function ($employeeId){
                $employee=Employee::where('id',$employeeId)->first();
                return $employee->first_name.' '.$employee->middle_name.' '.$employee->last_name;
            })->label('initiator'),
            Column::name('is_cleared')->label('cleared'),
            Column::name('status')->label('status')->searchable(),



        ];
    }



    public function approveInstitution($id){
        $this->emitUp('cheques',$id);
    }

    public function declineRequest($id){
        session()->put('declineCheckModal',$id);
        dd('decline check');
    }


}
