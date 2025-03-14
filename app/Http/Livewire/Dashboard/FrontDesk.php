<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\AccountsModel;
use App\Models\ClientsModel;
use App\Models\Employee;
use App\Models\general_ledger;
use App\Models\loans_schedules;
use App\Exports\LoanRepayment;
use App\Mail\LoanProgress;
use App\Models\LoansModel;
use App\Models\Teller;
use Carbon\Carbon;
use App\Http\Livewire\Document\StatementReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class FrontDesk extends Component
{
    use WithFileUploads;

    // Public Livewire variables
    public $firstname;
    public $middlename;
    public $lastname;
    public $nidanumber;
    public $phonenumber;
    public $region;
    public $district;
    public $ward;
    public $loan_product;
    public $amount2;
    public $email;
    public $accountSelected;

    // Car Details
    public $make_and_model;
    public $year_of_manufacture;
    public $vin;
    public $color;
    public $mileage;

    // Purchase Information
    public $purchase_price;
    public $down_payment;
    public $loan_amount;
    public $loan_term;

    public $amount3;



    public $images = [];
    public $uploadedImages = [];


    public $imagePreviews = []; // Stores temporary image previews

    // Validate images when they are updated
    public function updatedImages()
    {
//        $this->validate([
//            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:1024', // 1MB Max, specific file types
//        ]);

        // Generate temporary previews for the images
        $this->imagePreviews = [];
        foreach ($this->images as $image) {
            // Store the image in the 'public/assets/img/cars' directory
            $path = $image->store('public/assets/img/cars');

            // Remove the 'public/' prefix from the path for easier access
            $path = str_replace('public/', '', $path);

            // Insert the image path into the database
            DB::table('images')->insert([
                'url' => $path, // Save the path to the database
                'loan_id' => '1234',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Store the path in the uploadedImages array for display
            $this->uploadedImages[] = $path;
        }

        //dd($this->imagePreviews);
    }

    // Remove an image from the preview list
    public function removeImage($index)
    {
        array_splice($this->images, $index, 1); // Remove the image from the array
        array_splice($this->imagePreviews, $index, 1); // Remove the corresponding preview
    }

    // Save uploaded images
    public function save()
    {
        // Ensure there are images to process
        if (empty($this->images)) {
            session()->flash('error', 'No images selected for upload.');
            return;
        }

        try {
            foreach ($this->images as $image) {
                // Store the image in the 'public/assets/img/cars' directory
                $path = $image->store('public/assets/img/cars');

                // Remove the 'public/' prefix from the path for easier access
                $path = str_replace('public/', '', $path);

                // Store the path in the uploadedImages array
                $this->uploadedImages[] = $path;
            }

            // Flash success message
            session()->flash('success', 'Images uploaded successfully.');

            // Reset the images and previews after upload
            $this->reset(['images', 'imagePreviews']);
        } catch (\Exception $e) {
            // Handle any errors during the upload process
            session()->flash('error', 'An error occurred while uploading images: ' . $e->getMessage());
        }
    }



    public function downloadPDFFile(){
     $id=1;

     $value=new StatementReport();
     $value->Download(1);
      $this->emitTo('document.statement-report','downloadPDF',$id);

    }


    public  function downloadExcelFile(){

        $this->validate(['check_account_number'=>'required']);
        $getNumber=strlen($this->check_account_number);
        if($getNumber> 4){

            $getAcountNumber=AccountsModel::where('account_number',$this->check_account_number)->first();

            if($getAcountNumber){
                return    Excel::download(new  LoanRepayment([$getAcountNumber->account_number]) , 'loanSchedule.xlsx');

                // generate report here
            }else{
                Session::flash('error1', 'invalid input account number /client number');

            }
        }elseif($getNumber==4){
            $getAcountNumber=LoansModel::where('client_number',$this->check_account_number)->first();
             if($getAcountNumber){
                 return    Excel::download(new  LoanRepayment([$getAcountNumber->loan_account_number]) , 'loanSchedule.xlsx');
                 //   return    Excel::download(new  loans_schedules([$loandId]) , 'loanSchedule.xlsx');
                 // generate report here
             }else{
                 Session::flash('error1', 'invalid input account number /client number');
             }
        }
        else{
            Session::flash('error1', 'invalid input account number /client number');
        }
    }


    public function process1(){

//        $this->validate([
//            'firstname' => 'required|string',
//            'middlename' => 'required|string',
//            'lastname' => 'required|string',
//            'nidanumber' => 'required|string',
//            'phonenumber' => 'required|string',
//            'region' => 'required|string',
//            'district' => 'required|string',
//            'ward' => 'required|string',
//            'loan_product' => 'required',
//            'amount2' => 'required|numeric', // You can adjust the validation rules
//            'email' => 'required|string',
//            'make_and_model' => 'required|string',
//            'year_of_manufacture' => 'required|string',
//            'vin' => 'required|string',
//            'color' => 'required|string',
//            'mileage' => 'required|string',
//            'purchase_price' => 'required|string',
//            'down_payment' => 'required|string',
//            'loan_amount' => 'required|string'
//        ]);



        $id=  ClientsModel::create([
            'first_name' => $this->firstname,
            'middle_name' => $this->middlename,
            'last_name' => $this->lastname,
            'phone_number' => $this->phonenumber,
            'national_id' => $this->nidanumber,
            'region' => $this->region,
            'district' => $this->district,
            'street' => $this->ward,
            'amount' => $this->loan_amount,
            'email' => $this->email,
            'client_status' => "NEW CLIENT"
        ])->id;

        // Insert a new item and get the ID
        $itemId = DB::table('items')->insertGetId([
            'make_and_model' => $this->make_and_model,
            'year_of_manufacture' => $this->year_of_manufacture,
            'vin' => $this->vin,
            'color' => $this->color,
            'mileage' => $this->mileage,
            'purchase_price' => $this->purchase_price,
            'down_payment' => $this->down_payment,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $loan_id =  LoansModel::create([
            'principle'=>$this->loan_amount,
            'client_id'=>$id,
            'client_number'=>DB::table('clients')->where('id',$id)->value('client_number'),
            'loan_sub_product'=>$this->loan_product,
            'pay_method'=>'',
            'bank'=>'',
            'bank_account_number'=>'',
            'LoanPhoneNo'=>$this->phonenumber,
            'status'=>'NEW LOAN',
            'interest'=>DB::table('loan_sub_products')->where('sub_product_id',$this->loan_product)->value('interest_value'),
            'tenure'=>DB::table('loan_sub_products')->where('sub_product_id',$this->loan_product)->value('interest_tenure'),
            'supervisor_id'=> 1,
            'item_id'=>$itemId
        ])->id;


        // Insert a new item and get the ID
        $itemId = DB::table('applications')->insertGetId([
            'first_name' => $this->firstname,
            'middle_name' => $this->middlename,
            'last_name' => $this->lastname,
            'phone_number' => $this->phonenumber,
            'national_id' => $this->nidanumber,
            'region' => $this->region,
            'district' => $this->district,
            'street' => $this->ward,
            'amount' => $this->amount2,
            'email' => $this->email,
            'application_status' => "NEW CLIENT",
            'make_and_model' => $this->make_and_model,
            'year_of_manufacture' => $this->year_of_manufacture,
            'vin' => $this->vin,
            'color' => $this->color,
            'mileage' => $this->mileage,
            'purchase_price' => $this->purchase_price,
            'down_payment' => $this->down_payment,
            'loan_amount' => $this->loan_amount,
            'loan_id' => $loan_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);



        //Mail::to($this->email)->send(new LoanProgress($this->phonenumber, $this->firstname,'We acknowledge the successful receipt of your loan application. Our team is now processing it and will be in touch shortly regarding further stages '));

        $this->resetLoanRepayment();
        session()->flash('message_2','Successfully saved');
        // Clear input fields after successful insert
        $this->reset();

    }


    public function updatedDown_payment(){
        dd('dd');
    }


    function saveCarsToDatabase($jsonFilePath)
    {





        try {

            // Increase memory limit
            ini_set('memory_limit', '2560M');

            // Check if the file exists
            if (!file_exists($jsonFilePath)) {
                throw new \Exception('File not found: ' . $jsonFilePath);
            }

            // Read JSON file
            $jsonContent = file_get_contents($jsonFilePath);

            // Decode JSON content
            $carsData = json_decode($jsonContent, true);

            // Check if decoding was successful
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Error decoding JSON: ' . json_last_error_msg());
            }

            // Iterate through each car data and insert into the 'cars' table
            // Iterate through each car data and insert into the 'cars' table
            foreach ($carsData as $car) {

                //dd($car);
                // Extracting necessary fields
                $carData = [
                    'make' => $car['make'],
                    'model' => $car['model'],
                    'year' => $car['year'],
                    'city_mpg' => $car['city08'],
                    'highway_mpg' => $car['highway08'],
                    'combined_mpg' => $car['comb08'],
                    'cylinders' => $car['cylinders'],
                    'displacement' => $car['displ'],
                    'fuel_type' => $car['fueltype1'],
                    'co2_emission' => $car['co2tailpipegpm'],
                    'fuel_cost_city' => $car['fuelcost08'],
                    'drive_type' => $car['drive'],
                    'transmission' => $car['trany'],
                    'vehicle_class' => $car['vclass'],
                    'you_save_spend' => $car['yousavespend'],
                    'base_model' => $car['basemodel'],
                    'engine_id' => $car['engid'],
                    'engine_description' => $car['eng_dscr'][0],
                ];

                try {
                    // Insert into the 'cars' table
                    DB::table('cars')->insert($carData);
                }catch (\Exception $e){
                    dd($e);
                }


            }

        } catch (\Exception $e) {
            // Handle exceptions
            dd($e->getMessage());
        }


    }


    public function setAccount($account){
        $this->accountSelected=$account;
    }

    public function resetLoanRepayment(){
        // Reset Livewire variables after processing
        $this->reset([
            'firstname',
            'middlename',
            'lastname',
            'nidanumber',
            'phonenumber',
            'region',
            'district',
            'ward',
            'loan_product',
            'amount2',
        ]);
    }




    public function render()
    {


        $this->amount3=600;
        $this->amount3=$this->amount3 ?: null;


        return view('livewire.dashboard.front-desk');
    }
}

