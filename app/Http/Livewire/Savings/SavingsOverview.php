<?php

namespace App\Http\Livewire\Savings;


use Livewire\Component;
use App\Models\sub_products;
use Illuminate\Support\Facades\Session;


class SavingsOverview extends Component
{

    public $term = "";
    public $showAddUser = false;
    public $memberStatus = 'All';
    public $numberOfProducts;
    public $products;
    public $item;

    protected $listeners = ['refreshClientsListComponent' => '$refresh'];

    public function visit($item)
    {

        Session::put('savingsViewItem', $item);
        $this->item = $item;
        $this->emit('refreshSavingsComponent');
    }

    public function boot(){
        $this->item = 1;
    }

    public function render()
    {
        $query = sub_products::where('product_id', 12);
        $this->products = $query->get();
        $this->numberOfProducts = $query->count();

        return view('livewire.savings.savings-overview');
    }
}
