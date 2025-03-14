<?php

namespace App\Http\Livewire\Settings;

use App\Http\Traits\MailSender;
use App\Models\approvals;
use App\Models\departmentsList;
use App\Models\User;
use App\Models\UserSubMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Settings extends Component
{
    public $activeUsers;
    public $inActiveUsers;
    public $selected;
    public $tab_id;

    protected $listeners = [
        'showUsersList' => 'showUsersList',
        'blockUser' => 'blockUserModal',
        'editUser' => 'editUserModal'
        ];

    public $user_sub_menus;

    public $showCreateNewUser = false;


    //////////////////////////////////////////////// USR///////////////////////////////

    public $showDeleteUser = false;

    use MailSender;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $department;
    public $departmentList;
    public $menusArray;
    /**
     * @var string[]|null
     */
    public $menuItems;
    public $sub_menus;
    /**
     * @var true
     */
    public bool $showRoles = false;
    public $newuser;
    public $phone_number;


    protected $rules = [
        'newuser' => 'required|min:1',
        'department' => 'required|min:1'

    ];
    public $departmentName;


///////////////////////////////////////////BLOCK USER/////////////////////////////////////////////////


    public $userSelected;
    public $nodesList;
    public string $NODE_NAME;
    public string $userName;
    public $usersList;
    public $permission = 'BLOCKED';


    ////////////////////////////////////////ROLES SET//////////////////////////////////////////////////


    public $team;

    public $accounts;

    public $user;

    public $pendingUsers;



    public $pendinguser;

    public $userrole;

    public $department_name;
    public bool $showEditUser = false;


    public function showUsersList(): void
    {

        $this->tab_id = 6;
    }

    public function boot(): void
    {
        $this->nodesList = User::get();
        $this->userName = '';
        $this->tab_id = 6;
        $this->user_sub_menus = UserSubMenu::where('menu_id',8)->where('user_id', Auth::user()->id)->get();
        $this->password = "12345";
    }

    public function setView($page): void
    {
        $this->tab_id = $page;
    }


    public function createNewUser()
    {


        $this->showCreateNewUser = true;
    }

    public function blockUserModal($id)
    {
        $this->userSelected = $id;
        $this->showDeleteUser = true;
    }

    public function editUserModal($id)
    {

        $this->pendinguser = $id;
        $this->department = User::where('id',$id)->value('department');
        $this->showEditUser = true;
    }

        public function closeModal(){
            $this->showCreateNewUser = false;
            $this->showDeleteUser = false;
            $this->showEditUser = false;
        }


    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $this->activeUsers = User::where('status', 'ACTIVE')->get()->count();
        $this->inActiveUsers = User::where('status', 'PENDING')->orWhere('status', 'DELETED')->orWhere('status', 'INACTIVE')->orWhere('status', 'BLOCKED')->get()->count();
        $this->user_sub_menus = UserSubMenu::where('menu_id',8)->where('user_id', Auth::user()->id)->get();
        $this->departmentList = departmentsList::get();
        $this->usersList = User::get();
        $this->pendingUsers = User::get();
        return view('livewire.settings.settings');
    }





    public function createUser(): void
    {


            $validatedData = $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'phone_number' => [
                    'required',
                    'string',
                    'regex:/^(\+255|0)[1-9]\d{8}$/',
                    'unique:users,phone_number'
                ]
            ]);


            $user = new User();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->phone_number = $this->phone_number;
            $user->status = 'PENDING';
            $user->department = $this->department;
            $user->password = bcrypt($this->password);
            $user->otp_time = now();
            $user->verification_status = '0';
            if ($user->save()) {


                $update_value = approvals::updateOrCreate(
                    [
                        'process_id' => $user->id,
                        'user_id' => Auth::user()->id

                    ],
                    [
                        'institution' => '',
                        'process_name' => 'addUser',
                        'process_description' => Auth::user()->name.' has requested to add a User - '.$this->name,
                        'approval_process_description' => '',
                        'process_code' => '30',
                        'process_id' => $user->id,
                        'process_status' => 'PENDING',
                        'approval_status' => 'PENDING',
                        'user_id'  => Auth::user()->id,
                        'team_id'  => ''

                    ]
                );

                $this->newuser = $user->id;
                $this->showRoles = true;
                Session::put('newuser', $user->id);



            }

        session()->flash('message', 'User created, awaiting approval');
        session()->flash('alert-class', 'alert-success');
        session()->flash('success', 'User created successfully.');

        $this->name = '';
        $this->email = '';
        $this->phone_number = '';
        $this->department = '';

        //sleep(3);
        $this->closeModal();
        $this->render();



    }





    public function delete(): void
    {
        $user = User::where('id',$this->userSelected)->first();
        $action = '';
        if ($user) {

            if($this->permission == 'BLOCKED'){
                $action = 'blockUser';
            }
            if($this->permission == 'ACTIVE'){
                $action = 'activateUser';
            }
            if($this->permission == 'DELETED'){
                $action = 'deleteUser';
            }

            $update_value = approvals::updateOrCreate(
                [
                    'process_id' => $this->userSelected,
                    'user_id' => Auth::user()->id

                ],
                [
                    'institution' => '',
                    'process_name' => $action,
                    'process_description' => $this->permission.' user - '.$user->name,
                    'approval_process_description' => '',
                    'process_code' => '29',
                    'process_id' => $this->userSelected,
                    'process_status' => $this->permission,
                    'approval_status' => 'PENDING',
                    'user_id'  => Auth::user()->id,
                    'team_id'  => '',
                    'edit_package'=> null
                ]
            );


            // Delete the record
            //$node->delete();
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



    public function confirmPassword(): void
    {
        // Check if password matches for logged-in user
        if (Hash::check($this->password, auth()->user()->password)) {
            //dd('password matches');
            $this->delete();
        } else {
            //dd('password does not match');
            Session::flash('message', 'This password does not match our records');
            Session::flash('alert-class', 'alert-warning');
        }
        $this->resetPassword();


    }

    public function resetPassword(): void
    {
        $this->password = null;
    }



    public function saveRole(): void
    {


        $data = [
            'department' => $this->department,
        ];



        $update_value = approvals::updateOrCreate(
            [
                'process_id' => $this->pendinguser,
                'user_id' => Auth::user()->id

            ],
            [
                'institution' => '',
                'process_name' => 'editUser',
                'process_description' => 'A request to edit a ROLE of user - '.User::where('id',$this->pendinguser)->value('name'),
                'approval_process_description' => '',
                'process_code' => '27',
                'process_id' => $this->pendinguser,
                'process_status' => 'PENDING',
                'approval_status' => 'PENDING',
                'user_id'  => Auth::user()->id,
                'team_id'  => '',
                'edit_package'=> json_encode($data),

            ]
        );


        $this->pendinguser = null;
        $this->department = null;
        $this->userrole = null;

        session()->flash('message', 'Role changed');
        session()->flash('alert-class', 'alert-success');

        $this->closeModal();
        $this->render();


    }


}
