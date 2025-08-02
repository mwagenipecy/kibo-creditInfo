<?php

namespace App\Http\Livewire\HR;

use App\Mail\EmployeeRegisterMail;
use App\Models\BranchesModel;
use App\Models\Employee;
use App\Models\LeaveManagement;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class NewEmployee extends Component
{
    use WithFileUploads;

    public $photo;

    public $branch_id;

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

    public $removeEmployeeRegistrationForm;

    public function removeEmployeeRegistrationForm()
    {
        $this->emitUp('closeEmployeeModal');
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);
    }

    public function save()
    {

        //        dd($this->all());

        $imageUrl = '';

        $this->validate([
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'Employment_type' => 'required|min:3',
            'phone_number' => 'required|min:3',
            'date_of_birth' => 'required|min:3',
            'gender' => 'required|min:2',
            'marital_status' => 'required|min:3',
            'place_of_birth' => 'required|min:3',
            'street' => 'required|min:3',
            'address' => 'required|min:3',
            //                'notes' => 'required|min:3',
            'email' => 'required|min:1',
            'next_of_kin_name' => 'required|min:3',
            'next_of_kin_phone' => 'required|min:3',
            'tin_number' => 'required|min:3',
            'nida_number' => 'required|min:3',
            'branch_id' => 'required',
            'gross_salary' => 'required|numeric',

        ]);

        if ($this->photo) {
            $imageUrl = $this->photo->store('avatars', 'public');
        }

        $last_member = Employee::latest()->first();
        if ($last_member) {
            $last_member_id = $last_member->id;
            $last_member_id = $last_member_id + 1;
            $newMemberId = $this->branch_id.str_pad($last_member_id, 5, '0', STR_PAD_LEFT);

        } else {
            $last_member_id = 0;
            $last_member_id = $last_member_id + 1;
            $newMemberId = $this->branch_id.str_pad($last_member_id, 5, '0', STR_PAD_LEFT);

        }

        $id = Employee::create([
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'branch' => $this->branch_id,
            'email' => $this->email,
            'phone' => $this->phone_number,
            'job_title' => $this->job_title,
            'department' => $this->department,
            'salary' => $this->gross_salary,
            'contribution' => $this->contributions,
            'taxes' => $this->taxes,
            'benefits' => $this->benefits,
            'Employment_type' => $this->Employment_type,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'marital_status' => $this->marital_status,
            'employee_number' => $newMemberId,
            'employee_status' => 'PENDING',
            'street' => $this->street,
            'address' => $this->address,
            'notes' => $this->notes,
            'profile_photo_path' => $imageUrl,
            'registering_officer' => auth()->user()->id,
            'place_of_birth' => $this->place_of_birth,
            'next_of_kin_name' => $this->next_of_kin_name,
            'next_of_kin_phone' => $this->next_of_kin_phone,
            'tin_number' => $this->tin_number,
            'nida_number' => $this->nida_number,
            'institution_id' => auth()->user()->institution_id,

        ])->id;

        // instance to create leave of employee
        $leave_management = new LeaveManagement;
        $leave_management->employeeLeave($newMemberId);
        // create user login data
        $users = new User;

        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password = substr(str_shuffle($characters), 0, 10);

        $users->registerUser($this->email, $this->department, $this->first_name, $id, $this->branch_id, $password);

        // send email notification

        $employeeId = auth()->user()->employeeId;
        $user_email = $this->email;
        $name = $this->first_name;

        Mail::to($this->email)->send(new EmployeeRegisterMail($employeeId, $user_email, $name, $password));

        $this->resetData();

        // success session
        Session::flash('message', 'A new Employee has been successfully created!');
        Session::flash('alert-class', 'alert-success');
        sleep(2);
        $this->removeEmployeeRegistrationForm();
    }

    public function resetData()
    {

        $this->first_name = null;

        $this->middle_name = null;

        $this->last_name = null;

        $this->email = null;
        $this->department = null;

        $this->phone_number = null;

        $this->branch_id = null;

        $this->gross_salary = null;

        $this->Employment_type = null;
        $this->date_of_birth = null;
        $this->gender = null;
        $this->marital_status = null;

        $this->street = null;
        $this->address = null;
        $this->notes = null;

        $this->place_of_birth = null;
        $this->next_of_kin_name = null;
        $this->next_of_kin_phone = null;
        $this->tin_number = null;
        $this->nida_number = null;

        $this->photo = null;

    }

    public function back()
    {

        Session::put('memberNameInView', '');
        Session::put('memberIdInView', '');
        Session::put('showAddMember', false);
        $this->emit('refreshMembersListComponent');
    }

    public function render()
    {
        $this->branches = BranchesModel::all();

        return view('livewire.h-r.new-employee');
    }
}
