<section class="site-footer style-1 bg-black2 relative">
    <div class="xl:pt-[85px] md:pt-[80px] pt-[60px] lg:pb-10 md:pb-5 pb-0 relative z-[2]" id="#footer">
        <div class="container">
            <div class="row">
                <div class="xl:w-1/4 lg:w-1/3 sm:w-1/2 w-full px-[15px]">
                    <div class=" sm:mb-[30px] mb-2.5">
                        <h5
                            class="footer-title lg:mb-[30px] mb-5 text-white lg:text-2xl text-xl uppercase font-semibold">
                            Contact</h5>
                        <ul>
                            <li class="relative mb-[25px] pl-10">
                                <i
                                    class="flaticon-placeholder absolute text-3xl leading-[30px] left-0 top-[5px] text-primary w-[30px] h-[30px]"></i>
                                <p class="text-[#CCCCCC] tracking-wide leading-6">

                                    {{ $data->location }}<br>
                                </p>
                            </li>
                            <li class="relative mb-[25px] pl-10">
                                <i
                                    class="flaticon-telephone absolute text-3xl leading-[30px] left-0 top-[5px] text-primary w-[30px] h-[30px]"></i>
                                <p class="text-[#CCCCCC] tracking-wide leading-6">

                                    {{ $data->phone }}<br>
                                </p>
                            </li>
                            <li class="relative mb-[25px] pl-10">
                                <i
                                    class="flaticon-email-1 absolute text-3xl leading-[30px] left-0 top-[5px] text-primary w-[30px] h-[30px]"></i>
                                <p class="text-[#CCCCCC] tracking-wide leading-6">
                                    {{ $data->email }}
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="dz-social-icon">
                        <ul class="flex flex-row mb-2">
                            <li><a target="_blank" class="fab fa-facebook-f mr-2" href="{{ $data->facebook_link }}"></a>
                            </li>
                            <li><a target="_blank" class="fab fa-tiktok mr-2" href="{{ $data->tiktok_link }}"></a>
                            </li>
                            <li><a target="_blank" class="fab fa-whatsapp mr-2" href="{{ $data->whatsapp_link }}"></a>
                            </li>
                            <li><a target="_blank" class="fab fa-instagram mr-2" href="{{ $data->instagram_link }}"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="xl:w-3/12 lg:w-2/12 sm:w-6/12 w-full px-[15px]">
                    <div class="widget widget_services mb-[30px]">
                        <h5
                            class="footer-title mb-[30px] xl:text-2xl text-xl font-semibold text-white uppercase leading-[1.1]">
                            Our Links</h5>
                        <ul>
                            <li><a href="{{ route('home')}}"><span>Home</span></a></li>
                            <li><a href="{{ route('login')}}"><span>Login</span></a></li>
                            <li><a href="{{ route('register')}}"><span>Register</span></a></li>
                            <li><a href="{{ route('cart')}}"><span>Cart</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="xl:w-3/12 lg:w-3/12 sm:w-6/12 w-full px-[15px]">
                    <div class="widget widget_services mb-[30px]">
                        <h5
                            class="footer-title mb-[30px] xl:text-2xl text-xl font-semibold text-white uppercase leading-[1.1]">
                            OUR SERVICES</h5>
                        <ul>
                            <li><a href="{{ route('food')}}"><span>Food Delivery</span></a></li>
                            <li><a href="{{ route('equipments')}}"><span>Equipment Rentals</span></a></li>
                            <li><a href="#book"><span>Catering Services</span></a></li>
                            <li><a href="#book"><span>Event Management</span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="xl:w-3/12 lg:w-3/12 sm:w-6/12 w-full px-[15px]	">
                    <div class="widget widget_services mb-[30px]">
                        <h5
                            class="footer-title mb-[30px] xl:text-2xl text-xl font-semibold text-white uppercase leading-[1.1]">
                            Help Center</h5>
                        <ul>
                            <li><a href="{{ route('policy')}}"><span>Policy</span></a></li>
                            <li><a href="{{ route('guide')}}"><span>Terms & Conditions</span></a></li>
                            <li><a href="#footer"><span>Contact Us</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="footer-bottom relative py-5 border-t border-[#ffffff1a]">
            <div class="row">
                <div class="md:w-1/2 w-full md:text-left text-center px-[15px]">
                    <p class="text-sm text-[#999999]">Copyright {{ date('Y') }} All rights reserved.</p>
                </div>
                <div class="md:w-1/2 w-full md:text-right text-center px-[15px] md:mt-0 mt-[15px]">
                    <span class="text-sm text-[#999999]">Designed by <a href="https://ilvariretechnologies.com/"
                            target="_blank" class="text-primary">Ilvarire Technologies</a></span>
                </div>
            </div>
        </div>
    </div>
    <img src="assets/images/background/pic5.png" alt=""
        class="bg1 bottom-[10px] left-0 absolute max-2xl:hidden animate-dz">
    <img src="assets/images/background/pic6.png" alt=""
        class="top-[15px] right-[10px] absolute max-2xl:hidden animate-dz">
</section>