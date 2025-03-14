<?php

namespace App\Http\Livewire\Savings;

use Livewire\Component;

use App\Models\SavingsModel;
use App\Models\approvals;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


use App\Models\AccountsModel;
use App\Models\Clients;
use App\Models\TeamUser;


use Livewire\WithFileUploads;
use App\Models\issured_savings;



use App\Models\general_ledger;




class Savings extends Component
{


    public $tab_id = '1';
    public $title = 'Savings list';

    public $selected;
    public $activeSavingsCount;
    public $inactiveSavingsCount;
    public $showCreateNewSavingsAccount;
    public $name;
    public $region;
    public $wilaya;
    public $membershipNumber;
    public $parentSavingsAccount;
    public $showDeleteSavingsAccount;
    public $SavingsAccountSelected;
    public $showEditSavingsAccount;
    public $pendingSavingsAccount;
    public $SavingsList;
    public $pendingSavingsAccountname;
    public $SavingsAccount;
    public $showAddSavingsAccount;


    public $email;
    public $SavingsAccount_status;
    public $permission = 'BLOCKED';
    public $password;

    public $member;
    public $product;
    public $number_of_savings;
    public $linked_savings_account;
    public $account_number;
    public $balance;
    public $nominal_price;
    public $showIssueNewSavings;





    public $accountSelected;
    public $sub_product_number;
    public $savingsAvailable;



    public $number_of_shares;


    public $deposit_charge_min_value;

    public $amount;
    public $notes;
    public $bank;
    public $reference_number;

    protected $rules = [
        'member'=> 'required|min:1',
        'product'=> 'required|min:1',
        'number_of_savings'=> 'required|min:1',
        'linked_savings_account'=> 'required|min:1',
        'account_number'=> 'required|min:1',
    ];



    protected $listeners = [
        'showUsersList' => 'showUsersList',
        'blockSavingsAccount' => 'blockSavingsAccountModal',
        'editSavingsAccount' => 'editSavingsAccountModal'
        ];


        public function setAccount($account){
            $this->accountSelected = $account;
            $this->product = AccountsModel::where('account_number', $account)->value('sub_product_number');
            //dd($this->product_number);
        }



    public function showAddSavingsAccountModal($selected){
        $randomNumber = rand(9000, 9999);
        $this->membershipNumber= str_pad($randomNumber, 4, '0', STR_PAD_LEFT);
        $this->selected = $selected;
        $this->showAddSavingsAccount = true;
    }


    public function showIssueNewSavingsModal($selected){
        $randomNumber = rand(9000, 9999);
        $this->membershipNumber= str_pad($randomNumber, 4, '0', STR_PAD_LEFT);
        $this->selected = $selected;
        $this->showIssueNewSavings = true;
    }


    public function updatedSavingsAccount(){
        $SavingsAccountData = SavingsModel::select('membershipNumber', 'name', 'region', 'wilaya', 'email')
        ->where('id', '=', $this->SavingsAccount)
        ->get();
    foreach ($SavingsAccountData as $SavingsAccount){
        $this->membershipNumber=$SavingsAccount->membershipNumber;
        $this->name=$SavingsAccount->name;
        $this->region=$SavingsAccount->region;
        $this->wilaya=$SavingsAccount->wilaya;
        $this->email=$SavingsAccount->email;
        $this->status=$SavingsAccount->status;
    }
    }



    public function updateSavingsAccount(){

        $user = auth()->user();


        $data = [
            'membershipNumber' =>$this->membershipNumber,
            'name' =>$this->name,
            'region' =>$this->region,
            'wilaya' =>$this->wilaya,
            'email' =>$this->email
        ];

        $update_value = approvals::updateOrCreate(
            [
                'process_id' => $this->SavingsAccount,
                'user_id' => Auth::user()->id

                ],
            [
                'institution' => $this->SavingsAccount,
                'process_name' => 'editSavingsAccount',
                'process_description' => 'has edited a SavingsAccount',
                'approval_process_description' => 'has approved changes to a SavingsAccount',
                'process_code' => '02',
                'process_id' => $this->SavingsAccount,
                'process_status' => 'Pending',
                'user_id'  => Auth::user()->id,
                'team_id'  => $this->SavingsAccount,
                'edit_package'=> json_encode($data)
            ]
        );
        Session::flash('message', 'Awaiting approval');
        Session::flash('alert-class', 'alert-success');
        $this->resetData();
        $this->showAddSavingsAccount = false;
    }



