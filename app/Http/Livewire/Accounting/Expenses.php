<?php

namespace App\Http\Livewire\Accounting;

use App\Models\ExpensesCategory;
use App\Models\MembersModel;
use App\Models\TeamUser;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Livewire\Component;

use Exception;
use App\Models\ExpensesModel;
use App\Models\approvals;
use App\Models\AccountsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class Expenses extends Component
{

    public $title = 'Expenses list';
    public $selected;
    public $showCreateNewExpense;
    public $showDeleteExpense;
    public $ExpenseSelected;
    public $showEditExpense;
    public $Expense;
    public $showAddExpense;
    public $vendor;
    public $category;
    public $amount;
    public $paymentMethod;
    public $expenditureAccount;
    public $destinationAccount;
    public $employeeId;
    public $departmentId;
    public $expenseDate;
    public $confirmingUserDeletion = false;

    public $branches;
    public $activeExpensesCount;
    public $inactiveExpensesCount;
    public $pendingExpensename;
    public $photo;
    public $profile_photo_path;
    public $selectedCategory = null;
    public $approveExpenses=false;
    public $member_name;
    public $source_account;
    public $source_account_name;
    public $request_amount;
    public $description;
    public $account_balance;



    protected $listeners = [
        'showUsersList' => 'showUsersList',
        'editExpense' => 'editExpenseModal',
        'approveExpenses'=>'approveExpenseModal'
    ];

    protected $rules = [
        'vendor' => 'required|min:3',
        'category' => 'required|min:3',
        'amount' => 'required|numeric',
        'paymentMethod' => 'required|min:3',
        'expenditureAccount' => 'required|min:3',
        'destinationAccount' => 'required|min:3',
        'employeeId' => 'required|integer',
        'departmentId' => 'required|integer',
        'expenseDate' => 'required|date'
    ];
    public $categories;
    public $expenditureAccounts;



    public function desplayExpensesData($id){
        ///
        $expenses=  DB::table('Expenses')->where('id',$id)->first();
        $this->member_name =MembersModel::where('membership_number',$expenses->member_number)
            ->selectRaw("CONCAT(first_name,' ',middle_name,'  ',last_name) as name")->value('name');
        $this->source_account=AccountsModel::where('sub_category_code',$expenses->sub_category_code)->value('account_number');
        $this->source_account_name=AccountsModel::where('sub_category_code',$expenses->sub_category_code)->value('account_name');
        $this->account_balance=AccountsModel::where('sub_category_code',$expenses->sub_category_code)->value('balance');
        $this->request_amount=$expenses->amount;
        $this->description=$expenses->notes;

    }

    


    public function showAddExpenseModal($selected)
    {

        $this->selected = $selected;
        $this->showAddExpense = true;
    }

    public function updatedExpense()
    {
        $expenseData = ExpensesModel::where('id', $this->Expense)->get();
        foreach ($expenseData as $expense) {
            $this->vendor = $expense->vendor;
            $this->category = $expense->category;
            $this->amount = $expense->amount;
            $this->paymentMethod = $expense->paymentMethod;
            $this->expenditureAccount = $expense->expenditureAccount;
            $this->destinationAccount = $expense->destinationAccount;
            $this->employeeId = $expense->employeeId;
            $this->departmentId = $expense->departmentId;
            $this->expenseDate = $expense->expenseDate;

            // Perform further operations with the retrieved data as needed
        }
    }

    public function updateExpense(): void
    {
        ExpensesModel::where('id', $this->Expense)->update([
            'vendor' => $this->vendor,
            'category' => $this->category,
            'amount' => $this->amount,
            'paymentMethod' => $this->paymentMethod,
            'expenditureAccount' => $this->expenditureAccount,
            'destinationAccount' => $this->destinationAccount,
            'employeeId' => $this->employeeId,
            'departmentId' => $this->departmentId,
            'expenseDate' => $this->expenseDate,
            'updated_at' => now()
        ]);

        // reset data
        $this->resetData();

        Session::flash('message', 'Expense has been successfully updated!');
        Session::flash('alert-class', 'alert-success');
    }

    public function addExpense()
    {
        $this->validate();

        ExpensesModel::create([
            'vendor' => $this->vendor,
            'category' => $this->category,
            'amount' => $this->amount,
            'paymentMethod' => $this->paymentMethod,
            'expenditureAccount' => $this->expenditureAccount,
            'destinationAccount' => $this->destinationAccount,
            'employeeId' => $this->employeeId,
            'departmentId' => $this->departmentId,
            'expenseDate' => $this->expenseDate,
        ]);

        // reset data
        $this->resetData();

        Session::flash('message', 'A new expense has been successfully created!');
        Session::flash('alert-class', 'alert-success');

        $this->showAddExpense = false;
    }

    public function resetData()
    {
        $this->vendor = '';
        $this->category = '';
        $this->amount = '';
        $this->paymentMethod = '';
        $this->expenditureAccount = '';
        $this->destinationAccount = '';
        $this->employeeId = '';
        $this->departmentId = '';
        $this->expenseDate = '';
    }

    // ... the rest of the methods

    public function sendApproval($id,$msg,$code){

        $user = auth()->user();


        approvals::create([
            'institution' => $id,
            'process_name' => 'createExpense',
            'process_description' => $msg,
            'approval_process_description' => 'has approved a transaction',
            'process_code' => $code,
            'process_id' => $id,
            'process_status' => 'Pending',
            'user_id'  => Auth::user()->id,
            'team_id'  => $id
        ]);

    }


    public function submit()
    {

        $institution_id='';
        $id = auth()->user()->id;
        $currentUser = DB::table('team_user')->where('user_id', $id)->get();
        foreach ($currentUser as $User){
            $institution_id=$User->team_id;
        }

        $this->validate();

        // Execution doesn't reach here if validation fails.

        $id =  ExpensesModel::create([
            'name' => $this->name,
            'region' => $this->region,
            'wilaya' => $this->wilaya,
            'expenseshipNumber' => $this->expenseshipNumber,
            'parentExpense' => $this->parentExpense,
            'institution_id' => $institution_id,
            'Expense_status'  => 'Pending'
        ])->id;

        $user = auth()->user();


        approvals::create([
            'institution' => '',
            'process_name' => 'createExpense',
            'process_description' => 'has created a new Expense',
            'approval_process_description' => 'has approved a new Expense',
            'process_code' => '01',
            'process_id' => $id,
            'process_status' => 'Pending',
            'user_id'  => session()->get('currentUser')->id,
            'team_id'  => ""
        ]);



        $this->resetData();

        Session::flash('message', 'A new Expense has been successfully created!');
        Session::flash('alert-class', 'alert-success');
    }




    public function menuItemClicked($tabId){
        $this->tab_id = $tabId;
        if($tabId == '1'){
            $this->title = 'Expenses list';
        }
        if($tabId == '2'){
            $this->title = 'Enter new Expense details';
        }
    }


    public function createNewExpense()
    {


        $this->showCreateNewExpense = true;
    }

    public function approveExpenseModal($id)
    {
        $this->desplayExpensesData($id);
        $this->approveExpenses = true;
        $this->ExpenseSelected = $id;
    }

    public function editExpenseModal($id)
    {
        $this->showEditExpense = true;
        $this->pendingExpense = $id;
        $this->Expense = $id;
        $this->pendingExpensename = ExpensesModel::where('id',$id)->value('first_name');
        $this->updatedExpense();

    }

    public function closeModal(){
        $this->showCreateNewExpense = false;
        $this->showDeleteExpense = false;
        $this->showEditExpense = false;
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
//        $this->categories  = ExpensesCategory::get();
        $this->expenditureAccounts = AccountsModel::where('product_number', '10')->get();
        return view('livewire.accounting.expenses');
    }
}
