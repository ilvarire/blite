@component('mail::message')
<img src="{{ asset('blite.png') }}" alt="Blitefood" style="max-width: 150px; margin-bottom: 20px;"><br>
# Checkout Account Modification Alert

Hello Admin,

The site checkout account details were modified on {{ now()->format('d M Y, H:i') }}.

If you did not authorize this change, please log in immediately and update your password to secure your account.


Thanks,
{{ config('app.name') }}
@endcomponent