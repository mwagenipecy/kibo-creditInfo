<?php

namespace App\Http\Livewire\Shares;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class SharesListByClients extends Component
{


    public $term = "";
    public $showAddUser = false;
    public $memberStatus = 'All';
    protected $listeners = ['refreshClientsListComponent' => '$refresh'];

    public function resetSearch(){
        $this->term = '';
        Session::put('memberSearchTerm','');
        $this->emit('refreshClientsTable');
    }



    public function render()
    {

        if($this->term == ''){
            Session::put('memberStatus',$this->memberStatus);
            Session::put('memberSearchTerm','');
            $this->emit('refreshClientsTable');
        }else{
            Session::put('memberStatus',$this->memberStatus);
            Session::put('memberSearchTerm',$this->term);
            $this->emit('refreshClientsTable');
        }
        return view('livewire.shares.shares-list-by-clients');
    }
}
