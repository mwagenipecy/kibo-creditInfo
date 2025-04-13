<?php

namespace App\Http\Livewire\ApplicationSummary;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use App\Models\Application;
use App\Models\Image;
use App\Models\EmployerVerification;
use App\Mail\EmployerVerificationRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ApplicationSummary extends Component
{
    public $showEmployerMessageForm = false;
    public $employerMessageSent = false;
    public $employerMessageSentDate = null;

    public $statusFilter = 'ALL';
    public $isModalOpen = false;
    public $isImageModalOpen = false;

    public $isApplicationModalOpen = false;

    public $search;
    public $selectedApplication = null;
    public $images = [];
    public $selectedImageIndex = null;
    public $messageToEmployer;

    protected $rules = [
        'messageToEmployer' => 'required|min:10',
    ];

    public function mount($applicationId = null)
    {
        if ($applicationId) {
            $this->selectApplication($applicationId);
        }
    }

    public function getDefaultMessage()
    {
        $app = $this->selectedApplication;

        return "Dear " . ($app->employer_name ?? 'Employer') . ",

We are currently reviewing an application submitted by " . ($app->full_name ?? 'your employee') . ". Kindly help us confirm the following:

- Do you know this employee?
- What is their position and employment status?
- How long have they worked at your organization?
- Would you recommend them for financial assistance?

Thank you for your support.

Regards,
" . config('app.name');
    }

    public function toggleEmployerMessageForm()
    {
        $this->showEmployerMessageForm = !$this->showEmployerMessageForm;

        if ($this->showEmployerMessageForm && empty($this->messageToEmployer)) {
            $this->messageToEmployer = $this->getDefaultMessage();
        }
    }

    public function sendToEmployer()
    {
        $this->validate();

      
        try {
            $token = Str::random(64);

            $verification = EmployerVerification::create([
                'application_id' => $this->selectedApplication->id,
                'token' => $token,
                'status' => 'pending',
                'message_sent' => $this->messageToEmployer,
                'expires_at' => Carbon::now()->addDays(7),
            ]);

            Mail::to($this->selectedApplication->hrEmail)
                ->send(new EmployerVerificationRequest(
                    $this->selectedApplication,
                    $verification,
                    $this->messageToEmployer
                ));

            $this->selectedApplication->update([
                'employer_verification_sent' => true,
                'employer_verification_sent_at' => Carbon::now(),
            ]);

            $this->employerMessageSent = true;
            $this->employerMessageSentDate = now()->format('M d, Y');
            $this->showEmployerMessageForm = false;

            $this->dispatchBrowserEvent('notify', [
                'type' => 'success',
                'message' => 'Verification request sent successfully!',
            ]);
        } catch (\Exception $e) {
            Log::error("Employer verification error: " . $e->getMessage());

            dd($e->getMessage());
            $this->dispatchBrowserEvent('notify', [
                'type' => 'error',
                'message' => 'Failed to send verification: ' . $e->getMessage(),
            ]);
        }
    }

    public function resendVerification()
    {
        $this->toggleEmployerMessageForm();
    }

    public function selectApplication($id)
    {
        $this->selectedApplication = Application::findOrFail($id);

        session()->put('applicationId', $id);

        $this->images = Image::where('loan_id', $this->selectedApplication->loan_id)
            ->pluck('url')
            ->toArray();

        $latestVerification = EmployerVerification::where('application_id', $id)
            ->latest()
            ->first();

        if ($latestVerification) {
            $this->employerMessageSent = true;
            $this->employerMessageSentDate = $latestVerification->created_at->format('M d, Y');
        }

        $this->messageToEmployer = $this->getDefaultMessage();
    }

    public function downloadImage($imagePath)
    {
        try {
            $sanitizedPath = basename($imagePath);
            $fullPath = storage_path('app/public/' . $imagePath);

            if (
                empty($sanitizedPath) ||
                !str_starts_with($imagePath, 'assets/img/cars/') ||
                !file_exists($fullPath)
            ) {
                Log::warning("Invalid image download attempt: {$imagePath}");
                session()->flash('error', 'Image cannot be downloaded.');
                return redirect()->back();
            }

            $image = Image::where('url', $imagePath)->first();
            if (!$image) {
                Log::warning("Image not found in DB: {$imagePath}");
                session()->flash('error', 'Image not found.');
                return redirect()->back();
            }

            return response()->download(
                $fullPath,
                pathinfo($sanitizedPath, PATHINFO_BASENAME),
                ['Content-Type' => mime_content_type($fullPath)]
            );
        } catch (\Exception $e) {
            Log::error("Download error: " . $e->getMessage());
            session()->flash('error', 'Error while downloading image.');
            return redirect()->back();
        }
    }

    public function previousImage()
    {
        if ($this->selectedImageIndex > 0) {
            $this->selectedImageIndex--;
        }
    }

    public function nextImage()
    {
        if ($this->selectedImageIndex < count($this->images) - 1) {
            $this->selectedImageIndex++;
        }
    }

    public function showImageModal($index)
    {
        $this->selectedImageIndex = $index;
    }

    public function closeImageModal()
    {
        $this->selectedImageIndex = null;
    }

    public function openApplicationModal()
    {
        $this->isModalOpen = true;
    }

    public function closeApplicationModal()
    {
        $this->isModalOpen = false;
    }

    public function acceptApplication($id)
    {
        $application = Application::findOrFail($id);
        $application->update(['application_status' => 'ACCEPTED']);

        session()->flash('message', 'Application accepted.');
        $this->resetView();
    }

    public function rejectApplication($id)
    {
        $application = Application::findOrFail($id);
        $application->update(['application_status' => 'REJECTED']);

        session()->flash('message', 'Application rejected.');
        $this->resetView();
    }

    private function resetView()
    {
        $this->selectedApplication = null;
    }

    public function render()
    {
        $query = Application::where('lender_id', auth()->user()->institution_id);

        if ($this->statusFilter !== 'ALL') {
            $query->where('application_status', $this->statusFilter);
        }

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('first_name', 'like', '%' . $this->search . '%')
                  ->orWhere('last_name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.application-summary.application-summary', [
            'applicationx' => $query->latest()->paginate(30),
        ]);
    }
}
