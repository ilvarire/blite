<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ 'Blitefood | Online Food Ordering, Catering & Equipment Rentals' ?? config('app.name') }}</title>

    <meta name="description"
        content="Blitefood UK offers fast online food ordering, professional catering services, and reliable equipment rentals across the UK. Order now for fresh meals and seamless event support.">
    <meta name="keywords"
        content="online food ordering UK, catering services UK, event equipment rental UK, food delivery UK, Blitefood, party catering UK, hire catering equipment, buffet service UK">
    <meta name="author" content="Blitefood UK">
    <meta name="robots" content="">
    <link rel="canonical" href="https://www.blitefood.co.uk/" />


    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.blitefood.co.uk/">
    <meta property="og:title" content="Order Food, Hire Catering Equipment & Catering Services | Blitefood UK">
    <meta property="og:description"
        content="Get food delivered, rent catering gear, or book full-service catering in the UK. Blitefood UK is your one-stop solution.">
    <meta property="og:image" content="https://www.blitefood.co.uk/assets/images/og-image.jpg">


    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://www.blitefood.co.uk/">
    <meta name="twitter:title" content="Order Food, Hire Catering Equipment & Catering Services | Blitefood UK">
    <meta name="twitter:description"
        content="Order food online or hire equipment and catering services anywhere in the UK. Fast, fresh, and reliable with Blitefood.">
    <meta name="twitter:image" content="https://www.blitefood.co.uk/assets/images/og-image.jpg">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="{{ url('/favicon.svg') }}">

    <!-- Flaticon -->
    <link rel="stylesheet" href="{{ url('/assets/icons/flaticon/flaticon_swigo.css')}}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('/assets/icons/font-awesome/css/all.min.css')}}">

    <!-- Swiper -->
    <link rel="stylesheet" href="{{ url('/assets/vendor/swiper/swiper-bundle.min.css')}}">

    <!-- Nice Select -->
    <link rel="stylesheet" href="{{ url('/assets/vendor/niceselect/css/nice-select.css')}}">

    <!-- PickDate -->
    <link rel="stylesheet" href="{{ url('/assets/vendor/pickadate/lib/themes/default.css')}}">
    <link rel="stylesheet" href="{{ url('/assets/vendor/pickadate/lib/themes/default.date.css')}}">


    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lobster&amp;family=Lobster+Two:ital,wght@0,400;0,700;1,400;1,700&amp;family=Poppins:ital,wght@0,100;0,200;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ url('/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{ url('/assets/vendor/rangeslider/rangeslider.css')}}">
</head>

<body id="bg" class="box-border m-0 selection:bg-primary selection:text-white font-poppins">

    <!-- Loader -->
    <div id="loading-area"
        class="loading-page-3 fixed top-0 left-0 w-full h-full z-[999999999] items-center justify-center bg-white"
        style="display: flex;">
        <img src="/favicon.svg" width="50" alt="" style="animation: spin 2s linear infinite !important;">
    </div>

    <!-- scrolltop-progress -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>

    <div class="page-wraper">
        <!-- Header -->
        <header class="site-header main-bar-wraper top-0 left-0 w-full z-[999]">
            <div class="main-bar">
                <div class="container">
                    <!-- Website Logo -->
                    <div class="logo-header w-[180px] h-[64px] items-center relative flex float-left">
                        <a href="{{ route('home')}}">
                            <img src="/assets/images/logo.png" width="90" alt="/">
                        </a>
                    </div>

                    <!-- Toggle button -->
                    <button
                        class="togglebtn lg:hidden block bg-primary w-[45px] h-[45px] relative rounded-md float-right mt-2 ml-2">
                        <span class="bar1"></span>
                        <span class="bar2"></span>
                        <span class="bar3"></span>
                    </button>

                    <!-- EXTRA NAV -->
                    <div class="extra-nav float-right items-center h-[64px] lg:flex relative hidden pl-[60px]">
                        <div class="extra-cell flex items-center">
                            <ul class="flex items-center gap-[10px]">
                                @auth
                                    <li class="inline-block">
                                        <a class="bg-white text-[var(--title)] user-btn white-btn flex items-center justify-center w-[45px] h-[45px] rounded-md shadow-[0_10px_10px_0_rgba(0,0,0,0.1)]"
                                            href="{{ route('profile')}}">
                                            <i class="flaticon-user text-2xl inline-flex"></i>
                                        </a>

                                    </li>
                                @endauth

                                @livewire('customer.cart')
                            </ul>
                        </div>
                    </div>
                    <!-- EXTRA NAV -->

                    <!-- EXTRA NAV SMALL-->
                    <div class="lg:hidden mt-2 extra-nav float-right items-center h-[64px] lg:flex relative pl-[60px]">
                        <div class="extra-cell flex items-center">
                            <ul class="flex items-center gap-[10px]">
                                @livewire('customer.cart')
                            </ul>
                        </div>
                    </div>
                    <!-- EXTRA NAV SMALL-->

                    <!-- Header Nav -->
                    <div class="header-nav lg:justify-end lg:flex-row flex-col lg:gap-0 gap-5 flex">
                        <div class="logo-header lg:hidden">
                            <a href="{{ route('home')}}">
                                <img src="assets/images/logo.png" width="90" alt="/">
                            </a>
                        </div>
                        <ul class="nav navbar-nav navbar lg:flex items-center float-right">
                            <li>
                                <a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="sub-menu-down">
                                <a href="javascript:void(0);">Shop</a>
                                <ul class="sub-menu">
                                    <li class="py-[5px] px-5 relative"><a href="{{ route('food')}}">Food</a></li>
                                    <li class="py-[5px] px-5 relative"><a href="{{ route('equipments')}}">Equipments</a>
                                    </li>
                                    <li class="py-[5px] px-5 relative"><a href="{{ route('cart')}}">Cart</a></li>
                                </ul>
                            </li>

                            @auth
                                <li class="sub-menu-down">
                                    <a href="javascript:void(0);">Account</a>
                                    <ul class="sub-menu">
                                        <li class="py-[5px] px-5 relative"><a href="{{ route('orders')}}">Orders</a></li>
                                        <li class="py-[5px] px-5 relative"><a href="{{ route('profile')}}">Profile</a></li>
                                    </ul>
                                </li>
                            @endauth

                            <li class="sub-menu-down">
                                <a href="javascript:void(0);">Company</a>
                                <ul class="sub-menu">
                                    <li class="py-[5px] px-5 relative"><a href="{{ route('galleries')}}">Event
                                            Gallery</a>
                                    </li>
                                    <li class="py-[5px] px-5 relative"><a href="{{ route('about')}}">About Us</a></li>
                                    <li class="py-[5px] px-5 relative"><a href="{{ route('policy')}}">Policy</a></li>
                                </ul>
                            </li>
                            @guest
                                <li>
                                    <a href="{{ route('login')}}">Login</a>
                                </li>
                                <li>
                                    <a href="{{ route('register')}}">Register</a>
                                </li>
                            @endguest

                            @auth
                                <form action="{{ route('logout') }}" method="post" id="logout" style="display: none;">
                                    @csrf
                                </form>
                                <li>
                                    <button class="text-bodycolor" type="submit" form="logout">
                                        Logout
                                    </button>
                                </li>
                            @endauth
                        </ul>

                    </div>
                </div>
            </div>
        </header>
        <!-- Header -->

        <!-- Banner -->
        <div class="main-bnr-one overflow-hidden relative">
            <div class="slider-pagination 2xl:left-[50px] xl:left-0 max-xl:left-auto max-xl:right-[20px] z-[2]">
                <div class="main-button-prev lg:block hidden mx-auto">
                    <i class="fa-solid fa-arrow-up"></i>
                </div>
                <div class="main-slider-pagination">
                    <span class="swiper-pagination-bullet">01</span>
                    <span class="swiper-pagination-bullet">02</span>
                    <span class="swiper-pagination-bullet">03</span>
                </div>
                <div class="main-button-next lg:block hidden mx-auto">
                    <i class="fa-solid fa-arrow-down"></i>
                </div>
            </div>
            <div class="main-slider-1  overflow-hidden z-[1]">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="banner-inner lg:pt-0 md:pt-[110px] pt-[110px] overflow-hidden">
                            <div class="container h-full">
                                <div class="row items-center md:justify-between justify-center h-full">
                                    <div class="md:w-7/12 px-[15px]">
                                        <div class="banner-content md:mb-[60px] mb-0">
                                            <span
                                                class="font-lobster font-medium md:text-xl text-base text-[var(--secondary-dark)] mb-[10px] block">
                                                Authentic African Flavors
                                            </span>
                                            <h1 class="font-lobster mb-2.5 text-black2">Home of<br>Yummy <span
                                                    class="text-primary">Delight</span></h1>
                                            <p
                                                class="text-black2 italic max-w-[500px] lg:text-lg sm:text-base text-xs leading-[27px]">
                                                Enjoy mouth-watering African dishes,<br>
                                                delivered right to your door.<br> Next day delivery (exceptions to quick
                                                meals)
                                                Order hours: 7am to 7pm.
                                            </p>
                                            <div class="banner-btn flex items-center lg:mt-10 mt-[25px] gap-[30px]">
                                                <a href="{{ route('food') }}"
                                                    class="font-lobster btn btn-primary btn-md btn-hover-1"><span>
                                                        View our Menu
                                                    </span></a>
                                                <a href="{{ route('cart') }}}"
                                                    class="font-lobster btn btn-outline text-primary btn-md btn-hover-1"><span>
                                                        View Cart
                                                    </span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="md:w-5/12 px-[15px]">
                                        <div class="banner-media">
                                            <img src="assets/images/main-slider/slider1/rice.png" alt="/"
                                                class="xl:w-full lg:w-[450px] md:w-[100%] sm:w-[250px] w-[250px]"
                                                style="animation: spin 20s linear infinite !important;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="banner-inner lg:pt-0 md:pt-[110px] pt-[110px] overflow-hidden">
                            <div class="container">
                                <div class="row items-center md:justify-between justify-center">
                                    <div class="md:w-7/12 px-[15px]">
                                        <div class="banner-content md:mb-[60px] mb-0">
                                            <span
                                                class="font-lobster font-medium md:text-xl text-base text-[var(--secondary-dark)] mb-[10px] block">The
                                                Catering Equipment Rentals</span>
                                            <h1 class="font-lobster mb-2.5 text-black2">Perfect for your<br> Next <span
                                                    class="text-primary">Event</span></h1>
                                            <p class="max-w-[500px] lg:text-lg sm:text-base text-sm leading-[27px]">
                                                Rent top-tier catering equipment that ensures your event is smooth and
                                                successful.</p>
                                            <div class="banner-btn flex items-center lg:mt-10 mt-[25px] gap-[30px]">
                                                <a href="{{ route('equipments') }}"
                                                    class="font-lobster btn btn-primary btn-md btn-hover-1"><span>View
                                                        Equipments</span></a>
                                                <a href="{{ route('register') }}"
                                                    class="font-lobster btn btn-outline text-primary btn-md shadow-primary btn-hover-1"><span>
                                                        Rent</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="md:w-5/12 px-[15px]">
                                        <div class="banner-media">
                                            <img src="assets/images/main-slider/slider1/pic2.png" alt="/"
                                                class="xl:w-full lg:w-[450px] md:w-[100%] sm:w-[250px] w-[250px]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <img src="assets/images/main-slider/slider1/img3.png" class="img1" alt="/">
                            <img src="assets/images/main-slider/slider1/img1.png" class="img2" alt="/">
                            <img src="assets/images/main-slider/slider1/img2.png" class="img3 animate-motion" alt="/">
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="banner-inner lg:pt-0 md:pt-[110px] pt-[110px] overflow-hidden">
                            <div class="container">
                                <div class="row items-center md:justify-between justify-center">
                                    <div class="md:w-7/12 px-[15px]">
                                        <div class="banner-content md:mb-[60px] mb-0">
                                            <span
                                                class="font-lobster font-medium md:text-xl text-base text-[var(--secondary-dark)] mb-[10px] block">
                                                Fast & Reliable Delivery
                                            </span>
                                            <h1 class="font-lobster mb-2.5 text-black2">Fresh & Delicious Food <br>
                                                Right <span class="text-primary">On Time</span></h1>
                                            <p class="max-w-[500px] lg:text-lg sm:text-base text-sm leading-[27px]">
                                                We guarantee prompt and dependable delivery for all your catering and
                                                food needs.</p>
                                            <div class="banner-btn flex items-center lg:mt-10 mt-[25px] gap-[30px]">
                                                <a href="#book"
                                                    class="font-lobster btn btn-primary btn-md btn-hover-1 shadow-primary"><span>Book
                                                        our Service</span></a>
                                                <a href="{{ route('galleries') }}"
                                                    class="font-lobster btn btn-outline text-primary btn-md shadow-primary btn-hover-1"><span>View
                                                        Events</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="md:w-5/12 px-[15px]">
                                        <div class="banner-media">
                                            <img src="assets/images/main-slider/slider1/pic3.png" alt="/"
                                                class="xl:w-full lg:w-[450px] md:w-[100%] sm:w-[250px] w-[250px]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <img src="assets/images/main-slider/slider1/img3.png" class="img1" alt="/">
                            <img src="assets/images/main-slider/slider1/img1.png" class="img2" alt="/">
                            <img src="assets/images/main-slider/slider1/img2.png" class="img3 animate-motion" alt="/">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container relative z-[1]">
                <div class="main-thumb1-area swiper-btn-lr">
                    <div class="swiper main-thumb1 w-[612px] h-auto overflow-hidden">
                        <div class="swiper-wrapper">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner -->
        <br>

        <!-- combo pack -->
        @livewire('customer.browse-menu')
        <!-- Combo pack End -->

        <!-- our Categories -->
        @livewire('customer.special')
        <!-- our Categories End -->

        <!-- our Menu Start -->
        @livewire('customer.menu')
        <!-- our Menu ends -->

        <!--  Service Start -->
        <section
            class="bg-light relative section-wrapper-3  after:content-[''] after:h-[200px] after:w-full after:bg-white after:absolute after:bottom-0 after:left-0 after:z-[0] sm:py-[100px] py-[50px]">
            <div class="container">
                <div class="2xl:mb-[50px] mb-[25px] relative mx-auto text-center">
                    <h2 class="font-lobster">Our Services</h2>
                </div>
                <div class="icon-wrapper1 bg-white rounded-[15px] relative z-[1]">
                    <div class="row">
                        <div class="lg:w-1/4 sm:w-1/2 w-full px-[15px]">
                            <div class="bg-[url('../images/gallery/grid/pic1.jpg')] icon-box-wrapper group text-center">
                                <div class="inner-content relative z-[1]">
                                    <div class="mb-[10px]">
                                        <i class="flaticon-fast-delivery text-7xl text-yellow"></i>
                                    </div>
                                    <div class="icon-content overflow-hidden text-center">
                                        <h5 class="mb-2">Food delivery</h5>
                                        <p class="sm:text-base text-[15px] group-hover:text-white">
                                            Quick, reliable delivery of authentic African dishes, bringing the taste of
                                            home right to your door.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="lg:w-1/4 sm:w-1/2 w-full px-[15px]">
                            <div class="bg-[url('../images/gallery/grid/pic2.jpg')] icon-box-wrapper group text-center">
                                <div class="inner-content relative z-[1]">
                                    <div class="mb-[10px]">
                                        <i class="flaticon-chef text-7xl text-yellow"></i>
                                    </div>
                                    <div class="icon-content overflow-hidden text-center">
                                        <h5 class="mb-2">Catering Services</h5>
                                        <p class="sm:text-base text-[15px] group-hover:text-white">
                                            Delicious, freshly prepared African meals for all types of events, designed
                                            to impress your guests.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="lg:w-1/4 sm:w-1/2 w-full px-[15px]">
                            <div class="bg-[url('../images/gallery/grid/pic3.jpg')] icon-box-wrapper group text-center">
                                <div class="inner-content relative z-[1]">
                                    <div class="mb-[10px]">
                                        <i class="flaticon-pot text-7xl text-yellow"></i>
                                    </div>
                                    <div class="icon-content overflow-hidden text-center">
                                        <h5 class="mb-2">Equipment Rentals</h5>
                                        <p class="sm:text-base text-[15px] group-hover:text-white">
                                            High-quality catering equipment for rent, ensuring your event runs smoothly
                                            and efficiently.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="lg:w-1/4 sm:w-1/2 w-full px-[15px]">
                            <div class="bg-[url('../images/gallery/grid/pic4.jpg')] icon-box-wrapper group text-center">
                                <div class="inner-content relative z-[1]">
                                    <div class="mb-[10px]">
                                        <i class="flaticon-cake text-7xl text-yellow"></i>
                                    </div>
                                    <div class="icon-content overflow-hidden text-center">
                                        <h5 class="mb-2">Event Management</h5>
                                        <p class="sm:text-base text-[15px] group-hover:text-white">
                                            Full-service event management to handle every detail, making your special
                                            occasion stress-free.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img src="/assets/images/background/pic3.png" alt=""
                class="2xl:left-[20px] 2xl:top-[20px] absolute 2xl:block hidden">
        </section>
        <!-- Service End-->

        <!-- Equipments Start  -->
        @livewire('customer.equipments')
        <!-- Equipments Ends -->

        <!-- Catering Start  -->
        @livewire('customer.catering')
        <!-- Catering End -->

        <!-- Event start -->
        @livewire('customer.event-gallery')
        <!-- Event End -->

        <!-- Footer -->
        @livewire('customer.footer')
        <!-- Footer End -->
    </div>


    <div class="menu-backdrop"></div>

    <!--Start of Tawk.to Script-->

    <script type="text/javascript">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function () {
            var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/68efe7d17690531950dd3405/1j7ki33gd';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

    <script src="{{ url('/assets/js/jquery.min.js') }}"></script> <!-- JQUERY.MIN JS -->
    <script src="{{ url('/assets/vendor/niceselect/js/jquery.nice-select.min.js') }}"></script> <!-- NICE SELECT -->
    <script src="{{ url('/assets/vendor/swiper/swiper-bundle.min.js') }}"></script> <!-- SWIPER -->


    <script src="{{ url('/assets/js/dz.carousel.js') }}"></script><!-- OWL CAROUSEL -->
    <script src="{{ url('/assets/js/custom.min.js') }}"></script> <!-- CUSTOM.MIN.JS -->
    <script src="{{ url('/assets/vendor/rangeslider/rangeslider.js') }}"></script><!-- CUSTOM JS -->
    <script src="{{ url('/assets/js/dznav-init.js') }}"></script><!-- DZNAV INIT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>