    public function addSavingsAccount(){
        $branch = Clients::where('membership_number',$this->member)->value('branch');
        $id = Clients::where('membership_number', $this->member)->value('id');

        $id = AccountsModel::create([
            'account_use' => 'external',
            'institution_number'=> '1001',
            'branch_number'=> str_pad($branch, 2, '0', STR_PAD_LEFT),
            'member_number'=> $this->member,
            'product_number'=> '12',
            'sub_product_number'=> $this->product,
            'account_name'=> Clients::where('membership_number',$this->member)->value('first_name').' '.Clients::where('membership_number',$this->member)->value('middle_name').' '.Clients::where('membership_number',$this->member)->value('last_name'),
            'account_number'=> str_pad($branch, 2, '0', STR_PAD_LEFT).'111'.str_pad($id, 5, '0', STR_PAD_LEFT),

        ])->id;


        $user = auth()->user();

        $team = $user->currentTeam;

        $institution = TeamUser::where('user_id',Auth::user()->id)->value('institution');

        approvals::create([
            'institution' => $institution,
            'process_name' => 'createAccount',
            'process_description' => 'has added a new account',
            'approval_process_description' => 'has approved a new account',
            'process_code' => '04',
            'process_id' => $id,
            'process_status' => 'Pending',
            'user_id'  => Auth::user()->id,
            'team_id'  => ""
        ]);
        $this->resetData2();
        Session::flash('message', 'The process has been completed!');
        Session::flash('alert-class', 'alert-success');

    }

    public function resetData2()
    {
        // Code to reset the data goes here
        // You can define the logic to reset the desired data properties or perform any necessary actions
        // For example:
        $this->member = null;
        $this->product = null;
        // Reset other data properties as needed
    }




