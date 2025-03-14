<?php

namespace App\Http\Livewire\Approvals;

use App\Http\Traits\MailSender;
use App\Models\AccountsModel;
use App\Models\approvals;
use App\Models\Branches;
use App\Models\BranchesModel;
use App\Models\ChannelsModel;
use App\Models\departmentsList;
use App\Models\Employee;
use App\Models\general_ledger;
use App\Models\Investment;
use App\Models\Loan_sub_products;
use App\Models\loans_schedules;
use App\Models\Clients;
use App\Models\Nodes;
use App\Models\NodesList;
use App\Models\servicesModel;
use App\Models\Teller;
use App\Models\Transactions;
use App\Models\User;
use App\Models\UserSubMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\ServicesList;
use Livewire\WithFileUploads;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;


class ApprovalsTable extends LivewireDatatable
{

    use WithFileUploads;
    use MailSender;
    public $exportable = true;
    public $searchable="process_name, process_description,process_status,process_type,process_status,approval_status";

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {

        return approvals::query()->orderBy('id','DESC');


    }


    public function columns(): array
    {
        return [

            Column::name('created_at')
                ->label('Date Created')->defaultSort(),

            Column::name('process_name')
                ->label('Action Name'),

            Column::name('process_description')
                ->label('Details'),

            Column::callback(['user_id'], function ($id) {
                if($id){

                    return User::find($id)->name;

                }else{
                    return '';
                }

            })->unsortable()->label('Initiator'),

            Column::callback(['approver_id'], function ($id) {
                $user = User::find($id);
                if($user){
                    return $user->name;
                } else {
                    return 'Pending';
                }
            })->unsortable()->label('Approver'),



            Column::callback(['process_id'], function ($process_id) {

                $editPackage = approvals::where('process_id',$process_id)->value('edit_package');
                $processName = approvals::where('process_id',$process_id)->value('process_name');
                if($editPackage){
                    return view('livewire.approvals.changes-list', ['process_id' => $process_id, 'process_name' => $processName, 'edit_package' =>$editPackage]);
                }

                return null;
            })->unsortable()->label('Edit Changes'),


            Column::callback(['approval_status'], function ($status) {
                return view('livewire.settings.table-status', ['status' => $status, 'move' => false]);
            })->label('Approval Status'),


            Column::callback(['id'], function ($id) {
                if(approvals::find($id)->approval_status =='PENDING'){
                    return view('livewire.approvals.action', ['id' => $id, 'move' => false]);
                }
                return null;
            })->unsortable()->label('Decision'),
        ];
    }

    public function approve($id): void
    {
        $approval = approvals::find($id);




        /////////////Loan Products ////////////////////

        if($approval->process_name =='createLoanProduct'){
            $this->approveCreateLoanProduct($approval->process_id,$id);
        }


        /////////////PASSWORD POLICY////////////////////

        if($approval->process_name =='passwordPolicy'){
            $this->approvePasswordPolicy($approval->process_id,$id);
        }



        if($approval->process_name =='strongRoomDeposition'){
            $this->approveStrongRoomDeposition($approval->process_id,$id);
        }


        ///////////////////////////////////INVESTMENT//////////////////////////////////////////

        if($approval->process_name =='createInvestment'){
            $this->approveInvestment($approval->process_id,$id);
        }
        if($approval->process_name =='editNode'){
            $this->approveEditNode($approval->process_id,$id,$approval->edit_package);
        }
        if($approval->process_name =='addNode'){
            $this->approveAddNode($approval->process_id,$id,$approval->edit_package);
        }



///////////////////////////////////BRANCH//////////////////////////////////////////

        if($approval->process_name =='addBranch'){
            $this->approveAddBranch($approval->process_id,$id);
        }
        if($approval->process_name =='blockBranch'){
            $this->approveBlockBranch($approval->process_id,$id);
        }
        if($approval->process_name =='editBranch'){
            $this->approveEditBranch($approval->process_id,$id);
        }
        if($approval->process_name =='activateBranch'){
            $this->approveActivateBranch($approval->process_id,$id);
        }
        if($approval->process_name =='deleteBranch'){
            $this->approveDeleteBranch($approval->process_id,$id);
        }



        ///////////////////////////////////CASH ACCOUNTS//////////////////////////////////////////
        if($approval->process_name =='editAccount'){
            $this->approveEditAccount($approval->process_id,$id,$approval->edit_package);
        }



        //////////////////////////////////////DEPARTMENT//////////////////////

         if($approval->process_name =='createdDepartment'){
             $this->approveCreatedDepartment($approval->process_id,$id,$approval->edit_package);
         }

        ////////////////////////////////APPROVE MEMBERS/////////////////////////////////////////////
        if($approval->process_name =='createClient'){
            $this->approveCreateClient($approval->process_id,$id);
        }
        if($approval->process_name =='exitClient'){
            $this->approveClientExit($approval->process_id,$id);
        }
        if($approval->process_name =='addService'){
            $this->approveAddService($approval->process_id,$id,$approval->edit_package);
        }


 //////////////////////////////// TELLERS MANAGEMENT/////////////////////////////////////////////
        if($approval->process_name =='createTeller'){
            $this->approveCreateTeller($approval->process_id,$id);
        }
        if($approval->process_name =='assignTeller'){
            $this->approveAssignTeller($approval->process_id,$id);
        }
        /// remove teller////
        if($approval->process_name =='removeTeller'){
            $this->approveRemoveTeller($approval->process_id,$id);
        }
        if($approval->process_name =='editTeller'){
            $this->approveEditTeller($approval->process_id,$id);
        }

        ////////////////////////////////CHANNEL/////////////////////////////////////////////


        if($approval->process_name =='deleteChannel'){
            $this->approveDeleteChannel($approval->process_id,$id);
        }
        if($approval->process_name =='editChannel'){
            $this->approveEditChannel($approval->process_id,$id,$approval->edit_package);
        }
        if($approval->process_name =='addChannel'){
            $this->approveAddChannel($approval->process_id,$id,$approval->edit_package);
        }

        ////////////////////////////////USERS/////////////////////////////////////////////


        if($approval->process_name =='deleteUser' || $approval->process_name =='blockUser' || $approval->process_name =='activateUser' ){
            $this->approveDeleteUser($approval->process_id,$id);
        }
        if($approval->process_name =='editUser'){
            $this->approveEditUser($approval->process_id,$id,$approval->edit_package);
        }
        if($approval->process_name =='addUser'){
            $this->approveAddUser($approval->process_id,$id,$approval->edit_package);
        }

        ////////////////////////////////DEPARTMENT/////////////////////////////////////////////


        if($approval->process_name =='deleteDepartment'){
            $this->approveDeleteDepartment($approval->process_id,$id);
        }
        if($approval->process_name =='editRole'){
            $this->approveEditDepartment($approval->process_id,$id,$approval->edit_package);
        }
        if($approval->process_name =='addDepartment'){
            $this->approveAddDepartment($approval->process_id,$id,$approval->edit_package);
        }

        ////////////////////////////////PASSWORD RESET/////////////////////////////////////////////


        if($approval->process_name =='passwordReset'){
            $this->approvePasswordReset($approval->reset_email,$id);
        }

        ////////////////////////////////PERMISSIONS/////////////////////////////////////////////


        if($approval->process_name =='editPermission'){
            $this->approveEditPermission($approval->process_id,$id);
        }


        ////////////////////////////////LOAN PRODUCT/////////////////////////////////////////////
        if($approval->process_name =='createLanProduct'){
            $this->approveCreateLanProduct($approval->process_id,$id);
        }



            ////////////////////////////////TRANSACTIONS/////////////////////////////////////////////


            if($approval->process_name =='resolveTransaction'){
                $this->approveResolveTransaction($approval->process_id,$id,$approval->edit_package);
            }



    }

