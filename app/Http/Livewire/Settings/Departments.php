<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use App\Models\departmentsList;
use App\Models\menu_list;
use App\Models\TeamUser;
use Illuminate\Support\Facades\Auth;


class Departments extends Component
{
    public $departments = [];
    public $existingDepartments;
    public $departmentsList;
    public $department_name;
    public $department;

    protected $rules = [
        'department_name' => 'required|min:4',
    ];

    public function setnew(){
        $this->departments = [];
    }

    public function setexisting(){
        $this->existingDepartments = departmentsList::get();
    }


    public function save(){

        $this->validate();

        departmentsList::create([
            'institution' => TeamUser::where('user_id',Auth::user()->id)->value('institution'),
            'department_name' => $this->department_name,
            'modules' => json_encode($this->departments),

        ]);

        $this->departments = [];
        $this->department_name = null;

    }

    public function render()
    {
        $this->departmentsList = menu_list::get();
        $this->existingDepartments = departmentsList::get();
        //dd($this->existingDepartments);
        return view('livewire.settings.departments');
    }
}
