<p>Hello {{ $user->f_name }},</p>
<p>Click the link below to verify your email:</p>
<a href="{{ url('/verify-email/' . $user->email_verification_token) }}">Verify Email</a>
<p>Thank you!</p>
