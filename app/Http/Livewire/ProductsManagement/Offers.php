<?php

namespace App\Http\Livewire\ProductsManagement;

use App\Models\OffersModel;
use App\Models\Employee;
use App\Models\LoansModel;
use App\Models\PendingRegistration;
use App\Models\TeamUser;
use App\Models\User;
use App\Mail\LoanProgress;
use Exception;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use App\Models\MembersModel;
use App\Models\approvals;
use App\Models\AccountsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class Offers extends Component
{

    use WithFileUploads;

    public $tab_id = '1';
    public $title = 'Members list';
    public $selected;
    public $activeOffersCount;
    public $inactiveOffersCount;
    public $showCreateNewMember;
    public $membershipNumber;
    public $parentMember;
    public $showDeleteOffer;
    public $offerSelected;
    public $showEditOffer;
    public $pendingMember;
    public $MembersList;
    public $pendingOffername;
    public $offer;
    public $showAddOffer;
    public $nationarity;


    public $email;
    public $Member_status;
    public $permission = 'BLOCKED';
    public $password;

    public $photo;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $branch;
    public $registering_officer;
    public $supervising_officer;
    public $approving_officer;
    public $membership_type;
    public $incorporation_number;
    public $phone_number;
    public $mobile_phone_number;
    public $date_of_birth;
    public $gender;
    public $marital_status;
    public $membership_number;
    public $registration_date;
    public $street;
    public $address;
    public $notes;
    public $current_team_id;
    public $profile_photo_path;
    public $branch_id;
    public $business_name;
    public $name;
    public $member;

    public $confirmingUserDeletion = false;
    public $branches;


    public $sub_product_number_shares ='1199';
    public $sub_product_number_savings='1279';
    public $sub_product_number_deposits='1321';
    public $place_of_birth;
    public $next_of_kin_name;
    public $next_of_kin_phone;
    public $tin_number;
    public $nida_number;
    public $ref_number;
    public $shares_ref_number;
    public $member_exit_document;

    // vie members modal
    public $viewOfferDetails=false;
    public $loanStatus;


    public $account_number;
    public $institution_id;

    public $offer_number;


    public $created_at;
    public $updated_at;

    public $end_membership_description;
    public $amount;
    public $national_id;
    public $offer_id;
    public $customer_code;
    public $present_surname;
    public $birth_surname;
    public $number_of_spouse;
    public $number_of_children;
    public $classification_of_individual;

    public $country_of_birth;
    public $fate_status;
    public $social_status;
    public $residency;
    public $citizenship;
    public $nationality;
    public $employment;
    public $employer_name;
    public $education;
    public $income_available;
    public $monthly_expenses;
    public $negative_status_of_individual;
    public $tax_identification_number;
    public $passport_number;
    public $passport_issuer_country;
    public $driving_license_number;
    public $voters_id;
    public $foreign_unique_id;
    public $custom_id_number_1;
    public $custom_id_number_2;
    public $main_address;
    public $number_of_building;
    public $postal_code;
    public $region;
    public $district;
    public $country;
    public $viewpaid = false;
    public $viewnotpaid = false;
    public $allMembers = true;
    public $mobile_phone;
    public $fixed_line;
    public $web_page;
    public $trade_name;
    public $legal_form;
    public $establishment_date;
    public $registration_country;
    public $industry_sector;
    public $registration_number;
    public $variables;
    public $middle_names;
    public $viewOfferLoanData=false;

    public $isOpen = false;
    public $principle;
public $make_and_model;
public $purchase_price;
public $schedule;
public $table;
public $tablefooter;
    public $interest;
    public $tenure;
    public $offerId;

    protected $listeners = ['viewOfferDetails' => 'handleViewOfferDetails'];

    public function handleViewOfferDetails($id)
    {
        $this->offerId = $id;
        $this->principle = DB::table('offers')->where('id', $id)->value('principle');
        $this->interest = DB::table('offers')->where('id', $id)->value('interest');
        $this->tenure = DB::table('offers')->where('id', $id)->value('tenure');
        $this->make_and_model = DB::table('offers')->where('id', $id)->value('make_and_model');
        $this->purchase_price = DB::table('offers')->where('id', $id)->value('purchase_price');
        $this->schedule = DB::table('offers')->where('id', $id)->value('schedule');
        $this->table = json_decode($this->schedule, true);

        $datalistfooter[] = array(
            "Payment" => 0,
            "Interest" => 0,
            "Principle" => 0,
            "balance" => 0
        );

        $this->tablefooter = $datalistfooter;

        $this->isOpen = true;
    }

    public function accept()
    {
        DB::table('offers')->where('id',$this->offerId)->update(['offer_status' => 'ACCEPTED']);
        $this->isOpen = false;
    }
    public function decline()
    {
        DB::table('offers')->where('id',$this->offerId)->update(['offer_status' => 'DECLINED']);
        $this->isOpen = false;
    }
    public function openModal()
    {
        $this->isOpen = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.products-management.offers');
    }
}
