<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ 'Maintenance - Blitefood | Online Food Ordering, Catering & Equipment Rentals' ?? config('app.name') }}
    </title>

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

    <div class="page-wraper bg-white" style="height: 100vh">
        <div class="page-content bg-white">
            <div class="coming-wrapper overflow-hidden xl:px-[25px] py-[25px] relative z-[1]">
                <div class="container">
                    <div class="row">
                        <div class="lg:w-4/6 w-full px-[15px] mx-auto">
                            <div
                                class="inner-content text-center w-full 2xl:min-h-[650px] lg:min-h-[500px] md:min-h-[600px] sm:min-h-[500px] min-h-[400px] overflow-hidden">
                                <div
                                    class="logo-header mx-auto mb-[10px] h-[65px] w-[160px] align-middle logo-header items-center relative flex">

                                    <a href="/" class="mt-4"><br><br>
                                        <img src="/assets/images/logo.png" alt="/">
                                    </a>
                                </div>
                                <h3 class="coming-head md:text-[32px] mt-4 text-[25px] leading-[1.3] text-[#323232]">
                                    <br>Site Maintenance!
                                </h3>
                                <p class="coming-para text-[#828282] sm:text-base text-[15px] tracking-[0.01em] mb-4">
                                    Stay tuned.. we'll be right back.
                                </p>
                            </div>
                            <div class="middle-content 2xl:mb-[60px] mb-[35px]">

                                <div class="social-icon text-center">
                                    <ul class="mr-[-20px] ml-[-5px]">
                                        <li class="inline-block px-[5px] mr-5"><a target="_blank" class="text-xl"
                                                href="https://www.facebook.com/">
                                                <i class="fab fa-facebook-f text-lg"></i>
                                            </a></li>
                                        <li class="inline-block px-[5px] mr-5"><a target="_blank" class="text-xl"
                                                href="https://twitter.com/">
                                                <i class="fab fa-twitter text-lg"></i>
                                            </a></li>
                                        <li class="inline-block px-[5px] mr-5"><a target="_blank" class="text-xl"
                                                href="https://www.tiktok.com/">
                                                <i class="fa-brands fa-tiktok text-lg"></i>
                                            </a></li>
                                        <li class="inline-block px-[5px] mr-5"><a target="_blank" class="text-xl"
                                                href="https://www.instagram.com/">
                                                <i class="fab fa-instagram text-lg"></i>
                                            </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="coming-footer text-center">
                                <p class="lg:text-base text-[15px] text-[#828282] tracking-[0.01em]">© Copyrights by
                                    <a href="https://ilvariretechnologies.com/" target="_blank"
                                        class="text-primary">Ilvarire Technologies</a> | {{ date('Y') }} All Rights
                                    Reserved
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    <script src="{{ url('/assets/js/dz.ajax.js') }}"></script><!-- AJAX -->
    <script src="{{ url('/assets/js/dz.carousel.js') }}"></script><!-- OWL CAROUSEL -->
    <script src="{{ url('/assets/js/custom.min.js') }}"></script> <!-- CUSTOM.MIN.JS -->
    <script src="{{ url('/assets/vendor/rangeslider/rangeslider.js') }}"></script><!-- CUSTOM JS -->
    <script src="{{ url('/assets/js/dznav-init.js') }}"></script><!-- DZNAV INIT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>