@extends('landing.layouts.app')
@section('content')
    <div class="hero-wrap ftco-degree-bg" style="background-image: url('{{ asset('img/banner.png') }}');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
                <div class="col-lg-8 ftco-animate">
                    <div class="text w-100 text-center mb-md-5 pb-md-5">
                        <h1 class="mb-4">Pastikan Perjalanan anda cepat, aman dan nyaman bersama Wijaya Rental Car</h1>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-no-pt bg-light">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-12	featured-top">
                    <div class="row no-gutters">
                        <div class="col-md-4 d-flex align-items-center">
                            <form action="#" class="request-form ftco-animate bg-primary" style="width: inherit;">
                                <h2>Buat Perjalanamu</h2>
                                <div class="form-group">
                                    <label for="kategori_id" class="label">Kategori</label>
                                    {!! Form::select('kategori_id', ['' => 'Pilih Kategori'] + $kategoris->toArray(), null, [
                                        'class' => 'form-control',
                                    ]) !!}
                                    @push('css')
                                        <style>
                                            select option {
                                                color: black;
                                            }
                                        </style>
                                    @endpush
                                </div>
                                <div class="form-group">
                                    <label for="mobil_id" class="label">Mobil</label>
                                    {!! Form::select('mobil_id', ['' => 'Pilih Mobil'], null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group mr-2">
                                    <label for="waktu_mulai" class="label">Tanggal Mulai</label>
                                    <input type="text" class="form-control" id="waktu_mulai" placeholder="Date">
                                </div>
                                @push('scripts')
                                    <script type="text/javascript">
                                        $('#waktu_mulai').datetimepicker({
                                            format: 'YYYY-MM-DD HH:mm:ss',
                                            useCurrent: true,
                                            icons: {
                                                up: "icon-arrow-up-circle icons font-2xl",
                                                down: "icon-arrow-down-circle icons font-2xl"
                                            },
                                            sideBySide: true,
                                            minDate: moment(),

                                        })
                                    </script>
                                @endpush

                                <div class="form-group ml-2">
                                    <label for="waktu_selesai" class="label">Tanggal Selesai</label>
                                    <input type="text" class="form-control" id="waktu_selesai" placeholder="Date">
                                </div>
                                @push('scripts')
                                    <script type="text/javascript">
                                        $('#waktu_selesai').datetimepicker({
                                            format: 'YYYY-MM-DD HH:mm:ss',
                                            useCurrent: true,
                                            icons: {
                                                up: "icon-arrow-up-circle icons font-2xl",
                                                down: "icon-arrow-down-circle icons font-2xl"
                                            },
                                            sideBySide: true,
                                            minDate: moment()
                                        })
                                        $('#waktu_selesai').prop('disabled', true)
                                        $('#waktu_mulai').on('dp.change', function(e) {
                                            $('#waktu_selesai').prop('disabled', false)
                                            $('#waktu_selesai').datetimepicker();
                                            $('#waktu_selesai').data('DateTimePicker').minDate(e.date);
                                        });
                                    </script>
                                @endpush
                                <div class="form-group">
                                    <input type="submit" value="Sewa Mobil Sekarang" class="btn btn-secondary py-3 px-4">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-8 d-flex align-items-center">
                            <div class="services-wrap rounded-right w-100">
                                <h3 class="heading-section mb-4">Better Way to Rent Your Perfect Cars</h3>
                                <div class="row d-flex mb-4">
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                        <div class="services w-100 text-center">
                                            <div class="icon d-flex align-items-center justify-content-center"><span
                                                    class="flaticon-route"></span></div>
                                            <div class="text w-100">
                                                <h3 class="heading mb-2">Choose Your Pickup Location</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                        <div class="services w-100 text-center">
                                            <div class="icon d-flex align-items-center justify-content-center"><span
                                                    class="flaticon-handshake"></span></div>
                                            <div class="text w-100">
                                                <h3 class="heading mb-2">Select the Best Deal</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                        <div class="services w-100 text-center">
                                            <div class="icon d-flex align-items-center justify-content-center"><span
                                                    class="flaticon-rent"></span></div>
                                            <div class="text w-100">
                                                <h3 class="heading mb-2">Reserve Your Rental Car</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p><a href="{{ route('landing.car') }}" class="btn btn-primary py-3 px-4">Reserve Your
                                        Perfect Car</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>


    <section class="ftco-section ftco-no-pt bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                    <span class="subheading">What we offer</span>
                    <h2 class="mb-2">Feeatured Vehicles</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="carousel-car owl-carousel">
                        @foreach ($mobils as $mobil)
                            <div class="item">
                                <div class="car-wrap rounded ftco-animate">
                                    <div class="img rounded d-flex align-items-end"
                                        style="background-image: url('{{ asset('storage/mobils/foto/' . $mobil->foto) }}');">
                                    </div>
                                    <div class="text">
                                        <h2 class="mb-0"><a href="#">{{ $mobil->nama }}</a></h2>
                                        <div class="d-flex mb-3">
                                            <span class="cat">{{ $mobil->merk }}</span>
                                            <p class="price ml-auto">Rp. {{ $mobil->harga }}
                                                <span>/{{ $mobil->satuan }}</span>
                                            </p>
                                        </div>
                                        <p class="d-flex mb-0 d-block"><a href="#"
                                                class="btn btn-primary py-2 mr-1">Rental
                                                now</a> <a href="#" class="btn btn-secondary py-2 ml-1">Details</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-about">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center"
                    style="background-image: url({{ asset('carbook/images') }}/about.jpg);">
                </div>
                <div class="col-md-6 wrap-about ftco-animate">
                    <div class="heading-section heading-section-white pl-md-5">
                        <span class="subheading">About us</span>
                        <h2 class="mb-4">Welcome to Carbook</h2>

                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.
                            It is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                        <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it
                            would have been rewritten a thousand times and everything that was left from its origin
                            would be the word "and" and the Little Blind Text should turn around and return to its own,
                            safe country. A small river named Duden flows by their place and supplies it with the
                            necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly
                            into your mouth.</p>
                        <p><a href="{{ route('landing.car') }}" class="btn btn-primary py-3 px-4">Search Vehicle</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Services</span>
                    <h2 class="mb-3">Our Latest Services</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="services services-2 w-100 text-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span
                                class="flaticon-wedding-car"></span></div>
                        <div class="text w-100">
                            <h3 class="heading mb-2">Wedding Ceremony</h3>
                            <p>A small river named Duden flows by their place and supplies it with the necessary
                                regelialia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="services services-2 w-100 text-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span
                                class="flaticon-transportation"></span></div>
                        <div class="text w-100">
                            <h3 class="heading mb-2">City Transfer</h3>
                            <p>A small river named Duden flows by their place and supplies it with the necessary
                                regelialia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="services services-2 w-100 text-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span
                                class="flaticon-car"></span></div>
                        <div class="text w-100">
                            <h3 class="heading mb-2">Airport Transfer</h3>
                            <p>A small river named Duden flows by their place and supplies it with the necessary
                                regelialia.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="services services-2 w-100 text-center">
                        <div class="icon d-flex align-items-center justify-content-center"><span
                                class="flaticon-transportation"></span></div>
                        <div class="text w-100">
                            <h3 class="heading mb-2">Whole City Tour</h3>
                            <p>A small river named Duden flows by their place and supplies it with the necessary
                                regelialia.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-intro" style="background-image: url({{ asset('carbook/images') }}/bg_3.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-md-6 heading-section heading-section-white ftco-animate">
                    <h2 class="mb-3">Do You Want To Earn With Us? So Don't Be Late.</h2>
                    <a href="#" class="btn btn-primary btn-lg">Become A Driver</a>
                </div>
            </div>
        </div>
    </section>


    <section class="ftco-section testimony-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Testimonial</span>
                    <h2 class="mb-3">Happy Clients</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel ftco-owl">
                        <div class="item">
                            <div class="testimony-wrap rounded text-center py-4 pb-5">
                                <div class="user-img mb-2"
                                    style="background-image: url({{ asset('carbook/images') }}/person_1.jpg)">
                                </div>
                                <div class="text pt-4">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Roger Scott</p>
                                    <span class="position">Marketing Manager</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap rounded text-center py-4 pb-5">
                                <div class="user-img mb-2"
                                    style="background-image: url({{ asset('carbook/images') }}/person_2.jpg)">
                                </div>
                                <div class="text pt-4">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Roger Scott</p>
                                    <span class="position">Interface Designer</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap rounded text-center py-4 pb-5">
                                <div class="user-img mb-2"
                                    style="background-image: url({{ asset('carbook/images') }}/person_3.jpg)">
                                </div>
                                <div class="text pt-4">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Roger Scott</p>
                                    <span class="position">UI Designer</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap rounded text-center py-4 pb-5">
                                <div class="user-img mb-2"
                                    style="background-image: url({{ asset('carbook/images') }}/person_1.jpg)">
                                </div>
                                <div class="text pt-4">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Roger Scott</p>
                                    <span class="position">Web Developer</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap rounded text-center py-4 pb-5">
                                <div class="user-img mb-2"
                                    style="background-image: url({{ asset('carbook/images') }}/person_1.jpg)">
                                </div>
                                <div class="text pt-4">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Roger Scott</p>
                                    <span class="position">System Analyst</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(function() {
            $('select[name="kategori_id"]').on('change', function() {
                if ($(this).val()) {
                    $.get(`/mobils/${$(this).val()}`).then((result) => {
                        console.log(result);
                        $('select[name="mobil_id"]').empty();
                        $('select[name="mobil_id"]').append(
                            `<option value="">Pilih Mobil</option>`);
                        $.each(result, function(key, value) {
                            $('select[name="mobil_id"]').append(
                                `<option value="${key}">${value}</option>`);
                        });

                    }).catch((err) => {

                    });
                    // console.log($(this).val());
                }
            })
        });
    </script>
@endpush
