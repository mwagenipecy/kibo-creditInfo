<?php

namespace App\Http\Livewire\HR;

use App\Models\approvals;
use App\Models\Employee;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditEmployee extends Component
{
    use WithFileUploads;

    public $photo;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $branch;
    public $branches;
    public $registering_officer;
    public $supervising_officer;
    public $approving_officer;
    public $membership_type = 'Individual';
    public $incorporation_number;
    public $phone_number;
    public $mobile_phone_number;
    public $email;
    public $date_of_birth;
    public $gender;
    public $marital_status;
    public $membership_number;
    public $registration_date;
    public $street;
    public $address;
    public $notes;
    public $current_team_id;
    public $profile_photo_path;
    public $branch_id;
    public $business_name;
    public $sub_product_number_shares ='1199';
    public $sub_product_number_savings='1279';
    public $sub_product_number_deposits='1321';
    public $place_of_birth;
    public $next_of_kin_name;
    public $next_of_kin_phone;
    public $tin_number;
    public $nida_number;
    public $ref_number;
    public $department;
    public $shares_ref_number;
    public Employee $employee;
    public $contributions;
    public $gross_salary;
    public $benefits;
    public $Employment_type;
    public $taxes;
    public $job_title;

    protected $listeners=['editEmployeeModal'=>'editModal'];

    protected $rules=[
        'employee.first_name'=>'required',
        'employee.middle_name'=>'required',
        'employee.last_name'=>'required',
        'employee.branch'=>'required',
        'employee.phone_number'=>'required',

    ];



    public function editData(){

        $employee =Employee::where('id',session()->get('employeeIdForEdit'))->get();
//         $this->photo=$employee->photo;
//         $this->first_name=$employee->first_name;
//             $this->middle_name=$employee->middle_name;
//                 $this->last_name=$employee->last_name;
//                     $this->branch=$employee->branch;
    }

    public function back(){
        $this->emitUp('returnHome');
    }




    public function editModal(){




        session()->get('employeeIdForEdit');
        //

    }





    public function edit(){
        Employee::where('id',session()->get('employeeIdForEdit'))->update([
            'first_name'=> $this->first_name,
            'middle_name'=> $this->middle_name,
            'last_name'=> $this->last_name,
            'branch'=> $this->branch,
            'email'=> $this->email,
            'phone'=> $this->phone_number,
            'department'=> $this->department,
            'salary'=> $this->gross_salary,
            'contribution'=>$this->contributions,
            'taxes'=>$this->taxes,
            'benefits'=>$this->benefits,
            'Employment_type'=> $this->Employment_type,
            'date_of_birth'=> $this->date_of_birth,
            'gender'=> $this->gender,
            'marital_status'=> $this->marital_status,
            'employee_status'=>'PENDING',
            'street'=> $this->street,
            'address' => $this->address,
            'notes' => $this->notes,
            'place_of_birth' => $this->place_of_birth,
            'next_of_kin_name'=> $this->next_of_kin_name,
            'next_of_kin_phone'=> $this->next_of_kin_phone,
            'tin_number'=> $this->tin_number,
            'nida_number' => $this->nida_number,
            'job_title'=>$this->job_title,
        ]);



        session()->flash('message','successfully saved');

        $approval=new approvals();
        $approval->sendApproval(session()->get('employeeIdForEdit'),'editEmployee',session()->get('currentUser')->name.' has edit employee','has edited employee','102','');



    }


    public function resetData(){
        $this->nida_number='';
        $this->tin_number='';
        $this->next_of_kin_phone='';
        $this->first_name='';
    }



    public function render()
    {

        $this->editData();
        return view('livewire.h-r.edit-employee');
    }
}
