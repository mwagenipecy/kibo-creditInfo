<?php

namespace App\Http\Livewire\Shares;

use Livewire\Component;
use App\Models\sub_products;
use Illuminate\Support\Facades\Session;


class SharesListByProduct extends Component
{

    public $term = "";
    public $showAddUser = false;
    public $memberStatus = 'All';
    public $numberOfProducts;
    public $products;
    public $item;

    protected $listeners = ['refreshClientsListComponent' => '$refresh'];

    public function visit($item){

        Session::put('sharesViewItem',$item);
        $this->item = $item;
        $this->emit('refreshShareComponent');
    }


    public function render()
    {
        $query = sub_products::where('product_id',11);
        $this->products = $query->get();
        $this->numberOfProducts = $query->count();

        return view('livewire.shares.shares-list-by-product');
    }
}
