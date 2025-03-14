<?php

namespace App\Http\Livewire\Accounting;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\AccountsModel;
use App\Models\Members;
use App\Models\Branches;
use App\Models\Banks;
use Illuminate\Support\Facades\Session;


use App\Models\approvals;
use App\Models\TeamUser;
use Illuminate\Support\Facades\Auth;

class ExternalAccounts extends Component
{


    public $mirror_account;
    public $account_number;
    public $number_of_shares;
    public $bank;
    public $balance;
    public $nominal_price;
    public $branches;
    public $member;



    public function save()
    {

        $id = AccountsModel::create([
            'account_use' => 'external',
            'institution_number' => $this->bank,
            'branch_number' => '',
            'member_number' => '',
            'product_number' => '9',
            'sub_product_number' => '91',
            'account_name' => Banks::where('bank_number', $this->bank)->value('bank_name'),
            'account_number' => $this->account_number,
            'mirror_account' => $this->mirror_account,

        ])->id;


        $user = auth()->user();



        approvals::create([
            'institution' => auth()->user()->institution_id,
            'process_name' => 'createAccount',
            'process_description' => 'has added a new account',
            'approval_process_description' => 'has approved a new account',
            'process_code' => '04',
            'process_id' => $id,
            'process_status' => 'Pending',
            'user_id'  => Auth::user()->id,
            'team_id'  => ""
        ]);


        $this->resetData();

        Session::flash('message', 'Shares has been successfully issued!');
        Session::flash('alert-class', 'alert-success');
    }

    public function resetData()
    {
        $this->bank = '';
        $this->account_number = '';

    }

    public function render()
    {
        $this->branches = AccountsModel::where('sub_product_number', '19')->get();
        return view('livewire.accounting.external-accounts');
    }
}
