<?php

namespace App\Http\Livewire\Shares;

use Livewire\Component;
use App\Models\SharesModel;
use App\Models\approvals;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


use App\Models\AccountsModel;
use App\Models\Clients;
use App\Models\TeamUser;


use Livewire\WithFileUploads;
use App\Models\issured_shares;



use App\Models\general_ledger;




class Shares extends Component
{


    public $tab_id = '1';
    public $title = 'Shares list';

    public $selected;
    public $activeSharesCount;
    public $inactiveSharesCount;
    public $showCreateNewSharesAccount;
    public $name;
    public $region;
    public $wilaya;
    public $membershipNumber;
    public $parentSharesAccount;
    public $showDeleteSharesAccount;
    public $SharesAccountSelected;
    public $showEditSharesAccount;
    public $pendingSharesAccount;
    public $SharesList;
    public $pendingSharesAccountname;
    public $SharesAccount;
    public $showAddSharesAccount;


    public $email;
    public $SharesAccount_status;
    public $permission = 'BLOCKED';
    public $password;

    public $member;
    public $product;
    public $number_of_shares;
    public $linked_savings_account;
    public $account_number;
    public $balance;
    public $nominal_price;
    public $showIssueNewShares;





    public $accountSelected;
    public $sub_product_number;
    public $sharesAvailable;

    protected $rules = [
        'member'=> 'required|min:1',
        'product'=> 'required|min:1',
        'number_of_shares'=> 'required|min:1',
        'linked_savings_account'=> 'required|min:1',
        'account_number'=> 'required|min:1',
    ];



    protected $listeners = [
        'showUsersList' => 'showUsersList',
        'blockSharesAccount' => 'blockSharesAccountModal',
        'editSharesAccount' => 'editSharesAccountModal'
        ];


        public function setAccount($account){
            $this->accountSelected = $account;
            $this->product = AccountsModel::where('account_number', $account)->value('sub_product_number');
            //dd($this->product_number);
        }



    public function showAddSharesAccountModal($selected){
        $randomNumber = rand(9000, 9999);
        $this->membershipNumber= str_pad($randomNumber, 4, '0', STR_PAD_LEFT);
        $this->selected = $selected;
        $this->showAddSharesAccount = true;
    }


    public function showIssueNewSharesModal($selected){
        $randomNumber = rand(9000, 9999);
        $this->membershipNumber= str_pad($randomNumber, 4, '0', STR_PAD_LEFT);
        $this->selected = $selected;
        $this->showIssueNewShares = true;
    }


    public function updatedSharesAccount(){
        $SharesAccountData = SharesModel::select('membershipNumber', 'name', 'region', 'wilaya', 'email')
        ->where('id', '=', $this->SharesAccount)
        ->get();
    foreach ($SharesAccountData as $SharesAccount){
        $this->membershipNumber=$SharesAccount->membershipNumber;
        $this->name=$SharesAccount->name;
        $this->region=$SharesAccount->region;
        $this->wilaya=$SharesAccount->wilaya;
        $this->email=$SharesAccount->email;
        $this->status=$SharesAccount->status;
    }
    }



