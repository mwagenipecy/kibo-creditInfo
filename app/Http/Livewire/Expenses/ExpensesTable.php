<?php

namespace App\Http\Livewire\Expenses;

use App\Models\ExpensesModel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ExpensesTable extends LivewireDatatable
{

    public $exportable=true;

    protected $listeners = ['refreshExpenses' => '$refresh'];

    public function builder()
    {

        return ExpensesModel::query();
        //->leftJoin('branches', 'branches.id', 'members.branch')
    }

    /**
     * Write code on Method
     *
     * @return array()
     */
    public function columns(): array
    {
        return [

            Column::name('id')->label('id')->searchable(),
            Column::callback('amount', function ($amount)  {
                return number_format($amount,2);
            })->label('amount')->searchable(),
            Column::callback('employeeId', function ($employeeId)  {
                return DB::table('users')->where('id',$employeeId)->value('name');
            })->label('employee name')->searchable(),
//            Column::name('notes')->label(' description'),
            Column::name('created_at')->label('submission date')->searchable(),
            Column::name('status')->label('Status'),

            Column::callback('id', function ($id)  {
                //$status = 1;
                $status = ExpensesModel::where('id',$id)->value('status');

                if($status == 'ACTIVE' or $status == 'PAID'){
                    $html ='';
                }
                else{
                    $employeeId = ExpensesModel::where('id',$id)->value('employeeId');
                    if(auth()->user()->id == $employeeId){
                        $html= '
                            <button wire:click="deleteExpenses('.$id.')" type="button" class="text-white bg-gray-100 hover:bg-blue-100 hover:text-blue focus:ring-4 focus:outline-none focus:ring-blue-100 font-medium rounded-lg text-sm p-1 text-center inline-flex items-center mr-2 dark:bg-blue-200 dark:hover:bg-blue-200 dark:focus:ring-blue-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-8 h-8">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>

                                <span class="sr-only">Delete</span>
                            </button> ';
                    }else{
                        $html = '';

                    }

                }


                return $html;

            })->label('Action'),


        ];
    }



    public function editExpenses($id){
        $this->emitUp('editExpenses',$id);
    }
    public function deleteExpenses($id){
        $this->emitUp('deleteExpenses',$id);
    }

}
