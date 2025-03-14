<?php

namespace App\Http\Livewire\Expenses;

use App\Models\approvals;
use App\Models\ExpensesModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class NewExpense extends Component
{
    public $selected;
    public $showAddExpense=false;
    public $category;
    public $expense_category;
    public $sub_category;
    public $member_number;
    public $expense_sub_category;
    public $amount;
   public $notes;
   public $branchId;
   public  $editExpensesId;
   public $showEditExpense=false;
    public ExpensesModel $expense;
    public $availableBudget;
    public $deleteExpensesId;
    public $showDeleteExpense=false;

    protected $listeners=[
      'editExpenses'=>"editExpenseModal",
        'deleteExpenses'=>"deleteExpenseModal"
    ];

    protected $rules=[
         'expense_category'=>'required',
         'expense_sub_category'=>'required',
         'member_number'=>'required',
         'amount'=>'required',
          'notes'=>'required',
    ];

    public function editExpenseModal($id){
        $this->editData($id);
        $this->editExpensesId=$id;
        $this->showEditExpense  =true;

    }

    public function deleteExpenseModal($id){

        $this->deleteExpensesId=$id;
        $this->showDeleteExpense=true;

    }

    public function confirmDeleteExpense(){
        DB::table('Expenses')->where('id',$this->deleteExpensesId)->delete();
        $this->emit('refreshExpenses');
        $this->showDeleteExpense=false;
    }

    public function editData($id){
      $expenseData=  DB::table('Expenses')->where('id',$id)->first();
      $this->expense_sub_category=$expenseData->sub_category_code;
      $this->member_number=$expenseData->member_number;
      $this->amount=$expenseData->amount;
      $this->notes=$expenseData->notes;
      $this->expense_category=$expenseData->category_code;

    }

    public function editedData(){
        if(DB::table("Expenses")->where('id',$this->editExpensesId)->value('status')=="PENDING"){
        DB::table('Expenses')->where('id',$this->editExpensesId)
        ->update([
            "amount"=>$this->amount,
          "member_number"=>$this->member_number,
           "notes"=>$this->notes,
        "sub_category_code"=>$this->expense_sub_category,
            "category_code"=>$this->expense_category,
        ]);
        session()->flash('message',"successfully edited");
        }
        else{
            session()->flash('message_fail'," You cannot edit for now");
        }
    }


    public function reseteData(){
        $this->amount=null;
        $this->notes=null;
        $this->expense_sub_category=null;
        $this->expense_category=null;
        $this->member_number=null;
        $this->department=null;

    }




    public function render()
    {

        $this->category=DB::table('expense_accounts')->get();


        return view('livewire.expenses.new-expense');
    }

    public function addExpensesModal(){
        $this->showAddExpense=true;
    }

    public function addExpenses(){
      $this->validate();
      $expenses=new ExpensesModel();
      $expenses->amount=str_replace(",", "", $this->amount);
      $expenses->branchId=auth()->user()->branch;
      $expenses->member_number=$this->member_number;
      $expenses->notes=$this->notes;
      $expenses->sub_category_code=$this->expense_sub_category;
      $expenses->employeeId=auth()->user()->id;
      $expenses->category_code=$this->expense_category;
      $expenses->status="PENDING";
      $expenses->save();


        $update_value = approvals::updateOrCreate(
            [
                'process_id' => $expenses->id,
                'user_id' => Auth::user()->id

            ],
            [
                'institution' => '',
                'process_name' => 'addExpenses',
                'process_description' => Auth::user()->name.' has added a new expense of  type - '.DB::table('main_budget')->where('sub_category_code', $this->expense_sub_category)->value('sub_category_name').' and amount of '.$this->amount.' to the system',
                'approval_process_description' => '',
                'process_code' => '25',
                'process_id' => $expenses->id,
                'process_status' => 'PENDING',
                'approval_status' => 'PENDING',
                'user_id'  => Auth::user()->id,
                'team_id'  => ''

            ]
        );


        session()->flash('message','Awaiting for approval');
      $this->reseteData();

      $this->emit('refreshExpenses');

      sleep(2);
      $this->showAddExpense=false;
    }

    public function updatedAmount($value){
        $value=str_replace(",", "", $value); // remove commas
        //$value = preg_replace("/[^0-9\.]/", "", $value); // remove everything except numbers and dot "."
        if($value==null){
            $value=0;
        }elseif ($value<0) {
            $value=0;
        }elseif ($value>$this->availableBudget) {
            $value=$this->availableBudget;
        }

        $this->amount=number_format($value);
    }


}
