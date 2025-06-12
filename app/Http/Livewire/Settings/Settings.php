<?php

namespace App\Http\Livewire\Settings;

use App\Http\Traits\MailSender;
use App\Models\approvals;
use App\Models\Department;
use App\Models\departmentsList;
use App\Models\User;
use App\Models\UserSubMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use App\Services\UserService;

use Livewire\WithFileUploads;

class Settings extends Component
{
    use MailSender, WithFileUploads;

    // Tab navigation
    public $tab_id = 6;
    public $selected;

    // User statistics
    public $activeUsers;
    public $inActiveUsers;

    // Modal control
    public $showCreateNewUser = false;
    public $showDeleteUser = false;
    public $showEditUser = false;
    public bool $showRoles = false;

    // User lists
    public $usersList;
    public $pendingUsers;
    public $user_sub_menus;

    // User information
    public $name;
    public $email;
    public $phone_number;
    public $password;
    public $password_confirmation;
    public $role;
    public $status = 'ACTIVE';
    public $department;
    public $profile_photo;
    public $newuser;
    
    // User actions
    public $userSelected;
    public $permission = 'BLOCKED';
    public $pendinguser;
    
    // Department/Role info
    public $departmentList;
    public $departmentName;
    public $userrole;
    public $department_name;
    
    // Other variables
    public $nodesList;
    public string $NODE_NAME = '';
    public string $userName = '';
    public $menusArray;
    public $menuItems;
    public $sub_menus;
    public $team;
    public $accounts;
    public $user;
    protected $userService;
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email',
        'phone_number' => [
            'required',
            'string',
            'regex:/^(\+255|0)[1-9]\d{8}$/',
            'unique:users,phone_number'
        ],
        'department' => 'nullable'
    ];

    protected $listeners = [
        'showUsersList' => 'showUsersList',
        'blockUser' => 'blockUserModal',
        'editUser' => 'editUserModal',
        'refreshComponent' => '$refresh',
        'openCreateModal' => 'createNewUser',
    ];

    /**
     * Initialize component
     */
    public function boot(): void
    {
        $this->nodesList = User::get();
        $this->tab_id = 6;
        $this->user_sub_menus = UserSubMenu::where('menu_id', 8)
            ->where('user_id', Auth::user()->id)
            ->get();
        $this->password = "";

    }

    /**
     * Mount component and load initial data
     */
    public function mount(UserService $userService)
    {
        $this->loadDepartments();
        $this->userService = $userService;

    }

    /**
     * Load department list for dropdown
     */
    public function loadDepartments()
    {
        $this->departmentList = departmentsList::get();
    }

    /**
     * Render component with data
     */
    public function render()
    {
        $this->activeUsers = User::where('status', 'ACTIVE')->count();
        $this->inActiveUsers = User::where('status', '!=', 'ACTIVE')->count();
        $this->user_sub_menus = UserSubMenu::where('menu_id', 8)
            ->where('user_id', Auth::user()->id)
            ->get();
        $this->usersList = User::get();
        $this->pendingUsers = User::get();
        $this->departments=Department::get();

        return view('livewire.settings.settings', [
            'totalUsers' => User::count(),
            'activeUsers' => $this->activeUsers,
            'inactiveUsers' => $this->inActiveUsers,
        ]);
    }
    /**
     * Change active tab view
     */
    public function setView($id): void
    {
        $this->tab_id = $id;
    }
    /**
     * Set users tab as active
     */
    public function showUsersList(): void
    {
        $this->tab_id = 6;
    }
    /**
     * Open user creation modal
     */
    public function createNewUser(): void
    {
        $this->resetRegistrationFields();
        $this->showCreateNewUser = true;
    }
    /**
     * Reset user registration form fields
     */
    public function resetRegistrationFields(): void
    {
        $this->name = null;
        $this->email = null;
        $this->phone_number = null;
        $this->password = null;
        $this->password_confirmation = null;
        $this->role = null;
        $this->status = 'ACTIVE';
        $this->department = null;
        $this->profile_photo = null;
        $this->resetErrorBag();
    }

    /**
     * Create a new user with approval workflow
     */
    public function createUser(): void
    {

        // Validate form data
        $this->validate();



        try{



      

        // Create new user
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone_number = $this->phone_number;
        $user->status = 'ACTIVE';
        $user->department = $this->department;
        $user->password = bcrypt($this->password);
        $user->otp_time = now();
        $user->verification_status = '0';

        //$user->department=1;
        
        if ($user->save()) {
            // Create approval request
           

            $this->newuser = $user->id;
            $this->showRoles = true;
            Session::put('newuser', $user->id);
        }


         // Set success message
         session()->flash('message', 'User created, awaiting approval');
         session()->flash('alert-class', 'alert-success');
 
         // Reset form fields
         $this->resetRegistrationFields();
         $this->closeModal();
         $this->render();



    }
        catch (\Exception $e) {
            session()->flash('error', 'Error creating user: ' . $e->getMessage());

            dd($e->getMessage());
            return;
        }

       
    }

    /**
     * Alternative user registration method with profile photo upload
     */
    public function registerUser()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone_number' => [
                'required',
                'string',
                'regex:/^(\+255|0)[1-9]\d{8}$/',
                'unique:users,phone_number'
            ],
            'password' => ['required', 'confirmed', 'min:8'],
            'department' => 'nullable',
            'profile_photo' => 'nullable|image|max:1024', // 1MB Max
        ]);
        
        try {
            // Handle profile photo if uploaded
            $profile_photo_path = null;
            if ($this->profile_photo) {
                $profile_photo_path = $this->profile_photo->store('profile-photos', 'public');
            }
            
            // Create user
            $user = new User();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->phone_number = $this->phone_number;
            $user->status = 'ACTIVE';
            $user->department = $this->department;
            $user->password = bcrypt($this->password);
            $user->profile_photo_path = $profile_photo_path;
            $user->otp_time = now();
            $user->department=1;

            $user->verification_status = '0';

         //   $user->save();


            $data=[
                'name'=>$this->name,
                'email'=>$this->email,
                'password'=>$this->password,
                'phone_number'=>$this->phone_number,
                // 'department'=>$this->department,
                'profile_photo_path'=>$profile_photo_path,
                'status'=>'ACTIVE',
                'otp_time'=>now(),
                'verification_status'=>'0',
                'department'=>1,
                $user->verification_status = '0',


            ];
            $userService= new UserService();
            $user = $userService->createUser($data, true);
            
            
         
            
            // Reset form and close modal
            $this->resetRegistrationFields();
            $this->showCreateNewUser = false;
            
            // Show success message
            session()->flash('message', 'User registered successfully! Awaiting approval.');
            session()->flash('alert-class', 'alert-success');
            
            // Refresh user list component
            $this->emit('refreshUsersList');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Error registering user: ' . $e->getMessage());
        }
    }

    /**
     * Open block/delete user modal
     */
    public function blockUserModal($id): void
    {
        $this->userSelected = $id;
        $this->showDeleteUser = true;
    }

    /**
     * Open edit user modal
     */
    public function editUserModal($id): void
    {
        $this->pendinguser = $id;
        $this->department = User::where('id', $id)->value('department');
        $this->showEditUser = true;
    }

    /**
     * Close all modals
     */
    public function closeModal(): void
    {
        $this->showCreateNewUser = false;
        $this->showDeleteUser = false;
        $this->showEditUser = false;
    }

    /**
     * Process user status change
     */
    public function delete(): void
    {
        $user = User::where('id', $this->userSelected)->first();
        $action = '';
        
        if ($user) {
            if ($this->permission == 'BLOCKED') {
                $action = 'blockUser';
            }
            if ($this->permission == 'ACTIVE') {
                $action = 'activateUser';
            }
            if ($this->permission == 'DELETED') {
                $action = 'deleteUser';
            }

           

            Session::flash('message', 'Status change request submitted. Awaiting approval.');
            Session::flash('alert-class', 'alert-success');
        } else {
            Session::flash('message', 'User not found');
            Session::flash('alert-class', 'alert-warning');
        }

        $this->closeModal();
        $this->render();
    }

    /**
     * Confirm password before user action
     */
    public function confirmPassword(): void
    {
        // Check if password matches for logged-in user
        if (Hash::check($this->password, auth()->user()->password)) {
            $this->delete();
        } else {
            Session::flash('message', 'This password does not match our records');
            Session::flash('alert-class', 'alert-warning');
        }
        $this->resetPassword();
    }

    /**
     * Reset password field
     */
    public function resetPassword(): void
    {
        $this->password = null;
    }

    /**
     * Save user role changes
     */
    public function saveRole(): void
    {
        $data = [
            'department' => $this->department,
        ];

        // Create approval request
      

        // Reset fields
        $this->pendinguser = null;
        $this->department = null;
        $this->userrole = null;

        session()->flash('message', 'Role change requested. Awaiting approval.');
        session()->flash('alert-class', 'alert-success');

        $this->closeModal();
        $this->render();
    }
}