<?php

namespace App\Http\Livewire\Accounting;

use App\Models\Members;
use App\Models\LoansModel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class LoansDisbursement extends Component
{

    protected $listeners = ['currentloanID' => '$refresh',
        'viewMemberDetails'=>'memberDetails',
    ];
    public  $viewMemberDetail=false;
    public $member;
    public $loan_id;





    public function close(){
        $this->viewMemberDetail=false;
        Session::put('currentloanID',null);
        Session::put('currentloanMember',null);
    }


    public function memberDetails(){
        $this->viewMemberDetail=True;
    }



    public function render()
    {
        $this->loan_id = Session::get('currentloanID');
        $this->member = LoansModel::where('loan_id',Session::get('currentloanID'))->get();


        return view('livewire.accounting.loans-disbursement');
    }

    public  function showModal(){

        return true;
    }
}
