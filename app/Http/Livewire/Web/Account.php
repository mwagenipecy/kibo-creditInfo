<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class Account extends Component
{
    use WithFileUploads;

    // Personal Information
    public $name;
    public $email;
    public $phone;
    public $address;
    public $photo;
    public $currentPhoto;

    // Security
    public $current_password;
    public $password;
    public $password_confirmation;

    // Active tab
    public $activeTab = 'profile';
    
    // Delete account modal
    public $showDeleteModal = false;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount()
    {
        $user = Auth::user();
        if(!$user){

            return redirect()->route('client.registration');
        }
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone_number ?? '';
        $this->address = $user->address ?? '';
        $this->currentPhoto = $user->profile_photo_path;
    }

    /**
     * Update personal information
     */
    public function updateProfile()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone_number = $validatedData['phone'];
        $user->address = $validatedData['address'];

        if ($this->photo) {
            // Delete old photo if exists
            if ($user->profile_photo_path && Storage::exists('public/' . $user->profile_photo_path)) {
                Storage::delete('public/' . $user->profile_photo_path);
            }
            
            // Store new photo
            $photoPath = $this->photo->store('profile-photos', 'public');
            $user->profile_photo_path = $photoPath;
            $this->currentPhoto = $photoPath;
        }

        $user->save();

        $this->reset('photo');
        session()->flash('success', 'Profile information has been updated successfully.');
    }

    /**
     * Update password
     */
    public function updatePassword()
    {
        $validatedData = $this->validate([
            'current_password' => 'required|current_password',
            'password' => ['required', 'confirmed', Password::min(8)
                ->mixedCase()
                ->numbers()
                ->symbols()
            ],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($validatedData['password']);
        $user->save();

        $this->reset(['current_password', 'password', 'password_confirmation']);
        session()->flash('success', 'Password has been updated successfully.');
    }

    /**
     * Delete user account
     */
    public function deleteAccount()
    {
        // Show confirmation modal
        $this->showDeleteModal = true;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    /**
     * Cancel account deletion
     */
    public function cancelDeleteAccount()
    {
        $this->showDeleteModal = false;
    }

    /**
     * Confirm account deletion
     */
    public function confirmDeleteAccount()
    {
        $user = Auth::user();
        
        // Delete profile photo if exists
        if ($user->profile_photo_path && Storage::exists('public/' . $user->profile_photo_path)) {
            Storage::delete('public/' . $user->profile_photo_path);
        }
        
        // Logout (use session/web guard) and mark account deleted
        Auth::guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        $user->update([
            'status'=>'DELETED'
        ]);
        
        return redirect()->route('home.page')->with('success', 'Your account has been permanently deleted.');
    }

    /**
     * Set active tab
     */
    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.web.account');
    }
}