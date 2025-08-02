<?php

namespace App\Http\Livewire\HR;

use App\Models\FiscalPolicy\Benefits;
use App\Models\FiscalPolicy\Contributions;
use App\Models\FiscalPolicy\Taxes;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class FiscalPolicy extends LivewireDatatable
{
    protected $listeners = ['fiscal_policy_table' => 'builder'];

    public function builder()
    {
        session()->put('table_name', 'Contributions');
        if (session()->get('selected_policy') == '1') {
            session()->put('table_name', 'Contributions');

            return Contributions::query();
        } elseif (session()->get('selected_policy') == '2') {
            session()->put('table_name', 'benefits');

            return Benefits::query();
        } elseif (session()->get('selected_policy') == '3') {
            session()->put('table_name', 'taxes');

            return Taxes::query();
            //          return  Benefits::query();

        }

        return Contributions::query();

    }

    public function columns(): array
    {
        return [
            \Mediconesystems\LivewireDatatables\Column::name('id')
                ->label('ID'),
            \Mediconesystems\LivewireDatatables\Column::name('name')
                ->label('Category'),
            \Mediconesystems\LivewireDatatables\Column::name('amount')
                ->label('Amount'),
            \Mediconesystems\LivewireDatatables\Column::name('status')
                ->label('Status'),
            \Mediconesystems\LivewireDatatables\Column::callback(['id', 'amount'], function ($id, $amount) {
                $html = ' <button wire:click="edit('.$id.')" type="button" class="text-white bg-gray-100 hover:bg-blue-100 hover:text-blue focus:ring-4 focus:outline-none focus:ring-blue-100 font-medium rounded-lg text-sm p-1 text-center inline-flex items-center mr-2 dark:bg-blue-200 dark:hover:bg-blue-200 dark:focus:ring-blue-200">

            <svg xmlns="http://www.w3.org/2000/svg" fill="blue" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
            <span class="sr-only">Edit</span>
        </button>';

                return $html;
            })->label('Action'),
        ];
    }

    public function edit($id)
    {
        session()->put('fiscal_policy_id', $id);
        $this->emit('editFiscalPolicyEvent', $id);
    }
}
