<div class="container">
    <div class="row product-detail">
        <div class="lg:w-1/3 md:w-5/12 w-full px-[15px]">
            <div class="detail-media rounded-[10px] overflow-hidden w-full mb-[30px]">
                <div
                    class="dz-card rounded-lg overflow-hidden shadow-[0_15px_55px_rgba(34,34,34,0.1)] bg-white group mb-[30px]">
                    <div class="service-swiper swiper" wire:ignore>
                        <div class="swiper-wrapper">
                            @foreach ($equipment->images as $image)
                                <div class="swiper-slide"><img src="{{ asset('storage/' . $image->image_url) }}" alt="">
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination style-1 inline-block absolute bottom-2.5"></div>
                        <div
                            class="service-button-prev btn-prev absolute rounded-full top-[50%] bg-white text-primary hover:bg-primary hover:text-white translate-y-[-50%] duration-500">
                            <i class="icon-arrow-left"></i>
                        </div>
                        <div
                            class="service-button-next btn-next absolute rounded-full top-[50%] bg-white text-primary hover:bg-primary hover:text-white translate-y-[-50%] duration-500 right-0">
                            <i class="icon-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:w-8/12 md:w-7/12 w-full px-[15px]">
            <div class="detail-info relative">
                <a href="{{route('equipments')}}">
                    <span
                        class="badge mb-[10px] p-[2px] font-medium text-sm leading-5 text-[#666666] flex items-center rounded-[10px]">
                        <svg class="mr-2" width="18" height="18" viewBox="0 0 18 18" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.5" y="0.5" width="16" height="16" stroke="#0F8A65" />
                            <circle cx="8.5" cy="8.5" r="5.5" fill="#0F8A65" />
                        </svg>
                        Equipments
                    </span></a>
                <div class="dz-head">
                    <h2 class="mb-2 lg:text-4xl sm:text-[2rem] text-[1.75rem] font-semibold">
                        {{ $equipment->name}}
                    </h2>
                </div>
                <p class="text-[15px] mt-5 mb-4">
                    {{ $equipment->description}}
                </p>
                <ul class="detail-list flex my-[25px]">
                    <li class="mr-[45px] text-[15px] font-medium leading-[22px] text-bodycolor">Price <span
                            class="text-primary flex text-xl font-semibold leading-[30px] mt-[5px]">
                            {{ Number::currency($equipment->price, 'GBP') }}
                        </span>
                    </li>

                    <li class="mr-[45px] text-[15px] font-medium leading-[22px] text-bodycolor">Quantity
                        <div
                            class="input-group mt-[5px] flex flex-wrap items-stretch h-[31px] relative w-[105px] min-w-[105px]">
                            <input type="number" step="1" value="1" min="1" wire:model.live="quantity" name="quantity"
                                class="quantity-field">
                            <span class="flex justify-between p-[2px] absolute w-full">
                                <input type="button" value="-" class="button-minus" wire:click="decreaseQuantity">
                                <input type="button" value="+" class="button-plus" wire:click="increaseQuantity">
                            </span>
                        </div>
                    </li>
                    <li class="mr-[45px] text-[15px] font-medium leading-[22px] text-bodycolor">Duration
                        <div
                            class="input-group mt-[5px] flex flex-wrap items-stretch h-[31px] relative w-[105px] min-w-[105px]">
                            <select wire:model.live="duration"
                                class="ignore border-0 text-bodycolor text-xl rounded-md bg-white">
                                <option value="24">24hrs</option>
                                <option value="48">48hrs</option>
                                <option value="72">72hrs</option>
                                <option value="96">96hrs</option>
                            </select>

                        </div>
                    </li>

                </ul>
                <ul class="flex items-center mb-4">
                    <li class="inline-block relative text-sm text-bodycolor mr-3">Rental Date:
                        <a href="javascript:void(0);" class="text-sm font-medium text-bodycolor"><i
                                class="flaticon-calendar-date text-xs text-primary mr-[5px] translate-y-[1px] scale-150"></i>

                        </a>
                        <input type="date" wire:model.live="rental_start" class="border-0 rounded-md focus:outline">
                    </li>
                </ul>

                <div class="lg:flex justify-between">
                    <ul class="modal-btn-group sm:flex block mx-[-7px]">
                        <li class="mx-[7px] lg:mb-0 mb-[10px]">
                            <a href="javascript:;"
                                wire:click.prevent="addEquipmentToCart({{$equipment->id}}, '{{$rental_start}}', {{$duration}}, {{$quantity}})"
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