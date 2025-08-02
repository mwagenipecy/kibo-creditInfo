<?php

namespace App\Http\Livewire\HR;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class PayRoll extends livewiredatatable
{
    protected $listeners = ['refreshMembersTable' => '$refresh', 'employeePaymentModal', 'employeePaymentModalTurnOn'];

    public $exportable = true;

    public $selectedEmployee = false;

    public function employeePaymentModalTurnOn()
    {
        $this->selectedEmployee = true;

    }

    public function employeePaymentModalTurnOff()
    {
        $this->selectedEmployee = false;

    }

    public function boot()
    {
        Session::put('memberStatus', null);
    }

    public function builder()
    {
        $memberStatus = '';

        return Employee::query();
    }

    /**
     * Write code on Method
     *
     * @return array()
     */
    public function columns(): array
    {
        return [
            Column::name('employee_number')
                ->label('Employee Number')->searchable(),
            Column::callback('id', function ($id) {
                $first_name = Employee::where('id', $id)->value('first_name');
                $middle_name = Employee::where('id', $id)->value('middle_name');
                $last_name = Employee::where('id', $id)->value('last_name');

                return $first_name.'   '.$middle_name.'    '.$last_name;
            })->label('Full Name'),

            Column::callback('department', function ($id) {
                return Department::where('id', $id)->value('department_name');
            })->label('Department'),
            Column::name('salary')
                ->label('Salary')->searchable(),

            Column::callback('benefits', function ($benefitId) {
                return DB::table('benefits')->where('id', $benefitId)->value('amount');
            })
                ->label('Benefits'),
            Column::callback('taxes', function ($taxId) {
                return DB::table('taxes')->where('id', $taxId)->value('amount');
            })
                ->label('Taxes'),

            Column::callback('contribution', function ($contributionId) {
                return DB::table('Contributions')->where('id', $contributionId)->value('amount');
            })
                ->label('Contribution')->searchable(),

            Column::callback(['salary', 'taxes', 'contribution', 'benefits'], function ($salary, $taxes, $contribution, $benefits) {

                return array_sum([$salary, $taxes, $contribution, $benefits]);
            })->label('Total'),
            Column::name('employee_status')->label('Status')->searchable(),

            Column::callback(['id', 'employee_number'], function ($id, $employee_number) {
                $employee_status = Employee::where('id', $id)->value('employee_status');
                //                if()

                $html = null;

                if (in_array('Create and View employee', session()->get('permission_items'))) {
                    $html = '<div class="flex items-center space-x-4 flex-lg-row">
               <style>
                 .hoverable:hover .hidden {
                   display: block;
                   }
             </style>
             
                    <button wire:click="employeePaymentModal('.$employee_number.')" type="button" class="hoverable text-white bg-gray-100 hover:bg-blue-100 hover:text-blue focus:ring-4 focus:outline-none focus:ring-blue-100 font-medium rounded-lg text-sm p-1 text-center inline-flex items-center mr-2 dark:bg-blue-200 dark:hover:bg-blue-200 dark:focus:ring-blue-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="blue" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <span class="hidden text-blue-800 m-2">Pay</span>
                    </button>
                            </div> ';
                }

                return $html;

            })->label('Action'),

        ];
    }

    public function employeePaymentModal($employee_number)
    {
        session()->forget('employeeId');

        session()->put('employee_status', Employee::where('employee_status', $employee_number)->value('employee_status'));
        session()->put('employeeId',$employee_number);

        $this->employeePaymentModalTurnOn();
    }
}
