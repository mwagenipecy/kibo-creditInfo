<?php
//
//namespace App\Http\Livewire\TellerManagement;
//
//use App\Models\AccountsModel;
//use App\Models\approvals;
//use App\Models\Teller;
//use App\Models\Employee;
//use Illuminate\Support\Facades\Config;
//use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Hash;
//use Livewire\Component;
//
//class TellerRegister extends Component
//{
//    // define attrubute
//    public  $employee_id;
//    public $branch_id;
//    public $max_amount;
//    public $registered_by_id;
//    public $account_id;
//    public $transaction_type;
//    public $teller_description;
//    public $employee_details;
//    public $teller_account_id;
//
//    //editing
//    public $editTellerInfomation;
//
//    //password
//    public $password;
//    public $deleteTellerModal=false;
//    public $permission;
//
//    public $assignNewTellerModal=false;
//
//
//    public $listeners=['editTeller'=>'editTellerAction',
//        'deleteTeller'=>'deleteModal',
//        'assignTeller'=>'assignNewTeller'
//    ];
//
//    protected $rules=[
//        'branch_id'=>'required|numeric',
//        'max_amount'=>'required',
////                        'registered_by_id'=>'required',
////                         'account_id'=>'required',
//    ];
//
//
//
//
//    public function resetTeller(){
//        $this->branch_id=null;
//        $this->max_amount=null;
//        $this->registered_by_id=null;
//        $this->account_id=null;
//        $this->teller_type=null;
//        $this->teller_description=null;
//    }
//
//    public function createTeller(){
//        $this->validate();
//
//
//        $employeeDetails = Employee::where('id', $this->employee_id)->first();
//
//
//        $edit_package=json_encode(['branch_id'=>$this->branch_id]);
//
//        // teller instance
//        $teller = new \App\Models\Teller();
//        $teller->registered_by_id = auth()->user()->id;
//        $teller->branch_id = $this->branch_id;
//        $teller->max_amount = $this->max_amount;
//        $teller->status="PENDING";
//        $teller->institution_id=auth()->user()->institution_id;
//        $teller->save();
//
//        // send for approval
//
//        $approval = new approvals();
//        $approval->sendApproval($teller->id, 'createTeller', 'has created teller', 'approve new teller', '102',$edit_package);
//        session()->flash('message', 'Successfully created');
////          }
////            catch (\Exception $e){
////                session()->flash('message_fail','fail to create new teller');
////            }
////     }
////     catch (\Exception $e){
////         session()->flash('message_fail',"failed to create teller account");
////     }
//
////     finally {
//        $this->resetTeller();
////     }
//    }
//
//    public $createNewTeller=false;
//
//    public function showRegisterTellerModal(){
//        if($this->createNewTeller==false){
//            $this->createNewTeller=true;
//        }
//        else if($this->createNewTeller==true){
//            $this->createNewTeller=false;
//        }
//    }
//
//
//    public function render()
//    {
//        return view('livewire.teller-management.teller-register');
//    }
//
//
//
//    public function editTellerModal(){
//        if($this->editTellerInfomation==false){
//            $this->editTellerInfomation=true;
//        }else if($this->editTellerInfomation==true){
//            $this->editTellerInfomation=false;
//        }
//    }
//
//
//    public function editTellerAction(){
//
//        $tellers=DB::table('tellers')->where('id','=',session()->get('editTellerId'))->first();
//        $this->employee_id=$tellers->employee_id;
//        $this->branch_id=$tellers->branch_id;
//        $this->max_amount=$tellers->max_amount;
//        $this->registered_by_id=$tellers->registered_by_id;
//        $this->account_id=$tellers->account_id;
//        $this->editTellerModal();
//
////       dd( session()->get('editTellerId'));
//    }
//
//
//    public function updateTeller(){
//        $this->validate();
//        $id=session()->get('editTellerId');
//
//
//        $edit_package=json_encode([
//            'branch_id'=>$this->branch_id,
//            'max_amount'=>$this->max_amount,]);
//        // approval
//        $approval=new approvals();
//        $approval->sendApproval($id,'editTeller','teller has edited ','has to edit new teller','102',$edit_package);
//
//
//
//        session()->flash('message','updated successfully');
//    }
//
//
//    public function deleteModal(){
//        if($this->deleteTellerModal==false){
//            $this->deleteTellerModal=true;
//        }
//        else if($this->deleteTellerModal==true){
//            $this->deleteTellerModal=false;
//        }
//    }
//
//    public function deletetellerAction(){
//        $this->validate(['password'=>'required','permission'=>'required']);
//        $status=$this->permission;
//        if(Hash::Check($this->password,auth()->user()->password)){
//            if(DB::table('tellers')->where('id',session()->get('editTellerId'))->value('status')==$status){
//                session()->flash('message_fail','you can not'.$status.'twice');
//            }else {
//                DB::table('tellers')->where('id', session()->get('editTellerId'))->update(['status' => $status]);
//
//                $edit_package=json_encode($status);
//                //waiting for approval
//                $approval = new approvals();
//                $approval->sendApproval(session()->get('editTellerId'), 'removeTeller', 'has deleted Teller', 'has deleted teller', '102',$edit_package);
//
//                session()->flash('message', 'successfully, wait for approval');
//            }
//        }
//        else{
//            session()->flash('message_fail','invalid password');
//
//        }
//        $this->resetTeller();
//
//    }
//
//
//
//    public function assignNewTeller($id){
//        session()->put('tellerId',$id);
//        if($this->assignNewTellerModal==false){
//            $this->assignNewTellerModal=true;
//        }
//        else if($this->assignNewTellerModal==true){
//            $this->assignNewTellerModal=false;
//        }
//    }
//
//
//    public function assignEmployeeToTellerPosition(){
//
//        // check if id is present
//        $teller_id=Teller::where('employee_id',$this->employee_details)->first();
//
//        if($teller_id){
//
//            session()->flash('message_fail',"Sorry You cannot assign one teller in two position");
//        }
//        else if(Teller::where('id',session()->get('tellerId'))->value('account_id')==null or Teller::where('id',session()->get('tellerId'))->value('employee_id')!=null){
//            session()->flash('message_fail',"Sorry You cannot assign teller for now");
//
//        }
//
//        else{
//            $edit_package=json_encode(['employee_id'=>$this->employee_details]);
//            // send for the approval
//            Teller::where('id',session()->get('tellerId'))->update(['progress_status'=>'PENDING']);
//            $approvals=new approvals();
//            $approvals->sendApproval(session()->get('tellerId'),'assignTeller','has assign new teller','new  teller has been assigned','102',$edit_package);
//            session()->flash('message','successfully assigned');
//        }
//    }
//}


