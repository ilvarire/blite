<div class="container">
    <form class="shop-form">
        <div class="row">
            <div class="lg:w-1/2 w-full px-[15px]">
                <div class="widget mb-[50px]">
                    <h4 class="widget-title xl:mb-[30px] mb-5 pb-3 relative">Billing & Shipping Address</h4>
                    <div class="form-group mb-5 inline-block w-full">
                        <div class="w-full">
                            <label for="orderType" class="text-yellow mb-2 text-md">
                                ORDER TYPE
                            </label>
                        </div>
                        <select wire:model.live="orderType" id="orderType"
                            class="form-select mb-4 ignore py-[10px] h-[50px] px-5 text-bodycolor bg-white border border-bodycolor rounded-md after:border-black2 after:w-2 after:right-5 after:top-[60%] w-full">
                            <option value="pickup">Pick Up</option>
                            <option value="delivery">Delivery</option>
                        </select>
                        @error('orderType')
                            <span class="text-xs text-danger">
                                {{$message}}
                            </span>
                        @enderror
                    </div>

                    @if($orderType === 'pickup')
                        <!-- Pickup Location -->
                        <p class="text-base mb-4">
                            Pickup Location: <strong class="mb-2">
                                {{ $pickup_location }}.
                            </strong><br>
                            Time: <strong class="mb-2">
                                {{ $pickup_time }}
                            </strong>
                        </p>
                    @elseif($orderType === 'delivery')
                        <div class="form-group mt-5 mb-5 inline-block w-full">
                            <select wire:model.live="county_id"
                                class="form-select ignore py-[10px] px-5  h-[50px] text-bodycolor rounded-md after:border-black2 after:h-2 after:w-2 after:right-5 after:top-[60%] w-full">
                                <option value="">Select County</option>
                                @foreach ($counties as $county)
                                    <option value="{{ $county->id}}">{{ $county->name}}</option>
                                @endforeach
                            </select>
                            @error('county_id')
                                <span class="text-xs text-danger">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-5 inline-block w-full">
                            <select wire:model.live="state_id"
                                class="form-select ignore py-[10px] px-5  h-[50px] text-bodycolor rounded-md after:border-black2 after:h-2 after:w-2 after:right-5 after:top-[60%] w-full">
                                <option value="">Select City/Province</option>
                                @if ($states)
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->state }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('state_id')
                                <span class="text-xs text-danger">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-5">
                            <input wire:model="address" type="text"
                                class="h-[50px] py-[10px] px-5 w-full text-[15px] rounded-[6px] placeholder:text-[#666666] focus:border-primary duration-500"
                                placeholder="Address" autocomplete="address">
                            @error('address')
                                <span class="text-xs text-danger">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="form-group md:w-1/2 w-full px-[15px] mb-5">
                                <input wire:model="city" value="{{ old('city') }}" type="text"
                                    class="h-[50px] py-[10px] px-5 w-full text-[15px] rounded-[6px] placeholder:text-[#666666] focus:border-primary duration-500"
                                    placeholder="Town/City" autocomplete="city">
                                @error('city')
                                    <span class="text-xs text-danger">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group md:w-1/2 w-full px-[15px] mb-5">
                                <input wire:model="zip_code" value="{{ old('zip_code') }}" type="text"
                                    class="h-[50px] py-[10px] px-5 w-full text-[15px] rounded-[6px] placeholder:text-[#666666] focus:border-primary duration-500"
                                    placeholder="Post Code" autocomplete="post code">
                                @error('zip_code')
                                    <span class="text-xs text-danger">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @endif
                    <div class="row mt-5">
                        <div class="form-group md:w-1/2 w-full px-[15px] mb-5">
                            <input wire:model="phone_number" type="tel"
                                class="h-[50px] py-[10px] px-5 w-full text-[15px] rounded-[6px] placeholder:text-[#666666] focus:border-primary duration-500"
                                placeholder="Enter Phone Number" autocomplete="phone number">
                            @error('phone_number')
                                <span class="text-xs text-danger">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group md:w-1/2 w-full px-[15px] mb-5">
                            <input wire:model.defer="coupon" type="text"
                                class="h-[50px] py-[10px] px-5 w-full text-[15px] rounded-[6px] placeholder:text-[#666666] focus:border-primary duration-500"
                                placeholder="Enter Coupon">
                            @error('coupon')
                                <span class="text-xs text-danger">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group md:w-1/2 w-full px-[15px] mb-5">
                            <button wire:click="applyCoupon" type="button"
                                class="btn bg-[#F3F3F3] gap-[10px] mb-4 shadow-none btn-gray hover:bg-primary hover:text-white">
                                Apply Code
                            </button>
                        </div>
                    </div>
                    <br>
                    <h4 class="widget-title xl:mb-[30px] mb-5 pb-3 relative"></h4>
                    <div class="row mt-5">
                        <div class="w-full">
                            <p for="orderType" class="text-yellow px-[15px] text-sm">
                                DESIRED DELIVERY DATE
                            </p>
                        </div>
                        <div class="form-group md:w-1/2 w-full px-[15px] mb-5">
                            <input wire:model="delivery_date" type="datetime-local"
                                min="{{ now()->addMinutes(1440)->format('Y-m-d\TH:i') }}"
                                placeholder="Enter Delivery Date"
                                class="h-[50px] py-[10px] px-5 w-full text-[15px] rounded-[6px] placeholder:text-[#666666] focus:border-primary duration-500">
                            @error('delivery_date')
                                <span class="text-xs text-danger">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:w-1/2 w-full px-[15px]">
                <button
                    class="w-full btn bg-[#F3F3F3] gap-[10px] mb-4 shadow-none duration-700 hover:text-white hover:bg-primary different-address"
                    type="button">Add Order Note <i class="fa fa-angle-down text-xl"></i></button>
                <div id="different-address" class="widget" style="display: none;">
                    <p class="text-base mb-4">
                        Add Special Instructions to Customize Your Order — Mention Allergies, Preferred Ingredients, or
                        Any Personal Requests
                    </p>
                    <div class="form-group mb-5 inline-block w-full">
                        <textarea wire:model="note"
                            class="resize-none py-[10px] px-5 w-full text-[15px] rounded-[6px] placeholder:text-[#666666] focus:border-primary duration-500"
                            rows="5"
                            placeholder="Notes about your order, e.g. allergies, special instruction"></textarea>
                        @error('note')
                            <span class="text-xs text-danger">
                                {{$message}}
                            </span>
                        @enderror
                    </div>

                </div>

            </div>
        </div>
    </form>
    <div class="dz-divider bg-gray-dark icon-center my-12 relative h-[1px] bg-[#d3d3d3]">
        <i class="fa fa-circle bg-white text-primary absolute left-[50%] text-center top-[-8px] block"></i>
    </div>
    <div class="row">
        <div class="lg:w-1/2 w-full px-[15px]">
            <div class="widget">
                <h4 class="widget-title xl:mb-[30px] mb-5 pb-3 relative">Your Order</h4>
                <table class="mb-5 border border-[#00000020] align-middle w-full">
                    <thead class="text-center">
                        <tr class="border-b border-[#00000020]">
                            <th class="bg-[#222] p-[15px] text-base font-semibold text-white">IMAGE</th>
                            <th class="bg-[#222] p-[15px] text-base font-semibold text-white">PRODUCT NAME</th>
                            <th class="bg-[#222] p-[15px] text-base font-semibold text-white">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cartItems as $item)
                            <tr>
                                <td class="p-[15px] font-medium border border-[#00000020] product-item-img"><img
                                        src="{{ asset('storage/' . $item['image_url']) }}" alt="/"
                                        class="w-[100px] rounded-md">
                                </td>
                                <td class="p-[15px] font-medium border border-[#00000020] text-bodycolor">
                                    <a
                                        href="{{ $item['product_type'] === 'equipment' ? route('equipment.details', $item['slug']) : route('food.details', $item['slug'])}}"><strong
                                            class="text-primary"> {{ $item['name']}}</strong></a> <br>
                                    @if ($item['product_type'] === 'food')
                                        {{'(' . $item['size'] . ')'}}<br>
                                        {{ 'qty: ' . $item['quantity']}}
                                    @elseif($item['product_type'] === 'equipment')
                                        Rental Start: {{$item['rental_start'] . ' (' . $item['rental_duration'] . 'hrs)'}} <br>
                                        Return date: {{ $item['rental_end'] }} <br>
                                        Caution Fee: {{ Number::currency($item['caution_fee'], 'GBP')}}<br>
                                        {{ 'qty: ' . $item['quantity']}}
                                    @endif
                                </td>
                                <td class="p-[15px] font-medium border border-[#00000020] text-bodycolor">
                                    @if ($item['product_type'] === 'food')
                                        {{ Number::currency($item['total_amount'], 'GBP') }}
                                    @elseif($item['product_type'] === 'equipment')
                                        {{ Number::currency($item['total_amount'] + $item['caution_fee'], 'GBP') }}
                                    @endif
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="lg:w-1/2 w-full px-[15px]">
            <form class="shop-form widget">
                <h4 class="widget-title xl:mb-[30px] mb-5 pb-3 relative">Order Total</h4>
                <table class="mb-5 border border-[#00000020] align-middle w-full">
                    <tbody>
                        <tr>
                            <td class="p-[15px] font-medium text-bodycolor border border-[#00000020] ">Order
                                Subtotal</td>
                            <td class="p-[15px] font-medium text-bodycolor border border-[#00000020]">
                                {{ Number::currency($grand_total, 'GBP') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="p-[15px] font-medium text-bodycolor border border-[#00000020] ">
                                Cart Weight
                            </td>
                            <td class="p-[15px] font-medium text-bodycolor border border-[#00000020]">
                                {{ $cart_weight . 'kg' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="p-[15px] font-medium text-bodycolor border border-[#00000020]">Shipping
                            </td>
                            <td class="p-[15px] font-medium text-bodycolor border border-[#00000020]">
                                {{ Number::currency($shippingFee, 'GBP') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="p-[15px] font-medium text-bodycolor border border-[#00000020]">
                                Coupon
                            </td>
                            <td class="p-[15px] font-medium text-bodycolor border border-[#00000020]">
                                -{{ Number::currency($discount, 'GBP') }}
                            </td>
                        </tr>
                        <tr>
                            <td class="p-[15px] font-medium text-bodycolor border border-[#00000020]">Total</td>
                            <td class="p-[15px] font-medium text-bodycolor border border-[#00000020]">
                                {{ Number::currency($grand_total + $shippingFee - $discount, 'GBP') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <h4 class="widget-title xl:mb-[30px] mb-5 pb-3 relative">Payment Method</h4>

                <div class="form-group mb-5 inline-block w-full">
                    <select wire:model="paymentMethod"
                        class="form-select mb-4 ignore py-3 px-5 h-[50px] text-bodycolor bg-white border border-bodycolor rounded-md after:border-black2 after:h-2 after:w-2 after:right-5 after:top-[60%] w-full">
                        <option value="transfer">Transfer</option>
                    </select>
                </div>
                <div class="form-group">
                    <button
                        class="btn bg-[#F3F3F3] gap-[10px] mb-4 shadow-none duration-700 btn-hover-2 btn-gray hover:bg-primary"
                        type="button" wire:click="checkout" wire:loading.attr="disabled">

                        <span wire:loading.remove wire:target="checkout">Place Order Now</span>
                        <span wire:loading wire:target="checkout">Placing Order...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>