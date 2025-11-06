<li class="inline-block">
    <button
        class="cart-btn bg-white white-btn flex items-center justify-center w-[45px] h-[45px] rounded-md shadow-[0_10px_10px_0_rgba(0,0,0,0.1)]">
        <i class="flaticon-shopping-bag-1 text-2xl inline-flex ping-bag-1"></i>
        <span
            class="badge absolute top-[3px] right-[-6px] p-0 h-5 w-5 font-medium text-xs leading-5 bg-[#666666] text-white rounded-[10px]">
            {{ $cart_count}}
        </span>
    </button>
    <ul class="dropdown-menu cart-list mt-2.5" wire:ignore.self>
        @forelse(collect($cart_items)->take(4) as $item)
            <li class="cart-item" wire:key="{{ rand() }}">
                <div class="media">
                    <div class="media-left">
                        <a href="{{ route('food.details', $item['slug'])}}">
                            <img alt="/" class="media-object" src="{{ asset('storage/' . $item['image_url']) }}">
                        </a>
                    </div>
                    <div class="media-body">
                        <h6 class="dz-title">
                            <a href="@if ($item['product_type'] === 'food')
                                {{ route('food.details', $item['slug'])}}
                            @elseif($item['product_type'] === 'equipment')
                                    {{ route('equipment.details', $item['slug'])}}
                                @endif" class="media-heading">
                                {{ $item['name'] }}
                                @if ($item['product_type'] === 'equipment')
                                    <p>
                                        <i
                                            class="flaticon-pot items-center bg-white rounded-md min-w-[45px] h-[45px] min-h-[45px] flex align-center">{{$item['rental_start']}}
                                            (qty: {{$item['quantity']}})</i>
                                    </p>
                                @endif
                                @if ($item['product_type'] === 'food')
                                    <p>
                                        <i
                                            class="flaticon-burger items-center bg-white rounded-md min-w-[45px] h-[45px] min-h-[45px] flex align-center">food
                                            (qty: {{$item['quantity']}})</i>
                                    </p>
                                @endif

                            </a>
                        </h6>
                        <span class="dz-price">{{ Number::currency($item['total_amount'], 'GBP') }}</span>
                        <span class="item-close" wire:ignore.self @if ($item['product_type'] === 'food')
                            wire:click="removeFoodFromCart({{$item['food_id']}})"
                        @elseif($item['product_type'] === 'equipment')
                            wire:click="removeEquipmentFromCart({{$item['equipment_id']}})" @endif>&times;</span>
                    </div>
                </div>
            </li>
        @empty
        @endforelse
        <li class="cart-item text-center flex justify-between">
            <h6 class="text-primary mb-0">Total:</h6>
            <h6 class="text-primary mb-0">{{ Number::currency($cart_total, 'GBP') }}</h6>
        </li>
        <li class="text-center flex">
            <a href="{{ route('cart')}}" class="btn btn-primary me-2 w-full btn-hover-1"><span>
                    {{ count($cart_items) <= 6 ? 'View Cart' : 'See All'}}
                </span></a>
            <a href="{{ route('food')}}" class="btn btn-outline w-full btn-hover-1"><span>Menu</span></a>
        </li>
    </ul>
</li>