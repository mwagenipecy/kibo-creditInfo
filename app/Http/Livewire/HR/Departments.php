<?php

namespace App\Http\Livewire\HR;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Support\Facades\Session;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Departments extends LivewireDatatable
{
    protected $listeners = ['refreshMembersTable' => '$refresh'];

    public $exportable = true;

    public function boot()
    {

        Session::put('memberStatus', null);

    }

    public function builder()
    {
        $memberStatus = '';

        return Department::query();

    }

    public function viewMember($memberId)
    {
        Session::put('memberToViewId', $memberId);
        $this->emit('refreshMembersListComponent');
    }

    public function editMember($memberId, $name)
    {
        Session::put('memberToEditId', $memberId);
        Session::put('memberToEditName', $name);
        $this->emit('refreshMembersListComponent');
    }

    /**
     * Write code on Method
     *
     * @return array()
     */
    public function columns(): array
    {
        return [
            Column::name('id')
                ->label('ID'),
            Column::name('department_name')->label('Department Name')->searchable(),
            Column::callback('id', function ($id) {
                $employes = Employee::where('department', $id)->get();

                return count($employes);
            })->label('Employees'),
            Column::name('status')->label('status')->searchable(),

            Column::callback(['id', 'department_name'], function ($id, $department) {

                return view('livewire.h-r.department-action', ['id' => $id, 'name' => $department]);

            })->label('Action'),

            //                return view('livewire.members.table-actions', ['id' => $id, 'name' => $name]);
            //            })->unsortable()->label('id')
        ];
    }

    public function edit($id)
    {

        $this->emitTo('h-r.h-r', 'editDepartment', $id);
        session()->put('departmentIdForEditing', $id);

    }

    public function deleteDepartment($id)
    {
        $this->emitTo('h-r.h-r', 'deleteDepartment', $id);
    }
}
