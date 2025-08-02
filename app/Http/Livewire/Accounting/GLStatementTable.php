<?php

namespace App\Http\Livewire\Accounting;

use App\Models\general_ledger;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class GLStatementTable extends LivewireDatatable
{
    protected $listeners = ['refreshMembersTable' => '$refresh'];

    public $exportable = true;

    public function builder()
    {

        return general_ledger::query();

    }

    /**
     * Write code on Method
     *
     * @return array()
     */
    public function columns(): array
    {

        return [
            Column::name('created_at')
                ->label('Date')->searchable(),

            Column::name('record_on_account_number')
                ->label('Account Number')->searchable(),

            Column::name('narration')
                ->label('Narration')->searchable(),

            Column::name('credit')
                ->label('Credit')->searchable(),

            Column::name('debit')
                ->label('Debit')->searchable(),

        ];
    }
}
