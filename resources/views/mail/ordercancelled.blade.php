@component('mail::message')
<img src="{{ asset('blite.png') }}" alt="Blitefood" style="max-width: 150px; margin-bottom: 20px;"><br><br>
# Order Cancelled

We regret to inform you that your order has been cancelled due to unforeseen circumstances.

**Order Reference:** {{ $order->reference }}
**Total Amount:** {{ Number::currency($order->total_price, 'GBP') }}
**Order Date:** {{ $order->created_at->format('d M Y, H:i') }}

If you made any payment, a refund will be processed within 48 hours.

If you have any questions or need assistance, please don’t hesitate to contact our support team.

Thanks for your understanding,
{{ config('app.name') }}
@endcomponent