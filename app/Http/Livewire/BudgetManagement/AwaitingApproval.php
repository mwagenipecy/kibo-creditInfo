<?php

namespace App\Http\Livewire\BudgetManagement;

use App\Models\approvals;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AwaitingApproval extends Component
{

    public $pending_budget;


    public function mount(){
        $this->pending_budget=DB::table('main_budget_pending')->where('year',Carbon::now()->year)->get();

    }

    public function declineBudget($id){
        DB::table('main_budget_pending')->where('id',$id)->delete();
       session()->flash('message','successfully');
        $this->mount();

    }

    public function approveBudget($id){
        $data=DB::table('main_budget_pending')->where('id',$id)->first();


        $new_data=[
            'january' =>$data->january,
            'february'=> $data->february,
            'march'=> $data->march,
            'april'=>$data->april,
            'may'=> $data->may,
            'june'=>$data->june,
            'july'=> $data->july,
            'august' =>$data->august,
            'september'=>$data->september,
            'october'=> $data->october,
            'november'=> $data->november,
            'december'=> $data->december,

        ];

        $total= array_sum($new_data);
        DB::table('main_budget')->where('id',$data->budget_id)->update($new_data);
        DB::table('main_budget')->where('id',$data->budget_id)->update(['total'=>$total]);

        session()->flash('message','successfully');
        DB::table('main_budget_pending')->where('id',$id)->delete();

        $this->mount();

            }

    public function render()
    {
        return view('livewire.budget-management.awaiting-approval');
    }


    public function approveAll(){
        // get all id from the pending table where status == pending,
        $pluckId=DB::table('main_budget_pending')->pluck('budget_id');

        foreach ($pluckId as $id){
          $data=   DB::table('main_budget_pending')->where('budget_id',$id)->first();
            $value=[
                'january' =>$data->january,
                'february'=> $data->february,
                'march'=> $data->march,
                'april'=>$data->april,
                'may'=> $data->may,
                'june'=>$data->june,
                'july'=> $data->july,
                'august' =>$data->august,
                'september'=>$data->september,
                'october'=> $data->october,
                'november'=> $data->november,
                'december'=> $data->december,
                'total'=> $data->total,

            ];
            DB::table('main_budget')->where('id',$id)->update($value);
            session()->flash('message',"successfully");
            DB::table('main_budget_pending')->where('budget_id',$id)->delete();

        }
        $this->mount();



    }
}
