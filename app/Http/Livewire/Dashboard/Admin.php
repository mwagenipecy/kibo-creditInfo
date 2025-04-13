<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\CarDealer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Admin extends Component
{


    public $user=[],$carDealer=[],$lender=[],$application=[],$notificationDummyData=[];

    public function loadData(){

        $this->user=User::count();
        $this->carDealer=CarDealer::count();

        
        $this->lender=DB::table('lenders')->count();
        $this->application=DB::table('applications')->where('application_status','ACCEPTED')->count();
        $this->notificationDummyData= DB::table('activity_logs')->get();



    }


    public function render()
    {

        $this->loadData();
        return view('livewire.dashboard.admin');
    }
}
