@component('mail::message')
# Your Account Has Been Created

Dear {{ $user->name }},

Your account has been successfully created on **{{ config('app.name') }}**. Below are your login credentials:

@component('mail::panel')
**Email/Username:** {{ $user->email }}  
**Password:** {{ $password }}
@endcomponent

For security reasons, we recommend changing your password after your first login.

@component('mail::button', ['url' => $loginUrl, 'color' => 'primary'])
Login to Your Account
@endcomponent

If you have any questions or need assistance, please contact our support team.

Thank you,<br>
{{ config('app.name') }}

<small>This email contains sensitive information. Please do not share it with anyone.</small>
@endcomponent