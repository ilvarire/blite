<section class="content-inner-1 pb-[100px] overflow-hidden pt-0">
    <div class="container">
        <div
            class="section-head font-lobster mb-[50px] max-xl:mb-[30px] mx-auto relative flex items-center justify-between">
            <h2 class="title mb-0 text-black2">Our Quick Meals</h2>
            <div class="pagination-align flex">
                <div class="menu-button-prev1 btn-prev btn-hover-2"><i
                        class="fa-solid fa-arrow-left sm:text-xl text-[15px]"></i></div>
                <div class="menu-button-next1 btn-next btn-hover-2"><i
                        class="fa-solid fa-arrow-right sm:text-xl text-[15px]"></i></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="swiper menu-swiper2 swiper-visible swiper-item-4 overflow-visible" wire:ignore>
            <div class="swiper-wrapper">
                @forelse($foods as $food)
                    <div class="swiper-slide" wire:ignore.self wire:key="food-{{ $food->id }}">
                        <div
                            class="dz-img-box3 box-hover group style-4 bg-white p-[18px] flex flex-col h-[160px] relative z-[1] overflow-hidden rounded-[10px]">
                            <div class="menu-detail flex items-center mb-3">
                                <div class="dz-media mr-5 w-[60px] min-w-[60px] h-[60px]">
                                    <img class="rounded-xl" src="{{ asset('storage/' . $food->image_url) }}" alt="/">
                                </div>
                                <div class="dz-content">
                                    <h6 class="title mb-[3px] duration-500"><a
                                            href="{{ route('food.details', $food->slug)}}">{{ $food->name}}</a>
                                    </h6>
                                </div>
                            </div>
                            <div class="menu-footer max-w-[110px] mt-auto">
                                <span
                                    class="price duration-500">{{ Number::currency($food->prices->first()->price, 'GBP') }}</span>
                            </div>
                            <a class="detail-btn" href="javascript:;" wire:click.prevent="addFoodToCart({{$food->id}})">
                                <i class="fa-solid fa-plus"></i>
                            </a>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</section>