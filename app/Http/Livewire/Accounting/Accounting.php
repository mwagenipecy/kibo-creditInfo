<?php

namespace App\Http\Livewire\Accounting;

use App\Models\MembersModel;
use Illuminate\Support\Facades\Config;
use Livewire\Component;
use Illuminate\Support\Facades\Session;


use App\Models\approvals;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;


use App\Models\AccountsModel;
use App\Models\Members;
use App\Models\TeamUser;


use Livewire\WithFileUploads;
use App\Models\issured_accounts;



use App\Models\general_ledger;


class Accounting extends Component
{


    public $tab_id = '1';
    public $title = 'Savings report';



    public $selected;
    public $activeAccountsCount;
    public $inactiveAccountsCount;
    public $showCreateNewAccountsAccount;
    public $name;
    public $region;
    public $wilaya;
    public $membershipNumber;
    public $parentAccountsAccount;
    public $showDeleteAccountsAccount;
    public $AccountsAccountSelected;
    public $showEditAccountsAccount;
    public $pendingAccountsAccount;
    public $AccountsList;
    public $pendingAccountsAccountname;
    public $AccountsAccount;
    public $showAddAccountsAccount;


    public $email;
    public $AccountsAccount_status;
    public $permission = 'BLOCKED';
    public $password;

    public $member;
    public $product;
    public $number_of_accounts;
    public $linked_accounts_account;
    public $account_number;
    public $balance;
    public $nominal_price;
    public $showIssueNewAccounts;





    public $accountSelected;
    public $sub_product_number;
    public $accountsAvailable;

    // view member parameter
    public $viewMemberDetails=false;
    public $memberData;
    public $account_name;
    public $mirror_account;

    protected $rules = [
        'member'=> 'required|min:1',
        'product'=> 'required|min:1',
        'number_of_accounts'=> 'required|min:1',
        'linked_accounts_account'=> 'required|min:1',
        'account_number'=> 'required|min:1',
    ];



    protected $listeners = [
        'showUsersList' => 'showUsersList',
        'blockAccountsAccount' => 'blockAccountsAccountModal',
        'editAccountsAccount' => 'editAccountsAccountModal',
        'financeViewMember'=>'viewMembersData'
    ];






    public function viewMembersData($id){
        if($this->viewMemberDetails==false){
            $this->viewMemberDetails=true;
            session()->put('viewMemberId_details',$id);

        }
        else if($this->viewMemberDetails==true){
            $this->viewMemberDetails=false;
        }


    }



    public function setAccount($account){
        $this->accountSelected = $account;
        $this->product = AccountsModel::where('account_number', $account)->value('sub_product_number');
        //dd($this->product_number);
    }



    public function showAddAccountsAccountModal($selected){
        $randomNumber = rand(9000, 9999);
        $this->membershipNumber= str_pad($randomNumber, 4, '0', STR_PAD_LEFT);
        $this->selected = $selected;
        $this->showAddAccountsAccount = true;
    }


    public function showIssueNewAccountsModal($selected){
        $randomNumber = rand(9000, 9999);
        $this->membershipNumber= str_pad($randomNumber, 4, '0', STR_PAD_LEFT);
        $this->selected = $selected;
        $this->showIssueNewAccounts = true;
    }

    public function setView($selected){
        $this->tab_id = $selected;
    }


    public function updatedAccountsAccount(){
        $AccountsAccountData = AccountsModel::select('account_name', 'account_number', 'mirror_account')
            ->where('id', '=', $this->AccountsAccount)
            ->get();
        foreach ($AccountsAccountData as $AccountsAccount){
            $this->account_name=$AccountsAccount->account_name;
            $this->account_number=$AccountsAccount->account_number;
            $this->mirror_account=$AccountsAccount->mirror_account;
        }
    }



    public function updateAccountsAccount(){

        $user = auth()->user();


        $data = [
            'account_name' =>$this->account_name,
            'account_number' =>$this->account_number,
            'mirror_account' =>$this->mirror_account
        ];


        $update_value = approvals::updateOrCreate(
            [
                'process_id' => $this->AccountsAccount,
                'user_id' => Auth::user()->id

            ],
            [
                'institution' => auth()->user()->institution_id,
                'process_name' => 'editAccount',
                'process_description' => 'has edited an account',
                'approval_process_description' => 'has approved changes to this account',
                'process_code' => '02',
                'process_id' => $this->AccountsAccount,
                'process_status' => 'Pending',
                'user_id'  => Auth::user()->id,
                'team_id'  => $this->AccountsAccount,
                'edit_package'=> json_encode($data)
            ]
        );
        Session::flash('message', 'Awaiting approval');
        Session::flash('alert-class', 'alert-success');
        $this->resetData();
        $this->showEditAccountsAccount = false;
    }



