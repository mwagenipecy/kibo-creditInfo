@extends('emails.layouts.base')

@section('title', 'Welcome to KiboAuto - Your Account Credentials')

@section('promo-banner')
 Welcome to KiboAuto! Your account is ready with access to premium automotive services.
@endsection

@section('content')
<div class="text-center">
    <h2> Welcome to KiboAuto!</h2>
    <p>Dear <strong>{{ $user->name }}</strong>,</p>
    <p>Congratulations! Your account has been successfully created and you now have access to our comprehensive automotive platform.</p>
</div>

<div class="info-box success">
    <h3 style="margin-top: 0; color: #155724;"> Your Login Credentials</h3>
    <div style="background: #ffffff; border: 2px solid #28a745; padding: 20px; border-radius: 8px; margin: 15px 0;">
        <table class="table" style="margin: 0;">
            <tr>
                <td style="background: #f8f9fa; font-weight: bold; color: #495057;">📧 Email/Username:</td>
                <td style="background: #ffffff; font-family: monospace; color: #28a745;">{{ $user->email }}</td>
            </tr>
            <tr>
                <td style="background: #f8f9fa; font-weight: bold; color: #495057;">Password:</td>
                <td style="background: #ffffff; font-family: monospace; color: #28a745;">{{ $password }}</td>
            </tr>
        </table>
    </div>
    <p style="margin: 0; color: #155724;"><strong>🔒 Keep these credentials secure and don't share them with anyone!</strong></p>
</div>

<div class="btn-center">
    <a href="{{ $loginUrl }}" class="btn btn-success">🚀 Login to Your Account</a>
</div>

<div class="info-box">
    <h4>🛡️ Security Recommendations:</h4>
    <ul style="margin: 0; padding-left: 20px;">
        <li><strong>Change your password</strong> after your first login for enhanced security</li>
        <li>Use a strong, unique password that you don't use elsewhere</li>
        <li>Enable two-factor authentication if available</li>
        <li>Never share your login credentials with anyone</li>
    </ul>
</div>



<div class="text-center mt-20">
    <p style="color: #666; font-size: 14px;">
        Having trouble logging in? Contact our support team for assistance.
    </p>
</div>


@endsection