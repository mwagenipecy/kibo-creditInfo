<?php

namespace App\Http\Livewire\Procurement;

use App\Models\approvals;
use App\Models\ContractManagement;
use App\Models\Inventory;
use App\Models\PurchaseRequisition;
use App\Models\Tender;
use App\Models\Vendor;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Ramsey\Uuid\Uuid;

class Procurement extends Component
{
    use WithFileUploads;

    public $createInventory=false;
    public $createTenderModal=false;
    public $createContractModal=false;
    public $createPurchaseModal=false;
     public $createVendorModal=false;
    public $tab_id = '1';
    public $title = 'Procurement report';


// mount  vendor table
    public Vendor $vendor;
// delete

   public $deleteVendor=false;


    // purchases  attributes
    public $requisition_description;
    public $employeeId;
//    public PurchaseRequisition $purchase;

    // edit modal
    public $editPurchaseModal=false;
    public $assignModal=false;
    public $deletePurchaseModal=false;







     public $listeners=['editVendor'=>'subMenuItemClicked',
                          'deleteVendor'=>'deleteVendorModal',
                          'refreshPage'=>'$refresh',
                         // 'actionPurchaseRequisition'=>'purchaseRequisitionModal'
         ];





    public function purchaseRequisitionModal($id){
        if($id==1){
            if($this->editPurchaseModal==false){
                $this->editPurchaseModal=true;
            }

        }
        elseif($id==2){
           if($this->deletePurchaseModal==false){
               $this->deletePurchaseModal=true;
        }

        }elseif($id==3){
            if($this->assignModal==false){
                $this->assignModal=true;
//                dd($id);

          }
        }
    }

    public function deleteVendorModal($id){
        if($this->deleteVendor==false){
            $this->deleteVendor=true;
            session()->put('vendorId',$id);
        }
        elseif($this->deleteVendor==true){
            $this->deleteVendor=false;
            session()->forget('vendorId');
        }
    }

    public function deleteVendor(){
        Vendor::where('id',session()->get('vendorId'))->update(['status'=>"DELETED"]);
        session()->flash('delete_message','Item deleted successfully!');
        $this->deleteVendorModal(session()->get('vendorId'));
        $this->emitSelf('refreshPage');
    }


    public function menuItemClicked($tabId)
    {
        $this->tab_id = $tabId;
        if ($tabId == '1') {
            $this->title = 'Procurement report';
        }
        if ($tabId == '2') {
            $this->title = 'Enter new employee details';
        }
        if ($tabId == '3') {
            $this->title = 'Enter new shares details';
        }
    }



    public function subMenuItemClicked($id, Vendor $vendor = null){
        if($id==2){
            if($this->createVendorModal==false){
                $this->createVendorModal=true;
                $this->vendor = $vendor;
            }elseif($this->createVendorModal==true){
                $this->createVendorModal=false;
            }
        }
        elseif($id==3){
            if($this->createPurchaseModal==false){
                $this->createPurchaseModal=true;
            }
            elseif($this->createPurchaseModal==true){
                $this->createPurchaseModal=false;
            }
        }
        elseif($id==4){
            if($this->createContractModal==false){
                $this->createContractModal=true;
            }
            elseif($this->createContractModal==true){
                $this->createContractModal=false;
            }
        }
        elseif($id==5){
              if($this->createTenderModal==false){
                  $this->createTenderModal=true;}
               elseif($this->createTenderModal==true){
                  $this->createTenderModal=false;
              }
        }
        elseif($id==6){
            if($this->createInventory==false){
                $this->createInventory=true;
            }
            elseif($this->createInventory==true){
                $this->createInventory=false;
            }
        }
    }


    public function render()
    {
        return view('livewire.procurement.procurement');
    }
}
