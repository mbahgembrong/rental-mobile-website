<!DOCTYPE html>
<html lang="en">

<head>
    <title>Wijaya Rental</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('carbook/css') }}/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('carbook/css') }}/animate.css">

    <link rel="stylesheet" href="{{ asset('carbook/css') }}/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('carbook/css') }}/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('carbook/css') }}/magnific-popup.css">

    <link rel="stylesheet" href="{{ asset('carbook/css') }}/aos.css">

    <link rel="stylesheet" href="{{ asset('carbook/css') }}/ionicons.min.css">
    {{--
    <link rel="stylesheet" href="{{ asset('carbook/css') }}/bootstrap-datepicker.css">
    <link rel="stylesheet" href="{{ asset('carbook/css') }}/jquery.timepicker.css"> --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">

    <link rel="stylesheet" href="{{ asset('carbook/css') }}/flaticon.css">
    <link rel="stylesheet" href="{{ asset('carbook/css') }}/icomoon.css">
    <link rel="stylesheet" href="{{ asset('carbook/css') }}/style.css">
    @stack('css')
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="/"><img src="{{ asset('img/logo.svg') }}" width="100" height="100"
                    style="width: 8em; margin: -2em 0px;"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}"><a
                            href="{{ route('landing.index', []) }}" class="nav-link">Beranda</a>
                    </li>
                    <li class="nav-item {{ Request::is('about*') ? 'active' : '' }}"><a
                            href="{{ route('landing.about', []) }}" class="nav-link">Tentang Kami</a>
                    </li>
                    <li class="nav-item {{ Request::is('car*') ? 'active' : '' }}"><a
                            href="{{ route('landing.car', []) }}" class="nav-link">Mobil</a></li>
                    {{-- <li class="nav-item {{ Request::is('contact*') ? 'active' : '' }}"><a
                            href="{{ route('landing.contact', []) }}" class="nav-link">Contact</a></li> --}}


                    @if (auth()->guard('pelanggan')->check())
                        <li class="nav-item {{ Request::is('pelanggan*') ? 'active' : '' }}"><a href="/pelanggan/home"
                                class="nav-link">Dashboard
                                Pelanggan</a></li>
                    @elseif(auth()->guard('web')->check())
                        <li class="nav-item {{ Request::is('home*') ? 'active' : '' }}"><a
                                href="{{ route('home', []) }}" class="nav-link">Dashboard Admin</a></li>
                    @else
                        <li class="nav-item {{ Request::is('pelanggan*') ? 'active' : '' }}"><a
                                href="{{ route('landing.pelanggan.showLogin', []) }}" class="nav-link">Login
                                Pelanggan</a>
                        </li>
                        <li class="nav-item {{ Request::is('pelanggan*') ? 'active' : '' }}"><a
                                href="{{ route('login', []) }}" class="nav-link">Login Admin</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    @yield('content')

    <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2"><a href="/" class="logo"><img
                                    src="{{ asset('img/logo.svg') }}" width="100" height="100"
                                    style="width: 8em; margin: -2em 0px;"></a></h2>
                        <p>Rental mobil Kediri. harga sewa murah mengutamakan kenyamanan pelanggan.</p>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Pembayaran Bank BRI</h2>
                        <h6 class="ftco-heading-6">627001003192500 an Wijaya Rental Car</h6>

                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Ada Pertanyaan?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text">Jl. Kh. Hasyim
                                        Asy'ari RT/RW 001/009 Desa Banjarmlati Kec. Mojoroto, Kediri 64119.</span></li>
                                <li><a href="//wa.me/6281908237682" target="_blank"><span
                                            class="icon icon-phone"></span><span class="text">+62
                                            81908237682</span></a></li>
                                {{-- <li><a href="#"><span class="icon icon-envelope"></span><span
                                            class="text">info@yourdomain.com</span></a></li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> Wijaya Car Rental | This App is made with <i
                        class="icon-heart color-danger" aria-hidden="true"></i> by <a href="{{ url('/') }}"
                        target="_blank">Levin</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>


    <script src="{{ asset('carbook/js') }}/jquery.min.js"></script>
    <script src="{{ asset('carbook/js') }}/jquery-migrate-3.0.1.min.js"></script>
    <script src="{{ asset('carbook/js') }}/popper.min.js"></script>
    <script src="{{ asset('carbook/js') }}/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
    </script>
    <script src="{{ asset('carbook/js') }}/jquery.easing.1.3.js"></script>
    <script src="{{ asset('carbook/js') }}/jquery.waypoints.min.js"></script>
    <script src="{{ asset('carbook/js') }}/jquery.stellar.min.js"></script>
    <script src="{{ asset('carbook/js') }}/owl.carousel.min.js"></script>
    <script src="{{ asset('carbook/js') }}/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('carbook/js') }}/aos.js"></script>
    <script src="{{ asset('carbook/js') }}/jquery.animateNumber.min.js"></script>
    <script src="{{ asset('carbook/js') }}/bootstrap-datepicker.js"></script>
    <script src="{{ asset('carbook/js') }}/jquery.timepicker.min.js"></script>
    <script src="{{ asset('carbook/js') }}/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    {{-- <script src="{{ asset('carbook/js') }}/google-map.js"></script> --}}
    <script src="{{ asset('carbook/js') }}/main.js"></script>
    @stack('scripts')

</body>

</html>
