@component('mail::message')
<img src="{{ asset('blite.png') }}" alt="Blitefood" style="max-width: 150px; margin-bottom: 20px;"><br><br>
# New Order Received

Hello Admin,

A new order has just been placed.

**Order Reference:** {{ $order->reference }}
**Customer Name:** {{ $order->user->name }}
**Email:** {{ $order->user->email }}
**Phone:** {{ $order->phone_number ?? '-' }}

@if ($order->order_type === 'delivery')
    **Shipping Address:**
    {{ $order->shippingAddress->address }},
    {{ $order->shippingAddress->city }},
    {{ $order->shippingAddress->shippingFee->state }},
    {{ $order->shippingAddress->country->name }}
    **ZIP Code:** {{ $order->shippingAddress->zip_code }}

@else
    **Order Type:** Pickup
@endif

@if($order->note)
    **Customer Note:**
    {{ $order->note }}
@endif

---

## Order Items

@component('mail::table')
| Item | Details | Quantity | Unit Price | Total |
| ------------ | -------------------------------| -------- | --------------------- | --------------------- |
@foreach($order->items as $item)
    @if ($item->product_type === 'food')
        | {{ $item->product->name }} | {{ $item->size->label ?? '-' }} | {{ $item->quantity }} |
        {{ Number::currency($item->unit_price, 'GBP') }} | {{ Number::currency($item->total, 'GBP') }} |
    @elseif($item->product_type === 'equipment')
        | {{ $item->product->name }} | Rental Start: {{ $item->rental_start }} ({{ $item->rental_duration }}hrs) |
        {{ $item->quantity }} | {{ Number::currency($item->unit_price, 'GBP') }} | {{ Number::currency($item->total, 'GBP') }} |
    @endif
@endforeach
@endcomponent

---

**Order Total:** {{ Number::currency($order->total_price, 'GBP') }}

@component('mail::button', ['url' => url('/admin/orders/')])
View Order in Admin Panel
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent