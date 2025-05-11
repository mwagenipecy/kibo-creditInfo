<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;
use App\Models\LenderFinancingCriteria;

class ViewModelsModal extends Component
{
    public $showModal = false;
    public $criteriaId = null;
    public $criteria = null;
    public $models = [];
    
    protected $listeners = [
        'openModal' => 'openModal',
        'closeModal' => 'closeModal'
    ];
    
    public function openModal($criteriaId)
    {
        $this->showModal = true;
        $this->criteriaId = $criteriaId;
        $this->loadCriteria();
    }
    
    public function closeModal()
    {
        $this->showModal = false;
        $this->criteriaId = null;
        $this->criteria = null;
        $this->models = [];
    }
    
    private function loadCriteria()
    {
        if ($this->criteriaId) {
            $this->criteria = LenderFinancingCriteria::with(['make', 'models'])->findOrFail($this->criteriaId);
            $this->models = $this->criteria->models;
        }
    }
    
    public function render()
    {
        return view('livewire.modals.view-models-modal');
    }
}