    public function save()
    {

        $institution_id='';
        $id = auth()->user()->id;
        $currentUser = DB::table('team_user')->where('user_id', $id)->get();
        foreach ($currentUser as $User){
            $institution_id=$User->team_id;
        }

        //$this->validate();

        $mirror_account = AccountsModel::where('account_number',$this->bank)->value('mirror_account');

        $savings_account_new_balance = (double)AccountsModel::where('account_number',$this->accountSelected)->value('balance') + (double)$this->amount;

        $savings_ledger_account_new_balance = (double)AccountsModel::where('account_number',$mirror_account)->value('balance') - (double)$this->amount;

        $partner_bank_account_new_balance = (double)AccountsModel::where('account_number',$this->bank)->value('balance') + (double)$this->amount;

//        AccountsModel::where('account_number',$this->accountSelected)->update(['balance'=>$savings_account_new_balance]);
//        AccountsModel::where('account_number',$mirror_account)->update(['balance'=>$savings_ledger_account_new_balance]);
        AccountsModel::where('account_number',$this->bank)->update(['balance'=>$partner_bank_account_new_balance]);

        $reference_number = time();


        //DEBIT RECORD MEMBER
        $institution_id=1;
        general_ledger::create([
            'record_on_account_number'=> $this->accountSelected,
            'record_on_account_number_balance'=> $savings_account_new_balance,
            'sender_branch_id'=> $institution_id,
            'beneficiary_branch_id'=> $institution_id,
            'sender_product_id'=>  AccountsModel::where('account_number',$mirror_account)->value('product_number'),
            'sender_sub_product_id'=> AccountsModel::where('account_number',$mirror_account)->value('sub_product_number'),
            'beneficiary_product_id'=> AccountsModel::where('account_number',$this->accountSelected)->value('product_number'),
            'beneficiary_sub_product_id'=> AccountsModel::where('account_number',$this->accountSelected)->value('sub_product_number'),
            'sender_id'=> '999999',
            'beneficiary_id'=> $this->member,
            'sender_name'=> 'Organization',
            'beneficiary_name'=> Clients::where('membership_number',$this->member)->value('first_name').' '.Clients::where('membership_number',$this->member)->value('middle_name').' '.Clients::where('membership_number',$this->member)->value('last_name'),
            'sender_account_number'=> $mirror_account,
            'beneficiary_account_number'=> $this->accountSelected,
            'transaction_type'=> 'IFT',
            'sender_account_currency_type'=> 'TZS',
            'beneficiary_account_currency_type'=> 'TZS',
            'narration'=> $this->notes,
            'credit'=> (double)$this->amount,
            'debit'=> 0,
            'reference_number'=> $reference_number,
            'trans_status'=> 'Successful',
            'trans_status_description'=> 'Successful',
            'swift_code'=> '',
            'destination_bank_name'=> '',
            'destination_bank_number'=> '',
            'payment_status'=> 'Successful',
            'recon_status'=> 'Pending',
            'partner_bank'=> AccountsModel::where('account_number',$this->bank)->value('institution_number'),
            'partner_bank_name'=> AccountsModel::where('account_number',$this->bank)->value('account_name'),
            'partner_bank_account_number'=> $this->bank,
            'partner_bank_transaction_reference_number'=> $this->reference_number,
        ]);

        //CREDIT RECORD SHARE ACCOUNT
        general_ledger::create([
            'record_on_account_number'=> $this->bank,
            'record_on_account_number_balance'=> $partner_bank_account_new_balance,
            'sender_branch_id'=> $institution_id,
            'beneficiary_branch_id'=> $institution_id,
            'sender_product_id'=>  AccountsModel::where('account_number',$this->accountSelected)->value('product_number'),
            'sender_sub_product_id'=> AccountsModel::where('account_number',$this->accountSelected)->value('sub_product_number'),
            'beneficiary_product_id'=> AccountsModel::where('account_number',$this->bank)->value('product_number'),
            'beneficiary_sub_product_id'=> AccountsModel::where('account_number',$this->bank)->value('sub_product_number'),
            'sender_id'=> $this->member,
            'beneficiary_id'=> AccountsModel::where('account_number',$this->bank)->value('institution_number'),
            'sender_name'=> Clients::where('membership_number',$this->member)->value('first_name').' '.Clients::where('membership_number',$this->member)->value('middle_name').' '.Clients::where('membership_number',$this->member)->value('last_name'),
            'beneficiary_name'=> AccountsModel::where('account_number',$this->bank)->value('account_name'),
            'sender_account_number'=> $this->accountSelected,
            'beneficiary_account_number'=> $this->bank,
            'transaction_type'=> 'IFT',
            'sender_account_currency_type'=> 'TZS',
            'beneficiary_account_currency_type'=> 'TZS',
            'narration'=> $this->notes,
            'credit'=> (double)$this->amount,
            'debit'=> 0,
            'reference_number'=> $reference_number,
            'trans_status'=> 'Successful',
            'trans_status_description'=> 'Successful',
            'swift_code'=> '',
            'destination_bank_name'=> '',
            'destination_bank_number'=> '',
            'payment_status'=> 'Successful',
            'recon_status'=> 'Pending',
            'partner_bank'=> AccountsModel::where('account_number',$this->bank)->value('institution_number'),
            'partner_bank_name'=> AccountsModel::where('account_number',$this->bank)->value('account_name'),
            'partner_bank_account_number'=> $this->bank,
            'partner_bank_transaction_reference_number'=> $this->reference_number,
        ]);

        //CREDIT RECORD GL
        general_ledger::create([
            'record_on_account_number'=> $mirror_account,
            'record_on_account_number_balance'=> $savings_ledger_account_new_balance ,
            'sender_branch_id'=> $institution_id,
            'beneficiary_branch_id'=> $institution_id,
            'sender_product_id'=>  AccountsModel::where('account_number',$mirror_account)->value('product_number'),
            'sender_sub_product_id'=> AccountsModel::where('account_number',$mirror_account)->value('sub_product_number'),
            'beneficiary_product_id'=> AccountsModel::where('account_number',$this->accountSelected)->value('product_number'),
            'beneficiary_sub_product_id'=> AccountsModel::where('account_number',$this->accountSelected)->value('sub_product_number'),
            'sender_id'=> '999999',
            'beneficiary_id'=> $this->member,
            'sender_name'=> AccountsModel::where('account_number',$mirror_account)->value('account_name'),

            'beneficiary_name'=>  Clients::where('membership_number',$this->member)->value('first_name').' '.Clients::where('membership_number',$this->member)->value('middle_name').' '.Clients::where('membership_number',$this->member)->value('last_name'),
            'sender_account_number'=> $mirror_account,
            'beneficiary_account_number'=> $this->accountSelected,
            'transaction_type'=> 'IFT',
            'sender_account_currency_type'=> 'TZS',
            'beneficiary_account_currency_type'=> 'TZS',
            'narration'=> $this->notes,
            'credit'=> 0,
            'debit'=> (double)$this->amount,
            'reference_number'=> $reference_number,
            'trans_status'=> 'Successful',
            'trans_status_description'=> 'Successful',
            'swift_code'=> '',
            'destination_bank_name'=> '',
            'destination_bank_number'=> '',
            'payment_status'=> 'Successful',
            'recon_status'=> 'Pending',
            'partner_bank'=> AccountsModel::where('account_number',$this->bank)->value('institution_number'),
            'partner_bank_name'=> AccountsModel::where('account_number',$this->bank)->value('account_name'),
            'partner_bank_account_number'=> $this->bank,
            'partner_bank_transaction_reference_number'=> $this->reference_number,
        ]);

        $this->sendApproval($reference_number,'New savings transaction','07');
        $this->resetData();

        Session::flash('message', 'Shares has been successfully issued!');
        Session::flash('alert-class', 'alert-success');

    }