    public function addAccountsAccount(){
        $branch = Members::where('membership_number',$this->member)->value('branch');
        $id = Members::where('membership_number', $this->member)->value('id');

        $id = AccountsModel::create([
            'account_use' => 'external',
            'institution_number'=> '1001',
            'branch_number'=> str_pad($branch, 2, '0', STR_PAD_LEFT),
            'member_number'=> $this->member,
            'product_number'=> '11',
            'sub_product_number'=> $this->product,
            'account_name'=> Members::where('membership_number',$this->member)->value('first_name').' '.Members::where('membership_number',$this->member)->value('middle_name').' '.Members::where('membership_number',$this->member)->value('last_name'),
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

    }



    public function issueAccounts()
    {

        $institution_id='';
        $id = auth()->user()->id;
        $currentUser = DB::table('team_user')->where('user_id', $id)->get();
        foreach ($currentUser as $User){
            $institution_id=$User->team_id;
        }

        $this->validate();

        $accounts_account_new_balance = (double)AccountsModel::where('account_number',$this->linked_accounts_account)->value('balance') - ($this->number_of_accounts * $this->nominal_price);
        $loan_account_new_balance = (double)AccountsModel::where('account_number',$this->account_number)->value('balance') + ($this->number_of_accounts * $this->nominal_price);
        $loan_ledger_account_new_balance = (double)AccountsModel::where('account_number','5111108827')->value('balance') + ($this->number_of_accounts * $this->nominal_price);

        AccountsModel::where('account_number',$this->linked_accounts_account)->update(['balance'=>$accounts_account_new_balance]);
        AccountsModel::where('account_number',$this->account_number)->update(['balance'=>$loan_account_new_balance]);
        AccountsModel::where('account_number','5111108827')->update(['balance'=>$loan_ledger_account_new_balance]);

        $reference_number = time();


        //DEBIT RECORD MEMBER
        general_ledger::create([
            'record_on_account_number'=> $this->linked_accounts_account,
            'record_on_account_number_balance'=> $accounts_account_new_balance,
            'sender_branch_id'=> $institution_id,
            'beneficiary_branch_id'=> $institution_id,
            'sender_product_id'=>  AccountsModel::where('account_number',$this->linked_accounts_account)->value('product_number'),
            'sender_sub_product_id'=> AccountsModel::where('account_number',$this->linked_accounts_account)->value('sub_product_number'),
            'beneficiary_product_id'=> AccountsModel::where('account_number',$this->account_number)->value('product_number'),
            'beneficiary_sub_product_id'=> AccountsModel::where('account_number',$this->account_number)->value('sub_product_number'),
            'sender_id'=> $this->member,
            'beneficiary_id'=> $this->member,
            'sender_name'=> Members::where('membership_number',$this->member)->value('first_name').' '.Members::where('membership_number',$this->member)->value('middle_name').' '.Members::where('membership_number',$this->member)->value('last_name'),
            'beneficiary_name'=> Members::where('membership_number',$this->member)->value('first_name').' '.Members::where('membership_number',$this->member)->value('middle_name').' '.Members::where('membership_number',$this->member)->value('last_name'),
            'sender_account_number'=> $this->linked_accounts_account,
            'beneficiary_account_number'=> $this->account_number,
            'transaction_type'=> 'IFT',
            'sender_account_currency_type'=> 'TZS',
            'beneficiary_account_currency_type'=> 'TZS',
            'narration'=> 'Payment for accounts issued',
            'credit'=> 0,
            'debit'=> $this->number_of_accounts * $this->nominal_price,
            'reference_number'=> $reference_number,
            'trans_status'=> 'Successful',
            'trans_status_description'=> 'Successful',
            'swift_code'=> '',
            'destination_bank_name'=> '',
            'destination_bank_number'=> null,
            'payment_status'=> 'Successful',
            'recon_status'=> 'Pending',
        ]);

        //CREDIT RECORD ACCOUNT ACCOUNT
        general_ledger::create([
            'record_on_account_number'=> $this->account_number,
            'record_on_account_number_balance'=> $loan_account_new_balance,
            'sender_branch_id'=> $institution_id,
            'beneficiary_branch_id'=> $institution_id,
            'sender_product_id'=>  AccountsModel::where('account_number',$this->linked_accounts_account)->value('product_number'),
            'sender_sub_product_id'=> AccountsModel::where('account_number',$this->linked_accounts_account)->value('sub_product_number'),
            'beneficiary_product_id'=> AccountsModel::where('account_number',$this->account_number)->value('product_number'),
            'beneficiary_sub_product_id'=> AccountsModel::where('account_number',$this->account_number)->value('sub_product_number'),
            'sender_id'=> $this->member,
            'beneficiary_id'=> $this->member,
            'sender_name'=> Members::where('membership_number',$this->member)->value('first_name').' '.Members::where('membership_number',$this->member)->value('middle_name').' '.Members::where('membership_number',$this->member)->value('last_name'),
            'beneficiary_name'=> Members::where('membership_number',$this->member)->value('first_name').' '.Members::where('membership_number',$this->member)->value('middle_name').' '.Members::where('membership_number',$this->member)->value('last_name'),
            'sender_account_number'=> $this->linked_accounts_account,
            'beneficiary_account_number'=> $this->account_number,
            'transaction_type'=> 'IFT',
            'sender_account_currency_type'=> 'TZS',
            'beneficiary_account_currency_type'=> 'TZS',
            'narration'=> 'Payment for accounts issued',
            'credit'=> $this->number_of_accounts * $this->nominal_price,
            'debit'=> 0,
            'reference_number'=> $reference_number,
            'trans_status'=> 'Successful',
            'trans_status_description'=> 'Successful',
            'swift_code'=> '',
            'destination_bank_name'=> '',
            'destination_bank_number'=> null,
            'payment_status'=> 'Successful',
            'recon_status'=> 'Pending',
        ]);

        //CREDIT RECORD GL
        general_ledger::create([
            'record_on_account_number'=> '5111108827',
            'record_on_account_number_balance'=> $loan_ledger_account_new_balance ,
            'sender_branch_id'=> $institution_id,
            'beneficiary_branch_id'=> $institution_id,
            'sender_product_id'=>  AccountsModel::where('account_number',$this->linked_accounts_account)->value('product_number'),
            'sender_sub_product_id'=> AccountsModel::where('account_number',$this->linked_accounts_account)->value('sub_product_number'),
            'beneficiary_product_id'=> AccountsModel::where('account_number','5111108827')->value('product_number'),
            'beneficiary_sub_product_id'=> AccountsModel::where('account_number','5111108827')->value('sub_product_number'),
            'sender_id'=> $this->member,
            'beneficiary_id'=> '999999',
            'sender_name'=> Members::where('membership_number',$this->member)->value('first_name').' '.Members::where('membership_number',$this->member)->value('middle_name').' '.Members::where('membership_number',$this->member)->value('last_name'),
            'beneficiary_name'=> 'Organization',
            'sender_account_number'=> $this->linked_accounts_account,
            'beneficiary_account_number'=> '5111108827',
            'transaction_type'=> 'IFT',
            'sender_account_currency_type'=> 'TZS',
            'beneficiary_account_currency_type'=> 'TZS',
            'narration'=> 'Payment for accounts issued',
            'credit'=> $this->number_of_accounts * $this->nominal_price,
            'debit'=> 0,
            'reference_number'=> $reference_number,
            'trans_status'=> 'Successful',
            'trans_status_description'=> 'Successful',
            'swift_code'=> '',
            'destination_bank_name'=> '',
            'destination_bank_number'=> null,
            'payment_status'=> 'Successful',
            'recon_status'=> 'Pending',
        ]);

        issured_AccountsModel::create([
            'reference_number'=> $reference_number,
            'institution_id'=> $institution_id,
            'member'=> $this->member,
            'product'=> $this->product,
            'number_of_accounts'=> $this->number_of_accounts,
            'linked_accounts_account'=> $this->linked_accounts_account,
            'account_number'=> $this->account_number,
            'nominal_price'=> $this->nominal_price,
            'price'=> $this->number_of_accounts * $this->nominal_price,
        ]);
        $this->sendApproval($reference_number,'New accounts transaction','07');
        $this->resetData();

        Session::flash('message', 'Accounts has been successfully issued!');
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
        $this->number_of_accounts = '';
        $this->linked_accounts_account = '';
        $this->account_number = '';
        $this->balance = '';
        $this->nominal_price = '';
        $this->showIssueNewAccounts = false;
        $this->showAddAccountsAccount = false;
        $this->account_name = '';
        $this->mirror_account = '';

    }



    public function createNewAccountsAccount()
    {


        $this->showCreateNewAccountsAccount = true;
    }

    public function blockAccountsAccountModal($id)
    {

        $this->showDeleteAccountsAccount = true;
        $this->AccountsAccountSelected = $id;
    }

    public function editAccountsAccountModal($id)
    {
        $this->showEditAccountsAccount = true;
        $this->pendingAccountsAccount = $id;
        $this->AccountsAccount = $id;
        $this->pendingAccountsAccountname = AccountsModel::where('id',$id)->value('account_name');
        $this->updatedAccountsAccount();

    }

    public function closeModal(){
        $this->showCreateNewAccountsAccount = false;
        $this->showDeleteAccountsAccount = false;
        $this->showEditAccountsAccount = false;
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




    public function menuItemClicked($tabId)
    {
        $this->tab_id = $tabId;
        if ($tabId == '1') {
            $this->title = 'Internal accounts';
        }
        if ($tabId == '2') {
            $this->title = 'Enter new shares details';
        }
        if ($tabId == '3') {
            $this->title = 'External accounts';
        }
        if ($tabId == '4') {
            $this->title = 'Loan Disbursements';
            Session::put('viewAccountsWithCategory','Accounting');

            Session::put('currentloanID',null);
            Session::put('currentloanMember',null);
            Session::put('disableInputs',true);
        }

        if ($tabId == '5') {
            $this->title = 'PO / Invoices';
            Session::put('viewAccountsWithCategory','AccountingPO');

            Session::put('currentloanID',null);
            Session::put('currentloanMember',null);
            Session::put('disableInputs',true);
        }
    }


    public function render()
    {


        $this->activeAccountsCount = AccountsModel::where('account_status', 'ACTIVE')->count();
        $this->inactiveAccountsCount = AccountsModel::where('account_status', 'PENDING')->count();
        $this->AccountsList = AccountsModel::get();
        return view('livewire.accounting.accounting');
    }
}
