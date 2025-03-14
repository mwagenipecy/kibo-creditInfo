<?php

namespace App\Http\Livewire\HR;

use App\Models\approvals;
use App\Models\FiscalPolicy\Benefits;
use App\Models\FiscalPolicy\Contributions;
use App\Models\FiscalPolicy\Taxes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class FiscalCategory extends Component
{
// form input fields
    public $fiscal_policy;
    public $category_name;
    public $category_amount;
    public $description;

    public $editFiscalPolicyModal=false;


    public $selected_policy=1;
    public $fiscalModal=false;

    protected $listeners=['fiscalModalTurnOn_Off'=>'closeModal','editFiscalPolicyEvent'=>'editFiscalPolicy'];

    protected $rules=[
//      'fiscal_policy'=>'required',
        'category_name'=>'required|min:3',
        'category_amount'=>'required|numeric'
    ];


   


    public function resetData(){
        $this->fiscal_policy='';
        $this->category_amount='';
        $this->category_name='';
    }

    public function editFiscalPolicy(){
        if($this->editFiscalPolicyModal==false){
            $this->editFiscalPolicyModal=true;
            $policy=DB::table(session()->get('table_name'))->where('id',session()->get('fiscal_policy_id'))->first();
            $this->category_name=$policy->name;
            $this->category_amount=$policy->amount;
        }
        else if($this->editFiscalPolicyModal==true){
            $this->editFiscalPolicyModal=false;
            session()->forget('table_name');
            session()->forget('fiscal_policy_id');
        }
    }
    public function editPolicy(){
        $this->validate();
        DB::table(session()->get('table_name'))->where('id',session()->get('fiscal_policy_id'))
            ->update(['name'=>$this->category_name, 'amount'=>$this->category_amount]);

        // get id
        $id=session()->get('fiscal_policy_id');
        // approval notification
        $approvals=new approvals();
        $approvals->sendApproval($id,'updateFiscalPolicy',"update from".session()->get('table_name'),
            'has updated the fiscal policy','102',''
        );
        // notification

        session()->flash('message',"Updated successfully");
        session()->forget('table_name');
        session()->forget('fiscal_policy_id');
    }

    public function selectedPolicyCategory($id){
        $this->selected_policy=$id;
        session()->forget('selected_policy');
        session()->put('selected_policy',$id);
        $this->emit('fiscal_policy_table');

    }

    public function addPolicy(){
        $this->validate();
        //if it is contribution id is 1   ,benefit id is 2 taxes id=3
        try {
            $category = '';
            if ($this->fiscal_policy == 1) {
                $category = new  Contributions();
            } else if ($this->fiscal_policy == 2) {
                $category = new  Benefits();
            } else if ($this->fiscal_policy == 3) {
                $category = new Taxes();
            }

            $category->amount = $this->category_amount;
            $category->name = $this->category_name;
            $category->status ="PENDING";
            $category->save();

            approvals::create([
                'institution' =>1,
                'process_name' => 'create fiscal policy category',
                'process_description' => 'has created a new category',
                'approval_process_description' => 'has approved a new branch',
                'process_code' => '01',
                'process_id' => $category->id,
                'process_status' => 'PENDING',
                'user_id'  => Auth::user()->id,
                'team_id'  => ""
            ]);
            session()->flash('message', "successfully registered");
            $this->resetData();
        }
        catch (\Exception $e){
            session()->put('message_failure', "Something went wrong");
        }
    }

    public function closeModal(){
        if($this->fiscalModal==false){
            $this->fiscalModal=True;
        }
        else{
            $this->fiscalModal=false;
        }
    }
    public function render()
    {
        return view('livewire.h-r.fiscal-category');
    }

}
