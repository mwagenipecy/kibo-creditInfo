@component('mail::message')
# Employee Verification Request

Dear {{ $application->employer_name ?? 'Employer' }},

We are processing an application submitted by {{ $application->full_name ?? 'an employee' }} (Employee ID: {{ $application->employee_id ?? 'N/A' }}) and need to verify their employment details.

{!! nl2br(e($messageContent)) !!}

Please click the button below to provide verification of this employee's status:

@component('mail::button', ['url' => $verificationUrl, 'color' => 'green'])
Verify Employment
@endcomponent

**Important Information:**
- This link will expire in 7 days
- The verification process takes approximately 2-3 minutes
- Your response is confidential and will only be used for this application

If you have any questions or concerns, please contact our support team at {{ config('mail.from.address') }}.

**Note:** If you don't recognize this employee or believe this email was sent in error, you can indicate this in the verification form or simply disregard this message.

Thank you for your assistance,<br>
{{ config('app.name') }}

<small>This is an automated message. Please do not reply directly to this email.</small>
@endcomponent