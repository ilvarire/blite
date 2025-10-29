<section class="sm:pb-[100px] pb-[40px] relative">
    <div class="container">
        <div class="2xl:mb-[50px] mb-[25px] relative mx-auto text-center">
            <h2 class="font-lobster">From Our Menu</h2>
        </div>
        <div class="slider-frame relative">
            <div class="swiper menu-swiper" wire:ignore>
                <div class="swiper-wrapper">
                    @forelse($menus as $food)
                        <div class="swiper-slide" wire:key="food-{{ $food->id }}">
                            <div class="slide-box">
                                <div class="dz-img-box2 group">
                                    <div class="w-full min-w-full h-full">
                                        <img src="{{ asset('storage/' . $food->image_url) }}" alt="" class="block w-full">
                                    </div>
                                    <span
                                        class="absolute bg-[var(--secondary-dark)] left-0 text-white rounded-ee-[10px] uppercase py-[4px] px-1.5 font-semibold text-xs leading-[18px] z-[2] group-hover:top-0 top-[-40px] duration-500">
                                        Featured
                                    </span>
                                    <div
                                        class="hover-content flex justify-between py-5 px-[30px] absolute bottom-0 opacity-0 z-[2] w-full items-center  duration-500 mb-[-100px] group-hover:mb-0 group-hover:opacity-100">
                                        <div class="info relative">
                                            <h5 class="mb-0">
                                                <a class="text-white" href="{{ route('food.details', $food->slug)}}">
                                                    {{$food->name}}
                                                </a>
                                            </h5>
                                            <span class="text-xl text-yellow font-bold leading-[30px]">
                                                {{ Number::currency($food->prices->first()->price, 'GBP') }}
                                            </span>
                                        </div>
                                        <a href="javascript:;">
                                            <i wire:click.prevent="addFoodToCart({{$food->id}})"
                                                class="flaticon-shopping-cart items-center bg-white rounded-md min-w-[45px] h-[45px] min-h-[45px] leading-[45px] flex align-center relative justify-center text-2xl text-center"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
            <div class="swiper-nav">
                <div class="swiper-button-prev prev1 group hover:before:animate-spin">
                    <i class="fa-solid fa-arrow-left text-white group-hover:text-primary relative"></i>
                </div>
                <div class="swiper-button-next next1 group hover:before:animate-spin">
                    <i class="fa-solid fa-arrow-right text-white group-hover:text-primary relative"></i>
                </div>
            </div>
        </div>
    </div>
</section>