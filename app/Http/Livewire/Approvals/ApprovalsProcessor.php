<?php

namespace App\Http\Livewire\Approvals;

use App\Models\NodesList;
use App\Models\UserSubMenu;
use Livewire\Component;

use App\Models\approvals;
use App\Models\Branches;
use App\Models\Nodes;
use Illuminate\Support\Facades\Auth;

class ApprovalsProcessor extends Component
{

    public $approvals;
    public $term = "";
    public $showAddUser = false;
    protected $listeners = ['refreshBranchesListComponent' => '$refresh'];
    public $pendingApprovals;
    public $user_sub_menus;


    public function boot(): void
    {
        $this->user_sub_menus = UserSubMenu::where('menu_id',7)->where('user_id', Auth::user()->id)->get();
    }


    public function approveCreateNode($branchId,$approvalsId)
    {

        Branches::where('id', $branchId)->update([
            'branch_status' => 'Active'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Active',
        ]);

    }

    public function rejectCreateNode($branchId,$approvalsId)
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
    public function approveDeleteNode($branchId,$approvalsId)
    {

        NodesList::where('ID', $branchId)->update([
            'branch_status' => 'Blocked'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Blocked',
        ]);

    }

    public function rejectDeleteNode($branchId,$approvalsId)
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
    public function approveEditNode($nodeId,$approvalsId,$changes)
    {
        $changes = json_decode($changes, true);
        foreach($changes as $key => $value){
            $dbValue = Nodes::where('id',$nodeId)->value($key);
            if($dbValue != $value){
                Nodes::where('id', $nodeId)->update([
                    $key => $value
                ]);
            }

        }

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Active',
        ]);

    }

    public function rejectEditNode($approvalsId)
    {

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Rejected',
        ]);

    }

    ////////////////////////////////////////////////////////////////////
    /// ///////////////////////////////////////////////////////////////







    public function approveCreateClient($branchId,$approvalsId)
    {

        Branches::where('id', $branchId)->update([
            'branch_status' => 'Active'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Active',
        ]);

    }

    public function rejectCreateClient($branchId,$approvalsId)
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
    public function approveDeleteClient($branchId,$approvalsId)
    {

        Branches::where('id', $branchId)->update([
            'branch_status' => 'Blocked'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Blocked',
        ]);

    }

    public function rejectDeleteClient($branchId,$approvalsId)
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
    public function approveEditClient($branchId,$approvalsId,$changes)
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

    public function rejectEditClient($approvalsId)
    {

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Rejected',
        ]);

    }

    ////////////////////////////////////////////////////////////////////
    /// ///////////////////////////////////////////////////////////////












    public function approveCreateAccount($branchId,$approvalsId)
    {

        Branches::where('id', $branchId)->update([
            'branch_status' => 'Active'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Active',
        ]);

    }

    public function rejectCreateAccount($branchId,$approvalsId)
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
    public function approveDeleteAccount($branchId,$approvalsId)
    {

        Branches::where('id', $branchId)->update([
            'branch_status' => 'Blocked'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Blocked',
        ]);

    }

    public function rejectDeleteAccount($branchId,$approvalsId)
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
    public function approveEditAccount($branchId,$approvalsId,$changes)
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

    public function rejectEditAccount($approvalsId)
    {

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'Rejected',
        ]);

    }

    ////////////////////////////////////////////////////////////////////
    /// ///////////////////////////////////////////////////////////////









    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $this->approvals = approvals::where('approval_status','PENDING')->get();
        $this->pendingApprovals = $this->approvals->count();
        $this->user_sub_menus = UserSubMenu::where('menu_id',7)->where('user_id', Auth::user()->id)->get();
        //dd($this->approvals);

        return view('livewire.approvals.approvals-processor');
    }
}
