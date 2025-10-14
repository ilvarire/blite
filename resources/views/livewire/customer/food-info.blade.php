<div class="container">
    <div class="row product-detail">
        <div class="lg:w-1/3 md:w-5/12 w-full px-[15px]">
            <div class="detail-media rounded-[10px] overflow-hidden w-full mb-[30px]">
                <img src="{{ asset('storage/' . $food->image_url) }}" alt="/" class="h-full w-full object-cover">
            </div>
        </div>
        <div class="lg:w-8/12 md:w-7/12 w-full px-[15px]">
            <div class="detail-info relative">
                <a href="{{route('food', ['categories' => $food->category->slug])}}">
                    <span
                        class="badge mb-[10px] p-[2px] font-medium text-sm leading-5 text-[#666666] flex items-center rounded-[10px]">
                        <svg class="mr-2" width="18" height="18" viewBox="0 0 18 18" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.5" y="0.5" width="16" height="16" stroke="#0F8A65" />
                            <circle cx="8.5" cy="8.5" r="5.5" fill="#0F8A65" />
                        </svg>
                        {{ $food->category->name}}
                    </span></a>
                <div class="dz-head">
                    <h2 class="mb-2 lg:text-4xl sm:text-[2rem] text-[1.75rem] font-semibold">
                        {{ $food->name}}
                    </h2>
                    <div class="rating text-sm leading-[21px]">
                        <i class="fa-solid fa-star text-[var(--secondary-dark)]"></i> <span class="text-bodycolor">
                            <strong
                                class="font-medium">{{$food->averageRating() ? number_format($food->averageRating(), 1) : '0.0'}}</strong>
                            - {{$food->reviewCount()}} Reviews</span>
                    </div>
                </div>
                <p class="text-[15px] mt-5 mb-4">
                    {{ $food->description}}
                </p>
                <ul class="detail-list flex my-[25px]">
                    <li class="mr-[45px] text-[15px] font-medium leading-[22px] text-bodycolor">Price <span
                            class="text-primary flex text-xl font-semibold leading-[30px] mt-[5px]">
                            @if(isset($foodPrices[$food->id]))
                                {{ Number::currency($foodPrices[$food->id], 'GBP') }}
                            @else
                                {{ Number::currency($food->prices->first()->price, 'GBP') }}
                            @endif
                        </span>
                    </li>
                    <li class="mr-[45px] text-[15px] font-medium leading-[22px] text-bodycolor">Sizes<br>
                        <select name="size" wire:model.live="selectedSize.{{ $food->id }}"
                            class="ignore pl-2 border-0 text-bodycolor text-xl  w-[85px] min-w-[85px] rounded-md bg-white mt-[5px]">
                            @forelse($food->prices as $price)
                                <option value="{{$price->size_id}}">{{ $price->size->label}}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </li>
                    <li class="mr-[45px] text-[15px] font-medium leading-[22px] text-bodycolor">Quantity
                        <div
                            class="input-group mt-[5px] flex flex-wrap items-stretch h-[31px] relative w-[105px] min-w-[105px]">
                            <input type="number" step="1" value="1" min="1" wire:model="quantity" name="quantity"
                                class="quantity-field">
                            <span class="flex justify-between p-[2px] absolute w-full">
                                <input type="button" value="-" class="button-minus" wire:click="decreaseQuantity">
                                <input type="button" value="+" class="button-plus" wire:click="increaseQuantity">
                            </span>
                        </div>
                    </li>
                </ul>

                <div class="lg:flex justify-between">
                    <ul class="modal-btn-group sm:flex block mx-[-7px]">
                        <li class="mx-[7px] lg:mb-0 mb-[10px]">
                            <a href="javascript:;"
                                wire:click.prevent="addFoodToCart({{$food->id}}, {{ $selectedSize[$food->id] ?? $food->prices->first()->size_id }})"
                                class="btn shadow-none btn-primary btn-hover-1">
                                <span>Add To Cart <i class="flaticon-shopping-bag-1 text-xl ml-[10px] inline-flex"></i>
                                </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>