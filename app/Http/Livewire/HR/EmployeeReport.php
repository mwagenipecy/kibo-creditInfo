<?php

namespace App\Http\Livewire\HR;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Employeefiles;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class EmployeeReport extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $employeeN;
    public $creds1;
    public $creds2;

    public $docName;
    public $employeeFile;
    public $path;
    public $search;
    public $downloads;
    protected $rules = [
        'employeeN'=>'required|int',
        'docName'=>'required',
        'employeeFile'=>'required|file|mimes:pdf,doc,xlsx,docx|max:4112'
    ];

    public function addDocDetails(){
        $this->validate();
        $this->path = $this->employeeFile->store('employeeFiles');
        $this->creds1 = Employee::where('id',$this->employeeN)->value('first_name');
        $this->creds2 = Employee::where('id',$this->employeeN)->value('last_name');


        Employeefiles::create([
            'employeeN'=>$this->employeeN,
            'docName'=>$this->docName,
            'empName'=> $this->creds1.' '.$this->creds2,
            'path'=>$this->path
        ]);

        session()->flash('status','File Uploaded Successfully');
        $this->reset('employeeN','docName','employeeFile');

    }

    public function downloadFile(Employeefiles $employeefiles){
        if(Storage::disk('local')->exists($employeefiles->path)){
            session()->flash('status','File is downloading');
            return Storage::download($employeefiles->path, $employeefiles->docName);
        }
        session()->flash('status','File not found');
    }

    public function render()
    {
        $getEmployees = Employee::all();
        $getEmployeeFiles = Employeefiles::all();
        return view('livewire.h-r.employee-report',[
            'employees'=>$getEmployees,
            'empFiles'=>$getEmployeeFiles
        ]);
    }
}
