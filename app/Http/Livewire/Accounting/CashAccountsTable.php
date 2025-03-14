<?php

namespace App\Http\Livewire\Accounting;

use App\Models\AccountsModel;
use App\Models\BranchesModel;
use App\Models\Employee;
use App\Models\MembersModel;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class CashAccountsTable extends LivewireDatatable
{




    use WithFileUploads;

    public $exportable = true;

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        return AccountsModel::query()
            ->where('major_category_code','1000')->where('account_use','internal');
    }




    public function columns(): array
    {
        return [
            Column::name('account_name')->label('Account Name')->searchable(),
            Column::name('account_number')->label('Account Number')->searchable(),
            Column::name('balance')->label('Account Balance'),
            Column::name('mirror_account')->label('Mirror Account')->searchable(),
            Column::callback(['id'], function ($id) {
                return view('livewire.accounting.cash-accounts-table-actions', ['id' => $id, 'move' => false]);

            })->unsortable()->label('Action'),
        ];
    }

    public function edit($id){
        $this->emitUp('editAccountsAccount',$id);
    }


}
