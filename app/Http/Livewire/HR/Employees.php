<?php


namespace App\Http\Controllers;

use App\Models\Branches;
use App\Models\Employee;
use App\Models\grants;
use App\Models\ExpensesModel;
use App\Models\Bonus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Employees extends Controller
{

    public $employees;


    public function render()
    {
        $this->branches = Branches::where('institution_id',Auth::user()->institution_id)->get();


        return view('livewire.h-r.employees');
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
