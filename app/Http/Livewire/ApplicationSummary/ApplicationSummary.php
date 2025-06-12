<?php

namespace App\Http\Livewire\ApplicationSummary;

use App\Models\Attachment;
use App\Models\VehicleImage;
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
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use function PHPUnit\Framework\isEmpty;
class ApplicationSummary extends Component
{
    public $showEmployerMessageForm = false;
    public $employerMessageSent = false;
    public $employerMessageSentDate = null;

    public $statusFilter = 'ALL';
    public $isModalOpen = false;
    public $isImageModalOpen = false;

    public $isApplicationModalOpen = false;

    public $applicationDocuments=[];

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





    public function rejectApplication(){

        $applicationId = session('applicationId');
        $application = Application::find($applicationId);

        $loanId = $application->loan_id;


        $application->application_status = 'REJECTED';
        $application->save();
        
        // Update loan status
        DB::table('loans')->where('id', $loanId)->update(['status' => 'REJECTED']);
        


    }


    public function acceptApplication()
    {
        $applicationId = session('applicationId');
        $application = Application::find($applicationId);
        
        // Check if application exists
        if (!$application) {
          session()->flash('error' , 'Application not found' );
        }
        // Don't do anything if loan is already ACTIVE or REJECTED
        if (in_array($application->application_status, ['ACCEPTED', 'REJECTED'])) {
            session()->flash('message' ,'No action needed. Application is ' . $application->application_status );
        }
        
        $loanId = $application->loan_id;


        
        // Use transaction to handle errors and prevent partial operations
        try {

            DB::beginTransaction();
            
            // Update application status
            $application->application_status = 'ACCEPTED';
            $application->save();
            
            // Update loan status
           // DB::table('loans')->where('id', $loanId)->update(['status' => 'ACTIVE']);
            
            // Commit transaction if everything succeeded
            DB::commit();
            
            return session()->flash('message' , 'Application accepted successfully');
        } catch (\Exception $e) {
            // Rollback transaction if any operation fails
            DB::rollBack();


            dd($e->getMessage());
            
            // Log the error for debugging
            \Log::error('Error accepting application: ' . $e->getMessage());
            
            session()->flash('error' , 'Failed to accept application' );
        }
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

    public $statementData;
    public function selectApplication($id)
    {
        $this->selectedApplication = Application::findOrFail($id);

        $this->applicationDocuments = Attachment::where('loan_id', $this->selectedApplication->loan_id)->get();

        if ($this->applicationDocuments->isEmpty()) {
            $this->applicationDocuments = Attachment::where('loan_id', $id)->get();
        }
        

        session()->put('applicationId', $id);



        if ($this->selectedApplication->loan_id) {
            $this->images = Image::where('loan_id', $this->selectedApplication->loan_id)
                ->pluck('url')
                ->toArray();
        }
        
        // If no images found for the loan, try fetching from vehicle images
        if (empty($this->images) && $this->selectedApplication->vehicle_id) {
            $this->images = VehicleImage::where('vehicle_id', $this->selectedApplication->vehicle_id)
                ->pluck('image_url')
                ->toArray();
        }

        $latestVerification = EmployerVerification::where('application_id', $id)
            ->latest()
            ->first();

        if ($latestVerification) {
            $this->employerMessageSent = true;
            $this->employerMessageSentDate = $latestVerification->created_at->format('M d, Y');
        }

        $this->messageToEmployer = $this->getDefaultMessage();
    }


    public function show()
    {
        
        // Option 1: Use a proper JSON string with correct formatting
        $jsonString = <<<'JSON'
{
    "profile": {
        "name": "255767582837",
        "account": "255767582837",
        "contacts": "255767582837",
        "company": "Vodacom",
        "currency": "Tanzanian Shilling",
        "currency_code": "TZS",
        "type": "mno",
        "start_date": "2025-04-18T11:05:00",
        "end_date": "2025-05-02T09:03:00",
        "no_of_transactions": 17
    },
    "1d_analysis": {
        "initial_info": {
            "account_number": "255767582837", 
            "first_date": "2025-04-18 11:05:00",
            "last_date": "2025-05-02 09:03:00", 
            "total_days": 14,
            "total_active_days": 8
        },
        "customer_profile": {
            "wallet_balance": 760,
            "total_turnover": 617924,
            "total_transactions": 17
        },
        "statement_check": {
            "isvalid": true
        }
    },
    "2d_analysis": {
        "total_cash_inflow": 315000,
        "cash_inflow": {
            "bank_to_wallet": {
                "total_amout": 75000,
                "percentage_of_total": 23.81
            },
            "p2p_received": {
                "total_amout": 40000,
                "percentage_of_total": 12.7
            }
        },
        "total_cash_outflow": 302924,
        "cash_outflow": {
            "p2p_sent": {
                "total_amout": 180424,
                "percentage_of_total": 59.56
            }
        }
    },
    "affordability_scores": {
        "rank": 2,
        "high": 19467,
        "moderate": 14600,
        "low": 9733
    }
}
JSON;

        // Parse the JSON string
        $this->statementData = json_decode($jsonString, true);
        
        // If you already have the data as an array, you can skip the json_decode step
        
        // Pass the data to the view
    }




    public function download($filePath)
    {
        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->download($filePath);
        }

        session()->flash('error', 'File not found.');
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

    // public function acceptApplication($id)
    // {
    //     $application = Application::findOrFail($id);
    //     $application->update(['application_status' => 'ACCEPTED']);

    //     session()->flash('message', 'Application accepted.');
    //     $this->resetView();
    // }

    // public function rejectApplication($id)
    // {
    //     $application = Application::findOrFail($id);
    //     $application->update(['application_status' => 'REJECTED']);

    //     session()->flash('message', 'Application rejected.');
    //     $this->resetView();
    // }

    private function resetView()
    {
        $this->selectedApplication = null;
    }



    public function actionFunction($status,$id){

        if($status=="REJECTED"){

            $stage="car_dealer";

        }else{

            $stage="statement_verification";
        }

        Application::find($id)->update([
            'application_status'=>$status,
            'stage_name'=>$stage,
        
        ]);
        session()->flash('message',"successfully status changed to {$status}");
    }

    public function render()
    {
        $query = Application::query();

        // get user institution id 

        $this->show();

        $userInstitutionid= auth()->user()->institution_id;

        // user permission id 

        $userPermissionId=auth()->user()->department;

        // filter for lender is 2 and for car dealer is 3 

        if($userPermissionId==3){

            $query->whereIn('application_status',['pending'])
            ->where('car_dealer_id',auth()->user()->institution_id);


        }else{

            $query->whereNotIn('application_status',['pending'])->where('lender_id', auth()->user()->institution_id);

        }

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
