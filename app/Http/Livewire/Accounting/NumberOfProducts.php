<?php

namespace App\Http\Livewire\Accounting;

use App\Models\AccountsModel;
use Illuminate\Support\Facades\Session;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class NumberOfProducts extends LivewireDatatable
{
    protected $listeners = ['refreshSavingsComponent' => '$refresh'];

    public $exportable = true;

    public function builder()
    {
        // dd(Session::get('sharesViewItem'));

        return AccountsModel::query()->where('product_number', '10');

    }

    public function viewMember($memberId)
    {
        Session::put('memberToViewId', $memberId);
        $this->emit('refreshMembersListComponent');
    }

    public function editMember($memberId, $name)
    {
        Session::put('memberToEditId', $memberId);
        Session::put('memberToEditName', $name);
        $this->emit('refreshMembersListComponent');
    }

    /**
     * Write code on Method
     *
     * @return array()
     */
    public function columns(): array
    {

        return [

            Column::name('account_name')
                ->label('Account Name'),

            Column::name('account_number')
                ->label('Account number'),

            Column::name('balance')
                ->label('Current Balance'),

            Column::name('notes')
                ->label('Notes'),

            Column::name('account_status')
                ->label('Status'),

        ];
    }
}
