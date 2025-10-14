<section class="bg-light content-inner pb-0 relative overflow-hidden">
    <div class="container">
        <div class="2xl:mb-[50px] mb-[25px] relative mx-auto text-center">
            <h2 class="font-lobster">Our Menu</h2>
        </div>
        <div class="row" wire:ignore>
            @forelse($menus as $food)
                <div class="lg:w-1/4 sm:w-1/2 w-full pl-[15px] pr-[15px] pb-[30px]">
                    <div
                        class="rounded-[10px] shadow-[0_15px_55px_rgba(35,35,35,0.15)] duration-500 relative z-[1] overflow-hidden group dz-img-box">
                        <div class="w-full min-w-full h-full">
                            <img src="{{ asset('storage/' . $food->image_url) }}" alt="" class="w-full block">
                        </div>
                        <span
                            class="absolute top-0 bg-[var(--secondary-dark)] left-0 text-white rounded-ee-[10px] uppercase py-[4px] px-2.5 font-semibold text-xs leading-[18px] z-[2]">top
                            seller</span>
                        <div
                            class="content bg-white text-center py-[23px] px-[15px] block duration-500 absolute w-full bottom-0 mb-0 group-hover:bottom-[-150px] group-hover:opacity-0">
                            <h5 class="mb-2.5">
                                <a href="javascript:void(0);">
                                    {{ $food->name }}
                                </a>
                            </h5>
                            <p class="mb-[2px]">
                                {{ mb_strimwidth($food->description, 0, 50, '..') }}
                            </p>
                        </div>
                        <div
                            class="hover-content flex justify-between py-5 px-[30px] absolute bottom-0 opacity-0 z-[2] w-full items-center duration-500 mb-[-100px] group-hover:mb-0 group-hover:opacity-100">
                            <div class="info relative">
                                <h5 class="mb-0">
                                    <a class="text-white" href="{{ route('food.details', $food->slug)}}">
                                        {{ $food->name }}
                                    </a>
                                </h5>
                                <span class="text-xl text-[var(--secondary-dark)] font-bold leading-[30px]">
                                    {{ Number::currency($food->prices->first()->price, 'GBP') }}
                                </span>
                            </div>
                            <a href="javascript:;">
                                <i wire:click.prevent="addFoodToCart({{$food->id}})"
                                    class="flaticon-shopping-cart bg-white rounded-md min-w-[45px] h-[45px] min-h-[45px] leading-[45px] flex items-center relative justify-center text-2xl text-center"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
            <div class="w-full text-center mt-[10px]">
                <a href="{{ route('food')}}" class="btn btn-md btn-primary btn-hover-1">
                    <span>See All Dishes</span>
                </a>
            </div>
        </div>
    </div>
</section>