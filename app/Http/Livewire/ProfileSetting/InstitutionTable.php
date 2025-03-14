<?php

namespace App\Http\Livewire\ProfileSetting;

use App\Http\Livewire\Branches\Branches;
use App\Http\Livewire\Settings\DepartmentList;
use App\Mail\InstitutionRegistrationConfirmationMail;
use App\Models\Branch;
use App\Models\BranchesModel;
use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class InstitutionTable extends LivewireDatatable
{

    public $exportable=true;
    public function builder()
    {
        return  Application::query();
    }



    public function columns(): array
    {
        return [

            Column::name('first_name')
                ->label('first_name')->searchable(),
            Column::name('middle_name')
                ->label('middle_name')->searchable(),
            Column::name('last_name')
                ->label('last_name')->searchable(),
            Column::name('phone_number')
                ->label('phone_number')->searchable(),
            Column::name('loan_amount')
                ->label('loan_amount'),
            Column::name('application_status')->label('application_status'),
            Column::callback('loan_id',function($id){
                 return '<div class="flex items-center space-x-4 flex-lg-row">
                                 
                             <svg xmlns="http://www.w3.org/2000/svg" wire:click="view('.$id.')"  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
    
                         </div>';
             })->label('View'),



            ];
    }



    public function view($id){
        $this->emit('showApplication', $id);
    }

    public function download2($id){
        $get_microfinance=institutions::where('id',$id)->value('tcdc_form');
        $filePath = storage_path('app/public/' .$get_microfinance);
        return response()->download($filePath);
    }




    public function approveInstitution($id){
        $institution=institutions::where('id',$id)->first();
        // create  branch
          DB::table('branches')->insert([
            'institution_id'=>$id,
            'name'=>'HQ',
            'region'=>$institution->region ,
            'wilaya'=>$institution->wilaya ,
            'email'=>$institution->manager_email,
            'branch_status'=>'ACTIVE',
            'membershipNumber'=>str_pad($id,2,'0',STR_PAD_LEFT),
        ]);

          // branch id
        $branch_id=DB::table('branches')->where('institution_id',$id)->pluck('id');

        // create  manager user
        User::create([
            'name'=>$institution->manager_email,
            'email'=>$institution->manager_email,
            'password'=>Hash::make('1234567890'),
            'department'=>DB::table('departments')->where('department_name','MANAGEMENT')->value('id'),
            'branch'=>$branch_id,
            'institution_id'=>$id,
            'remember_token' => Str::random(10),
        ]);


        User::create([
            'name'=>$institution->admin_email,
            'email'=>$institution->admin_email,
            'password'=>Hash::make('1234567890'),
            'department'=>DB::table('departments')->where('department_name','DEVELOPERS')->value('id'),
            'branch'=>$branch_id,
            'institution_id'=>$id,
            'remember_token' => Str::random(10),
        ]);

        //|||//|| mail to the user
        Mail::to('percyegno@gmail.com')->send(  new InstitutionRegistrationConfirmationMail('confirmation detail'));


    }

}
