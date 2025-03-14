<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class approvals extends Model
     {
    use HasFactory;
    protected $guarded = [];
    protected $table='approvals';


    public function sendApproval($id,$description,$msg,$aprroval_process_description,$code,$edit_package){

       
        approvals::create([
            'institution' => auth()->user()->institution_id,
            'process_name' => $description,
            'process_description' => $msg,
            'approval_process_description' => $aprroval_process_description,
            'process_code' => $code,
            'process_id' => $id,
            'process_status' => 'PENDING',
            'user_id'  => Auth::user()->id,
            'team_id'  => "",
             'edit_package'=>$edit_package,
        ]);

    }


}
