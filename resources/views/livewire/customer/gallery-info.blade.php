<div class="container">
    <div class="row product-detail">
        <div class="lg:w-1/3 md:w-5/12 w-full px-[15px]">
            <div class="detail-media rounded-[10px] overflow-hidden w-full mb-[30px]">
                <div
                    class="dz-card rounded-lg overflow-hidden shadow-[0_15px_55px_rgba(34,34,34,0.1)] bg-white group mb-[30px]">
                    <div class="service-swiper swiper" wire:ignore>
                        <div class="swiper-wrapper">
                            @foreach ($gallery->images as $image)
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
                <a href="{{route('galleries')}}">
                    <span
                        class="badge mb-[10px] p-[2px] font-medium text-sm leading-5 text-[#666666] flex items-center rounded-[10px]">
                        <svg class="mr-2" width="18" height="18" viewBox="0 0 18 18" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.5" y="0.5" width="16" height="16" stroke="#0F8A65" />
                            <circle cx="8.5" cy="8.5" r="5.5" fill="#0F8A65" />
                        </svg>
                        Galleries
                    </span></a>
                <div class="dz-head">
                    <h2 class="mb-2 lg:text-4xl sm:text-[2rem] text-[1.75rem] font-semibold">
                        {{ $gallery->title}}
                    </h2>
                </div>
                <p class="text-[15px] mt-5 mb-4">
                    {{ $gallery->description}}
                </p>

            </div>
        </div>
    </div>
</div>