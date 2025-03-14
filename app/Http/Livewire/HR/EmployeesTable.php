<?php

namespace App\Http\Livewire\HR;


use App\Models\Branches;
use App\Models\Department;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


use App\Models\Employee;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Illuminate\Support\Facades\Session;
use App\Models\search;

class EmployeesTable extends LivewireDatatable
{

    protected $listeners = ['refreshMembersTable' => '$refresh'];
    public $exportable = true;

    public function boot(): void
    {

        Session::put('memberStatus',null);




    }

    public function builder()
    {
        $memberStatus = '';

        return Employee::query();

    }

    public function delete($id){
        $this->emitTo('h-r.h-r','deleteEmployee',$id);

    }

    public function viewClient($memberId)
    {

        Session::put('memberToViewId', $memberId);
        $this->emit('refreshMembersListComponent');
        $this->emit('viewMemberDetailsForm');
    }

    public function editClient($memberId)
    {
        Session::put('employeeIdForEdit', $memberId);

        $this->emit('editEmployeeModal',$memberId);
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
                ->label('Employee Number')->searchable(),
            Column::callback(['first_name','middle_name','last_name'], function($first_name,$middle_name,$last_name){

                return $first_name.' '.$middle_name.' '.$last_name;})
                ->label('Name')->searchable(),
            Column::callback('branch',function ($branchId){
                return Branches::where('id',$branchId)->value('name');
            })
                ->label('Branch')->searchable(),
            Column::callback('department',function($departmentId){
                return Department::where('id',$departmentId)->value('department_name');
            })
                ->label('Department')->searchable(),
            Column::name('job_title')
                ->label('Title'),
            Column::name('phone')
                ->label('Phone Number'),
            Column::name('created_at')
                ->label('Start Date'),
            Column::name('employee_status')
                ->label('Status'),
            Column::callback(['id', 'first_name'], function ($id, $name) {
                return view('livewire.clients.table-actions', ['id' => $id, 'name' => $name]);
            })->unsortable()
        ];
    }
}
