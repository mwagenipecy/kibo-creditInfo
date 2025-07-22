<?php

namespace App\Http\Livewire\Settings;

use App\Models\approvals;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\NodesList;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Search;

class Users extends LivewireDatatable
{
    use WithFileUploads;

    public $exportable = true;

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return User::query(); // You can modify the ordering as per your requirement
    }

    public function columns(): array
    {
        return [
            Column::name('id')->label('ID'),
            Column::name('name')->label('Name')->searchable(),
        Column::name('email')->label('Email')->searchable(),

            Column::name('phone_number')->label('Phone Number'),
            Column::name('created_at')->label('Created At'),
            Column::callback(['department'], function ($departmentid) {
                //dd($departmentid);
                return \App\Models\departmentsList::where('id', $departmentid)->value('department_name');
            })->label('Role'),
            Column::callback(['status'], function ($status) {
                return view('livewire.settings.table-status', ['status' => $status, 'move' => false]);
            })->label('status'),

            Column::callback(['ID'], function ($id) {
                return view('livewire.settings.users-list-action', ['id' => $id, 'move' => false]);
            })->unsortable()->label('Action'),
        ];
    }

    public function edit($id){
    $this->emitUp('editUser',$id);
    }

    public function block($id){
    $this->emitUp('blockUser',$id);
    }

}
