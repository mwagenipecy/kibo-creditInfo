<?php

namespace App\Http\Livewire\Procurement;

use App\Models\Tender;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class TenderTable extends LivewireDatatable
{
    public $exportable = true;

    public function builder()
    {
        return Tender::query();
    }

    public function columns(): array
    {
        return [
            Column::name('tender_number')->label('tender number')->searchable(),
            Column::name('tender_name')->label('tender name'),
            Column::name('tender_description')->label('tender description'),
            Column::name('status')->label(' status'),
            Column::callback('id', function ($id) {
                return view('livewire.procurement.tender-action', ['id' => $id]);
            })->label('action'),
        ];
    }

    public function edit($id)
    {
        $this->emit('editTenderModal', $id);
    }

    public function delete($id)
    {
        $this->emit('deleteTenderModal', $id);
    }
}
