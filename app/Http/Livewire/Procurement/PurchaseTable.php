<?php

namespace App\Http\Livewire\Procurement;

use App\Http\Livewire\Settings\DepartmentList;
use App\Models\Department;
use App\Models\Employee;
use App\Models\PurchaseRequisition;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class PurchaseTable extends LivewireDatatable
{
    public $exportable=true;

    protected $listeners=['refresh'=>'$refresh'];

    public function boot()
    {

        $user = auth()->user();
        $institution_id = $user->institution_id ;
        // Set the database connection based on the selected SACCO
        if ($institution_id) {
            $institution = \App\Models\institutions::find($institution_id);
            //dd($institution);
            if ($institution) {
                // Set the database connection
                Config::set('database.connections.institution', [
                    'driver' => 'mysql',
                    'host' => $institution->db_host,
                    'port' => $institution->db_port,
                    'database' => $institution->db_name,
                    'username' => $institution->db_username,
                    'password' => $institution->db_password,
                ]);
                DB::setDefaultConnection('institution');

            }
        }


    }


    public function builder(){
        return PurchaseRequisition::query();
    }

    public function columns():array{

        return [
            Column::callback('employeeId',function($id){
                return Employee::where('id',$id)->value('first_name').'   '.Employee::where('id',$id)->value('middle_name').'  '.Employee::where('id',$id)->value('last_name');
            })->label('NAME')->sortable(),

            Column::name('requisition_description')->label('Description')->searchable(),

            Column::callback(['employeeId','id'],function($employeeId,$id){
                return  Department::where('id',Employee::where('id',$employeeId)->value('department'))->value('department_name') ;
            })->label('Department'),
            Column::name('quantity')->label('quantity')->searchable(),

            Column::callback('created_at',function ($date){
                return $date;
            })->label('issue date')->sortable(),

            Column::name('status')->label('status')->sortable(),
            Column::callback(['id','status'],function($id){

                return view('livewire.procurement.purchase-action',['id'=>$id]);

            })->label('action')
        ];
}

          public function edit($id){
           //  session()->put('purchaseId',$id);
              $this->emit('actionPurchaseRequisition',$id);
          }
          public function delete($id){
              $this->emit('deletePurchaseRequisition',$id);
          }

          public function assign($id){
                $this->emit('actionPurchaseRequisition',3);
          }
}