    public function reject($id): void
    {

        $approval = approvals::find($id);



        if($approval->process_name =='strongRoomDeposition'){
            $this->rejectStrongRoomDeposition($approval->process_id,$id);
        }

        ////////////////////PASSWORD POLICY///////////////

        if($approval->process_name =='passwordPolicy'){
            $this->rejectPasswordPolicy($approval->process_id,$id);
        }


        ///////////////////////////////////REJECT INVESTMENT//////////////////////////////////////////

        if($approval->process_name =='createInvestment'){

            $this->rejectCreateInvestment($approval->process_id,$id);
        }

        ///////////////////////////////////LOAN SUB PRODUCT//////////////////////////////////////////

        if($approval->process_name =='createLanProduct'){

            $this->rejectCreateLanProduct($approval->process_id,$id);
        }


        //////////////////////////////////////// BRANCHES/////////////////////////////

        if($approval->process_name=='addBranch'){
            $this->declineAddBranch($approval->process_id,$id);
        }
        if($approval->process_name=='editBranch'){
            $this->declineEditBranch($approval->process_id,$id);
        }
        if($approval->process_name=='blockBranch'){
            $this->declineBlockBranch($approval->process_id,$id);
        }
        if($approval->process_name=='activateBranch'){
            $this->declineActivateBranch($approval->process_id,$id);
        }
        if($approval->process_name=='deleteBranch'){
            $this->declineDeleteBranch($approval->process_id,$id);
        }


///////////////////////////////////CASH ACCOUNTS//////////////////////////////////////////

        if($approval->process_name =='editAccount'){
            $this->rejectEditAccount($approval->process_id,$id);
        }


        //////////////////////////////DEPARTMENT/////////////////////////

         if($approval->process_name =='createdDepartment'){

             $this->rejectCreatedDepartment($approval->process_id,$id);
         }


        if($approval->process_name =='editNode'){
            $this->rejectEditNode($approval->process_id,$id);
        }
        if($approval->process_name =='addNode'){
            $this->rejectAddNode($approval->process_id,$id,$approval->edit_package);
        }

        ////////////////////////////////TELLER MANAGEMENT/////////////////////////////////////////////


        if($approval->process_name =='createTeller'){
            $this->rejectCreateTeller($approval->process_id,$id);
        }
        if($approval->process_name =='assignTeller'){
            $this->rejectAssignTeller($approval->process_id,$id);
        }
        if($approval->process_name =='editTeller'){
            $this->rejectEditTeller($approval->process_id,$id);
        }

        ////////////////////////////////CHANNEL/////////////////////////////////////////////


        if($approval->process_name =='deleteChannel'){
            $this->rejectDeleteChannel($approval->process_id,$id);
        }
        if($approval->process_name =='editChannel'){
            $this->rejectEditChannel($approval->process_id,$id,$approval->edit_package);
        }
        if($approval->process_name =='addChannel'){
            $this->rejectAddChannel($approval->process_id,$id,$approval->edit_package);
        }

        ////////////////////////////////USER/////////////////////////////////////////////


        if($approval->process_name =='deleteUser' || $approval->process_name =='blockUser' || $approval->process_name =='activateUser'){
            $this->rejectDeleteUser($approval->process_id,$id);
        }
        if($approval->process_name =='editUser'){
            $this->rejectEditUser($approval->process_id,$id,$approval->edit_package);
        }
        if($approval->process_name =='addUser'){
            $this->rejectAddUser($approval->process_id,$id,$approval->edit_package);
        }

        ////////////////////////////////DEPARTMENT/////////////////////////////////////////////


        if($approval->process_name =='deleteDepartment'){
            $this->rejectDeleteDepartment($approval->process_id,$id);
        }
        if($approval->process_name =='editRole'){
            $this->rejectEditDepartment($approval->process_id,$id,$approval->edit_package);
        }
        if($approval->process_name =='addDepartment'){
            $this->rejectAddDepartment($approval->process_id,$id,$approval->edit_package);
        }

        ////////////////////////////////PASSWORD RESET/////////////////////////////////////////////


        if($approval->process_name =='passwordReset'){
            $this->rejectPasswordReset($approval->reset_email,$id);
        }

        ////////////////////////////////PERMISSIONS/////////////////////////////////////////////


        if($approval->process_name =='editPermission'){
            $this->rejectEditPermission($approval->process_id,$id);
        }

        ////////////////////////////////TRANSACTIONS/////////////////////////////////////////////


               if($approval->process_name =='resolveTransaction'){
                $this->rejectResolveTransaction($approval->process_id,$id);
            }

    }