namespace App\Http\Livewire\TellerManagement;

use App\Models\AccountsModel;
use App\Models\approvals;
use App\Models\Teller;
use App\Models\Employee;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class TellerRegister extends Component
{
    // define attrubute
    public $employee_id;
    public $branch_id;
    public $max_amount;
    public $registered_by_id;
    public $account_id;
    public $transaction_type;
    public $teller_description;
    public $employee_details;
    public $teller_account_id;

    //editing
    public $editTellerInfomation;

    //password
    public $password;
    public $deleteTellerModal = false;
    public $permission;

    public $assignNewTellerModal = false;


    public $listeners = ['editTeller' => 'editTellerAction',
        'deleteTeller' => 'deleteModal',
        'assignTeller' => 'assignNewTeller'
    ];

    protected $rules = [
        'branch_id' => 'required|numeric',
        'max_amount' => 'required',
//                        'registered_by_id'=>'required',
//                         'account_id'=>'required',
    ];


    public function resetTeller()
    {
        $this->branch_id = null;
        $this->max_amount = null;
        $this->registered_by_id = null;
        $this->account_id = null;
        $this->teller_type = null;
        $this->teller_description = null;
    }

    public function createTeller()
    {
        $this->validate();


        $employeeDetails = Employee::where('id', $this->employee_id)->first();


        $edit_package = json_encode(['branch_id' => $this->branch_id]);

        // teller instance
        $teller = new \App\Models\Teller();
        $teller->registered_by_id = auth()->user()->id;
        $teller->branch_id = $this->branch_id;
        $teller->max_amount = $this->max_amount;
        $teller->status = "PENDING";
        $teller->institution_id = auth()->user()->institution_id;
        $teller->save();


        $approval = new approvals();
        $approval->sendApproval($teller->id, 'createTeller', 'has created teller', 'approve new teller', '102', $edit_package);
        session()->flash('message', 'Successfully created');

        $this->resetTeller();
        $this->createNewTeller=false;


    }

    public $createNewTeller = false;

    public function showRegisterTellerModal()
    {
        if ($this->createNewTeller == false) {
            $this->createNewTeller = true;
        } else if ($this->createNewTeller == true) {
            $this->createNewTeller = false;
        }
    }


    public function render()
    {
        return view('livewire.teller-management.teller-register');
    }


    public function editTellerModal()
    {
        if ($this->editTellerInfomation == false) {
            $this->editTellerInfomation = true;
        } else if ($this->editTellerInfomation == true) {
            $this->editTellerInfomation = false;
        }
    }


    public function editTellerAction()
    {

        $tellers = DB::table('tellers')->where('id', '=', session()->get('editTellerId'))->first();
        $this->employee_id = $tellers->employee_id;
        $this->branch_id = $tellers->branch_id;
        $this->max_amount = $tellers->max_amount;
        $this->registered_by_id = $tellers->registered_by_id;
        $this->account_id = $tellers->account_id;
        $this->editTellerModal();

    }


    public function updateTeller()
    {
        $this->validate();
        $id = session()->get('editTellerId');

        // get teller account number
        $teller_account_id = Teller::where('id', $id)->value('account_id');

        if (AccountsModel::where('id', $teller_account_id)->value('balance') > 0) {
            session()->flash('message_fail', 'found some balance to this til please close first');
        } else {


            $edit_package = json_encode([
                'branch_id' => $this->branch_id,
                'max_amount' => $this->max_amount,]);
            // approval
            $approval = new approvals();
            $approval->sendApproval($id, 'editTeller', 'teller has edited ', 'has to edit new teller', '102', $edit_package);


            session()->flash('message', 'updated successfully');

            $this->editTellerInfomation=false;

        }
    }


    public function deleteModal()
    {
        if ($this->deleteTellerModal == false) {
            $this->deleteTellerModal = true;
        } else if ($this->deleteTellerModal == true) {
            $this->deleteTellerModal = false;
        }
    }

    public function deletetellerAction()
    {


        // get teller account number
        $teller_account_id = Teller::where('id', session()->get('editTellerId'))->value('account_id');

        if (AccountsModel::where('id', $teller_account_id)->value('balance') > 0) {
            session()->flash('message_fail', 'found some balance to this til please close first');
        } else {

            $this->validate(['password' => 'required', 'permission' => 'required']);
            $status = $this->permission;
            if (Hash::Check($this->password, auth()->user()->password)) {
                if (DB::table('tellers')->where('id', session()->get('editTellerId'))->value('status') == $status) {
                    session()->flash('message_fail', 'you can not' . $status . 'twice');
                } else {
                    DB::table('tellers')->where('id', session()->get('editTellerId'))->update(['status' => $status]);

                    $edit_package = json_encode($status);
                    //waiting for approval
                    $approval = new approvals();
                    $approval->sendApproval(session()->get('editTellerId'), 'removeTeller', 'has deleted Teller', 'has deleted teller', '102', $edit_package);

                    session()->flash('message', 'successfully, wait for approval');

                      $this->deleteTellerModal=false;

                }
            } else {
                session()->flash('message_fail', 'invalid password');

            }
            $this->resetTeller();

        }

    }


    public function assignNewTeller($id)
    {
        session()->put('tellerId', $id);
        if ($this->assignNewTellerModal == false) {
            $this->assignNewTellerModal = true;
        } else if ($this->assignNewTellerModal == true) {
            $this->assignNewTellerModal = false;
        }
    }


    public function assignEmployeeToTellerPosition()
    {

        // check if id is present
        $teller_id = Teller::where('employee_id', $this->employee_details)->first();

        if ($teller_id) {

            session()->flash('message_fail', "Sorry You cannot assign one teller in two position");
        } else if (Teller::where('id', session()->get('tellerId'))->value('account_id') == null or Teller::where('id', session()->get('tellerId'))->value('employee_id') != null) {
            session()->flash('message_fail', "Sorry You cannot assign teller for now");

        } else {
            $edit_package = json_encode(['employee_id' => $this->employee_details]);
            // send for the approval
            Teller::where('id', session()->get('tellerId'))->update(['progress_status' => 'PENDING']);
            $approvals = new approvals();
            $approvals->sendApproval(session()->get('tellerId'), 'assignTeller', auth()->user()->name . ' has assign new teller', 'new  teller has been assigned', '102', $edit_package);
            session()->flash('message', 'successfully assigned');
            $this->assignNewTellerModal=false;
        }
    }
}
