<?php

namespace App\Http\Livewire\Accounting;

use App\Models\approvals;
use App\Models\BranchesModel;
use App\Models\ClientsModel;
use App\Models\institutions;
use App\Models\Members;
use App\Models\MembersModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use function PHPUnit\Framework\isEmpty;

class MemberTable extends LivewireDatatable
{
    protected $listeners = ['refreshMembersTable' => '$refresh'];
    public $exportable = true;

    


    public function builder()
    {
        return ClientsModel::query()->where('client_status','ONPROGRESS')->orWhere('client_status','NEW LOAN APPLICATION');
        //->leftJoin('branches', 'branches.id', 'members.branch')
    }

    public function viewMember($memberId){
        Session::put('memberToViewId',$memberId);
        $this->emit('refreshMembersListComponent');
    }
    public function editMember($memberId,$name){
        Session::put('memberToEditId',$memberId);
        Session::put('memberToEditName',$name);
        $this->emit('refreshMembersListComponent');
    }

    public function columns(): array
    {
        return [

            Column::name('first_name')
                ->label('first name')->searchable(),

            Column::name('middle_name')
                ->label('middle name'),

            Column::callback('branch',function($id){
                return BranchesModel::where('id',$id)->value('name');
            })
                ->label('branch'),

            Column::name('phone_number')
                ->label('phone number'),

            Column::name('id')
                ->label('membership number')->searchable(),

            Column::callback(['client_status'], function ($status) {
                return view('livewire.branches.table-status', ['status' => $status, 'move' => false]);
            })->label('status'),
            Column::callback('id',function($id){
                return view('livewire.accounting.member-action',['id'=>$id]);
            })->label('action')

        ];
    }
    public function  financeViewMemberes($id){

        $this->emitTo('accounting.accounting','financeViewMember',$id);

    }

    public function   financeAccept ($id){
        // member name
        $full_name= MembersModel::where('id',$id)->value('first_name').' '.MembersModel::where('id',$id)->value('middle_name').' '.MembersModel::where('id',$id)->value('last_name');
        // get status
        $member_status=MembersModel::where('id',$id)->value('member_status');
        if($member_status=="SAVING WITHDRAW REQUEST"){
            MembersModel::where('id',$id)->update([
                'member_status'=>"ACTIVE",
                'allow_deposit_withdraw'=>true,
            ]);
            approvals::create([
                'approver_id' => Auth::user()->id,
                'process_status' => 'APPROVED',
                'approval_status' => 'APPROVED',
                'approval_process_description' => 'allow savings withdraw  to '.$full_name,
            ]);
        }
        elseif($member_status=="SAVING WITHDRAW END"){
            MembersModel::where('id',$id)->update([
                'member_status'=>"ACTIVE",
                'allow_deposit_withdraw'=>false,
            ]);

            approvals::create([
                'approver_id' => Auth::user()->id,
                'process_status' => 'APPROVED',
                'approval_status' => 'APPROVED',
                'approval_process_description' => 'terminate savings withdraw to '.$full_name,
            ]);
        }

    }

    public function financeReject($id){
        // member name
        $full_name= MembersModel::where('id',$id)->value('first_name').' '.MembersModel::where('id',$id)->value('middle_name').' '.MembersModel::where('id',$id)->value('last_name');

        MembersModel::where('id',$id)->update([
            'member_status'=>"ACTIVE",
        ]);
        approvals::create([
            'approver_id' => session()->get('currentUser')->id,
            'process_status' => 'REJECTED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'reject savings withdraw '.$full_name,
        ]);
    }



}
