<div class="style-1">

    <div class="flex justify-between">
        <div class="widget-title xl:mb-[30px] mb-5 pb-3 text-lg relative">
            <h5 class="">Cart <span class="text-primary">({{count($cartItems)}})</span></h5>
        </div>
    </div>
    @forelse($cartItems as $item)
        <div class="cart-item flex items-center border-b border-[#2222221a] pb-[15px] mb-[15px]">
            <div class="dz-media w-[80px] min-w-[80px] h-[80px] overflow-hidden rounded-[10px] relative">
                <img src="{{ asset('storage/' . $item['image_url']) }}" alt="/">
            </div>
            <div class="dz-content ml-[15px] w-full">
                <div class="dz-head mb-[10px] flex items-center justify-between">

                    <h6 class="text-base">
                        <a
                            href="{{ $item['product_type'] === 'equipment' ? route('equipment.details', $item['slug']) : route('food.details', $item['slug'])}}">
                            {{ $item['product_type'] === 'equipment' ? Str::title($item['name']) . '🍽️' : Str::title($item['name']) . '🍚🍖'}}
                        </a>
                        @if ($item['product_type'] === 'equipment')
                            <p class="text-xs">Rental Date:
                                {{$item['rental_start'] . '(' . $item['rental_duration'] . 'hrs' . ')'}}
                            </p>
                        @endif
                        @if ($item['product_type'] === 'food')
                            <p class="text-xs">Size:
                                {{$item['size']}}
                            </p>
                        @endif

                    </h6>
                    <a href="javascript:void(0);" class="text-black2" @if ($item['product_type'] === 'food')
                    wire:click="removeFoodFromCart({{$item['food_id']}})" @elseif($item['product_type'] === 'equipment')
                        wire:click="removeEquipmentFromCart({{$item['equipment_id']}})" @endif>
                        <i class="fa-solid fa-xmark text-danger"></i>
                    </a>

                </div>
                <div class="dz-body flex items-center justify-between">
                    <div
                        class="input-group mt-[5px] flex flex-wrap items-stretch h-[31px] relative w-[105px] min-w-[105px]">
                        <input type="number" min="1" step="1" value="{{$item['quantity']}}" name="quantity"
                            class="quantity-field" disabled>
                        <span class="flex justify-between p-[2px] absolute w-full">
                            <input type="button" value="-" class="button-minus"
                                wire:click="decreaseQuantity('{{$item['product_type'] }}', {{$item['product_type'] === 'food' ? $item['food_id'] : $item['equipment_id']}})">
                            <input type="button" value="+" class="button-plus"
                                wire:click="increaseQuantity('{{$item['product_type'] }}', {{$item['product_type'] === 'food' ? $item['food_id'] : $item['equipment_id']}})">
                        </span>
                    </div>
                    <h5 class="price text-primary mb-0">
                        {{ Number::currency($item['total_amount'], 'GBP') }}
                    </h5>
                </div>
            </div>
        </div>
    @empty
        <p class="text-bodycolor text-lg">Cart Empty!</p>
    @endforelse
    @if (count($cartItems) > 0)
        <div class="order-detail mt-10">
            <h6 class="mb-2">Bill Details</h6>
            <table class="mb-[25px] w-full border-collapse">
                <tbody>
                    <tr>
                        <td class="py-[6px] font-medium text-sm leading-[21px] text-bodycolor">Item
                            Total</td>
                        <td class="price text-primary font-semibold text-base leading-6 text-right">
                            {{ Number::currency(array_sum(array_column($cartItems, 'total_amount')), 'GBP') }}

                        </td>
                    </tr>

                    <tr class="charges border-b border-dashed border-[#22222233]">
                        <td class="pt-[6px] pb-[15px] font-medium text-sm leading-[21px] text-bodycolor">
                            Caution fee (equipment only)
                        </td>
                        <td class="price pt-[6px] pb-[15px] text-primary font-semibold text-base leading-6 text-right">
                            {{ Number::currency(array_sum(array_map(function ($item) {
            // Check if the item is 'equipment' and has 'caution_fee'
            if ($item['product_type'] === 'equipment' && isset($item['caution_fee'])) {
                return $item['caution_fee'] * $item['quantity'];
            }
            return 0; // Return 0 for food or items without caution_fee
        }, $cartItems)), 'GBP') }}
                        </td>
                    </tr>
                    <tr class="tax border-b-2 border-[#22222233]">
                        <td class="pt-[6px] pb-[15px] font-medium text-sm leading-[21px] text-bodycolor">
                            Taxes & Other Charges</td>
                        <td class="price pt-[6px] pb-[15px] text-primary font-semibold text-base leading-6 text-right">
                            {{ Number::currency(0, 'GBP') }}
                        </td>
                    </tr>
                    <tr class="total">
                        <td class="py-[6px] font-medium text-sm leading-[21px] text-bodycolor">
                            <h6>Total</h6>
                        </td>
                        <td class="price text-primary font-semibold text-base leading-6 text-right">
                            {{ Number::currency(array_sum(array_column($cartItems, 'total_amount')) + array_sum(array_column($cartItems, 'caution_fee')), 'GBP') }}
                        </td>
                    </tr>
                </tbody>
            </table>
            @if ($checkout)
                <a href="{{ route('checkout')}}" class="btn btn-primary block text-center btn-md w-full btn-hover-1"><span
                        class="z-[2] relative block">Order Now <i class="fa-solid fa-arrow-right ml-[10px]"></i></span></a>
            @endif

        </div>
    @endif

</div>