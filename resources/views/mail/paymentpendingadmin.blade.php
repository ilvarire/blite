@component('mail::message')
<img src="{{ asset('blite.png') }}" alt="Blitefood" style="max-width: 150px; margin-bottom: 20px;"><br>
# New Order Pending Payment

Hello Admin,

A new order has been placed and is awaiting payment confirmation.

**Order Reference:** {{ $order->reference }}
**Total Amount:** {{ Number::currency($order->total_price, 'GBP') }}
**Order Date:** {{ $order->created_at->format('d M Y, H:i') }}

Please review the order and monitor for payment confirmation.

@component('mail::button', ['url' => $url])
View Order Details
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent