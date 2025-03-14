<?php

namespace App\Http\Livewire\Approvals;



use App\Models\AccountsModel;
use App\Models\Branches;
use App\Models\institutions;
use App\Models\Clients;
use App\Models\Search;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

use App\Models\approvals;
use App\Models\TeamUser;
use Illuminate\Support\Facades\Auth;
use App\Actions\IFT;

class ApprovalsList extends Component
{

    public $approvals;
    public $term = "";
    public $showAddUser = false;
    protected $listeners = ['refreshBranchesListComponent' => '$refresh'];


    public function validateAge($birthday):bool
    {

        if (time() < strtotime('+18 years', strtotime($birthday))) {
            return false;
        }

        return true;
    }



    public function approveCreateBranch($branchId,$approvalsId)
    {

        Branches::where('id', $branchId)->update([
            'branch_status' => 'Active'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Active',
        ]);

    }

    public function rejectCreateBranch($branchId,$approvalsId)
    {

        Branches::where('id', $branchId)->update([
            'branch_status' => 'Rejected'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Rejected',
        ]);

    }

    ////////////////////////////////////////////////////////////////////
    /// ///////////////////////////////////////////////////////////////
    ///
    ///
    public function approveDeleteBranch($branchId,$approvalsId)
    {

        Branches::where('id', $branchId)->update([
            'branch_status' => 'Blocked'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Blocked',
        ]);

    }

    public function rejectDeleteBranch($branchId,$approvalsId)
    {
        Branches::where('id', $branchId)->update([
            'branch_status' => 'Active'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Active',
        ]);
    }

    ////////////////////////////////////////////////////////////////////
    /// ///////////////////////////////////////////////////////////////
    ///
    public function approveEditBranch($branchId,$approvalsId,$changes)
    {
        $changes = json_decode($changes, true);
        foreach($changes as $key => $value){
            $dbValue = Branches::where('id',$branchId)->value($key);
            if($dbValue != $value){
                Branches::where('id', $branchId)->update([
                    $key => $value
                ]);
            }

        }

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Active',
        ]);

    }

    public function rejectEditBranch($approvalsId)
    {

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Rejected',
        ]);

    }

    ////////////////////////////////////////////////////////////////////
    /// ///////////////////////////////////////////////////////////////







    public function approveCreateClient($memberId,$approvalsId)
    {

        Clients::where('id', $memberId)->update([
            'member_status' => 'Active'
        ]);
        $membership_number =  Clients::where('id', $memberId)->value('membership_number');
        AccountsModel::where('member_number', $membership_number)->update([
            'account_status' => 'Active'
        ]);

        $ift = new IFT();
        $ift.processIFT('Transfer of member shares','11111111','11111111','11111111');

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Active',
        ]);

    }

    public function rejectCreateClient($memberId,$approvalsId)
    {

        Clients::where('id', $memberId)->update([
            'member_status' => 'Rejected'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Rejected',
        ]);

    }

    ////////////////////////////////////////////////////////////////////
    /// ///////////////////////////////////////////////////////////////
    ///
    ///
    public function approveDeleteClient($memberId,$approvalsId)
    {

        Clients::where('id', $memberId)->update([
            'member_status' => 'Blocked'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Blocked',
        ]);

    }

    public function rejectDeleteClient($memberId,$approvalsId)
    {

        Clients::where('id', $memberId)->update([
            'member_status' => 'Active'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Active',
        ]);

    }

    ////////////////////////////////////////////////////////////////////
    /// ///////////////////////////////////////////////////////////////
    ///
    public function approveEditClient($memberId,$approvalsId,$changes)
    {
        $changes = json_decode($changes, true);
        foreach($changes as $key => $value){
            $dbValue = Clients::where('id',$memberId)->value($key);
            if($dbValue != $value){
                Clients::where('id', $memberId)->update([
                    $key => $value
                ]);
            }

        }

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Active',
        ]);

    }

    public function rejectEditClient($approvalsId)
    {

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Rejected',
        ]);

    }

    ////////////////////////////////////////////////////////////////////
    /// ///////////////////////////////////////////////////////////////


    ////////////////////////////////////////////////////////////////////
    /// ///////////////////////////////////////////////////////////////
    ///
    public function approveEditInstitution($institutionId,$approvalsId,$changes)
    {
        $changes = json_decode($changes, true);
        foreach($changes as $key => $value){
            $dbValue = institutions::where('id',$institutionId)->value($key);
            if($dbValue != $value){
                institutions::where('id', $institutionId)->update([
                    $key => $value
                ]);
            }

        }

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Active',
        ]);

    }

    public function rejectEditInstitution($approvalsId)
    {

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Rejected',
        ]);

    }

    ////////////////////////////////////////////////////////////////////
    /// ///////////////////////////////////////////////////////////////









    public function approveCreateAccount($accountId,$approvalsId)
    {

        AccountsModel::where('id', $accountId)->update([
            'account_status' => 'Active'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Active',
        ]);

    }

    public function rejectCreateAccount($accountId,$approvalsId)
    {

        AccountsModel::where('id', $accountId)->update([
            'account_status' => 'Rejected'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Rejected',
        ]);

    }

    ////////////////////////////////////////////////////////////////////
    /// ///////////////////////////////////////////////////////////////
    ///
    ///
    public function approveDeleteAccount($accountId,$approvalsId)
    {

        AccountsModel::where('id', $accountId)->update([
            'account_status' => 'Blocked'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Blocked',
        ]);

    }

    public function rejectDeleteAccount($accountId,$approvalsId)
    {

        AccountsModel::where('id', $accountId)->update([
            'account_status' => 'Active'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Active',
        ]);

    }

    ////////////////////////////////////////////////////////////////////
    /// ///////////////////////////////////////////////////////////////
    ///
    public function approveEditAccount($accountId,$approvalsId,$changes)
    {
        $changes = json_decode($changes, true);
        foreach($changes as $key => $value){
            $dbValue = AccountsModel::where('id',$accountId)->value($key);
            if($dbValue != $value){
                AccountsModel::where('id', $accountId)->update([
                    $key => $value
                ]);
            }

        }

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Active',
        ]);

    }

    public function rejectEditAccount($approvalsId)
    {

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Rejected',
        ]);

    }

    ////////////////////////////////////////////////////////////////////
    /// ///////////////////////////////////////////////////////////////

    public function render()
    {

        $institution = TeamUser::where('user_id', Auth::user()->id)->value('institution');
        $this->approvals = approvals::where('institution',$institution)
            ->where('process_status','Pending')->get();


        return view('livewire.approvals.approvals-list');
    }
}

