<?php

namespace App\Http\Livewire\HR;

use App\Http\Livewire\Settings\DepartmentList;
use App\Models\approvals;
use App\Models\Employee;
use App\Models\LeaveManagement;
use App\Models\User;
use Faker\Core\DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class HR extends Component
{

    public $leave_register=false;
    public $tab_id = '1';
    public $title  = 'Savings report';
    public $employesRegisterModel=false;
    public $registerFiscalPolicy= false;
    public $viewMemberDitails=false;
    public $editEmployeeStatus=false;

    public $leave_type;
    public $start_date;
    public $end_date;
    public $leave_description;

    //class field for edit and delete sub class modal
    public $permission;
    public $password;
    public $department_name;
    public $openEditDepartmentModal=false;
    public $deleteDepartmentModal=false;
    public $sub_menu_id=1;
    public $deleteEmployeeModal=false;


    public $photo;
    public $branch;
    public $Employment_type = 'Permanent';
    public $first_name;
    public $middle_name;
    public $last_name;
    public $street;
    public $address;
    public $notes;
    public $next_of_kin_name;
    public $next_of_kin_phone;
    public $email;
    public $date_of_birth;
    public $gender;
    public $marital_status;
    public $place_of_birth;
    public $tin_number;
    public $nida_number;
    public $phone_number;
    public $gross_salary;
    public $department;

    public $taxes;
    public $benefits;
    public $contributions;
    public $branches;
    public $job_title;
    public $employeeId;




    protected $rules=['leave_type'=>'required',
        'start_date'=>'required',
        'end_date'=>'required',
    ];

    protected $listeners=['leave_register_modal'=>'register_modal','departmentModalClose'=> 'departmentModal'
        ,'viewMemberDetailsForm'=>'viewMemberDetails',
        'editEmployeeModal'=>'editEmployeeStatus',
        'deleteDepartment'=>'departmentDelete',
        'editDepartment'=>'departmentEdit',
        'closeEmployeeModal'=>'closeNewEmployeeModal',
        'returnHome'=>'homeButton',
        'deleteEmployee'=>'deleteEmployeeModal'

    ];


    public function deleteEmployeeModal($id){

        session()->put('deleteEmployeeModal',$id);
        $this->deleteEmployeeModal=true;



    }

    public function employeeAction(){

        $approval=new approvals();
        $approval->sendApproval(session()->get('deleteEmployeeModal'),$this->permission.'Employee',
            session()->get('currentUser')->name.' has '.$this->permission.' employee  '.  DB::table('employees')
                ->where('id',session()->get('deleteEmployeeModal'))->value('first_name'),
            ' delete employee','102','');

        session()->flash('message','awaiting for approval');

    }

    public function editDepartment(){
        $this->validate(['department_name'=>'required']);
        try {
            DepartmentList::where('id', session()->get('departmentIdForEditing'))->update(['department_name' => $this->department_name]);

            // send for the approvals
            $apprpvals=new approvals();
            $apprpvals->sendApproval(session()->get('departmentIdForEditing')," Update$this->department_name ","has updated $this->department_name department","has update $this->department_name department","102",'','');

            session()->flash('message', "Updated successfully");
        }
        catch (\Exception $e){
            session()->flash('message_fail',"Fail to update");
        }
    }

    public function homeButton(){
        $this->sub_menu_id=1;
    }

    public function departmentAction(){

        $this->validate(['password'=>'required']);
        $status='';
        // get the previous status
        $checkPassword=Hash::check($this->password,auth()->user()->password);
        if($checkPassword){
            $department=DB::table('departments')->where('id',session()->get('departmentIdToAction'))->first();
            $prev_status=$department->status;
            if($this->permission==$prev_status){
                session()->flash('message_fail',"You cannot $this->permission twice");
            }
            else{
                DB::table('departments')->where('id',session()->get('departmentIdToAction'))->update([ 'status'=>$this->permission]);

                // send for the approvals
                $apprpvals=new approvals();
                $apprpvals->sendApproval($department->id,"$this->permission Department","has $this->permission department","has to $this->permission department","102",'');
                session()->flash('message',"Successfully $this->permission");
            }
        }
        else{
            session()->flash('message_fail',"password  mismatch");

        }
    }

    //  department delete
    public function departmentDelete($id){
        if($this->deleteDepartmentModal==false){
            session()->put('departmentIdToAction',$id);
            $this->password=null;
            $this->deleteDepartmentModal=true;
        }
        else if($this->deleteDepartmentModal==true){
            $this->deleteDepartmentModal=false;
            session()->forget('departmentIdToAction');
        }
    }

    //open department edit modal
    public function departmentEdit(){
        if($this->openEditDepartmentModal==false){
            $this->openEditDepartmentModal=true;

            $this->department_name=DB::table('departments')->where('id',session()->get('departmentIdForEditing'))->value('department_name');
        }
        else if($this->openEditDepartmentModal==true){
            $this->openEditDepartmentModal=false;
        }
    }
    // edn of department modal



    public function closeModal(){
        session()->forget('employee_number');
        $this->registerFiscalPolicy=false;
    }

    public function editEmployeeStatus($id){

        $this->sub_menu_id=2;
        $this->employeeId=$id;

        $employee=Employee::where('id',$id)->first();

        $this->photo=$employee->photo;
        $this->branch=$employee->branch;
        $this->Employment_type=$employee->Employment_type;
        $this->first_name=$employee->first_name;
        $this->middle_name=$employee->middle_name;
        $this->last_name=$employee->last_name;
        $this->street=$employee->street;
        $this->address=$employee->address;
        $this->notes=$employee->notes;
        $this->next_of_kin_name=$employee->next_of_kin_name;
         $this->next_of_kin_phone=$employee->next_of_kin_name;
         $this->email=$employee->email;
         $this->date_of_birth=$employee->date_of_birth;
         $this->gender=$employee->gender;
         $this->marital_status=$employee->marital_status;
         $this->place_of_birth=$employee->place_of_birth;
         $this->tin_number=$employee->tin_number;
         $this->nida_number=$employee->nida_number;
         $this->phone_number=$employee->phone;
         $this->gross_salary=$employee->gross_salary;
         $this->department=$employee->department;
         $this->taxes=$employee->taxes;
         $this->benefits=$employee->benefits;
         $this->contributions=$employee->contributions;
         $this->branches=$employee->branches;
         $this->job_title=$employee->job_title;

    }



    public function editEmployeeData(){

        $id=$this->employeeId;
        Employee::where('id',$id)->update([
            'profile_photo_path' =>$this->photo,
              'branch'=> $this->branch,
          'Employment_type'=> $this->Employment_type,
          'first_name'=> $this->first_name,
          'middle_name'=> $this->middle_name,
          'last_name'=> $this->last_name,
           'street'=>  $this->street,
          'address'=> $this->address,
          'notes'=> $this->notes,
          'next_of_kin_name'=>$this->next_of_kin_name,
        'email'=> $this->email,
         'date_of_birth'=> $this->date_of_birth,
        'gender'=> $this->gender,
        'marital_status'=> $this->marital_status,
         'place_of_birth'=> $this->place_of_birth,
         'tin_number'=>  $this->tin_number,
        'nida_number'=> $this->nida_number,
         'phone'=> $this->phone_number,
         'salary'=>$this->gross_salary,
         'department'=>  $this->department,
          'taxes'=> $this->taxes,
            'benefits'=>$this->benefits,
        'contribution'=> $this->contributions,
         'job_title'=> $this->job_title


        ]);

        User::where('employeeId',$id)->update([
            'name'=>$this->first_name,
            'email'=>$this->email,
            'phone_number'=>$this->phone_number,
            'department'=>$this->department,
            'branch'=>$this->branch,
        ]);




   session()->flash('message','updated successfully');

   sleep(3);
        $this->homeButton();
    }




    public function resetLeaveData(){
        $this->end_date=null;
        $this->leave_type=null;
        $this->leave_description=null;
        $this->start_date=null;
    }

    public function closeNewEmployeeModal(){
        $this->sub_menu_id=1;
    }



    public function menuItemClicked($tabId){



        session()->forget('memberToViewId');
        $this->tab_id = $tabId;
        if($tabId == '1'){
            $this->title = 'Employee report';
        }else
            if($tabId == '2'){
                $this->title = 'Enter new employee details';
            }else
                if($tabId == '3'){
                    $this->title = 'Department Details';
                }else
                    if($tabId=='30'){
                        $this->tab_id='3';
                        $this->employesRegisterModel=True;
                        $this->title="Register New department";
                    }else

                        if($this->tab_id=='10'){
                            $this->tab_id='1';
                            $this->sub_menu_id=4;
                            $this->title="Register New Member";
                        }


                        else if($this->tab_id=='4'){
                            $this->title="Pay Roll";
                        }
                        else if($this->tab_id=='6'){
                            $this->title="Fiscal Policy";
                        }
                        else if($this->tab_id=='60'){
                            $this->tab_id=6;
                            $this->emit('fiscalModalTurnOn_Off');

                        }
                        else if($this->tab_id=='5'){
                            $this->title='Leave';
                        }
                        else if($this->tab_id=='50'){
                            $this->tab_id=5;
                        }
                        else if($this->tab_id=="7"){
                            $this->title="Employee Report";
                        }
    }

    // clode department modal
    public function departmentModal(){
        $this->employesRegisterModel=false;
    }

    public function viewMemberDetails(){
        $this->sub_menu_id=3;
    }




    public function register_modal(){
        if($this->leave_register==false){
            $this->leave_register=true;
        }
        else if($this->leave_register==true){
            $this->leave_register=false;
        }
    }


    public function render()
    {
        return view('livewire.h-r.h-r');
    }



    public function assignLeave(){
        $this->validate();
        $id=  \App\Models\Leave::create([
            'leave_type'=>$this->leave_type,
            'start_date'=>$this->start_date,
            'end_date'=>$this->end_date,
            'description'=>$this->leave_description,
            'employee_id'=>session()->get('employee_number_id'),
        ])->id;

        //  calculate days requested
        $startDateTime = Carbon::parse($this->start_date);
        $endDateTime = Carbon::parse($this->end_date);
        $daysrequested=$startDateTime->diffInDays($endDateTime);

        // calculate days taken before
        $days_taken=LeaveManagement::where('employee_number',session()->get('employee_number_id'))->value('leave_days_taken');

        // new total days requested
        $new_data_taken=$days_taken+$daysrequested;

        // get days balance
        $new_day_balance=28-$new_data_taken;

        LeaveManagement::where('employee_number',session()->get('employee_number_id'))->update([
            'leave_days_taken'=>$new_data_taken,
            'balance'=>$new_day_balance,
        ]);

        $approval=new approvals();
        $approval->sendApproval($id,'assignLeave','assign new leave','has assigned new leave','10','');
        session()->flash('message',"Has been assigned successfully");
        $this->resetLeaveData();
    }
}