    /////////////////////////////department///////////////////////

    public function approveCreatedDepartment($process_id,$approvalsId){

        DB::table('departments')
            ->where('id',$process_id)->update(['status'=>"ACTIVE"]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'APPROVED',
            'approval_status' => 'APPROVED',
            'approval_process_description' => ' has Approved  to create new department',
        ]);

    }



    ///////////////////////////////////////INVESTMENT////////////////////////////////////////
    public function approveInvestment($process_id,$approvalsId): void
    {
        $edit_package=json_decode(approvals::where('id',$approvalsId)->value('edit_package'));


        Investment::where('id', $process_id)->update([
            'status' => 'APPROVED'
        ]);

        $sub_product=DB::table('accounts')->where('product_number','1600')->latest()->value('sub_product_number');
        if($sub_product){
            $sub_product=(int)$sub_product +1;
        }
        else{
            $sub_product=1610;
        }

        $account_number=str_pad(auth()->user()->institution_id,2,0,STR_PAD_LEFT).str_pad(auth()->user()->branch,2,0,STR_PAD_LEFT) .'0000'.$sub_product;

        $idx =  AccountsModel::create([
            'account_use' => 'internal',
            'institution_number'=>auth()->user()->institution_id,
            'branch_number'=> auth()->user()->branch,
            'member_number'=> null,
            'product_number'=> '1600',
            'sub_product_number'=> $sub_product,
            'account_name'=> DB::table('asset_account')->where('account_code',1600)->value('name') .'-'.$edit_package->name,
            'account_number'=>$account_number,

        ])->id;


         // get account number
         $debit_account_number=DB::table('accounts')->where('sub_product_number',$edit_package->account_code)->value('account_number');
         $new_investment_account_balance = (double)AccountsModel::where('account_number', $account_number)->value('balance') + (double)$edit_package->amount;
        $new_investment_costs_account_balance = (double)AccountsModel::where('account_number',$debit_account_number)->value('balance') - (double)$edit_package->amount;


      AccountsModel::where('account_number', $debit_account_number)->update(['balance' => $new_investment_costs_account_balance]);
//      AccountsModel::where('account_number', $mirror_account)->update(['balance' => $savings_ledger_account_new_balance]);
        AccountsModel::where('account_number', $account_number)->update(['balance' => $new_investment_account_balance]);


        $reference_number = time();
        $institution_id=auth()->user()->institution_id;




        //DEBIT RECORD MEMBER
        general_ledger::create([
            'record_on_account_number'=> $debit_account_number,
            'record_on_account_number_balance'=> $new_investment_costs_account_balance,
            'sender_branch_id'=> auth()->user()->institution_id,
            'beneficiary_branch_id'=> auth()->user()->institution_id,
            'sender_product_id'=>  AccountsModel::where('account_number',$debit_account_number)->value('product_number'),
            'sender_sub_product_id'=> AccountsModel::where('account_number',$debit_account_number)->value('sub_product_number'),
            'beneficiary_product_id'=> AccountsModel::where('account_number',$account_number)->value('product_number'),
            'beneficiary_sub_product_id'=> AccountsModel::where('account_number',$account_number)->value('sub_product_number'),
            'sender_id'=> '0000',
            'beneficiary_id'=> '0000',
            'sender_name'=> AccountsModel::where('account_number',$debit_account_number )->value('account_name'),
            'beneficiary_name'=> AccountsModel::where('account_number',$account_number)->value('account_name'),
            'sender_account_number'=>$debit_account_number ,
            'beneficiary_account_number'=> $account_number,
            'transaction_type'=> 'IFT',
            'sender_account_currency_type'=> 'TZS',
            'beneficiary_account_currency_type'=> 'TZS',
            'narration'=> 'Payment for investment  - '.DB::table('asset_account')->where('account_code',1600)->value('name') .'-'.$edit_package->name,
            'credit'=> 0,
            'debit'=> $edit_package->amount,
            'reference_number'=> $reference_number,
            'trans_status'=> 'Successful',
            'trans_status_description'=> 'Successful',
            'swift_code'=> '',
            'destination_bank_name'=> '',
            'destination_bank_number'=> null,
            'payment_status'=> 'Successful',
            'recon_status'=> 'PENDING',
        ]);



        //CREDIT RECORD LOAN ACCOUNT
        general_ledger::create([
            'record_on_account_number'=> $account_number,
            'record_on_account_number_balance'=> $new_investment_costs_account_balance,
            'sender_branch_id'=> auth()->user()->institution_id,
            'beneficiary_branch_id'=> auth()->user()->institution_id,
            'sender_product_id'=>  AccountsModel::where('account_number',$debit_account_number)->value('product_number'),
            'sender_sub_product_id'=> AccountsModel::where('account_number',$debit_account_number)->value('sub_product_number'),
            'beneficiary_product_id'=> AccountsModel::where('account_number',$account_number)->value('product_number'),
            'beneficiary_sub_product_id'=> AccountsModel::where('account_number',$account_number)->value('sub_product_number'),
            'sender_id'=> '0000',
            'beneficiary_id'=> '0000',
            'sender_name'=> AccountsModel::where('account_number',$debit_account_number )->value('account_name'),
            'beneficiary_name'=> AccountsModel::where('account_number',$debit_account_number )->value('account_name'),
            'sender_account_number'=> $debit_account_number,
            'beneficiary_account_number'=>$account_number ,
            'transaction_type'=> 'IFT',
            'sender_account_currency_type'=> 'TZS',
            'beneficiary_account_currency_type'=> 'TZS',
            'narration'=> 'Payment for loans issued',
            'credit'=> $edit_package->amount,
            'debit'=> 0,
            'reference_number'=> $reference_number,
            'trans_status'=> 'Successful',
            'trans_status_description'=> 'Successful',
            'swift_code'=> '',
            'destination_bank_name'=> '',
            'destination_bank_number'=> null,
            'payment_status'=> 'Successful',
            'recon_status'=> 'PENDING',
        ]);



        //CREDIT RECORD GL
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'APPROVED',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved  create new investment of the node',
        ]);

    }

    //////////////////////////////////////REJECT CREATE INVESTMENT////////////////////////////////////////////
    public function rejectCreateInvestment($process_id,$approvalsId): void
    {
      Investment::where('id',$process_id)->update(['status'=>"REJECTED"]);
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'REJECTED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the creation of new investment',


        ]);

    }



    public function rejectCreateLanProduct($process_id,$approvalsId){
        Loan_sub_products::where('id',$process_id)->update(['sub_product_status'=>"DECLINED"]);
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'REJECTED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the creation of new loan sub product',


        ]);

    }


    private function approveEditNode($process_id, $approvalsId,$changes): void
    {
        $changes = json_decode($changes, true);
        foreach($changes as $key => $value){
            $dbValue = NodesList::where('id',$process_id)->value($key);
            if($dbValue != $value){
                NodesList::where('id', $process_id)->update([
                    $key => $value
                ]);
            }

        }

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved editing of the node',
        ]);
    }


    ///////////////////////PASSWORD POLICY//////////////////////
    public function approvePasswordPolicy($process_id,$approvalsId){

        $value=approvals::where('id',$approvalsId)->value('approval_process_description');
        $values=json_decode($value);

        DB::table('password_policies')->where('id',$process_id)->update([
            'length'=>$values->length,
            'requireUppercase'=>$values->requireUppercase,
            'requireNumeric'=>$values->requireNumeric,
            'requireSpecialCharacter'=>$values->requireSpecialCharacter,
            'limiter'=>$values->limiter,
            'passwordExpire'=>$values->passwordExpire,
        ]);


        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'APPROVED',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved  change  of password policy',
        ]);
    }

    public function approveCreateLoanProduct($process_id,$approvalsId){

       // $value=Loan_sub_products::where('id',$approvalsId)->update([''=>'']);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'APPROVED',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved  change  of password policy',
        ]);
    }




    private function rejectEditNode($process_id, $approvalsId): void
    {
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'EDITED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected editing of the node',
        ]);
    }

    private function approveAddNode($process_id, $approvalsId, $edit_package): void
    {

        NodesList::where('ID', $process_id)->update([
            'NODE_STATUS' => 'ACTIVE'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'ACTIVE',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved the addition of the node',
        ]);

    }

    private function rejectAddNode($process_id, $approvalsId, $edit_package): void
    {
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the addition of the node',
        ]);
    }

