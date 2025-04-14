<?php

namespace App\Services;

use App\Models\User;
use App\Mail\UserCredentials;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserService
{
    /**
     * Create a new user and send credentials via email.
     *
     * @param array $userData
     * @param bool $sendCredentials
     * @return User
     */
    public function createUser(array $userData, bool $sendCredentials = true): User
    {
        // Generate a random password if not provided
        $plainPassword = $userData['password'] ?? Str::random(10);
        
        // Hash the password for storage
        $userData['password'] = Hash::make($plainPassword);
        
        // Create the user
        $user = User::create($userData);
        
        // Send credentials email if requested
        if ($sendCredentials) {
            $this->sendCredentials($user, $plainPassword);
        }
        
        return $user;
    }
    
    /**
     * Send login credentials to a user via email.
     *
     * @param User $user
     * @param string $password
     * @return void
     */
    public function sendCredentials(User $user, string $password): void
    {
        Mail::to($user->email)->send(new UserCredentials($user, $password));
    }
    
    /**
     * Reset a user's password and send new credentials.
     *
     * @param User $user
     * @param string|null $newPassword
     * @return string The new password
     */
    public function resetPassword(User $user, ?string $newPassword = null): string
    {
        // Generate a random password if not provided
        $newPassword = $newPassword ?? Str::random(10);
        
        // Update the user's password
        $user->password = Hash::make($newPassword);
        $user->save();
        
        // Send the new credentials
        $this->sendCredentials($user, $newPassword);
        
        return $newPassword;
    }
}