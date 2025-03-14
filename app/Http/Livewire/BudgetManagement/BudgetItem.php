<?php

namespace App\Http\Livewire\BudgetManagement;

use App\Models\approvals;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\BudgetManagement;

class BudgetItem extends Component
{

    public $new_budget_item=false;
    public $revenue;
    public $capital_expenditure;
    public $notes;
    public $budget_name;



    public function menuItemClick(){
        if($this->new_budget_item==false){
            $this->new_budget_item=true;
        }
    }

    public function save(){

//        $this->validate(['expenditure'=>'required',
//                          'revenue'=>'required',
//
//
//            ]);

       $id=  BudgetManagement::create([
             'revenue'=>$this->revenue,
             'capital_expenditure'=>$this->capital_expenditure,
             'budget_name'=>$this->budget_name,
             'approval_status'=>"PENDING",
             'notes'=>$this->notes,
             'status'=>"PENDING",
         ])->id;

       $approval=new approvals();
       $approval->sendApproval($id,'createBudget',auth()->user()->name.' has created new budget','has created new  budget','102','');
       session()->flash('message','successfully saved');

    $this->resetBudgetData();

}

public function resetBudgetData(){
        $this->revenue=null;
        $this->capital_expenditure=null;
        $this->notes=null;
        $this->budget_name=null;
                                 }



    public function render()
    {
        return view('livewire.budget-management.budget-item');
    }
}
