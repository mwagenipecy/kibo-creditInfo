<?php

namespace App\Http\Livewire\Settings;


use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\Actions\UpdateTeamClientRole;
use Laravel\Jetstream\Contracts\AddsTeamClients;
use Laravel\Jetstream\Contracts\InvitesTeamClients;
use Laravel\Jetstream\Contracts\RemovesTeamClients;
use Laravel\Jetstream\Features;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\Role;
use Livewire\Component;
use App\Models\AccountsModel;
use Laravel\Jetstream\Team;
use App\Models\User;
use App\Models\TeamUser;
use App\Models\departmentsList;


class UserSettings extends Component
{
    /**
     * The team instance.
     *
     * @var mixed
     */
    public $team;

    /**
     * Indicates if a user's role is currently being managed.
     *
     * @var bool
     */
    public $currentlyManagingRole = false;

    /**
     * The user that is having their role managed.
     *
     * @var mixed
     */
    public $managingRoleFor;

    /**
     * The current role for the user that is having their role managed.
     *
     * @var string
     */
    public $currentRole;

    /**
     * Indicates if the application is confirming if a user wishes to leave the current team.
     *
     * @var bool
     */
    public $confirmingLeavingTeam = false;

    /**
     * Indicates if the application is confirming if a team member should be removed.
     *
     * @var bool
     */
    public $confirmingTeamClientRemoval = false;

    /**
     * The ID of the team member being removed.
     *
     * @var int|null
     */
    public $teamClientIdBeingRemoved = null;


    public $accounts;

    public $user;

    public $pendingUsers;

    public $department;

    public $departmentList;

    public $pendinguser;

    public $userrole;

    /**
     * The "add team member" form state.
     *
     * @var array
     */
    public $addTeamClientForm = [
        'email' => '',
        'role' => null,
    ];

    /**
     * Mount the component.
     *
     * @param mixed $team
     * @return void
     */
    public function mount(): void
    {
        $this->user = auth()->user();

        $this->team = $this->user->currentTeam;

        $this->pendingUsers = User::get();
        $institution = TeamUser::where('user_id',Auth::user()->id)->value('institution');
        $this->departmentList = departmentsList::where('institution',$institution )->get();
    }


    protected $rules = [
        'pendinguser' => 'required|min:4',
        'department' => 'required|min:4',
        'userrole' => 'required|min:4',
    ];

    public function save(){

        //dd('kk');

        //$this->validate();

        TeamUser::where('user_id',$this->pendinguser)->update([
            'role'=>$this->userrole,
            'institution'=>TeamUser::where('user_id',Auth::user()->id)->value('institution'),
            'team_id'=>TeamUser::where('user_id',Auth::user()->id)->value('team_id'),
            'department'=>$this->department
        ]);

        User::where('id',$this->pendinguser)->update([
            'branch_id'=>'OFFICER',
            'current_team_id'=>TeamUser::where('user_id',Auth::user()->id)->value('team_id'),
        ]);

        $this->pendinguser = null;
        $this->department = null;
        $this->userrole = null;

    }


    /**
     * Add a new team member to a team.
     *
     * @return void
     */
    public function addTeamClient()
    {
        $this->resetErrorBag();

        if (Features::sendsTeamInvitations()) {
            app(InvitesTeamClients::class)->invite(
                $this->user,
                $this->team,
                $this->addTeamClientForm['email'],
                $this->addTeamClientForm['role']
            );
        } else {
            app(AddsTeamClients::class)->add(
                $this->user,
                $this->team,
                $this->addTeamClientForm['email'],
                $this->addTeamClientForm['role']
            );
        }

        $this->addTeamClientForm = [
            'email' => '',
            'role' => null,
        ];

        $this->team = $this->team->fresh();

        $this->emit('saved');
    }

    /**
     * Cancel a pending team member invitation.
     *
     * @param int $invitationId
     * @return void
     */
    public function cancelTeamInvitation($invitationId)
    {
        if (!empty($invitationId)) {
            $model = Jetstream::teamInvitationModel();

            $model::whereKey($invitationId)->delete();
        }

        $this->team = $this->team->fresh();
    }

    /**
     * Allow the given user's role to be managed.
     *
     * @param int $userId
     * @return void
     */
    public function manageRole($userId)
    {
        $this->currentlyManagingRole = true;
        $this->managingRoleFor = Jetstream::findUserByIdOrFail($userId);
        $this->currentRole = $this->managingRoleFor->teamRole($this->team)->key;
    }

    /**
     * Save the role for the user being managed.
     *
     * @param \Laravel\Jetstream\Actions\UpdateTeamClientRole $updater
     * @return void
     */
    public function updateRole(UpdateTeamClientRole $updater)
    {
        $updater->update(
            $this->user,
            $this->team,
            $this->managingRoleFor->id,
            $this->currentRole
        );

        $this->team = $this->team->fresh();

        $this->stopManagingRole();
    }

    /**
     * Stop managing the role of a given user.
     *
     * @return void
     */
    public function stopManagingRole()
    {
        $this->currentlyManagingRole = false;
    }

    /**
     * Remove the currently authenticated user from the team.
     *
     * @param \Laravel\Jetstream\Contracts\RemovesTeamClients $remover
     * @return void
     */
    public function leaveTeam(RemovesTeamClients $remover)
    {
        $remover->remove(
            $this->user,
            $this->team,
            $this->user
        );

        $this->confirmingLeavingTeam = false;

        $this->team = $this->team->fresh();

        return redirect(config('fortify.home'));
    }

    /**
     * Confirm that the given team member should be removed.
     *
     * @param int $userId
     * @return void
     */
    public function confirmTeamClientRemoval($userId)
    {
        $this->confirmingTeamClientRemoval = true;

        $this->teamClientIdBeingRemoved = $userId;
    }

    /**
     * Remove a team member from the team.
     *
     * @param \Laravel\Jetstream\Contracts\RemovesTeamClients $remover
     * @return void
     */
    public function removeTeamClient(RemovesTeamClients $remover)
    {
        $remover->remove(
            $this->user,
            $this->team,
            $user = Jetstream::findUserByIdOrFail($this->teamClientIdBeingRemoved)
        );

        $this->confirmingTeamClientRemoval = false;

        $this->teamClientIdBeingRemoved = null;

        $this->team = $this->team->fresh();
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    /**
     * Get the available team member roles.
     *
     * @return array
     */
    public function getRolesProperty()
    {
        return collect(Jetstream::$roles)->transform(function ($role) {
            return with($role->jsonSerialize(), function ($data) {
                return (new Role(
                    $data['key'],
                    $data['name'],
                    $data['permissions']
                ))->description($data['description']);
            });
        })->values()->all();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $this->accounts = AccountsModel::where('sub_product_number', '19')->get();
        return view('livewire.settings.user-settings');
    }
}
