<?php

namespace App\Http\Livewire\Sidebar;

use App\Models\departmentsList;
use App\Models\sub_menus;
use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Sidebar extends Component
{
    // Public properties for the component
    public $tab_id;
    public $currentUserId;
    public $currentUserDepartment;
    public $menuItems = [];

    // Method to handle when a menu item is clicked
    public function menuItemClicked($item)
    {
        $this->tab_id = $item;
        $this->emit('menuItemClicked', $item);



    }

    /**
     * Renders the component.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     *
     * @throws BindingResolutionException
     */
    public function render()
    {
        // Get the current user ID
        $this->currentUserId = Auth::user()->id;

        // Get the current user's department
        $this->currentUserDepartment = User::where('id', $this->currentUserId)->first()->department;

        // Get the menu items for the current user's department
        $this->menuItems = departmentsList::where('id', $this->currentUserDepartment)->first()->permissions;

        if ($this->menuItems) {
            // Clean up the menu items and sort them
            $str_json = json_encode($this->menuItems);
            $this->menuItems = json_decode($str_json, TRUE);
            $this->menuItems = str_replace(array('[', ']', '"', ' '), '', $this->menuItems);
            $permissions = explode(",", $this->menuItems);
            sort($permissions);


            // Store the permissions in the session
            session()->put('permissions', $permissions);
        } else {
            // If there are no menu items, store a null value in the session
            session()->put('permissions', null);
        }
//        dd($permissions);

        // Get the IDs of the menus that the user has access to
        $menuIds = [];
        foreach ($permissions as $permission) {
            $rows = DB::table('sub_menus')->select('id', 'menu_id')->where('id', $permission)->get();


            foreach ($rows as $row) {
                if (!in_array($row->menu_id, $menuIds)) {
                    $menuIds[] = $row->menu_id;
                }
            }

        }
        $this->menuItems = $menuIds;

        $permission_items =[];
        foreach ($permissions as $permission){
            $rows = DB::table('sub_menus')->select('user_action')->where('id', $permission)->first();

            if($rows){
                $permission_items[] = $rows->user_action;
            }



        }

        session()->put('permission_items', $permission_items);
//        dd($permission_items);
        // Check the user's status and return the appropriate view
        $userStatus = User::where('id', Auth::user()->id)->value('status');
        if ($userStatus == 'PENDING' || $userStatus == 'BLOCKED' || $userStatus == 'DELETED') {
            return view('livewire.empty-div');
        } else {
            return view('livewire.sidebar.sidebar');
        }
    }
}
