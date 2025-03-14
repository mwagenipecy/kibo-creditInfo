<?php

namespace App\Http\Livewire\ProfileSetting;

use App\Models\approvals;
use App\Models\institutions;
use App\Models\InstitutionsList;
use App\Models\TeamUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OrganizationSetting extends Component
{

    public $registration_fees;
    public $allocated_shares;
    public $available_shares;
    public $institution_name;
    public $region;
    public $wilaya;
    public $settings_status;
    public $min_shares;
    public $value_per_share;
    public $email;
    public $phone_number;
    public $inactivity;
    public $repayment_frequency;
    public $notes;

    public institutions $institution;


    protected $rules=
                     ['registration_fees'=>'required|numeric',
                       'available_shares'=>'required|numeric',
                         'region'=>'required',
                         'wilaya'=>'required',
                         'min_shares'=>'required',
                         'inactivity'=>'required',
                         'allocated_shares'=>'required|numeric',
                         'institution_name'=>'required|string',
                         ];


    public function institutionSetting(){
        $this->validate();
        // get institution id
        $institution_id=1;

//        DB::table('institutions')->insert([
//            'name'=>$this->institution_name,
//            'registration_fees'=>$this->registration_fees,
//                'available_shares'=>$this->available_shares,
//                'region'=>$this->region,
//                'wilaya'=>$this->wilaya,
//                'min_shares'=>$this->min_shares,
//                'inactivity'=>$this->inactivity,
//                'allocated_shares'=>$this->allocated_shares,
//            ]
//        );
        // send for approval to update


        $institution = TeamUser::where('user_id',Auth::user()->id)->value('institution');
        approvals::create([
            'institution' => 1,
            'process_name' => "editOrganizationSetting",
            'process_description' =>'organization settings are edited',
            'approval_process_description' => "edit organization settings",
            'process_code' => '102',
            'process_id' => $institution_id,
            'process_status' => 'Pending',
            'user_id'  => Auth::user()->id,
            'team_id'  => "",
            'edit_package'=>json_encode($this->all()),
        ]);

        session()->flash('message','Awaiting for approval');


    }

    public function boot(){
        $institutionValues=  DB::table('institutions')->where('id',1)->get();
        $institutionValues->name=$this->institution_name;
        $institutionValues->wilaya=$this->wilaya;
        $institutionValues->region=$this->region;
        $institutionValues->registration_fees=$this->registration_fees;


    }


    public function render()
    {

        return view('livewire.profile-setting.organization-setting');
    }
}
