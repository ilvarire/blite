<div class="container">
    <div class="row">
        <div class="w-full px-[15px] mb-[30px]">
            <div class="table-responsive rounded-md overflow-x-auto min-w-[60rem]">
                <h4 class="mb-2.5">Order Details {{ '(' . count($order->items) . ')' }}</h4>
                <p class="mb-[15px] xl:w-[480px] w-full text-base">
                    Intiated: {{ $order->created_at->format('l jS F Y') }}<br>
                    Payment: {{ str($order->payment_status)->title() }}

                <div class="progress-bx style-1 relative overflow-hidden">
                    <h6 class="progress-label mb-[15px] font-medium tracking-[0.02em]">
                        Order Status: {{ str($order->status)->title() }}
                        @php
                            $width = match ($order->status) {
                                'processing' => 50,
                                'completed' => 100,
                                default => 4,
                            };
                        @endphp
                        <span class="pull-end absolute right-0">{{ $width }}%</span>
                    </h6>
                    <div
                        class="w-[480px] progress primary rounded-md m-b20 h-[3px] bg-[#D0D0D0] mb-[30px] overflow-visible">
                        <div class="progress-bar rounded-md bg-[#138919] flex flex-col justify-center overflow-hidden h-full"
                            role="progressbar" aria-valuenow="{{ $width }}" aria-valuemin="0" aria-valuemax="100"
                            style="width: {{ $width }}%">
                        </div>
                    </div>
                </div>
                <h4 class="text-[30px] mb-[5px]">Product Details</h4>
                <table class="border border-[#00000020] overflow-x-auto align-middle w-full">
                    <thead class="align-bottom">
                        <tr class="border-b border-[#00000020]">
                            <th class="text-left bg-[#222] p-[15px] text-base font-semibold text-white">Image</th>
                            <th class="text-left bg-[#222] p-[15px] text-base font-semibold text-white">Name</th>
                            <th class="text-left bg-[#222] p-[15px] text-base font-semibold text-white">Info</th>
                            <th class="text-left bg-[#222] p-[15px] text-base font-semibold text-white">Quantity</th>
                            <th class="text-left bg-[#222] p-[15px] text-base font-semibold text-white">Price</th>
                            <th class="text-left bg-[#222] p-[15px] text-base font-semibold text-white">Weight</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)

                            <tr class="border-b border-[#00000020]">
                                <td class="p-[15px] font-medium product-item-img"><img
                                        src="{{ $item->product_type === 'food' ? asset('storage/' . $item->product->image_url) : asset('storage/' . $item->product->images->first()->image_url) }}"
                                        alt="/" class="w-[100px] rounded-md">
                                </td>

                                <td class="p-[15px] font-medium text-bodycolor">
                                    <a href="{{ $item->product_type === 'food' ? route('food.details', $item->product->slug) : route('equipment.details', $item->product->slug)}}"
                                        class="cursor-pointer text-bodycolor">
                                        {{ $item->product->name }}
                                    </a>
                                </td>
                                @if ($item->product_type === 'food')
                                    <td class="p-[15px] font-medium text-bodycolor">
                                        {{-- {{ Number::currency($order->total_price, 'GBP') }} --}}
                                        Size: {{ $item->size }} <br>
                                    </td>
                                @elseif($item->product_type === 'equipment')
                                    <td class="p-[15px] font-medium text-bodycolor">
                                        {{-- {{ Number::currency($order->total_price, 'GBP') }} --}}
                                        Rental Start: {{ \Carbon\Carbon::parse($item->rental_start)->format('l jS F Y') }} <br>
                                        Duration: {{ $item->rental_duration . 'hrs' }} <br>
                                        Rental Ends: {{ \Carbon\Carbon::parse($item->rental_end)->format('l jS F Y') }} <br>
                                        Caution Fee: {{ Number::currency($item->caution_fee, 'GBP') }}
                                    </td>
                                @endif
                                <td class="p-[15px] font-medium text-bodycolor">
                                    {{ $item->quantity }}
                                </td>
                                <td class="p-[15px] font-medium text-bodycolor">
                                    {{ Number::currency($item->unit_price, 'GBP') }}
                                </td>
                                <td class="p-[15px] font-medium text-bodycolor">
                                    {{ $item->weight . 'kg' }}
                                </td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
                <br>
                @if ($order->order_type === 'delivery')
                    <h4 class="text-[30px] mb-[5px]">Delivery Details</h4>
                    <p class="mb-[10px] text-sm">
                        📍{{ $order->shippingAddress->address }}. <br>
                        CITY: {{ $order->shippingAddress->city }} <br>
                        REGION/PROVINCE: {{ $order->shippingAddress->shippingFee->state }}. <br>
                        STATE/COUNTY: {{ $order->shippingAddress->shippingFee->county->name }}. <br>
                        POST CODE: {{ $order->shippingAddress->zip_code }} <br>
                        📱PHONE NUMBER: {{ $order->shippingAddress->phone_number }} <br>
                    </p>
                @endif
                @if ($order->order_type === 'pickup')
                    <h5 class="mb-[10px] text-sm text-xl">Order Type: PICK UP</h5>
                @endif

            </div>
        </div>

    </div>
</div>