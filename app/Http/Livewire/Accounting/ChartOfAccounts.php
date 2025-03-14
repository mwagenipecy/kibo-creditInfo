<?php

namespace App\Http\Livewire\Accounting;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;
use App\Models\AccountsModel;
use App\Models\sub_products;
use Illuminate\Support\Facades\Session;

use App\Models\approvals;
use App\Models\TeamUser;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Random;


class ChartOfAccounts extends Component
{

    public $term = "";
    public $showAddUser = false;
    public $memberStatus = 'All';
    public $numberOfProducts;
    public $products;
    public $item;
    public $category;
    public $account_name;
    public $notes;
    public $account_number;
    public $createNewAccount;



    // new
    public $sub_category_name;
    public $account_code;


    protected $rules = [
        'account_number' => 'required|min:9',
//        'notes' => 'required|min:5',
        'account_name' => 'required|min:5',
        'category' => 'required|min:1',
    ];






    protected $listeners = ['refreshChartOfAccountsComponent' => '$refresh'];

    public function visit($item)
    {

        Session::put('savingsViewItem', $item);
        $this->item = $item;
        $this->emit('refreshSavingsComponent');
    }



    


    public function render()
    {
        $query = sub_products::where('product_id', 12);
        $this->products = $query->get();
        $this->numberOfProducts = $query->count();
        if($this->notes && $this->account_name && $this->category){
            $this->account_number = $this->category.'11110'.rand(0000,9999);
        }


        return view('livewire.accounting.chart-of-accounts');
    }


    public function save()
    {

//        $this->validate();

        $user = auth()->user();

        $team = $user->currentTeam;

        $category_code=DB::table($this->sub_category_name)->value('category_code');

        $category_code=substr($category_code,0,2);
        $category_code=$category_code.''.rand(00,99);



        $plug_category_code=DB::table($this->sub_category_name)->pluck('sub_category_code');
        $category_code='5400';
        $plug_category_code=['5400','5433'];
        foreach ($plug_category_code as $code){
            if($code==$category_code){
                continue;
            }
            else{
                break;
            }
        }

        $table_name=DB::table('GL_accounts')->where('id',$this->category)->value('account_name');
        $table_name=strtolower($table_name);
        $table_name=str_replace($table_name,' ','_');

        $GN_account_code=DB::table('GL_accounts')->where('id',$this->category)->value('account_code');
        $account_id=DB::table('GL_accounts')->where('id',$this->category)->value('id');





//        $sub_category_code=DB::table()->pluck
//
//        if (Schema::hasTable($table_name)) {
//
//        }
//        else {
//
//            Schema::create($table_name, function ($table) {
//                $table->increments('id');
//                $table->string('gl_account_id')->nullable();
//                $table->string('account_code')->nullable();
//                $table->string('name')->nullable();
//
//                $table->dateTime('updated_at')->nullable();
//                $table->dateTime('created_at')->nullable();
//            });
//
//        }
//
//            $id = DB::table($table_name)->insert(['gl_account_id' => $account_id, 'account_code' => $GN_account_code, 'name' => $this->sub_category_name]);
//
//        if (Schema::hasTable($this->sub_category_name)) {
//
//
//        } else {
//            Schema::create($this->sub_category_name, function ($table) {
//                $table->increments('id');
//                $table->string('name')->nullable();
//                $table->string('expenses_account_code')->nullable();
//                $table->string('account_code')->nullable();
//                $table->dateTime('updated_at')->nullable();
//                $table->dateTime('created_at')->nullable();
//            });
//        }



        $id = DB::table($this->sub_category_name)->insert(['expenses_account_code' => $GN_account_code, 'account_code' => $this->account_code, 'name' => $this->account_name]);


        $id = AccountsModel::create([
            'account_use' => 'internal',
            'institution_number' => auth()->user()->institution_id,
            'branch_number' => auth()->user()->branch,
            'member_number' => '0000',
            'major_category_code' => $GN_account_code,
            'category_code'=>$this->category_code,
            'sub_category_code' => $this->account_code,
            'account_name' => $this->account_name,
            'account_number' => str_pad(auth()->user()->institution_id, 2, 0, STR_PAD_LEFT) . '' . str_pad(auth()->user()->branch, 2, 0, STR_PAD_LEFT) . '0000'.$this->account_code,
            'notes' => "  ",

        ])->id;


//        approvals::create([
//            'institution' => $institution,
//            'process_name' => 'createAccount',
//            'process_description' => 'has added a new account',
//            'approval_process_description' => 'has approved a new account',
//            'process_code' => '04',
//            'process_id' => $id,
//            'process_status' => 'Pending',
//            'user_id'  => Auth::user()->id,
//            'team_id'  => ''
//        ]);


        $this->resetData();

        Session::flash('message', 'Account has been successfully saved!');
        Session::flash('alert-class', 'alert-success');

        $this->createNewAccount = false;
    }


    public function resetData()
    {
        $this->category = '';
        $this->account_name = '';
        $this->account_number = '';

    }

    public function back()
    {

        Session::put('memberNameInView', '');
        Session::put('memberIdInView', '');
        Session::put('showAddMember', false);
        $this->emit('refreshMembersListComponent');
    }

    public function setAccount($account){
        $this->accountSelected = $account;
    }

    public function showDiv(){
        $this->createNewAccount = true;
    }


}
