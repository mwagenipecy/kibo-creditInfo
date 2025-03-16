<?php

namespace App\Http\Livewire\ApplicationSummary;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Application;

class ApplicationSummary extends Component
{

    public $applications;
    public $selectedApplication = null;

    public function mount()
    {
        $this->applications = Application::all();
    }

    public function selectApplication($id)
    {
        $this->selectedApplication = Application::find($id);

        session()->put("applicationId", $id);
    }

    public function acceptApplication($id)
    {
        $application = Application::find($id);
        $application->application_status = 'ACCEPTED';
        $application->save();
        session()->flash('message', 'Application accepted successfully.');
        $this->resetView();
    }

    public function rejectApplication($id)
    {
        $application = Application::find($id);
        $application->application_status = 'REJECTED';
        $application->save();
        session()->flash('message', 'Application rejected successfully.');
        $this->resetView();
    }

    private function resetView()
    {
        $this->selectedApplication = null;
        $this->applications = Application::all();
    }

    public function render()
    {
        return view('livewire.application-summary.application-summary');
    }
}
