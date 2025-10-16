@component('mail::message')
<img src="{{ asset('blite.png') }}" alt="Blitefood" style="max-width: 150px; margin-bottom: 20px;"><br><br>
# Order Completed

Good news! Your order **{{ $ref }}** has been successfully completed.

We’d love to hear your feedback—please take a moment to rate the products you received to help us improve our service.

Thank you for choosing us. We look forward to serving you again soon!

Thanks,
{{ config('app.name') }}
@endcomponent