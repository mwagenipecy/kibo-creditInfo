<?php

namespace App\Http\Livewire\Settings;

use App\Models\approvals;
use App\Models\departmentsList;
use App\Models\sub_menus;
use App\Models\User;
use App\Models\UserSubMenu;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Roles extends Component
{
    public $team;

    public $accounts;

    public $user;

    public $pendingUsers;

    public $department;

    public $departmentList;

    public $pendinguser;

    public $userrole;

    public $menusArray;

    public $sub_menus;

    public $setSubMenuPermission;

    protected $rules = [
        'pendinguser' => 'required|min:1',
        'department' => 'required|min:1',

    ];

    /**
     * @var string[]|null
     */
    public $menuItems;

    public $department_name;

    public function boot()
    {
        $permissions = [];

    }

    public function setPermission($value): void
    {

        $string = $value;
        $array = explode('-', $string);
        $permission = $array[0]; // "1"
        $menu_id = $array[2]; // "1"
        $sub_menu_id = $array[1];

        $this->validate();

        $userSubMenu = UserSubMenu::where('user_id', $this->pendinguser)->where('sub_menu_id', $sub_menu_id)->first();
        if ($userSubMenu) {
            UserSubMenu::where('user_id', $this->pendinguser)->where('sub_menu_id', $sub_menu_id)
                ->update([
                    'permission' => $permission,
                    'updated' => 1,
                    'previous' => $userSubMenu->permission,
                    'status' => 'PENDING',
                ]);

            // Add a new permission
            $permissions[sub_menus::where('ID', $sub_menu_id)->value('user_action')] = [
                'previous_setting' => [$userSubMenu->permission],
                'new_setting' => [$permission],
            ];

        } else {
            // dd($this->pendinguser);
            $user = new UserSubMenu;
            $user->user_id = $this->pendinguser;
            $user->menu_id = $menu_id;
            $user->sub_menu_id = $sub_menu_id;
            $user->permission = $permission;

            $user->updated = 1;
            $user->previous = null;
            $user->status = 'PENDING';
            $user->save();

            // Add a new permission
            $permissions[sub_menus::where('ID', $sub_menu_id)->value('user_action')] = [
                'previous_setting' => [null],
                'new_setting' => [$permission],
            ];
        }

        $update_value = approvals::updateOrCreate(
            [
                'process_id' => $this->pendinguser,
                'user_id' => Auth::user()->id,

            ],
            [
                'institution' => '',
                'process_name' => 'editPermission',
                'process_description' => 'A request to edit a permissions - '.json_encode($permissions),
                'approval_process_description' => '',
                'process_code' => '22',
                'process_id' => $this->pendinguser,
                'process_status' => 'PENDING',
                'approval_status' => 'PENDING',
                'user_id' => Auth::user()->id,
                'team_id' => '',
                'edit_package' => null,

            ]
        );

        // dd($this->menusArray);
        $this->updatedPendinguser();

    }

    public function save(): void
    {

        User::where('id', $this->pendinguser)->update([
            'department' => $this->department,
        ]);

        $this->pendinguser = null;
        $this->department = null;
        $this->userrole = null;

        session()->flash('message', 'Role changed');
        session()->flash('alert-class', 'alert-success');

    }

    public function updatedPendinguser(): void
    {
        $this->menusArray = [];

        $departmentid = User::where('id', $this->pendinguser)->get()->value('department');
        $this->department = $departmentid;
        // dd($departmentid);
        $this->department_name = departmentsList::where('id', $departmentid)->get()->value('department_name');

        $this->menuItems = departmentsList::where('id', $departmentid)->first()->modules;

        if ($this->menuItems) {
            $str_json = json_encode($this->menuItems);
            $this->menuItems = json_decode($str_json, true);
            $this->menuItems = str_replace(['[', ']', '"', ' '], '', $this->menuItems);

            $this->menuItems = explode(',', $this->menuItems);
            // Sort the menuItems array in ascending order
            sort($this->menuItems);

            foreach ($this->menuItems as $item) {

                $this->sub_menus = sub_menus::where('menu_id', $item)->get();

                foreach ($this->sub_menus as $sub_menu) {
                    $userSubMenu = UserSubMenu::where('user_id', $this->pendinguser)->where('sub_menu_id', $sub_menu->ID)->first();
                    if ($userSubMenu) {
                        $sub_menu->permission = $userSubMenu->permission;
                        // $sub_menu[] = $userSubMenu;
                    } else {
                        $sub_menu->permission = 7;
                    }

                    $this->menusArray[] = $sub_menu;

                }

            }

        } else {
            $this->menuItems = null;
        }

        // dd($this->menusArray);

    }

    public function updatedDepartment($departmentid)
    {
        $this->menusArray = [];

        // dd($departmentid);
        // $this->department = departmentsList::where('id',$departmentid)->get()->value('department_name');

        $this->menuItems = departmentsList::where('id', $departmentid)->first()->modules;

        if ($this->menuItems) {
            $str_json = json_encode($this->menuItems);
            $this->menuItems = json_decode($str_json, true);
            $this->menuItems = str_replace(['[', ']', '"', ' '], '', $this->menuItems);

            $this->menuItems = explode(',', $this->menuItems);
            // Sort the menuItems array in ascending order
            sort($this->menuItems);

            foreach ($this->menuItems as $item) {

                $this->sub_menus = sub_menus::where('menu_id', $item)->get();

                foreach ($this->sub_menus as $sub_menu) {
                    $userSubMenu = UserSubMenu::where('user_id', $this->pendinguser)->where('sub_menu_id', $sub_menu->ID)->first();
                    if ($userSubMenu) {
                        $sub_menu->permission = $userSubMenu->permission;
                        // $sub_menu[] = $userSubMenu;
                    } else {
                        $sub_menu->permission = 7;
                    }

                    $this->menusArray[] = $sub_menu;

                }

            }

        } else {
            $this->menuItems = null;
        }

        // dd($this->menusArray);

    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $this->pendingUsers = User::get();
        $this->departmentList = departmentsList::get();

        return view('livewire.settings.roles');
    }
}
