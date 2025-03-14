<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\ClientsModel;
use App\Jobs\EndOfDay;
use App\Models\LoansModel;
use Carbon\Carbon;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class LoanPromises extends Component
{
    public $currentLoans;
    public $especialLoans;
    public $substandard;
    public $doubtful;
    public $loss;


    public function runJob(){
        EndOfDay::dispatch();
    }

    public function boot(){
        // for current loan take all loans with less than five days in arrears;
      $this->currentLoans=[];

        $this->currentLoans['count'] =  LoansModel::where('days_in_arrears','<',5)->count();
        $this->currentLoans['amount']=LoansModel::where('days_in_arrears','<',5)->sum('arrears_in_amount');
       // $this->currentLoans['reserved']=LoansModel::where('days_in_arrears','<',5)->sum('principle');


      $this->especialLoans=[];
        $this->especialLoans['count'] = LoansModel::whereBetween('days_in_arrears',[5,30])->count();
        $this->especialLoans['amount'] = LoansModel::whereBetween('days_in_arrears',[5,30])->sum('arrears_in_amount');
       // $this->especialLoans['count'] = LoansModel::whereBetween('days_in_arrears',[5,30])->count();


        $this->substandard=[];

        $this->substandard['count']=  LoansModel::whereBetween('days_in_arrears',[30,60])->count();
        $this->substandard['amount']=  LoansModel::whereBetween('days_in_arrears',[30,60])->sum('arrears_in_amount');
      //  $this->substandard['reserve']=  LoansModel::whereBetween('days_in_arrears',[30,60])->sum('arrears_in_amount');


      $this->doubtful=[];
        $this->doubtful['count']=LoansModel::whereBetween('days_in_arrears',[60,90])->count();
        $this->doubtful['amount']=LoansModel::whereBetween('days_in_arrears',[60,90])->sum('arrears_in_amount');
       // $this->doubtful['count']=LoansModel::whereBetween('days_in_arrears',[60,90])->count();

      $this->loss=[];
        $this->loss['count']=LoansModel::where('days_in_arrears','>',90)->count();
        $this->loss['amount']=LoansModel::where('days_in_arrears','>',90)->sum('arrears_in_amount');
        //$this->loss['count']=LoansModel::where('days_in_arrears','>',90)->count();
    }


    public function render(){
        return view('livewire.dashboard.loan-promises');
    }

}
