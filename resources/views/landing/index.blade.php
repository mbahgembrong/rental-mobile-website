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
                            <form
                                action="{{ Auth::guard('web')->check() ? route('rentals.create') : route('pelanggan.rentals.create') }}"
                                class="request-form ftco-animate bg-primary" style="width: inherit;" method="get">
                                <h2>Buat Perjalanamu</h2>
                                <div class="form-group">
                                    <label for="kategori_id" class="label">Kategori</label>
                                    {!! Form::select('kategori_id', ['' => 'Pilih Kategori'] + $kategoris->pluck('nama', 'id')->toArray(), null, [
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
                                    <input type="text" name="waktu_mulai" class="form-control" id="waktu_mulai"
                                        placeholder="Date">
                                </div>
                                @push('scripts')
                                    <script type="text/javascript">
                                        $('#waktu_mulai').datetimepicker({
                                            format: 'YYYY-MM-DD HH:mm:ss',
                                            useCurrent: true,
                                            icons: {
                                                time: "fa fa-clock-o",
                                                date: "fa fa-calendar",
                                                up: "fa fa-arrow-up",
                                                down: "fa fa-arrow-down",
                                                previous: "fa fa-chevron-left",
                                                next: "fa fa-chevron-right",
                                                today: "fa fa-clock-o",
                                                clear: "fa fa-trash-o"
                                            },
                                            sideBySide: true,
                                            minDate: moment(),

                                        })
                                    </script>
                                @endpush

                                {{-- <div class="form-group ml-2">
                                    <label for="waktu_selesai" class="label">Tanggal Selesai</label>
                                    <input type="text" class="form-control" name="waktu_selesai" id="waktu_selesai"
                                        placeholder="Date">
                                </div> --}}
                                {{-- @push('scripts')
                                    <script type="text/javascript">
                                        $('#waktu_selesai').datetimepicker({
                                            format: 'YYYY-MM-DD HH:mm:ss',
                                            useCurrent: true,
                                            icons: {
                                                time: "fa fa-clock-o",
                                                date: "fa fa-calendar",
                                                up: "fa fa-arrow-up",
                                                down: "fa fa-arrow-down",
                                                previous: "fa fa-chevron-left",
                                                next: "fa fa-chevron-right",
                                                today: "fa fa-clock-o",
                                                clear: "fa fa-trash-o"
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
                                @endpush --}}
                                <div class="form-group">
                                    <input type="submit" value="Sewa Mobil Sekarang" class="btn btn-secondary py-3 px-4">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-8 d-flex align-items-center">
                            <div class="services-wrap rounded-right w-100">
                                <h3 class="heading-section mb-4">Rental Mobil yang mengutamakan Kenyamanan Pelanggan</h3>
                                <div class="row d-flex mb-4">
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                        <div class="services w-100 text-center">
                                            <div class="icon d-flex align-items-center justify-content-center"><span
                                                    class="flaticon-route"></span></div>
                                            <div class="text w-100">
                                                <h3 class="heading mb-2">Pilih Lokasi Penjemputan Anda</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                        <div class="services w-100 text-center">
                                            <div class="icon d-flex align-items-center justify-content-center"><span
                                                    class="flaticon-handshake"></span></div>
                                            <div class="text w-100">
                                                <h3 class="heading mb-2">Pilih Penawaran Terbaik</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                        <div class="services w-100 text-center">
                                            <div class="icon d-flex align-items-center justify-content-center"><span
                                                    class="flaticon-rent"></span></div>
                                            <div class="text w-100">
                                                <h3 class="heading mb-2">Pesan Mobil Sewa Anda</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p><a href="{{ Auth::guard('web')->check() ? route('rentals.create') : route('pelanggan.rentals.create') }}"
                                        class="btn btn-primary py-3 px-4">Pesan
                                        Mobil
                                        Sekarang Juga!</a>
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
                    <h2 class="mb-2">Kategori Mobil</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="carousel-car owl-carousel">
                        @foreach ($kategoris as $kategori)
                            <div class="item">
                                <div class="car-wrap rounded ftco-animate">
                                    <div class="img rounded d-flex align-items-end"
                                        style="background-image: url('{{ asset('storage/kategoriMobils/foto/' . $kategori->foto) }}');">
                                    </div>
                                    <div class="text">
                                        <span class="d-flex mb-0 d-block justify-content-around">
                                            <h2 class="mb-0 mr-1" style="display: inline-block;">{{ $kategori->nama }}
                                            </h2>
                                            <a href="{{ route('landing.car', ['kategori_id' => $kategori->id]) }}"
                                                class="btn btn-primary py-2 ml-auto">Cari Mobil</a>
                                        </span>
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
                    style="background-image: url({{ asset('img/banner-right.jpg') }}); background-size: contain">
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
                        <p><a href="{{ route('landing.car') }}" class="btn btn-primary py-3 px-4">Cari Mobil</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-no-pt bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                    <h2 class="mb-2">Mobil yang Banyak di Pinjam</h2>
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
                                            <p class="price ml-auto">Rp. {{ number_format($mobil->harga, 2, ',', '.') }}
                                                <span>/{{ $mobil->satuan }}</span>
                                            </p>
                                        </div>
                                        <p class="d-flex mb-0 d-block"><a
                                                href=" {{ Auth::guard('web')->check() ? route('rentals.create', ['mobil_id' => $mobil->id]) : route('pelanggan.rentals.create', ['mobil_id' => $mobil->id]) }}"
                                                class="btn btn-primary py-2 mr-1">Rental</a> <a
                                                class="btn btn-secondary py-2 ml-1 car-detail"
                                                data-car='{!! json_encode($mobil) !!}'>Detail</a>
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
@endsection
@include('landing.layouts.modal_car_detail')
@push('scripts')
    <script>
        $(function() {

            $('.item').on('click', '.car-detail', function(e) {
                $('#modal-car-detail').modal();
                const detailCar = $(this).data('car');
                $('#modal-car-detail #modalBodyCarDetailFoto').attr('src',
                    `{{ asset('storage/mobils/foto') }}/${detailCar.foto}`);
                $('#modal-car-detail #modalBodyCarDetailKategori').text(detailCar.kategori_mobil.nama);
                $('#modal-car-detail #modalBodyCarDetailNama').text(detailCar.nama);
                $('#modal-car-detail #modalBodyCarDetailJenis').text(detailCar.jenis);
                $('#modal-car-detail #modalBodyCarDetailMerk').text(detailCar.merk);
                $('#modal-car-detail #modalBodyCarDetailHarga').text(
                    `Rp. ${detailCar.harga.toLocaleString('id-ID')} / ${detailCar.satuan}`);
                $('#modal-car-detail #modalBodyCarDetailDenda').text(
                    `Rp. ${detailCar.denda.toLocaleString('id-ID')}  / ${detailCar.satuan}`);

                let carsDetail = [];
                $.each(detailCar.detail_mobils, function(key, value) {
                    carsDetail.push(`<tr>
                        <td>${key+1}</td>
                        <td>${value.plat}</td>
                        <td>${value.stnk}</td>
                        <td>${value.tahun_mobil}</td>
                        <td>${value.status}</td>
                    </tr>`);
                });
                $('#modal-car-detail #modalBodyCarDetailMobil tbody').html(carsDetail);
            })
            $('select[name="kategori_id"]').on('change', function() {
                if ($(this).val()) {
                    $.get(`/mobil/${$(this).val()}`).then((result) => {
                        console.log(result);
                        $('select[name="mobil_id"]').empty();
                        $('select[name="mobil_id"]').append(
                            `<option value="">Pilih Mobil</option>`);
                        $.each(result.data, function(key, value) {
                            $('select[name="mobil_id"]').append(
                                `<option value="${value.id}">${value.nama}</option>`);
                        });

                    }).catch((err) => {

                    });
                    // console.log($(this).val());
                }
            })
        });
    </script>
@endpush
