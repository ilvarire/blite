<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ? $title : 'Blitefood | Online Food Ordering, Catering & Equipment Rentals'}}</title>

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
    <link rel="icon" type="image/png" href="{{ url('/assets/images/favicon.png')}}">

    <!-- Flaticon -->
    <link rel="stylesheet" href="{{ url('/assets/icons/flaticon/flaticon_swigo.css')}}">


    <link href="{{ url('/assets/vendor/niceselect/css/nice-select.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('/assets/vendor/nouislider/nouislider.min.css')}}">
    <link href="{{ url('/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('/assets/icons/font-awesome/css/all.min.css')}}">

    <!-- Line Awesome -->
    <link rel="stylesheet" href="{{ url('/assets/icons/line-awesome/css/line-awesome.min.css')}}">

    <!-- Feather -->
    <link rel="stylesheet" href="{{ url('/assets/icons/feather/css/iconfont.css')}}">

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
        class="loading-page-3 fixed top-0 left-0 w-full h-full z-[999999999] items-center justify-center bg-white "
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
        <header class="site-header main-bar-wraper main-bar-wraper top-0 left-0 w-full z-[999]">
            <div class="main-bar">
                <div class="container">
                    <!-- Website Logo -->
                    <div class="logo-header w-[180px] h-[64px] items-center relative flex float-left">
                        <a href="{{ route('home')}}" class=" pt-[5px] relative logo-white">
                            <img src="/assets/images/logo.png" width="90" alt="/">
                        </a>
                        <a href="{{ route('home')}}" class="logo-black">
                            <img src="/assets/images/logo.png" width="98" alt="/">
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
                                <img src="/assets/images/logo2.png" width="90" alt="/">
                            </a>
                        </div>
                        <ul class="nav white navbar-nav navbar lg:flex items-center float-right">
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
                            </li>
                        </ul>
                        </li>

                        @auth
                            <li class="sub-menu-down">
                                <a href="javascript:void(0);">Account</a>
                                <ul class="sub-menu">
                                    <li class="py-[5px] px-5 relative"><a href="{{ route('orders')}}">Orders</a></li>
                                    <li class="py-[5px] px-5 relative"><a href="{{ route('profile')}}">Profile</a>
                                    </li>
                                </ul>
                            </li>
                        @endauth

                        <li class="sub-menu-down">
                            <a href="javascript:void(0);">Company</a>
                            <ul class="sub-menu">
                                <li class="py-[5px] px-5 relative"><a href="{{ route('galleries')}}">Event Gallery</a>
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
                                <button class="text-primary flex mt-2 mb-2" type="submit" form="logout">

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

        <!-- Banner  -->
        <section
            class="bg-[url('../images/banner/bnr2.jpg')] bg-fixed relative z-[1] after:content-[''] after:absolute after:z-[-1] after:opacity-100 after:w-full after:h-full after:top-0 after:left-0  pt-[50px] lg:h-[450px] sm:h-[400px] h-[300px] overflow-hidden bg-cover bg-center">
            <div class="container table h-full relative z-[1] text-center">
                <div class="dz-bnr-inr-entry align-middle table-cell">
                    <h2 class="font-lobster text-white mb-5 2xl:text-[70px] md:text-[60px] text-[40px] leading-[1.2]">
                        {{ $page ? $page : ''}}
                    </h2>
                    <!-- Breadcrumb Row -->
                    <nav aria-label="breadcrumb" class="breadcrumb-row">
                        <ul
                            class="breadcrumb bg-primary shadow-[0px_10px_20px_rgba(0,0,0,0.05)] rounded-[10px] inline-block lg:py-[13px] md:py-[10px] sm:py-[5px] py-[7px] lg:px-[30px] md:px-[18px] sm:px-5 px-3.5 m-0">
                            <li class="breadcrumb-item p-0 inline-block text-[15px] font-normal">
                                <a href="{{ route('home')}}" class="text-white ">
                                    Home
                                </a>
                            </li>
                            <li class="breadcrumb-item text-white p-0 inline-block text-[15px] pl-2 font-normal active">
                                {{ $page ? $page : ''}}
                            </li>
                        </ul>
                    </nav>
                    <!-- Breadcrumb Row End -->
                </div>
            </div>
        </section>
        <!-- Banner End -->

        {{ $slot }}

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

    <script src="{{ url('/assets/js/jquery.min.js')}}"></script> <!-- JQUERY.MIN JS -->
    <script src="{{ url('/assets/vendor/niceselect/js/jquery.nice-select.min.js')}}"></script> <!-- nice-select -->
    <script src="{{ url('/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{ url('/assets/vendor/nouislider/nouislider.min.js')}}"></script><!-- NOUSLIDER MIN JS-->

    <script src="assets/vendor/masonry/masonry-4.2.2.js"></script><!-- MASONRY -->
    <script src="assets/vendor/masonry/isotope.pkgd.min.js"></script><!-- ISOTOPE -->
    <!-- PICKDATE -->
    <script src="{{ url('/assets/vendor/pickadate/lib/picker.js') }}"></script>
    <script src="{{ url('/assets/vendor/pickadate/lib/picker.date.js') }}"></script>
    <script src="{{ url('/assets/vendor/pickadate/lib/picker.time.js') }}"></script>


    <script src="{{ url('/assets/vendor/wnumb/wNumb.js')}}"></script><!-- WNUMB -->
    <script src="{{ url('/assets/vendor/rangeslider/rangeslider.js')}}"></script><!-- RANGESLIDER -->
    <script src="{{ url('/assets/js/dz.carousel.js')}}"></script>
    <script src="{{ url('/assets/js/custom.min.js')}}"></script> <!-- CUSTOM.MIN.JS -->
    <script src="{{ url('/assets/vendor/rangeslider/rangeslider.js')}}"></script><!-- CUSTOM JS -->
    <script src="{{ url('/assets/js/dznav-init.js')}}"></script><!-- DZNAV INIT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>