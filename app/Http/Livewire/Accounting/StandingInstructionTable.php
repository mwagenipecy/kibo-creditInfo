<?php

namespace App\Http\Livewire\Accounting;

use App\Models\StandingInstruction;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class StandingInstructionTable extends LivewireDatatable
{
    
    public function builder(){
        return StandingInstruction::query();
    }

    public function columns(): array
    {
        return [
            Column::name('id')
                ->label('id')->searchable(),

            Column::name('action_date')
                ->label('run date'),

            Column::name('status')
                ->label('status'),
            Column::name('source_account_number')
                ->label('source account number'),
            Column::name('destination_account_number')
                ->label('destination account number'),
        ];
    }

}