    public function sendApproval($id,$msg,$code){

        $user = auth()->user();

        $team = $user->currentTeam;

        $institution = TeamUser::where('user_id',Auth::user()->id)->value('institution');

        approvals::create([
            'institution' => $institution,
            'process_name' => 'createBranch',
            'process_description' => $msg,
            'approval_process_description' => 'has approved a transaction',
            'process_code' => $code,
            'process_id' => $id,
            'process_status' => 'Pending',
            'user_id'  => Auth::user()->id,
            'team_id'  => ""
        ]);

    }

    public function resetData()
    {
        $this->member = '';
        $this->product = '';
        $this->accountSelected = '';
        $this->amount = '';
        $this->account_number = '';
        $this->notes = '';
        $this->bank = '';
        $this->reference_number = '';


    }




    public function menuItemClicked($tabId){
        $this->tab_id = $tabId;
        if($tabId == '1'){
            $this->title = 'Savings list';
        }
        if($tabId == '2'){
            $this->title = 'Enter new SavingsAccount details';
        }
    }


    public function createNewSavingsAccount()
    {


        $this->showCreateNewSavingsAccount = true;
    }

    public function blockSavingsAccountModal($id)
    {

        $this->showDeleteSavingsAccount = true;
        $this->SavingsAccountSelected = $id;
    }

    public function editSavingsAccountModal($id)
    {
        $this->showEditSavingsAccount = true;
        $this->pendingSavingsAccount = $id;
        $this->SavingsAccount = $id;
        $this->pendingSavingsAccountname = SavingsModel::where('id',$id)->value('name');
        $this->updatedSavingsAccount();

    }

        public function closeModal(){
            $this->showCreateNewSavingsAccount = false;
            $this->showDeleteSavingsAccount = false;
            $this->showEditSavingsAccount = false;
        }

        public function confirmPassword(): void
        {
            // Check if password matches for logged-in user
            if (Hash::check($this->password, auth()->user()->password)) {
                //dd('password matches');
                $this->delete();
            } else {
                //dd('password does not match');
                Session::flash('message', 'This password does not match our records');
                Session::flash('alert-class', 'alert-warning');
            }
            $this->resetPassword();


        }

        public function resetPassword(): void
        {
            $this->password = null;
        }

    public function delete(): void
    {
        $user = User::where('id',$this->userSelected)->first();
        $action = '';
        if ($user) {

            if($this->permission == 'BLOCKED'){
                $action = 'blockUser';
            }
            if($this->permission == 'ACTIVE'){
                $action = 'activateUser';
            }
            if($this->permission == 'DELETED'){
                $action = 'deleteUser';
            }

            $update_value = approvals::updateOrCreate(
                [
                    'process_id' => $this->userSelected,
                    'user_id' => Auth::user()->id

                ],
                [
                    'institution' => '',
                    'process_name' => $action,
                    'process_description' => $this->permission.' user - '.$user->name,
                    'approval_process_description' => '',
                    'process_code' => '29',
                    'process_id' => $this->userSelected,
                    'process_status' => $this->permission,
                    'approval_status' => 'PENDING',
                    'user_id'  => Auth::user()->id,
                    'team_id'  => '',
                    'edit_package'=> null
                ]
            );


            // Delete the record
            //$node->delete();
            // Add your logic here for successful deletion
            Session::flash('message', 'Awaiting approval');
            Session::flash('alert-class', 'alert-success');

            $this->closeModal();
            $this->render();


        } else {
            // Handle case where record was not found
            // Add your logic here
            Session::flash('message', 'Node error');
            Session::flash('alert-class', 'alert-warning');
        }

    }





    public function render()
    {
        $this->activeSavingsCount = SavingsModel::where('account_status', 'Active')->count();
        $this->inactiveSavingsCount = SavingsModel::where('account_status', 'Pending')->count();
        $this->SavingsList = SavingsModel::get();
        return view('livewire.savings.savings');
    }
}
