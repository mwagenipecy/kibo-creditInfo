<?php

namespace App\Http\Livewire\ProductManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\LoanProduct;
use Illuminate\Support\Facades\Validator;

class ProductDashboard extends Component
{

    use WithPagination;
    
    protected $paginationTheme = 'tailwind';
    
    public $searchTerm = '';
    
    // Properties for creating/editing product
    public $sub_product_id;
    public $product_id;
    public $sub_product_name;
    public $prefix;
    public $sub_product_status;
    public $currency;
    public $principle_min_value;
    public $principle_max_value;
    public $min_term;
    public $max_term;
    public $interest_value;
    public $interest_tenure;
    public $interest_method;
    public $amortization_method;
    public $repayment_strategy;
    public $inactivity;
    public $showDeleteModal = false;    
    
    public $isOpen = false;
    public $editMode = false;
    public $loanProductId;
    
    // Listeners
    protected $listeners = ['delete' => 'deleteProduct'];
    
    // Reset inputs after operations
    public function resetInputs()
    {
        $this->sub_product_id = '';
        $this->product_id = '';
        $this->sub_product_name = '';
        $this->prefix = '';
        $this->sub_product_status = '';
        $this->currency = '';
        $this->principle_min_value = '';
        $this->principle_max_value = '';
        $this->min_term = '';
        $this->max_term = '';
        $this->interest_value = '';
        $this->interest_tenure = '';
        $this->interest_method = '';
        $this->amortization_method = '';
        $this->repayment_strategy = '';
        $this->inactivity = '';
        $this->editMode = false;
        $this->loanProductId = null;
    }
    
    // Open modal for create/edit
    public function openModal()
    {
        $this->isOpen = true;
    }
    
    // Close modal
    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputs();
    }
    
    // Create new loan product
    public function createProduct()
    {
        $this->resetInputs();
        $this->openModal();
    }
    
    // Edit loan product
    public function editProduct($id)
    {
        $product = LoanProduct::findOrFail($id);
        $this->loanProductId = $id;
        $this->sub_product_id = $product->sub_product_id;
        $this->product_id = $product->product_id;
        $this->sub_product_name = $product->sub_product_name;
        $this->prefix = $product->prefix;
        $this->sub_product_status = $product->sub_product_status;
        $this->currency = $product->currency;
        $this->principle_min_value = $product->principle_min_value;
        $this->principle_max_value = $product->principle_max_value;
        $this->min_term = $product->min_term;
        $this->max_term = $product->max_term;
        $this->interest_value = $product->interest_value;
        $this->interest_tenure = $product->interest_tenure;
        $this->interest_method = $product->interest_method;
        $this->amortization_method = $product->amortization_method;
        $this->repayment_strategy = $product->repayment_strategy;
        $this->inactivity = $product->inactivity;
        
        $this->editMode = true;
        $this->openModal();
    }
    
    // Store or update loan product
    public function store()
    {


      
        
        $validatedData = Validator::make([
          
            'sub_product_name' => $this->sub_product_name,
            'sub_product_status' => $this->sub_product_status,
            'principle_min_value' => $this->principle_min_value,
            'principle_max_value' => $this->principle_max_value,
            'min_term' => $this->min_term,
            'max_term' => $this->max_term,
            'interest_value' => $this->interest_value,
            'interest_tenure' => $this->interest_tenure,
            'interest_method' => $this->interest_method,
            'repayment_strategy' => $this->repayment_strategy,
        ], [
           
            'sub_product_name' => 'required|string|max:255',
            'sub_product_status' => 'required|string|max:255',
            'principle_min_value' => 'required|numeric|min:0',
            'principle_max_value' => 'required|numeric|min:0|gt:principle_min_value',
            'min_term' => 'required|numeric|min:0',
            'max_term' => 'required|numeric|min:0|gt:min_term',
            'interest_value' => 'required|integer|min:0',
            'interest_tenure' => 'required|integer|min:0',
            'interest_method' => 'required|string|max:255',
            'repayment_strategy' => 'required|string|max:255',
        ])->validate();


        
        try {
            if ($this->editMode) {
                $product = LoanProduct::find($this->loanProductId);
                $product->update($validatedData);
                $this->isOpen = false;
                session()->flash('message', 'Loan product updated successfully.');
            } else {
                LoanProduct::create($validatedData);
                $this->isOpen = false;

                session()->flash('message', 'Loan product created successfully.');
            }
            
            $this->closeModal();
            $this->resetInputs();
            $this->isOpen = false;

        } catch (\Exception $e) {
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
    }
    
    // Delete confirmation
    public function deleteConfirmation($id)
    {
        $this->loanProductId = $id;
        $this->showDeleteModal=true;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }


    
    // Delete loan product
    public function deleteProduct()
    {
        try {
            LoanProduct::find($this->loanProductId)->delete();
            session()->flash('message', 'Loan product deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
    }
    
    // Render the component
    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        
        $loanProducts = LoanProduct::where('sub_product_name', 'like', $searchTerm)
            ->orWhere('interest_tenure', 'like', $searchTerm)
            ->orWhere('min_term', 'like', $searchTerm)
            ->orderBy('id', 'desc')
            ->paginate(10);
            
        return view('livewire.product-management.product-dashboard', [
            'loanProducts' => $loanProducts
        ]);
    }



}