///////////////////////////////////END OF NODES////////////////////////////////////////


//////////////////////TELLER MANAGEMENT//////////////////////////////////////

//////////////////////////////////CREATE TELLER//////////////////////////////////////////
    public  function  approveCreateTeller($process_id,$approvalsId){

        $approval=approvals::where('id',$approvalsId)->value('edit_package');
          $approval=json_decode($approval);


        $getlatest_account_number=DB::table('accounts')->where('product_number','2200')->where('sub_product_number','2240')->latest()->value('account_number');
        $get_sub_string_nunber=substr($getlatest_account_number,4,4);
        if($get_sub_string_nunber){
            $get_sub_string_nunber=(int)$get_sub_string_nunber+1;

        }
        else{
            $get_sub_string_nunber='0001';
        }


        $account=str_pad(auth()->user()->institution_id, 2, '0', STR_PAD_LEFT).str_pad(auth()->user()->branch,2,0,STR_PAD_LEFT).str_pad($get_sub_string_nunber,4,0,STR_PAD_LEFT).'2240';
        $id = AccountsModel::create([
            'account_use' => 'internal',
            'institution_number' => auth()->user()->institution_id,
            'branch_number' => $approval->branch_id,
            'client_number' => '0000',
            'product_number' => '2200',
            'sub_product_number' => '2240',
            'employeeId' => auth()->user()->employeeId,
            'account_name' =>'TELLER'.(int)$get_sub_string_nunber,
            'account_number' => $account,
        ])->id;


        // update teller table
        Teller::where('id',$process_id)->update(['status'=>"APPROVED",'account_id'=>$id,'teller_name'=>'TELLER'.(int)$get_sub_string_nunber]);


        ///// update teller creation //////
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'APPROVED',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved the creation of new teller',
        ]);
}
/////////////////////////////END CREATE TELLER////////////////////////////////////////


