<section class="bg-light sm:py-[100px] py-[40px] relative overflow-hidden">
    <div class="container">
        <div class="2xl:mb-[50px] mb-[25px] relative mx-auto text-center">
            <h2 class="font-lobster">Event Gallery</h2>
        </div>
        <div class="swiper team-swiper overflow-visible swiper-visible">
            <div class="swiper-wrapper">
                @forelse($events as $ev)
                    <div class="swiper-slide">
                        <div class="slide-box">
                            <div
                                class="shadow-[0_15px_55px_rgba(35,35,35,0.15)] rounded-[10px] bg-white overflow-hidden group">
                                <div
                                    class="relative  overflow-hidden z-[1] before:content-[''] before:absolute before:w-[200px] before:h-[200px] before:bg-black2 before:top-[-100px] before:left-[-100px] before:opacity-30 before:z-[1] before:duration-500 before:rounded-full before:scale-50 before:translate-x-[-50%] group-hover:before:scale-[7]">
                                    <img src="{{ asset('storage/' . $ev->images->first()->image_url) }}" alt="/"
                                        class="group-hover:scale-110 duration-500 block w-full">
                                </div>
                                <div class="content bg-white flex justify-between items-center py-[15px] px-5">
                                    <div class="clearfix">
                                        <h6>
                                            <a href="{{ route('gallery.details', $ev->slug) }}">
                                                {{ mb_strimwidth($ev->title, 0, 20, '...') }}
                                            </a>
                                        </h6>
                                        <span class="font-normal text-sm leading-5 text-primary">
                                            {{ mb_strimwidth($ev->description, 0, 23, '...') }}
                                        </span>
                                    </div>
                                    <ul class="team-social">
                                        <li>
                                            <a href="javascript:void(0);"
                                                class="text-xl inline-block h-10 w-10 leading-10 text-center rounded-lg bg-primary text-white pt-[2px]">

                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <ul
                                                class="sub-team-social absolute bottom-[20px] z-[1] w-10 rounded-lg opacity-0 duration-500 	hover:opacity-100 hover:pb-[80px]">
                                                <li class="mb-2 relative">
                                                    <a href="{{ $ev->facebook_link }}"
                                                        class="text-white duration-500 text-center text-lg bg-[#4867AA] h-10 w-10 flex items-center justify-center rounded-lg">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                                <li class="mb-2 relative">
                                                    <a href="{{ $ev->tiktok_link }}"
                                                        class="text-white duration-500 text-center text-lg bg-[#BFBABA] h-10 w-10 flex items-center justify-center rounded-lg">
                                                        <i class="fab fa-tiktok"></i>
                                                    </a>
                                                </li>
                                                <li class="mb-2 relative">
                                                    <a href="{{ $ev->instagram_link }}"
                                                        class="text-white duration-500 text-center text-lg bg-[#D74141] h-10 w-10 flex items-center justify-center rounded-lg">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
            <div class="swiper-nav">
                <div class="swiper-button-prev team-button-prev group hover:before:animate-spin">
                    <i class="fa-solid fa-arrow-left text-white group-hover:text-primary relative"></i>
                </div>
                <div class="swiper-button-next team-button-next group hover:before:animate-spin">
                    <i class="fa-solid fa-arrow-right text-white group-hover:text-primary relative"></i>
                </div>
            </div>
        </div>

    </div>
</section>