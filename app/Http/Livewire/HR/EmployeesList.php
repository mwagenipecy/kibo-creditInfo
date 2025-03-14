<?php
namespace App\Http\Livewire\HR;

use App\Models\Employee;
use App\Models\grants;
use App\Models\ExpensesModel;
use App\Models\Bonus;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Config;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\WithFileUploads;
use App\Models\issured_shares;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\AccountsModel;
use App\Models\general_ledger;
use App\Models\Members;


use App\Models\approvals;
use App\Models\TeamUser;

class EmployeesList extends Component
{

    public $employees;
    public $viewMemberDetails=false;
    protected $listeners=['memberToViewId'=>'vewMemberDetail'];


    public function vewMemberDetail(){
        if($this->viewMemberDetails==false){
            $this->viewMemberDetails=true;
        }
        else if($this->viewMemberDetails==true){
            $this->viewMemberDetails=false;
        }
    }

//    public function

    public function mount()
    {
        $this->employees = Employee::all();
    }

    public function render()
    {
        $this->employees = Employee::all();

        //dd($this->employees);
        return view('livewire.h-r.employees-list');
    }

    public function show(Employee $employee)
    {
        $employee->load([
            'absences' => function ($query) {
                $query->orderBy('absence_date', 'desc');
            },
            'benefits',
            'bonuses',
        ]);

        return view('employees.show', compact('employee'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $employee = Employee::create($request->all());

        return redirect()->route('employees.show', $employee->id);
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->all());

        return redirect()->route('employees.show', $employee->id);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index');
    }

    public function addAbsence(Request $request, Employee $employee)
    {
        $employee->absences()->create($request->all());

        return redirect()->route('employees.show', $employee->id);
    }
}