///////////////////////////// REJECT TELLER///////////

 public function rejectCreateTeller($process_id,$approvalsId):void{
        Teller::where('id',$process_id)->update(['status'=>'REJECTED']);

     approvals::where('id', $approvalsId)->update([
         'approver_id' => Auth::user()->id,
         'process_status' => 'REJECTED',
         'approval_status' => 'REJECTED',
         'approval_process_description' => 'rejected the creation of new teller',
     ]);
 }

 //////////reject assign teller///////////////
 public function rejectAssignTeller($process_id,$approvalsId):void{
        Teller::where('id',$process_id)->update(['status'=>'REJECTED']);

     approvals::where('id', $approvalsId)->update([
         'approver_id' => Auth::user()->id,
         'process_status' => 'REJECTED',
         'approval_status' => 'REJECTED',
         'approval_process_description' => 'rejected the creation of new teller',
     ]);
 }

 /////////////////reject edit teller/////////////////
    public function rejectEditTeller($process_id,$approvalsId):void{
//        Teller::where('id',$process_id)->update(['status'=>'REJECTED']);
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'REJECTED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'rejected edit of  teller',
        ]);
    }




    public function rejectStrongRoomDeposition($process_id,$approvalsId):void{
//        Teller::where('id',$process_id)->update(['status'=>'REJECTED']);
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'REJECTED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'rejected  funds transfer to strong room ',
        ]);
    }





    public function approveStrongRoomDeposition($proces_id,$id){


        $approval=approvals::where('id',$id)->value('edit_package');

        // get edit package
        $edit_package=json_decode($approval);

        // debit side
        $debit_account_number=$edit_package->source_account_number;

        $debit_amount=$edit_package->amount;

        $debit_account_previous_balance= AccountsModel::where('account_number',$debit_account_number)->value('balance');
        // get remaining balance
        $debit_account_new_balance=(double)$debit_account_previous_balance-(double)$debit_amount;

        // update debited account
        AccountsModel::where('account_number',$debit_account_number)->update(['balance'=>$debit_account_new_balance]);

        // credit accounts
        $credit_account_number=$edit_package->destination_account_number;
        //get previous balance
        $credit_account_previous_balance=AccountsModel::where('account_number',$credit_account_number)->value('balance');
        // total balance
        $credit_side_new_balance=(double)$edit_package->amount + (double)$credit_account_previous_balance;
        // update credited account
        AccountsModel::where('account_number',$credit_account_number)->update(['balance'=>$credit_side_new_balance]);



        //  general ledger record
        $general_redger_records=new general_ledger();
        // debit records
        $general_redger_records->debit(
            $debit_account_number,$debit_account_new_balance,
            $credit_account_number,$edit_package->amount,$edit_package->notes,''
        );
        // credit record
        $general_redger_records->credit(
            $credit_account_number,$credit_side_new_balance
            ,$debit_account_number,$edit_package->amount,$edit_package->notes,'');

        approvals::where('id', $id)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'APPROVED',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved strong room funds deposits',
        ]);

    }



