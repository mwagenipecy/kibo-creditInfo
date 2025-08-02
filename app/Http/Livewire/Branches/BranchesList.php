<?php

namespace App\Http\Livewire\Branches;

use App\Models\BranchesModel;
use Livewire\WithFileUploads;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class BranchesList extends LivewireDatatable
{
    use WithFileUploads;

    public $exportable = true;

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return BranchesModel::query(); // You can modify the ordering as per your requirement
    }

    public function columns(): array
    {
        return [
            Column::name('id')->label('ID'),
            Column::name('name')->label('Name')->searchable(),
            Column::name('region')->label('Region'),

            Column::name('branchNumber')->label('branch Number')->searchable(),
            Column::name('phone_number')->label('Contacts'),

            Column::callback(['branch_status'], function ($status) {
                return view('livewire.branches.table-status', ['status' => $status, 'move' => false]);
            })->label('status'),

            Column::callback(['id'], function ($id) {
                return view('livewire.branches.list-action', ['id' => $id, 'move' => false]);
            })->unsortable()->label('Action'),

            //        Column::callback(['id','branch_status'], function ($id,$branch_status) {
            //            $html=' <a wire:click="viewBranchDetails('.$id.')" target="_blank" class=" cursor-pointer text-white bg-gray-100 hover:bg-blue-100 hover:text-blue focus:ring-4 focus:outline-none focus:ring-blue-100 font-medium rounded-lg text-sm p-1 text-center inline-flex items-center mr-2 dark:bg-blue-200 dark:hover:bg-blue-200 dark:focus:ring-blue-200">
            //            <svg class="w-6 h-6" stroke-width="1.5" stroke="gray" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
            //        </a>';
            //            return  $html;
            //
            //            })->unsortable()->label('view branch'),
        ];
    }

    public function edit($id)
    {
        $this->emitUp('editBranch', $id);
    }

    public function block($id)
    {
        $this->emitUp('blockBranch', $id);
    }

    public function viewBranchDetails($id)
    {
        $this->emit('viewBranchId', $id);
    }
}
