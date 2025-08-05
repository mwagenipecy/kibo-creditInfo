<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'otp_time',
        'otp',
        'department',
        'employeeId',
        'branch',
        'institution_id',
        'address',
        'phone_number',
        'status'
        // add this line to the array
    ];


    public function shop()
{
    return $this->belongsTo(Shop::class);
}



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getOtpTimeAttribute($value): ?\Carbon\Carbon
    {
        return $value ? \Carbon\Carbon::parse($value) : null;
    }

    public static function isEmailAvailable($email): bool
    {
        return static::where('email', $email)->count() == 0;
    }


    public function registerUser($email,$department,$name,$imployeeId,$password){


        User::create([
            'email'=>$email,
            'password'=>Hash::make($password),   // password is 1234567890
            'department'=>$department,
            'created_at'=>Carbon::now(),
             'updated_at'=>Carbon::now(),
            'name'=>$name,
            'employeeId'=>$imployeeId,
            'branch'=>auth()->user()->branch,
            'institution_id'=>auth()->user()->institution_id,
        ]);
        // send mail
    }



    public function needsOtpVerification()
    {
        return is_null($this->email_verified_at);
    }

    /**
     * Mark user as OTP verified
     *
     * @return void
     */
    public function markOtpAsVerified()
    {
        $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Get masked phone number for display
     *
     * @return string|null
     */
    public function getMaskedPhoneAttribute()
    {
        if (!$this->phone) {
            return null;
        }

        $phone = $this->phone;
        if (strlen($phone) >= 7) {
            return substr($phone, 0, 3) . '***' . substr($phone, -4);
        }

        return $phone;
    }

    /**
     * Get masked email for display
     *
     * @return string
     */
    public function getMaskedEmailAttribute()
    {
        $email = $this->email;
        $atPosition = strpos($email, '@');

        if ($atPosition > 1) {
            return substr($email, 0, 1) . '***' . substr($email, $atPosition);
        }

        return $email;
    }




}