///////////////////////////////ASSIGN  TELLER POSITION
public function approveAssignTeller($process_id,$approvalsId){
        $approval_data=approvals::where('id',$approvalsId)->value('edit_package');
        $teller_id=json_decode($approval_data);
        $check_if_exist=Teller::where('employee_id',$teller_id->employee_id)->first();
        if($check_if_exist){
            dd('reject');
        }
        else{

            Teller::where('id',$process_id)->update(['employee_id'=>$teller_id->employee_id]);

            approvals::where('id', $approvalsId)->update([
                'approver_id' => Auth::user()->id,
                'process_status' => 'APPROVED',
                'approval_status' => 'APPROVED',
                'approval_process_description' => 'Approved the creation of new teller',
            ]);

        }

}
    //////////////////END ASSIGN  TELLER POSITION ///////////////
    ///
    //////  REMOVE TELLER////
    public function approveRemoveTeller($process_id,$approvalsId):void{

        Teller::where('id',$process_id)->update(['employee_id'=>0,'status'=>'APPROVED']);
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'APPROVED',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved remove teller position',
        ]);
    }




    ///////////////
    public function approveEditTeller($process_id,$approvalsId){

        $edited_data=json_decode(approvals::where('id',$approvalsId)->value('edit_package'));

        DB::table('tellers')->where('id',$process_id)->update([
            'branch_id'=>$edited_data->branch_id,
            'max_amount'=>$edited_data->max_amount,
        ]);


        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'APPROVED',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved remove teller position',
        ]);
    }

    ///////////////////////////////////////SERVICES////////////////////////////////////////
    public function approveCreateClient($process_id,$approvalsId): void
    {

        ////////////////// serving account//////////////////////////
        $account_number=str_pad(auth()->user()->institution_id,2,0,STR_PAD_LEFT).str_pad(auth()->user()->branch,2,0,STR_PAD_LEFT) .DB::table('clients')->where('id',$process_id)->value('membership_number').'2210';
        $idx =  AccountsModel::create([
            'account_use' => 'external',
            'institution_number'=> auth()->user()->institution_id,
            'branch_number'=> str_pad(DB::table('clients')->where('id',$process_id)->value('branch'), 2, '0', STR_PAD_LEFT),
            'member_number'=> DB::table('clients')->where('id',$process_id)->value('membership_number'),
            'product_number'=> '2200',
            'sub_product_number'=> '2210',
            'account_name'=>DB::table('clients')->where('id',$process_id)->value('first_name').' '.DB::table('clients')->where('id',$process_id)->value('middle_name').' '.DB::table('clients')->where('id',$process_id)->value('last_name'),
            'account_number'=>$account_number,
        ])->id;
        //$this->sendApproval($idx,'has created a new savings account','09');


        //////////////////// fixed-term deposits////////////////
        $account_number2=str_pad(auth()->user()->institution_id,2,0,STR_PAD_LEFT).str_pad(auth()->user()->branch,2,0,STR_PAD_LEFT) .DB::table('clients')->where('id',$process_id)->value('membership_number').'2230';
        $idy =  AccountsModel::create([
            'account_use' => 'external',
            'institution_number'=>auth()->user()->institution_id,
            'branch_number'=> str_pad(DB::table('clients')->where('id',$process_id)->value('branch'), 2, '0', STR_PAD_LEFT),
            'member_number'=> DB::table('clients')->where('id',$process_id)->value('membership_number'),
            'product_number'=> '2200',
            'sub_product_number'=> '2230',
            'account_name'=>DB::table('clients')->where('id',$process_id)->value('first_name').' '.DB::table('clients')->where('id',$process_id)->value('middle_name').' '.DB::table('clients')->where('id',$process_id)->value('last_name'),
            'account_number'=> $account_number2,

        ])->id;
        //$this->sendApproval($idy,'has created a new amana account','09');

       //////////////////////shares account//////////////////
        $account_number3=str_pad(auth()->user()->institution_id,2,0,STR_PAD_LEFT).str_pad(auth()->user()->branch,2,0,STR_PAD_LEFT) .DB::table('clients')->where('id',$process_id)->value('membership_number').'3010';
        $idz =  AccountsModel::create([
            'account_use' => 'external',
            'institution_number'=> auth()->user()->institution_id,
            'branch_number'=>str_pad(DB::table('clients')->where('id',$process_id)->value('branch'), 2, '0', STR_PAD_LEFT),
            'member_number'=> DB::table('clients')->where('id',$process_id)->value('membership_number'),
            'product_number'=> '3000',
            'sub_product_number'=> '3010',
            'account_name'=>DB::table('clients')->where('id',$process_id)->value('first_name').' '.DB::table('clients')->where('id',$process_id)->value('middle_name').' '.DB::table('clients')->where('id',$process_id)->value('last_name'),
            'account_number'=>$account_number3,

        ]);
        //$this->sendApproval($idz,'has created a new deposit account','09');




////// update the status of the new clients///////
        DB::table('clients')->where('id',$process_id)->update(['member_status'=>'NON FULLY MEMBER']);


        ///// update new  clients//////
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'APPROVED',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved the deletion of the service',
        ]);

    }




    public function approveEditAccount($process_id, $approvalsId, $changes )
    {


        $changes = json_decode($changes, true);
        foreach($changes as $key => $value){
            $dbValue = AccountsModel::where('id',$process_id)->where('institution_number',auth()->user()->institution_id)->value($key);
            if($dbValue != $value){
                AccountsModel::where('id', $process_id)->update([
                    $key => $value
                ]);
            }

        }

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved editing of an account',
        ]);
    }

    public function rejectEditAccount($process_id,$approvalsId){
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected editing of an account',
        ]);
    }



    public function rejectPasswordPolicy($process_id,$approvalsId): void
    {
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'REJECTED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the  changes  of  password policy',
        ]);

    }


    public function rejectDeleteService($process_id,$approvalsId): void
    {

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'DELETED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the deletion of the service',
        ]);

    }

    private function approveClientExit($process_id, $approvalsId): void
    {
      $Client_number=Clients::where('id',$process_id)->value('membership_number');

        $total_balance_available=DB::table('accounts')->where('member_number',$Client_number)->sum('balance');

        $unpaid_balance=loans_schedules::where('loan_id',DB::table('loans')->where('member_number',$Client_number)->value('loan_id'))->where('completion_status','!=','CLOSED')->sum('installment');

        // new balance
        $new_member_balance=(double) ($total_balance_available-$unpaid_balance);

        // exit suspense account
            $account_details=DB::table('accounts')->where('product_number',2000)->where('sub_product_number',2231)->first();
            $account_balance =(double) ($account_details->balance +$new_member_balance);
            // update balance
        DB::table('accounts')->where('product_number',2000)->where('sub_product_number',2231)->update(['balance'=>$account_balance]);

        $reference_number=time();
        foreach(DB::table('accounts')->where('member_number',$Client_number)->get()     as   $member_accounts) {

            general_ledger::create([
                'record_on_account_number' => $member_accounts->account_number,
                'record_on_account_number_balance' => 0,
                'sender_branch_id' => auth()->user()->institution_id,
                'beneficiary_branch_id' => auth()->user()->institution_id,
                'sender_product_id' => AccountsModel::where('account_number', $member_accounts->account_number)->value('product_number'),
                'sender_sub_product_id' => AccountsModel::where('account_number', $member_accounts->account_number)->value('product_number'),
                'beneficiary_product_id' => AccountsModel::where('account_number', $account_details->account_number)->value('product_number'),
                'beneficiary_sub_product_id' => AccountsModel::where('account_number', $account_details->account_number)->value('sub_product_number'),
                'sender_id' => '0000',
                'beneficiary_id' => '0000',
                'sender_name' => AccountsModel::where('member_number', $member_accounts->account_number)->value('account_name'),
                'beneficiary_name' => AccountsModel::where('account_number', $account_details->account_number)->value('account_name'),
                'sender_account_number' => $member_accounts->account_name,
                'beneficiary_account_number' => $account_details->account_number,
                'transaction_type' => 'IFT',
                'sender_account_currency_type' => 'TZS',
                'beneficiary_account_currency_type' => 'TZS',
                'narration' => 'Payment for loans issued',
                'credit' => 0,
                'debit' => $member_accounts->balance,
                'reference_number' => $reference_number,
                'trans_status' => 'Successful',
                'trans_status_description' => 'Successful',
                'swift_code' => '',
                'destination_bank_name' => '',
                'destination_bank_number' => null,
                'payment_status' => 'Successful',
                'recon_status' => 'PENDING',
            ]);

            DB::table('accounts')->where('account_number',$member_accounts->account_number)->update(['balance'=>0]);


        }


        //CREDIT RECORD LOAN ACCOUNT
        general_ledger::create([
            'record_on_account_number'=> $account_details->account_number,
            'record_on_account_number_balance'=> $account_balance,
            'sender_branch_id'=> auth()->user()->institution_id,
            'beneficiary_branch_id'=> auth()->user()->institution_id,
            'sender_product_id'=>  $Client_number,
            'sender_sub_product_id'=>$Client_number,
            'beneficiary_product_id'=> AccountsModel::where('account_number', $account_details->account_number)->value('product_number'),
            'beneficiary_sub_product_id'=> AccountsModel::where('account_number', $account_details->account_number)->value('sub_product_number'),
            'sender_id'=> '0000',
            'beneficiary_id'=> '0000',
            'sender_name'=> AccountsModel::where('member_number',$Client_number )->value('account_name'),
            'beneficiary_name'=> AccountsModel::where('account_number',$account_details->account_number )->value('account_name'),
            'sender_account_number'=> $Client_number,
            'beneficiary_account_number'=>$account_details->account_number  ,
            'transaction_type'=> 'IFT',
            'sender_account_currency_type'=> 'TZS',
            'beneficiary_account_currency_type'=> 'TZS',
            'narration'=> 'Payment for loans issued',
            'credit'=> $new_member_balance,
            'debit'=> 0,
            'reference_number'=> $reference_number,
            'trans_status'=> 'Successful',
            'trans_status_description'=> 'Successful',
            'swift_code'=> '',
            'destination_bank_name'=> '',
            'destination_bank_number'=> null,
            'payment_status'=> 'Successful',
            'recon_status'=> 'PENDING',
        ]);


        // DEBIT





           approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved editing of the service',
        ]);
    }

    private function rejectEditService($process_id, $approvalsId): void
    {
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'EDITED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected editing of the service',
        ]);
    }

    private function approveAddService($process_id, $approvalsId, $edit_package): void
    {

        servicesModel::where('ID', $process_id)->update([
            'STATUS' => 'ACTIVE'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'ACTIVE',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved the addition of the service',
        ]);

    }

    private function rejectAddService($process_id, $approvalsId, $edit_package): void
    {
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the addition of the service',
        ]);
    }

