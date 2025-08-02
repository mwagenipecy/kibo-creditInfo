<?php

/**
 * File: app/Http/Livewire/LenderManagement/LenderSettings.php
 * This is the complete Livewire component for managing lender financing criteria
 */

namespace App\Http\Livewire\LenderManagement;

use App\Models\Lender;
use App\Models\LenderFinancingCriteria;
use App\Models\Make;
use App\Models\VehicleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class LenderSettings extends Component
{
    use WithPagination;

    // Pagination theme
    protected $paginationTheme = 'tailwind';

    // Properties for single criteria form
    public $showForm = false;

    public $editMode = false;

    public $criteriaId = null;

    public $criteria = [];

    public $searchTerm = '';

    public $selectedMake = null;

    public $interest_rate; // Default interest rate, can be set in the form if needed

    // Properties for batch form
    public $showBatchForm = false;

    public $batchModels = [];

    public $selectedBatchModels = [];

    public $batchCriteria = [];

    // Validation rules
    protected function rules()
    {
        $uniqueRule = $this->editMode
            ? 'unique:lender_financing_criterias,model_id,'.$this->criteriaId.',id,lender_id,'.$this->criteria['lender_id'].',make_id,'.$this->criteria['make_id']
            : 'unique:lender_financing_criterias,model_id,NULL,id,lender_id,'.$this->criteria['lender_id'].',make_id,'.$this->criteria['make_id'];

        return [
            'criteria.lender_id' => 'required|exists:lenders,id',
            'criteria.make_id' => 'required|exists:makes,id',
            'criteria.model_id' => [
                'nullable',
                'exists:vehicle_models,id',
                $uniqueRule,
            ],
            'criteria.min_year' => 'required|integer|min:1900|max:'.(date('Y') + 1),
            'criteria.max_year' => [
                'required',
                'integer',
                'min:1900',
                'max:'.(date('Y') + 5),
                'gte:criteria.min_year', // Ensure max_year is greater than or equal to min_year
            ],
            'criteria.interest_rate' => 'numeric|min:0|max:100', // Interest rate validation
            'criteria.max_mileage' => 'nullable|numeric|min:0',
            'criteria.max_price' => 'nullable|numeric|min:0',
            'criteria.min_down_payment_percent' => 'nullable|numeric|min:0|max:100',
        ];
    }

    // Initialize component
    public function mount()
    {
        $this->resetCriteriaForm();
    }

    /**
     * SINGLE CRITERIA FORM METHODS
     */

    // Show add criteria form
    public function showAddCriteriaForm()
    {
        $this->resetCriteriaForm();
        $this->showForm = true;
        $this->showBatchForm = false; // Hide batch form
        $this->editMode = false;
    }

    // Update selected make
    public function updatedCriteriaMakeId($value)
    {
        $this->selectedMake = $value;
        $this->criteria['model_id'] = null; // Reset model when make changes
    }

    // Edit existing criteria
    public function editCriteria($id)
    {
        $this->resetCriteriaForm();

        $this->criteriaId = $id;
        $this->editMode = true;
        $this->showForm = true;
        $this->showBatchForm = false; // Hide batch form

        $criteria = LenderFinancingCriteria::findOrFail($id);
        $this->criteria = $criteria->toArray();

        // Set selected make for model dropdown
        $this->selectedMake = $criteria->make_id;
    }

    // Cancel form
    public function cancelForm()
    {
        $this->resetCriteriaForm();
        $this->showForm = false;
        $this->editMode = false;
    }

    // Add new criteria
    // Add new criteria with duplicate check
    public function addCriteria()
    {

        $this->validate();

        try {
            // Check for existing criteria with the same lender, make, and model
            $exists = LenderFinancingCriteria::where([
                'lender_id' => $this->criteria['lender_id'],
                'make_id' => $this->criteria['make_id'],
                'model_id' => $this->criteria['model_id'],
            ])->exists();

            if ($exists) {
                session()->flash('error', 'A criteria with this lender, make, and model combination already exists.');

                return;
            }

            // Create new criteria
            $newCriteria = new LenderFinancingCriteria;
            $newCriteria->lender_id = $this->criteria['lender_id'];
            $newCriteria->make_id = $this->criteria['make_id'];
            $newCriteria->model_id = $this->criteria['model_id']; // This can be null for "Any Model"
            $newCriteria->min_year = $this->criteria['min_year'];
            $newCriteria->max_year = $this->criteria['max_year'];
            $newCriteria->max_mileage = $this->criteria['max_mileage'];
            $newCriteria->max_price = $this->criteria['max_price'];
            $newCriteria->interest_rate = $this->criteria['interest_rate']; // Set interest rate
            $newCriteria->min_down_payment_percent = $this->criteria['min_down_payment_percent'];
            $newCriteria->save();

            session()->flash('success', 'Financing criteria added successfully!');
            $this->resetCriteriaForm();
            $this->showForm = false;

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to add criteria. '.$e->getMessage());
        }
    }

    // Update existing criteria with duplicate check
    public function updateCriteria()
    {
        $this->validate();

        try {
            $existingCriteria = LenderFinancingCriteria::findOrFail($this->criteriaId);

            // Check if we're changing make/model and if this would create a duplicate
            if (
                ($existingCriteria->make_id != $this->criteria['make_id'] ||
                 $existingCriteria->model_id != $this->criteria['model_id']) &&
                LenderFinancingCriteria::where([
                    'lender_id' => $this->criteria['lender_id'],
                    'make_id' => $this->criteria['make_id'],
                    'model_id' => $this->criteria['model_id'],
                ])
                    ->where('id', '!=', $this->criteriaId)
                    ->exists()
            ) {
                session()->flash('error', 'A criteria with this lender, make, and model combination already exists.');

                return;
            }

            // Update criteria fields
            $existingCriteria->lender_id = $this->criteria['lender_id'];
            $existingCriteria->make_id = $this->criteria['make_id'];
            $existingCriteria->model_id = $this->criteria['model_id']; // This can be null for "Any Model"
            $existingCriteria->min_year = $this->criteria['min_year'];
            $existingCriteria->max_year = $this->criteria['max_year'];
            $existingCriteria->max_mileage = $this->criteria['max_mileage'];
            $existingCriteria->max_price = $this->criteria['max_price'];
            $existingCriteria->interest_rate = $this->criteria['interest_rate'];  // Set interest rate
            $existingCriteria->min_down_payment_percent = $this->criteria['min_down_payment_percent'];
            $existingCriteria->save();

            session()->flash('success', 'Financing criteria updated successfully!');
            $this->resetCriteriaForm();
            $this->showForm = false;

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update criteria. '.$e->getMessage());
        }
    }

    // Delete criteria
    public function deleteCriteria($id)
    {
        try {
            $criteria = LenderFinancingCriteria::findOrFail($id);
            $criteria->delete();

            session()->flash('success', 'Financing criteria deleted successfully');

        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete criteria. '.$e->getMessage());
        }
    }

    // Reset criteria form
    private function resetCriteriaForm()
    {
        $this->criteria = [
            'lender_id' => Auth::user()->institution_id,
            'make_id' => '',
            'model_id' => null,
            'min_year' => date('Y') - 5,
            'max_year' => date('Y'),
            'max_mileage' => null,
            'max_price' => null,
            'min_down_payment_percent' => null,
        ];

        $this->criteriaId = null;
        $this->selectedMake = null;
        $this->resetValidation();
    }

    /**
     * BATCH CRITERIA FORM METHODS
     */

    // Show batch criteria form
    public function showAddMultipleCriteriaForm()
    {
        $this->resetBatchForm();
        $this->showBatchForm = true;
        $this->showForm = false; // Hide the regular form
    }

    // Cancel batch form
    public function cancelBatchForm()
    {
        $this->resetBatchForm();
        $this->showBatchForm = false;
    }

    // Reset batch form
    private function resetBatchForm()
    {
        $this->batchCriteria = [
            'lender_id' => Auth::user()->institution_id,
            'make_id' => '',
            'min_year' => date('Y') - 5,
            'max_year' => date('Y'),
            'max_mileage' => null,
            'max_price' => null,
            'interest_rate' => null,
            'min_down_payment_percent' => null,
            'interest_rate' => 0, // Default interest rate
        ];

        $this->batchModels = [];
        $this->selectedBatchModels = [];
        $this->resetValidation();
    }

    // Update models when make is selected in batch form
    public function updateBatchModels($makeId)
    {
        if (! $makeId) {
            $this->batchModels = [];
            $this->selectedBatchModels = [];

            return;
        }

        $this->batchModels = VehicleModel::where('make_id', $makeId)
            ->orderBy('name')
            ->get();
    }

    // Toggle all models in the batch selection
    public function toggleAllBatchModels($select)
    {
        if ($select) {
            $this->selectedBatchModels = $this->batchModels->pluck('id')->toArray();
        } else {
            $this->selectedBatchModels = [];
        }
    }

    // Add criteria for multiple models// Add criteria for multiple models with duplicate handling
    public function addBatchCriteria()
    {

        // Validate batch criteria
        $this->validate([
            'batchCriteria.lender_id' => 'required|exists:lenders,id',
            'batchCriteria.make_id' => 'required|exists:makes,id',
            'batchCriteria.min_year' => 'required|integer|min:1900|max:'.(date('Y') + 1),
            'batchCriteria.max_year' => [
                'required',
                'integer',
                'min:1900',
                'max:'.(date('Y') + 5),
                'gte:batchCriteria.min_year',
            ],
            'batchCriteria.interest_rate' => 'numeric|min:0|max:100', // Interest rate validation
            'batchCriteria.max_mileage' => 'nullable|numeric|min:0',
            'batchCriteria.max_price' => 'nullable|numeric|min:0',
            'batchCriteria.min_down_payment_percent' => 'nullable|numeric|min:0|max:100',
            'selectedBatchModels' => 'required|array|min:1',
            'selectedBatchModels.*' => 'exists:vehicle_models,id',
        ], [
            'selectedBatchModels.required' => 'Please select at least one model',
            'selectedBatchModels.min' => 'Please select at least one model',
            'batchCriteria.max_year.gte' => 'Maximum year must be greater than or equal to minimum year',
        ]);

        try {
            DB::beginTransaction();

            $createdCount = 0;
            $skippedCount = 0;
            $updatedCount = 0;

            // Get existing criteria for this lender and make
            $existingCriteria = LenderFinancingCriteria::where([
                'lender_id' => $this->batchCriteria['lender_id'],
                'make_id' => $this->batchCriteria['make_id'],
            ])->whereIn('model_id', $this->selectedBatchModels)
                ->get()
                ->keyBy('model_id');

            foreach ($this->selectedBatchModels as $modelId) {
                // Check if criteria already exists for this make/model combination
                if (isset($existingCriteria[$modelId])) {
                    // Update existing criteria
                    $existing = $existingCriteria[$modelId];
                    $existing->min_year = $this->batchCriteria['min_year'];
                    $existing->max_year = $this->batchCriteria['max_year'];
                    $existing->max_mileage = $this->batchCriteria['max_mileage'];
                    $existing->max_price = $this->batchCriteria['max_price'];
                    $existing->interest_rate = $this->batchCriteria['interest_rate']; // Set interest rate
                    $existing->min_down_payment_percent = $this->batchCriteria['min_down_payment_percent'];
                    $existing->save();

                    $updatedCount++;
                } else {
                    // Create a new criteria entry for the model
                    $newCriteria = new LenderFinancingCriteria;
                    $newCriteria->lender_id = $this->batchCriteria['lender_id'];
                    $newCriteria->make_id = $this->batchCriteria['make_id'];
                    $newCriteria->model_id = $modelId;
                    $newCriteria->min_year = $this->batchCriteria['min_year'];
                    $newCriteria->max_year = $this->batchCriteria['max_year'];
                    $newCriteria->max_mileage = $this->batchCriteria['max_mileage'];
                    $newCriteria->max_price = $this->batchCriteria['max_price'];
                    $newCriteria->interest_rate = $this->batchCriteria['interest_rate']; // Set interest rate
                    $newCriteria->min_down_payment_percent = $this->batchCriteria['min_down_payment_percent'];
                    $newCriteria->save();

                    $createdCount++;
                }
            }

            DB::commit();

            $message = '';
            if ($createdCount > 0) {
                $message .= "{$createdCount} new criteria added. ";
            }
            if ($updatedCount > 0) {
                $message .= "{$updatedCount} existing criteria updated. ";
            }
            if ($skippedCount > 0) {
                $message .= "{$skippedCount} criteria skipped due to duplicate entries.";
            }

            session()->flash('success', $message);
            $this->resetBatchForm();
            $this->showBatchForm = false;

        } catch (\Exception $e) {

            // dd($e->getMessage());
            DB::rollBack();
            session()->flash('error', 'Failed to add criteria. '.$e->getMessage());
        }
    }
    /**
     * RENDER METHOD
     */

    // Render the component
    public function render()
    {
        $models = [];

        // Get makes and models
        $makes = Make::orderBy('name')->get();

        // Get model options based on selected make
        if ($this->selectedMake) {
            $models = VehicleModel::where('make_id', $this->selectedMake)
                ->orderBy('name')
                ->get();
        }

        // Get lender criteria with filtering
        $lenderId = Auth::user()->institution_id;

        $criteriaQuery = LenderFinancingCriteria::where('lender_id', $lenderId)
            ->with(['make', 'model'])
            ->when($this->searchTerm, function ($query) {
                return $query->whereHas('make', function ($q) {
                    $q->where('name', 'like', '%'.$this->searchTerm.'%');
                })
                    ->orWhereHas('model', function ($q) {
                        $q->where('name', 'like', '%'.$this->searchTerm.'%');
                    });
            });

        $criteriaList = $criteriaQuery->paginate(10);

        return view('livewire.lender-management.lender-settings', [
            'criteriaList' => $criteriaList,
            'makes' => $makes,
            'models' => $models,
        ]);
    }
}
