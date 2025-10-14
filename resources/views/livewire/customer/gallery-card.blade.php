<div class="container clearfix">
    <div
        class="row search-wraper style-1 text-center lg:mt-[-135px] sm:mt-[-100px] mt-[-90px] xl:mb-[80px] lg:mb-[60px] sm:mb-[50px] mb-[40px]">
        <div class="lg:w-2/3 w-full px-[15px] m-auto">
            <form>
                <div class="input-group relative flex flex-wrap items-stretch z-[1] w-full">
                    <input required="required" type="text" wire:model.live.debounce.500ms="search"
                        class="form-control bg-white py-[25px] sm:pr-[150px] pr-20 pl-[30px] border-none rounded-[10px] lg:h-[80px] h-[60px] w-full shadow-[0px_15px_55px_rgba(34,34,34,0.15)] text-[#666666] text-[15px] outline-none"
                        placeholder="Search Event">
                    <div class="input-group-addon absolute top-[50%] right-[12px] translate-y-[-50%] z-[9]">
                        <button name="submit" value="submit" type="submit"
                            class="btn btn-primary btn-hover-2 lg:py-[15PX] xl:px-[30px] sm:py-[10px] py-[6px] px-3">
                            <span class="sm:block hidden">Search</span>
                            <i class="icon-search sm:hidden block text-xl"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="masonry" class="row" data-masonry='{"percentPosition": true}'>
        @forelse($galleries as $ev)
            <div class="card-container lg:w-2/6 md:w-1/2 w-full px-[15px]" wire:key="{{$ev->id}}">
                <div
                    class="dz-card rounded-lg overflow-hidden shadow-[0_15px_55px_rgba(34,34,34,0.1)] bg-white group mb-[30px]">
                    <div class="service-swiper swiper">
                        <div class="swiper-wrapper">
                            @foreach ($ev->images as $image)
                                <div class="swiper-slide"><img src="{{ asset('storage/' . $image->image_url) }}" alt=""></div>
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
                    <div class="content flex-col flex p-[30px] max-xl:p-5 relative">

                        <h5 class="mb-2">
                            <a href="{{ route('gallery.details', $ev->slug)}}">
                                {{ mb_strimwidth($ev->title, 0, 30, '..') }}
                            </a>
                        </h5>

                        <p class="text-base">
                            {{ mb_strimwidth($ev->description, 0, 60, '..') }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-base">
                No events found
            </p>
        @endforelse
    </div>
    <div class="text-center m-t10 text-primary">

        @if ($galleries->links() != '')
            {{ $galleries->links() }}
        @endif

    </div>
</div>