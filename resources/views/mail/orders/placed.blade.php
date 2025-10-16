@component('mail::message')
<img src="{{ asset('blite.png') }}" alt="Blitefood" style="max-width: 150px; margin-bottom: 20px;"><br><br>
# Order Placed Successfully!

Thank you for your payment of {{ Number::currency($order->total_price, 'GBP') }}.
Your order has been confirmed and is now being processed.

Your order reference is **{{ $order->reference }}**.

We’ll keep you updated with the progress and notify you once your order is shipped.

@component('mail::button', ['url' => $url])
View Order Details
@endcomponent

Thanks for choosing {{ config('app.name') }}!
If you have any questions, feel free to reach out to our support team.

Best regards,
{{ config('app.name') }}
@endcomponent