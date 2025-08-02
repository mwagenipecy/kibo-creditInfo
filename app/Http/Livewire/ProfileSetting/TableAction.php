<?php

namespace App\Http\Livewire\ProfileSetting;

use Livewire\Component;

class TableAction extends Component
{
    public function approveInstitution($id) {}

    public function approveRequest($id)
    {
        dd(__LINE__);
    }

    public function render()
    {

        return view('livewire.profile-setting.table-action');
    }
}
