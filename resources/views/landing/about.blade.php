@extends('landing.layouts.app')
@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('img/banner.png') }}');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('landing.index') }}">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>About us <i
                                class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-3 bread">About Us</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-about">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center"
                    style="background-image: url({{ asset('img/banner-right.jpg') }}); ">
                </div>
                <div class="col-md-6 wrap-about ftco-animate">
                    <div class="heading-section heading-section-white pl-md-5">
                        <span class="subheading">Tentang Kami</span>
                        <h2 class="mb-4">Selamat datang di Wijaya Rental Car</h2>

                        <p>Penyedia jasa rental mobil terbaik untuk kebutuhan transportasi Anda di daerah Kediri. Kami telah
                            beroperasi selama kurang lebih 6 tahun, memberikan layanan terbaik dan berkualitas kepada
                            pelanggan kami di seluruh Indonesia khususnya Kota Kediri.</p>
                        <p>Kami memiliki armada mobil yang terawat dengan baik dan selalu siap digunakan untuk berbagai
                            keperluan, seperti perjalanan bisnis, liburan keluarga, atau sekadar mengantar tamu dari dan ke
                            bandara. Selain itu, kami juga menawarkan berbagai jenis mobil dari berbagai merek terkenal,
                            mulai dari mobil sedan, SUV, hingga minibus.</p>
                        <p>Kami memahami bahwa kenyamanan dan keamanan adalah hal yang utama dalam perjalanan Anda, oleh
                            karena itu kami selalu mengutamakan pelayanan terbaik dengan sopir yang berpengalaman dan ramah
                            serta dilengkapi dengan fasilitas keselamatan yang lengkap.</p>
                        <p>Kami juga menawarkan harga rental mobil yang terjangkau dan fleksibel, dengan berbagai pilihan
                            paket sesuai dengan kebutuhan Anda. Selain itu, kami juga memberikan layanan 24 jam untuk
                            memastikan Anda selalu terlayani dengan baik.</p>
                        <p>Kami berkomitmen untuk memberikan pengalaman rental mobil yang terbaik untuk setiap pelanggan
                            kami, dan kami selalu siap memberikan solusi terbaik untuk kebutuhan transportasi Anda. Terima
                            kasih telah memilih Wijaya Rental Car sebagai mitra perjalanan Anda.</p>
                        <p><a href="{{ route('landing.car', []) }}" class="btn btn-primary py-3 px-4">Cari Mobil</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--
    <section class="ftco-counter ftco-section img" id="section-counter">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="60">0</strong>
                            <span>Year <br>Experienced</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="1090">0</strong>
                            <span>Total <br>Cars</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="2590">0</strong>
                            <span>Happy <br>Customers</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text d-flex align-items-center">
                            <strong class="number" data-number="67">0</strong>
                            <span>Total <br>Branches</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