///////////////////////////////////END OF SERVICES////////////////////////////////////////



    ///////////////////////////////////////CHANNEL////////////////////////////////////////
    public function approveDeleteChannel($process_id,$approvalsId): void
    {

        ChannelsModel::where('ID', $process_id)->update([
            'STATUS' => 'DELETED'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'DELETED',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved the deletion of the channel',
        ]);

    }

    public function rejectDeleteChannel($process_id,$approvalsId): void
    {

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'DELETED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the deletion of the channel',
        ]);

    }

    private function approveEditChannel($process_id, $approvalsId, $changes): void
    {
        $changes = json_decode($changes, true);
        foreach($changes as $key => $value){
            $dbValue = ChannelsModel::where('ID',$process_id)->value($key);
            if($dbValue != $value){
                ChannelsModel::where('ID', $process_id)->update([
                    $key => $value
                ]);
            }

        }

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved editing of the channel',
        ]);
    }

    private function rejectEditChannel($process_id, $approvalsId): void
    {
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'EDITED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected editing of the channel',
        ]);
    }

    private function approveAddChannel($process_id, $approvalsId, $edit_package): void
    {

        ChannelsModel::where('ID', $process_id)->update([
            'STATUS' => 'ACTIVE'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'ACTIVE',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved the addition of the channel',
        ]);

    }

    private function rejectAddChannel($process_id, $approvalsId, $edit_package): void
    {
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the addition of the channel',
        ]);
    }

///////////////////////////////////END OF CHANNEL////////////////////////////////////////



    ///////////////////////////////////////USER////////////////////////////////////////
    public function approveDeleteUser($process_id,$approvalsId): void
    {

        $status = approvals::where('id',$approvalsId)->value('process_status');
        User::where('id', $process_id)->update([
            'status' => $status
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved this action',
        ]);

    }

    public function rejectDeleteUser($process_id,$approvalsId): void
    {

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'DELETED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the deletion of the user',
        ]);

    }

    private function approveEditUser($process_id, $approvalsId, $changes): void
    {
        $changes = json_decode($changes, true);
        foreach($changes as $key => $value){
            $dbValue = User::where('id',$process_id)->value($key);
            if($dbValue != $value){
                User::where('id', $process_id)->update([
                    $key => $value
                ]);
            }

        }

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved editing of the user information',
        ]);
    }

    private function rejectEditUser($process_id, $approvalsId): void
    {
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'EDITED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected editing of the user information',
        ]);
    }

    private function approveAddUser($process_id, $approvalsId, $edit_package): void
    {

        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+{}[]<>,.?/~';
        $randomString = str_shuffle($characters);
        $password = substr($randomString, 0, 8);

        User::where('id', $process_id)->update([
            'status' => 'ACTIVE',
            'password' => bcrypt($password),
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'ACTIVE',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved the addition of the user',
        ]);


        $this->composeEmail(User::where('id',$process_id)->value('email'), 'Dear '.User::where('id',$process_id)->value('name').', You have been added as a user in the CyberPoint Pro System. You can proceed and login using your email and temporary password '.$password. ' use link https://testcyberpointpro.ubx.co.tz as soon as you are logged in you must change the temporary password to your choice. Thank you');

        //dd($password);
    }

    private function rejectAddUser($process_id, $approvalsId, $edit_package): void
    {
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the addition of the user',
        ]);
    }

///////////////////////////////////END USER////////////////////////////////////////



    ///////////////////////////////////////DEPARTMENT////////////////////////////////////////
    public function approveDeleteDepartment($process_id,$approvalsId): void
    {

        departmentsList::where('id', $process_id)->update([
            'status' => 'DELETED'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'DELETED',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved the deletion of the department',
        ]);

    }

    public function rejectDeleteDepartment($process_id,$approvalsId): void
    {

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'DELETED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the deletion of the department',
        ]);

    }

    private function approveEditDepartment($process_id, $approvalsId, $changes): void
    {
        //dd('hapaa');
        $changes = json_decode($changes, true);
        foreach($changes as $key => $value){
            $dbValue = departmentsList::where('id',$process_id)->value($key);
            if($dbValue != $value){
                departmentsList::where('id', $process_id)->update([
                    $key => $value
                ]);
            }

        }

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved editing of the department',
        ]);
    }

    private function rejectEditDepartment($process_id, $approvalsId): void
    {
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'EDITED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected editing of the department',
        ]);
    }

    private function approveAddDepartment($process_id, $approvalsId, $edit_package): void
    {

        departmentsList::where('id', $process_id)->update([
            'status' => 'ACTIVE'
        ]);

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'ACTIVE',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved the addition of the department',
        ]);

    }

    private function rejectAddDepartment($process_id, $approvalsId, $edit_package): void
    {
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected the addition of the user',
        ]);
    }

///////////////////////////////////END DEPARTMENT////////////////////////////////////////