    public function updateSharesAccount(){

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
                'process_id' => $this->SharesAccount,
                'user_id' => Auth::user()->id

                ],
            [
                'institution' => $this->SharesAccount,
                'process_name' => 'editSharesAccount',
                'process_description' => 'has edited a SharesAccount',
                'approval_process_description' => 'has approved changes to a SharesAccount',
                'process_code' => '02',
                'process_id' => $this->SharesAccount,
                'process_status' => 'Pending',
                'user_id'  => Auth::user()->id,
                'team_id'  => $this->SharesAccount,
                'edit_package'=> json_encode($data)
            ]
        );
        Session::flash('message', 'Awaiting approval');
        Session::flash('alert-class', 'alert-success');
        $this->resetData();
        $this->showAddSharesAccount = false;
    }



    public function addSharesAccount(){
        $branch = Clients::where('membership_number',$this->member)->value('branch');
        $id = Clients::where('membership_number', $this->member)->value('id');

        $id = AccountsModel::create([
            'account_use' => 'external',
            'institution_number'=> '1001',
            'branch_number'=> str_pad($branch, 2, '0', STR_PAD_LEFT),
            'member_number'=> $this->member,
            'product_number'=> '11',
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

    }



    public function issueShares()
    {

        $institution_id=1;
        $id = auth()->user()->id;
        $currentUser = DB::table('team_user')->where('user_id', $id)->get();
        foreach ($currentUser as $User){
            $institution_id=$User->team_id;
        }

        $this->validate();

        $savings_account_new_balance = (double)AccountsModel::where('account_number',$this->linked_savings_account)->value('balance') - ($this->number_of_shares * $this->nominal_price);
        $share_account_new_balance = (double)AccountsModel::where('account_number',$this->account_number)->value('balance') + ($this->number_of_shares * $this->nominal_price);
        $share_ledger_account_new_balance = (double)AccountsModel::where('account_number','5111108827')->value('balance') + ($this->number_of_shares * $this->nominal_price);

        AccountsModel::where('account_number',$this->linked_savings_account)->update(['balance'=>$savings_account_new_balance]);
        AccountsModel::where('account_number',$this->account_number)->update(['balance'=>$share_account_new_balance]);
        AccountsModel::where('account_number','5111108827')->update(['balance'=>$share_ledger_account_new_balance]);

        $reference_number = time();


        //DEBIT RECORD MEMBER
        general_ledger::create([
            'record_on_account_number'=> $this->linked_savings_account,
            'record_on_account_number_balance'=> $savings_account_new_balance,
            'sender_branch_id'=> $institution_id,
            'beneficiary_branch_id'=> $institution_id,
            'sender_product_id'=>  AccountsModel::where('account_number',$this->linked_savings_account)->value('product_number'),
            'sender_sub_product_id'=> AccountsModel::where('account_number',$this->linked_savings_account)->value('sub_product_number'),
            'beneficiary_product_id'=> AccountsModel::where('account_number',$this->account_number)->value('product_number'),
            'beneficiary_sub_product_id'=> AccountsModel::where('account_number',$this->account_number)->value('sub_product_number'),
            'sender_id'=> $this->member,
            'beneficiary_id'=> $this->member,
            'sender_name'=> Clients::where('membership_number',$this->member)->value('first_name').' '.Clients::where('membership_number',$this->member)->value('middle_name').' '.Clients::where('membership_number',$this->member)->value('last_name'),
            'beneficiary_name'=> Clients::where('membership_number',$this->member)->value('first_name').' '.Clients::where('membership_number',$this->member)->value('middle_name').' '.Clients::where('membership_number',$this->member)->value('last_name'),
            'sender_account_number'=> $this->linked_savings_account,
            'beneficiary_account_number'=> $this->account_number,
            'transaction_type'=> 'IFT',
            'sender_account_currency_type'=> 'TZS',
            'beneficiary_account_currency_type'=> 'TZS',
            'narration'=> 'Payment for shares issued',
            'credit'=> 0,
            'debit'=> $this->number_of_shares * $this->nominal_price,
            'reference_number'=> $reference_number,
            'trans_status'=> 'Successful',
            'trans_status_description'=> 'Successful',
            'swift_code'=> '',
            'destination_bank_name'=> '',
            'destination_bank_number'=> null,
            'payment_status'=> 'Successful',
            'recon_status'=> 'Pending',
        ]);

        //CREDIT RECORD SHARE ACCOUNT
        general_ledger::create([
            'record_on_account_number'=> $this->account_number,
            'record_on_account_number_balance'=> $share_account_new_balance,
            'sender_branch_id'=> $institution_id,
            'beneficiary_branch_id'=> $institution_id,
            'sender_product_id'=>  AccountsModel::where('account_number',$this->linked_savings_account)->value('product_number'),
            'sender_sub_product_id'=> AccountsModel::where('account_number',$this->linked_savings_account)->value('sub_product_number'),
            'beneficiary_product_id'=> AccountsModel::where('account_number',$this->account_number)->value('product_number'),
            'beneficiary_sub_product_id'=> AccountsModel::where('account_number',$this->account_number)->value('sub_product_number'),
            'sender_id'=> $this->member,
            'beneficiary_id'=> $this->member,
            'sender_name'=> Clients::where('membership_number',$this->member)->value('first_name').' '.Clients::where('membership_number',$this->member)->value('middle_name').' '.Clients::where('membership_number',$this->member)->value('last_name'),
            'beneficiary_name'=> Clients::where('membership_number',$this->member)->value('first_name').' '.Clients::where('membership_number',$this->member)->value('middle_name').' '.Clients::where('membership_number',$this->member)->value('last_name'),
            'sender_account_number'=> $this->linked_savings_account,
            'beneficiary_account_number'=> $this->account_number,
            'transaction_type'=> 'IFT',
            'sender_account_currency_type'=> 'TZS',
            'beneficiary_account_currency_type'=> 'TZS',
            'narration'=> 'Payment for shares issued',
            'credit'=> $this->number_of_shares * $this->nominal_price,
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
            'record_on_account_number_balance'=> $share_ledger_account_new_balance ,
            'sender_branch_id'=> $institution_id,
            'beneficiary_branch_id'=> $institution_id,
            'sender_product_id'=>  AccountsModel::where('account_number',$this->linked_savings_account)->value('product_number'),
            'sender_sub_product_id'=> AccountsModel::where('account_number',$this->linked_savings_account)->value('sub_product_number'),
            'beneficiary_product_id'=> AccountsModel::where('account_number','5111108827')->value('product_number'),
            'beneficiary_sub_product_id'=> AccountsModel::where('account_number','5111108827')->value('sub_product_number'),
            'sender_id'=> $this->member,
            'beneficiary_id'=> '999999',
            'sender_name'=> Clients::where('membership_number',$this->member)->value('first_name').' '.Clients::where('membership_number',$this->member)->value('middle_name').' '.Clients::where('membership_number',$this->member)->value('last_name'),
            'beneficiary_name'=> 'Organization',
            'sender_account_number'=> $this->linked_savings_account,
            'beneficiary_account_number'=> '5111108827',
            'transaction_type'=> 'IFT',
            'sender_account_currency_type'=> 'TZS',
            'beneficiary_account_currency_type'=> 'TZS',
            'narration'=> 'Payment for shares issued',
            'credit'=> $this->number_of_shares * $this->nominal_price,
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

        issured_shares::create([
            'reference_number'=> $reference_number,
            'institution_id'=> $institution_id,
            'member'=> $this->member,
            'product'=> $this->product,
            'number_of_shares'=> $this->number_of_shares,
            'linked_savings_account'=> $this->linked_savings_account,
            'account_number'=> $this->account_number,
            'nominal_price'=> 20000,
//            'nominal_price'=> $this->nominal_price,
            'price'=> $this->number_of_shares * $this->nominal_price,
        ]);
        $this->sendApproval($reference_number,'New shares transaction','07');
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
        $this->number_of_shares = '';
        $this->linked_savings_account = '';
        $this->account_number = '';

    }





    public function menuItemClicked($tabId){
        $this->tab_id = $tabId;
        if($tabId == '1'){
            $this->title = 'Shares list';
        }
        if($tabId == '2'){
            $this->title = 'Enter new SharesAccount details';
        }
    }


    public function createNewSharesAccount()
    {


        $this->showCreateNewSharesAccount = true;
    }

    public function blockSharesAccountModal($id)
    {

        $this->showDeleteSharesAccount = true;
        $this->SharesAccountSelected = $id;
    }

    public function editSharesAccountModal($id)
    {
        $this->showEditSharesAccount = true;
        $this->pendingSharesAccount = $id;
        $this->SharesAccount = $id;
        $this->pendingSharesAccountname = SharesModel::where('id',$id)->value('name');
        $this->updatedSharesAccount();

    }

        public function closeModal(){
            $this->showCreateNewSharesAccount = false;
            $this->showDeleteSharesAccount = false;
            $this->showEditSharesAccount = false;
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
        $this->activeSharesCount = SharesModel::where('status', 'Active')->count();
        $this->inactiveSharesCount = SharesModel::where('status', 'Inactive')->count();
        $this->SharesList = SharesModel::get();
        return view('livewire.shares.shares');
    }
}
