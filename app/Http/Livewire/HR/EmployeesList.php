<?php

namespace App\Http\Livewire\HR;

use App\Models\Employee;
use Illuminate\Http\Request;
use Livewire\Component;

class EmployeesList extends Component
{
    public $employees;

    public $viewMemberDetails = false;

    protected $listeners = ['memberToViewId' => 'vewMemberDetail'];

    public function vewMemberDetail()
    {
        if ($this->viewMemberDetails == false) {
            $this->viewMemberDetails = true;
        } elseif ($this->viewMemberDetails == true) {
            $this->viewMemberDetails = false;
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

        // dd($this->employees);
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
