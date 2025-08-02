<?php

namespace App\Http\Livewire\Branches;

use App\Models\approvals;
use App\Models\BranchesModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Branches extends Component
{
    public $tab_id = '1';

    public $title = 'Branches list';

    public $selected;

    public $activeBranchesCount;

    public $inactiveBranchesCount;

    public $showCreateNewBranch;

    public $name;

    public $region;

    public $wilaya;

    public $membershipNumber;

    public $parentBranch;

    public $showDeleteBranch;

    public $branchSelected;

    public $showEditBranch;

    public $pendingbranch;

    public $branchesList;

    public $pendingbranchname;

    public $branch;

    public $showAddBranch = false;

    public $phone_number;

    public bool $viewBranchDetails = false;

    public $email;

    public $branch_status;

    public $permission;

    public $password;

    protected $listeners = [
        'showUsersList' => 'showUsersList',
        'blockBranch' => 'blockBranchModal',
        'editBranch' => 'editBranchModal',
    ];

    protected $rules = [
        'name' => 'required|min:3',
        'region' => 'required|min:3',
        'wilaya' => 'required|min:3',
        'branchNumber' => 'required|unique:branches',
        // 'parentBranch' => 'required|min:3',
    ];

    public function showAddBranchModal($selected)
    {

        $latest_branch = DB::table('branches')->latest()->value('branchNumber');
        $this->branchNumber = $latest_branch + 1;
        $this->selected = $selected;
        $this->showAddBranch = true;
    }

    public function closeShowAddBranch()
    {
        $this->resetData();
        $this->showAddBranch = false;
    }

    public function updatedBranch()
    {
        $branchData = BranchesModel::select('branchNumber', 'name', 'region', 'wilaya', 'email', 'phone_number')
            ->where('id', '=', $this->branch)
            ->get();
        foreach ($branchData as $branch) {
            $this->branchNumber = $branch->branchNumber;
            $this->name = $branch->name;
            $this->region = $branch->region;
            $this->wilaya = $branch->wilaya;
            $this->email = $branch->email;
            $this->phone_number = $branch->phone_number;
            $this->branch_status = $branch->branch_status;
        }
    }

    public function updateBranch()
    {

        $user = auth()->user();

        $data = [
            'branchNumber' => $this->branchNumber,
            'name' => $this->name,
            'region' => $this->region,
            'wilaya' => $this->wilaya,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
        ];

        $update_value = approvals::updateOrCreate(
            [
                'process_id' => $this->branch,
                'user_id' => Auth::user()->id,

            ],
            [
                'institution' => $this->branch,
                'process_name' => 'editBranch',
                'process_description' => 'has edited a branch',
                'approval_process_description' => 'has approved changes to a branch',
                'process_code' => '02',
                'process_id' => $this->branch,
                'process_status' => 'Pending',
                'user_id' => auth()->user()->id,
                'team_id' => $this->branch,
                'edit_package' => json_encode($data),
            ]
        );
        Session::flash('message', 'Awaiting approval');
        Session::flash('alert-class', 'alert-success');
        $this->resetData();
        $this->showAddBranch = false;
    }

    public function addBranch()
    {
        $this->validate();

        $user = auth()->user();

        $branch = new BranchesModel;
        $branch->branch_status = 'PENDING';
        $branch->branchNumber = str_pad($this->branchNumber, 2, 0, STR_PAD_LEFT);
        $branch->name = $this->name;
        $branch->region = $this->region;
        $branch->wilaya = $this->wilaya;
        $branch->email = $this->email;
        $branch->phone_number = $this->phone_number;
        $branch->institution_id = auth()->user()->institution_id;
        $branch->save();
        $insertedId = $branch->id;

        $update_value = approvals::updateOrCreate(
            [
                'process_id' => $insertedId,
                'user_id' => Auth::user()->id,

            ],
            [
                'institution' => $insertedId,
                'process_name' => 'addBranch',
                'process_description' => 'has added a branch',
                'approval_process_description' => 'has approved addition of a branch',
                'process_code' => '02',
                'process_id' => $insertedId,
                'process_status' => 'Pending',
                'user_id' => Auth::user()->id,
                'team_id' => $insertedId,
                'edit_package' => '',
            ]
        );
        Session::flash('message', 'Awaiting approval');
        Session::flash('alert-class', 'alert-success');
        $this->resetData();
        $this->closeShowAddBranch();
    }

    public function submit()
    {

        $institution_id = '';
        $id = auth()->user()->id;
        $currentUser = DB::table('team_user')->where('user_id', $id)->get();
        foreach ($currentUser as $User) {
            $institution_id = $User->team_id;
        }

        $this->validate();

        // Execution doesn't reach here if validation fails.

        $id = BranchesModel::create([
            'name' => $this->name,
            'region' => $this->region,
            'wilaya' => $this->wilaya,
            'branchNumber' => $this->branchNumber,
            'parentBranch' => $this->parentBranch,
            'institution_id' => auth()->user()->institution_id,
            'branch_status' => 'Pending',
        ])->id;

        $user = auth()->user();

        $team = $user->currentTeam;

        $institution = TeamUser::where('user_id', Auth::user()->id)->value('institution');

        approvals::create([
            'institution' => $institution,
            'process_name' => 'createBranch',
            'process_description' => 'has created a new branch',
            'approval_process_description' => 'has approved a new branch',
            'process_code' => '01',
            'process_id' => $id,
            'process_status' => 'Pending',
            'user_id' => Auth::user()->id,
            'team_id' => '',
        ]);

        $this->resetData();

        Session::flash('message', 'A new branch has been successfully created!');
        Session::flash('alert-class', 'alert-success');
    }

    public function resetData()
    {
        $this->name = '';
        $this->region = '';
        $this->wilaya = '';
        $this->branchNumber = '';
        $this->parentBranch = '';
        $this->email = '';
        $this->phone_number = '';

    }

    public function menuItemClicked($tabId)
    {
        $this->tab_id = $tabId;
        if ($tabId == '1') {
            $this->title = 'Branches list';
        }
        if ($tabId == '2') {
            $this->title = 'Enter new branch details';
        }
    }

    public function createNewBranch()
    {
        $this->showCreateNewBranch = true;
    }

    public function blockBranchModal($id)
    {

        $this->showDeleteBranch = true;
        $this->branchSelected = $id;
    }

    public function editBranchModal($id)
    {
        $this->showEditBranch = true;
        $this->pendingbranch = $id;
        $this->branch = $id;
        $this->pendingbranchname = BranchesModel::where('id', $id)->value('name');
        $this->updatedBranch();

    }

    public function closeModal()
    {
        $this->showCreateNewBranch = false;
        $this->showDeleteBranch = false;
        $this->showEditBranch = false;
    }

    public function confirmPassword(): void
    {
        // Check if password matches for logged-in user
        if (Hash::check($this->password, auth()->user()->password)) {
            // dd('password matches');
            $this->delete();
        } else {
            // dd('password does not match');
            Session::flash('message', 'This password does not match our records');
            Session::flash('alert-class', 'alert-warning');
        }
        $this->resetPassword();

    }

    public function resetPassword(): void
    {
        $this->password = null;
    }

    public function delete(): void
    {
        $user = BranchesModel::where('id', $this->branchSelected)->first();
        $action = '';
        if ($user->id) {
            if ($this->permission == 'BLOCKED') {
                $action = 'blockUser';
            }
            if ($this->permission == 'ACTIVE') {
                $action = 'activateUser';
            }
            if ($this->permission == 'DELETED') {
                $action = 'deleteUser';
            }
            $update_value = approvals::updateOrCreate(
                [
                    'process_id' => $this->branchSelected,
                    'user_id' => auth()->user()->id,

                ],
                [
                    'institution' => ' ',
                    'process_name' => $action,
                    'process_description' => $this->permission.' user - '.$user->name,
                    'approval_process_description' => '',
                    'process_code' => '29',
                    'process_id' => $this->branchSelected,
                    'process_status' => $this->permission,
                    'approval_status' => 'PENDING',
                    'user_id' => Auth::user()->id,
                    'team_id' => '',
                    'edit_package' => null,
                ]
            );

            // Delete the record
            // $node->delete();
            // Add your logic here for successful deletion
            Session::flash('message', 'Awaiting approval');
            Session::flash('alert-class', 'alert-success');

            $this->closeModal();
            $this->render();

        } else {
            // Handle case where record was not found
            // Add your logic here
            Session::flash('message', 'Node error');
            Session::flash('alert-class', 'alert-warning');
        }

    }

    public function render()
    {
        $this->activeBranchesCount = BranchesModel::where('branch_status', '=', 'ACTIVE')->count();
        $this->inactiveBranchesCount = BranchesModel::where('branch_status', '!=', 'ACTIVE')->where('institution_id', auth()->user()->instituion_id)->count();
        $this->branchesList = BranchesModel::get();

        return view('livewire.branches.branches');
    }
}
