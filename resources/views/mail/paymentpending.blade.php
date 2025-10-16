@component('mail::message')
<img src="{{ asset('blite.png') }}" alt="Blitefood" style="max-width: 150px; margin-bottom: 20px;"><br>


# Your Order is Pending

Thank you for your order!

We’ve received your order with a total amount of {{ Number::currency($order->total_price, 'GBP') }}, but your payment is
still pending confirmation.

Your order reference is **{{ $order->reference }}**.
Please use this reference as the transfer narration to help us identify your payment.

We’ll notify you as soon as your payment is confirmed.

@component('mail::button', ['url' => $url])
View Payment Details
@endcomponent

Thank you for choosing {{ config('app.name') }}!
If you have any questions, feel free to contact our support team.

Best regards,
{{ config('app.name') }}
@endcomponent