<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\ClearingForwardingCompany;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CFCompanyManagement extends Component
{
    use WithPagination, WithFileUploads;

    public $activeTab = 'companies';
    public $statusFilter = '';
    public $searchTerm = '';
    public $showModal = false;
    public $modalMode = 'create'; // 'create', 'edit', 'view'
    public $selectedCompany;

    // Company form properties
    public $company_name = '';
    public $registration_number = '';
    public $tra_license_number = '';
    public $contact_person_name = '';
    public $contact_person_position = '';
    public $phone_number = '';
    public $email = '';
    public $physical_address = '';
    public $postal_address = '';
    public $region = '';
    public $city = '';
    public $website = '';
    public $years_in_operation = '';
    public $specializations = [];
    public $service_ports = [];
    public $average_clearance_time_days = '';
    public $languages_supported = '';
    public $operating_hours = '';
    public $verification_documents = [];
    public $status = 'PENDING';

    // User creation properties
    public $showUserModal = false;
    public $user_name = '';
    public $user_email = '';
    public $user_password = '';
    public $user_phone_number = '';
    public $user_role = 'cf_company';

    protected $rules = [
        'company_name' => 'required|string|max:255',
        'registration_number' => 'required|string|max:100',
        'tra_license_number' => 'required|string|max:100',
        'contact_person_name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'physical_address' => 'required|string',
        'region' => 'required|string|max:100',
        'city' => 'required|string|max:100',
        'years_in_operation' => 'nullable|integer|min:0|max:100',
        'average_clearance_time_days' => 'nullable|integer|min:1|max:30',
    ];

    protected $userRules = [
        'user_name' => 'required|string|max:255',
        'user_email' => 'required|email|max:255|unique:users,email',
        'user_password' => 'required|string|min:8',
        'user_phone_number' => 'nullable|string|max:20',
    ];

    public function mount()
    {
        $this->resetForm();
    }

    public function updatedStatusFilter()
    {
        $this->resetPage();
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function openModal($mode, $companyId = null)
    {
        $this->modalMode = $mode;
        
        if ($companyId) {
            $this->selectedCompany = ClearingForwardingCompany::findOrFail($companyId);
            $this->populateForm($this->selectedCompany);
        } else {
            $this->resetForm();
        }
        
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
        $this->resetValidation();
    }

    public function openUserModal($companyId)
    {
        $this->selectedCompany = ClearingForwardingCompany::findOrFail($companyId);
        $this->user_email = $this->selectedCompany->email;
        $this->user_name = $this->selectedCompany->contact_person_name;
        $this->user_phone_number = $this->selectedCompany->phone_number;
        $this->showUserModal = true;
    }

    public function closeUserModal()
    {
        $this->showUserModal = false;
        $this->resetUserForm();
        $this->resetValidation();
    }

    protected function resetForm()
    {
        $this->company_name = '';
        $this->registration_number = '';
        $this->tra_license_number = '';
        $this->contact_person_name = '';
        $this->contact_person_position = '';
        $this->phone_number = '';
        $this->email = '';
        $this->physical_address = '';
        $this->postal_address = '';
        $this->region = '';
        $this->city = '';
        $this->website = '';
        $this->years_in_operation = '';
        $this->specializations = [];
        $this->service_ports = [];
        $this->average_clearance_time_days = '';
        $this->languages_supported = '';
        $this->operating_hours = '';
        $this->verification_documents = [];
        $this->status = 'PENDING';
        $this->selectedCompany = null;
    }

    protected function resetUserForm()
    {
        $this->user_name = '';
        $this->user_email = '';
        $this->user_password = '';
        $this->user_phone_number = '';
        $this->user_role = 'cf_company';
    }

    protected function populateForm($company)
    {
        $this->company_name = $company->company_name;
        $this->registration_number = $company->registration_number;
        $this->tra_license_number = $company->tra_license_number;
        $this->contact_person_name = $company->contact_person_name;
        $this->contact_person_position = $company->contact_person_position;
        $this->phone_number = $company->phone_number;
        $this->email = $company->email;
        $this->physical_address = $company->physical_address;
        $this->postal_address = $company->postal_address;
        $this->region = $company->region;
        $this->city = $company->city;
        $this->website = $company->website;
        $this->years_in_operation = $company->years_in_operation;
        $this->specializations = $company->specializations ?? [];
        $this->service_ports = $company->service_ports ?? [];
        $this->average_clearance_time_days = $company->average_clearance_time_days;
        $this->languages_supported = $company->languages_supported;
        $this->operating_hours = $company->operating_hours;
        $this->status = $company->status;
    }

    public function save()
    {
        $rules = $this->rules;
        
        if ($this->modalMode === 'edit' && $this->selectedCompany) {
            $rules['email'] = ['required', 'email', 'max:255', Rule::unique('clearing_forwarding_companies')->ignore($this->selectedCompany->id)];
            $rules['tra_license_number'] = ['required', 'string', 'max:100', Rule::unique('clearing_forwarding_companies')->ignore($this->selectedCompany->id)];
        } else {
            $rules['email'] = 'required|email|max:255|unique:clearing_forwarding_companies,email';
            $rules['tra_license_number'] = 'required|string|max:100|unique:clearing_forwarding_companies,tra_license_number';
        }

        $this->validate($rules);

        try {
            DB::beginTransaction();

            $data = [
                'company_name' => $this->company_name,
                'registration_number' => $this->registration_number,
                'tra_license_number' => $this->tra_license_number,
                'contact_person_name' => $this->contact_person_name,
                'contact_person_position' => $this->contact_person_position,
                'phone_number' => $this->phone_number,
                'email' => $this->email,
                'physical_address' => $this->physical_address,
                'postal_address' => $this->postal_address,
                'region' => $this->region,
                'city' => $this->city,
                'website' => $this->website,
                'years_in_operation' => $this->years_in_operation ?: null,
                'specializations' => $this->specializations,
                'service_ports' => $this->service_ports,
                'average_clearance_time_days' => $this->average_clearance_time_days ?: null,
                'languages_supported' => $this->languages_supported,
                'operating_hours' => $this->operating_hours,
                'status' => $this->status,
            ];

            if ($this->modalMode === 'edit' && $this->selectedCompany) {
                $this->selectedCompany->update($data);
                $message = 'CF Company updated successfully!';
            } else {
                ClearingForwardingCompany::create($data);
                $message = 'CF Company created successfully!';
            }

            DB::commit();
            session()->flash('success', $message);
            $this->closeModal();

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'An error occurred while saving the company.');
            \Log::error('CF Company save error: ' . $e->getMessage());
        }
    }

    public function createUser()
    {
        $rules = $this->userRules;
        
        // Check if user already exists for this company
        $existingUser = User::where('email', $this->user_email)->first();
        if ($existingUser) {
            $rules['user_email'] = 'required|email|max:255'; // Remove unique constraint
        }

        $this->validate($rules);

        try {
            DB::beginTransaction();

            if ($existingUser) {
                // Update existing user
                $existingUser->update([
                    'name' => $this->user_name,
                    'phone_number' => $this->user_phone_number,
                ]);
                $message = 'User updated successfully!';
            } else {
                // Create new user
                User::create([
                    'name' => $this->user_name,
                    'email' => $this->user_email,
                    'password' => Hash::make($this->user_password),
                    'phone_number' => $this->user_phone_number,
                    //'role' => $this->user_role,
                    'status' => 'ACTIVE',
                    'department' => 5,
                ]);
                $message = 'User created successfully!';
            }

            DB::commit();
            session()->flash('success', $message);
            $this->closeUserModal();

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'An error occurred while creating the user.');
            \Log::error('User creation error: ' . $e->getMessage());
        }
    }

    public function updateStatus($companyId, $newStatus)
    {
        try {
            $company = ClearingForwardingCompany::findOrFail($companyId);
            $company->update([
                'status' => $newStatus,
                'verified_at' => $newStatus === 'APPROVED' ? now() : null,
                'verified_by' => auth()->id(),
            ]);

            session()->flash('success', "Company status updated to {$newStatus}");

        } catch (\Exception $e) {
            session()->flash('error', 'Error updating company status.');
        }
    }

    public function deleteCompany($companyId)
    {
        try {
            $company = ClearingForwardingCompany::findOrFail($companyId);
            
            // Check if company has active quotations
            if ($company->quotations()->whereIn('status', ['SUBMITTED', 'SELECTED'])->exists()) {
                session()->flash('error', 'Cannot delete company with active quotations.');
                return;
            }

            $company->delete();
            session()->flash('success', 'Company deleted successfully.');

        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting company.');
        }
    }

    public function getCompanies()
    {
        $query = ClearingForwardingCompany::query();

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('company_name', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('tra_license_number', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('contact_person_name', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $this->searchTerm . '%');
            });
        }

        return $query->orderBy('created_at', 'desc')->paginate(15);
    }

    public function getCompanyStats()
    {
        return [
            'total' => ClearingForwardingCompany::count(),
            'pending' => ClearingForwardingCompany::where('status', 'PENDING')->count(),
            'approved' => ClearingForwardingCompany::where('status', 'APPROVED')->count(),
            'rejected' => ClearingForwardingCompany::where('status', 'REJECTED')->count(),
            'suspended' => ClearingForwardingCompany::where('status', 'SUSPENDED')->count(),
            'recent' => ClearingForwardingCompany::where('created_at', '>=', now()->subDays(7))->count(),
        ];
    }

    public function getSpecializationOptions()
    {
        return [
            'vehicles' => 'Motor Vehicles',
            'machinery' => 'Heavy Machinery',
            'electronics' => 'Electronics',
            'textiles' => 'Textiles & Clothing',
            'food_beverages' => 'Food & Beverages',
            'chemicals' => 'Chemicals',
            'pharmaceuticals' => 'Pharmaceuticals',
            'general_cargo' => 'General Cargo',
        ];
    }

    public function getServicePortOptions()
    {
        return [
            'dar_es_salaam' => 'Dar es Salaam',
            'mtwara' => 'Mtwara',
            'tanga' => 'Tanga',
            'mwanza' => 'Mwanza',
            'dodoma' => 'Dodoma',
        ];
    }

    public function render()
    {
        $companies = $this->getCompanies();
        $stats = $this->getCompanyStats();
        $specializationOptions = $this->getSpecializationOptions();
        $servicePortOptions = $this->getServicePortOptions();

        return view('livewire.admin.c-f-company-management', [
            'companies' => $companies,
            'stats' => $stats,
            'specializationOptions' => $specializationOptions,
            'servicePortOptions' => $servicePortOptions,
        ]);
    }


    
}
