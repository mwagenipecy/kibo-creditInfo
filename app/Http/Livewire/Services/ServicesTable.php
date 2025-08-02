<?php

namespace App\Http\Livewire\Services;

use App\Models\ServicesList;
use Livewire\WithFileUploads;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ServicesTable extends LivewireDatatable
{
    use WithFileUploads;

    public $exportable = true;

    public $searchable = 'NAME,STATUS';

    public function builder(): \Illuminate\Database\Eloquent\Builder
    {

        return ServicesList::query()->whereNot('STATUS', 'DELETED');

    }

    public function columns(): array
    {
        return [

            Column::name('NAME')
                ->label('Service Name'),

            Column::callback(['NODES'], function ($nodes) {

                $json = $nodes;

                // Decode the JSON string into an array
                $array = json_decode($json, true);

                // Loop through the array and extract the node_id values
                $nodeIds = [];
                foreach ($array as $item) {
                    $nodeIds[] = $item['node_id'];
                }

                // Output the node_id values
                $nodeslisting = implode(', ', $nodeIds);

                return view('livewire.services.list-of-nodes', ['nodeslisting' => $nodeIds, 'move' => true]);
            })->unsortable()->label('Service Nodes'),

            Column::callback(['STATUS'], function ($status) {
                return view('livewire.settings.table-status', ['status' => $status, 'move' => false]);
            })->label('Service Status'),

        ];
    }
}