///////////////////////////////////PASSWORD RESET////////////////////////////////////////
    private function approvePasswordReset($reset_email, $id): void
    {

        if (User::where('email',$reset_email)->get()->count() > 0 ) {

            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+{}[]<>,.?/~';
            $randomString = str_shuffle($characters);
            $password = substr($randomString, 0, 8);

            User::where('email', $reset_email)->update([
                'password'  =>  bcrypt($password),
                'otp_time'  =>  now(),
                'verification_status'   =>  '0',
            ]);

            approvals::where('id', $id)->update([
                'approver_id' => Auth::user()->id,
                'approval_status' => 'APPROVED',
                'approval_process_description' => 'Approved password reset for the user with email - '.$reset_email,
            ]);

            $this->composeEmail($reset_email, 'Dear '.User::where('email',$reset_email)->value('name').', You have requested to reset your password, use the following temporary password - '.$password.' Change the password immediately after login. ');

        } else {

            approvals::where('id', $id)->update([
                'approver_id' => Auth::user()->id,
                'approval_status' => 'REJECTED',
                'approval_process_description' => Auth::user()->name . ' This email is not registered - '.$reset_email,
            ]);
        }



    }



    /////////////////////////branch//////////////////
    public function approveAddBranch($process_id, $id){

        BranchesModel::where('id',$process_id)->update(['branch_status'=>"ACTIVE"]);

        approvals::where('id', $id)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'APPROVED',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved  create new branch',
        ]);
    }
    public function approveBlockBranch($process_id, $id){

        BranchesModel::where('id',$process_id)->update(['branch_status'=>"BLOCKED"]);

        approvals::where('id', $id)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'APPROVED',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved  block branch',
        ]);
    }
    public function approveEditBranch($process_id, $id){

        $edit_package=approvals::where('id',$id)->value('edit_package');
        $edit_package=json_decode($edit_package);


        BranchesModel::where('id',$process_id)->update([
            'name' =>$edit_package->name,
            'region' =>$edit_package->region,
            'wilaya' =>$edit_package->wilaya,
            'email' =>$edit_package->email,
            'phone_number'=>$edit_package->phone_number,
        ]);

        approvals::where('id', $id)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'APPROVED',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved  edit branch informations',
        ]);
    }
    public function approveActivateBranch($process_id, $id){

        BranchesModel::where('id',$process_id)->update(['branch_status'=>"ACTIVE"]);

        approvals::where('id', $id)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'APPROVED',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved  activate branches',
        ]);
    }
    public function approveDeleteBranch($process_id, $id){

        BranchesModel::where('id',$process_id)->update(['branch_status'=>"DELETED"]);

        approvals::where('id', $id)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'APPROVED',
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved  delete branches',
        ]);
    }




    public function declineAddBranch($process_id, $id){

        BranchesModel::where('id',$process_id)->update(['branch_status'=>"REJECTED"]);
        approvals::where('id', $id)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'REJECTED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected  to create new branch',
        ]);
    }
    public function declineBlockBranch($process_id, $id){

//        BranchesModel::where('id',$process_id)->update(['branch_status'=>"REJECTED"]);
        approvals::where('id', $id)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'REJECTED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => ' has rejected  to block a branch',
        ]);
    }

    public function declineEditBranch($process_id, $id){

//        BranchesModel::where('id',$process_id)->update(['branch_status'=>"REJECTED"]);
        approvals::where('id', $id)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'REJECTED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => ' has rejected  to edit  branch informations',
        ]);
    }
    public function declineDeleteBranch($process_id, $id){

//        BranchesModel::where('id',$process_id)->update(['branch_status'=>"REJECTED"]);
        approvals::where('id', $id)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'REJECTED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => ' has rejected  to delete a branch',
        ]);
    }

    public function declineActivateBranch($process_id, $id){

//        BranchesModel::where('id',$process_id)->update(['branch_status'=>"REJECTED"]);
        approvals::where('id', $id)->update([
            'approver_id' => Auth::user()->id,
            'process_status' => 'REJECTED',
            'approval_status' => 'REJECTED',
            'approval_process_description' => ' has rejected  to activate a branch',
        ]);
    }





    private function rejectPasswordReset($reset_email, $id): void
    {
        approvals::where('id', $id)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected password reset for the user with email - '.$reset_email,
        ]);
    }

    /////////////////////////loan product/ /////////////////////

    public function approveCreateLanProduct($process_id, $id){
        Loan_sub_products::where('id',$process_id)->update(['sub_product_status'=>'ACTIVE']);

        approvals::where('id', $id)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved ',
        ]);

    }



    ////////////////////////////////PERMISSIONS/////////////////////////////////////////////
    private function approveEditPermission($process_id, $id)
    {
        UserSubMenu::where('user_id', $process_id)->update([
            'updated' => 0,
            'previous' => null,
            'status' => 'ACTIVE'
        ]);
        approvals::where('id', $id)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved change',
        ]);
    }

    private function rejectEditPermission($process_id, $id)
    {
        $menuData = UserSubMenu::where('user_id', $process_id)->where('updated', 1)->get();
        foreach ($menuData as $data)
        {
            UserSubMenu::where('ID', $data->ID)->update([
                'updated' => 0,
                'previous' => null,
                'permission' => $data->previous,
                'status' => 'ACTIVE'
            ]);
        }


        approvals::where('id', $id)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected change',
        ]);
    }


    /////////////////////////////////////TRANSACTIONS///////////////////////////////

    public function approveResolveTransaction($process_id, $approvalsId, $changes){
        $changes = json_decode($changes, true);
        foreach($changes as $key => $value){
            $dbValue = Transactions::where('id',$process_id)->value($key);
            if($dbValue != $value){
                Transactions::where('id', $process_id)->update([
                    $key => $value
                ]);
            }

        }

        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'APPROVED',
            'approval_process_description' => 'Approved resolution of transaction',
        ]);
    }

    public function rejectResolveTransaction($process_id,$approvalsId){
        approvals::where('id', $approvalsId)->update([
            'approver_id' => Auth::user()->id,
            'approval_status' => 'REJECTED',
            'approval_process_description' => 'Rejected transaction resolution',
        ]);
    }

}
