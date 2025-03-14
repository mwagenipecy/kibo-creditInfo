<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;

class System extends Component
{
    public $menu_id;

    protected $listeners = ['menuItemClicked'];

     public function boot(): void
     {
        DB::table('users')->where('id', auth()->user()->id)->update(['verification_status' => 0]);
        $userStatus = User::where('id', Auth::user()->id)->value('status');

        $userDepartmentName =DB::table('departments')->where('id',User::where('id', Auth::user()->id)->value('department'))->value('department_name');
        session()->put('userDepartment',$userDepartmentName);

        if($userStatus == 'PENDING' || $userStatus == 'BLOCKED' || $userStatus == 'DELETED') {

            $this->menu_id = 9;
        }else{
            $this->menu_id = 0;
        }

    }

    public function menuItemClicked($item): void
    {
        //dd($item);
        $this->menu_id = $item;
        $this->dispatchBrowserEvent('contentChanged');
    }

    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        return view('livewire.system');
    }
}
