<?php

namespace App\Http\Livewire\HR;

use App\Models\Employee;
use App\Models\LeaveManagement;
use Illuminate\Support\Carbon;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\TimeColumn;

class Leave extends LivewireDatatable
{

    public function builder(){
        return LeaveManagement::query();
    }
    public function columns(): array
    {
        return [
            Column::callback('employee_number',function($id){


                return Employee::where('employee_number',$id)->value("first_name").'   '.Employee::where('employee_number',$id)->value("middle_name").'   '.Employee::where('employee_number',$id)->value("last_name");

            })->label('Employee full name')->searchable('MEMBER NUMBER'),
            Column::name('leave_days_taken')->label('Total Leave Days'),
            Column::callback('created_at',function ($created_at){
                $start_date=Carbon::parse($created_at);
                $end_date=Carbon::now();

                $days= $start_date->diffInDays($end_date);
                // calculate  days for leave acc
                $days_created=$days*0.077;
                return (int)$days_created;

            })->label('Days Acquire'),
            Column::name('balance')->label("Balance Day")->searchable(),
            Column::callback(['employee_number','id'],function($employeeNumber){
                $html2 ='<div class="flex items-center space-x-4 flex-lg-row">
                     <style>
                     .hoverable:hover.hidden {
                     display: block;
                     }
                     </style>
                     <button  type="button"  wire:click="checkBox('.$employeeNumber.')" class="hoverable text-white bg-gray-100 hover:bg-blue-100 hover:text-blue-200 focus:ring-4 focus:outline-none focus:ring-blue-100 font-medium rounded-lg text-sm p-1 text-center inline-flex items-center mr-2 dark:bg-blue-200 dark:hover:bg-blue-200 dark:focus:ring-blue-200">
                     <svg xmlns="http://www.w3.org/2000/svg" fill="blue" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                     </svg>
                     <span class="hidden text-blue-800 m-1">Assign</span>
                     </button>
                     </div> ';
                return $html2;
            })->label('Assign')


        ];

    }

    public function checkBox($employeeNumber){
        session()->put('employee_number_id',$employeeNumber);
        $this->emit('leave_register_modal');
    }



    public function assignLeave(){
        dd(__LINE__);
    }

}
