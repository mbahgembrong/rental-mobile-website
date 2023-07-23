@extends('landing.layouts.app')
@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('img/banner.png') }}');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('landing.index') }}">Beranda <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>Mobil </span></p>
                    <h1 class="mb-3 bread">Pilih Mobil mu</h1>
                </div>
            </div>
        </div>
    </section>


    <section class="ftco-section bg-light">

        <div class="container">
            <div class=" d-block">
                <div class="form-group row">
                    {!! Form::label('kategori_id', 'Kategori :', ['class' => 'col-sm-6']) !!}
                    {!! Form::select('kategori_id', ['' => 'Pilih Kategori'] + $kategoris->toArray(), null, [
                        'class' => 'col-sm-6',
                        'id' => 'selectKategoriCar',
                    ]) !!}
                </div>
                @push('css')
                    <style>
                        #selectKategoriCar {
                            border: none;
                        }

                        #selectKategoriCar:active {
                            border: none;
                        }
                    </style>
                @endpush
            </div>
            <div class="row">
                @foreach ($mobils as $mobil)
                    <div class="col-md-4 item">
                        <div class="car-wrap rounded ftco-animate">
                            <div class="img rounded d-flex align-items-end"
                                style="background-image: url('{{ asset('storage/mobils/foto/' . $mobil->foto) }}');">
                            </div>
                            <div class="text">
                                <h2 class="mb-0"><a href="car-single.html">{{ $mobil->nama }}</a></h2>
                                <div class="d-flex mb-3">
                                    <span class="cat">{{ $mobil->merk }}</span>
                                    <p class="price ml-auto">Rp. {{ number_format($mobil->harga, 2, ',', '.') }}
                                        <span>/{{ $mobil->satuan }}</span></p>
                                </div>
                                <p class="d-flex mb-0 d-block">
                                    <a href=" {{ Auth::guard('web')->check() ? route('rentals.create', ['mobil_id' => $mobil->id]) : route('pelanggan.rentals.create', ['mobil_id' => $mobil->id]) }}"
                                        class="btn btn-primary py-2 mr-1">Rental</a>
                                    <a class="btn btn-secondary py-2 ml-1 car-detail"
                                        data-car='{!! json_encode($mobil) !!}'>Detail</a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            @if (count($mobils) > 0)
                <div class="row mt-5">
                    <div class="col text-center">
                        <div class="block-27">
                            <ul>
                                @if ($mobils->currentPage() != 1)
                                    <li><a href="{{ $mobils->url($mobils->currentPage() - 1) }}">&lt;</a></li>
                                @endif
                                @for ($i = 1; $i <= $mobils->lastPage(); $i++)
                                    @if ($mobils->currentPage() == $i)
                                        <li class="active">
                                            <span>{{ $i }}</span>
                                        </li>
                                    @else
                                        <li><a href=" {{ $mobils->url($i) }}">{{ $i }}</a></li>
                                    @endif
                                @endfor
                                @if ($mobils->currentPage() != $mobils->lastPage())
                                    <li><a href="{{ $mobils->url($mobils->currentPage() + 1) }}">&gt;</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
@include('landing.layouts.modal_car_detail')
@push('scripts')
    <script>
        $(function() {
            $('.item').on('click', '.car-detail', function(e) {
                console.log(e);
                $('#modal-car-detail').modal();
                const detailCar = $(this).data('car');
                console.log(detailCar);
                $('#modal-car-detail #modalBodyCarDetailFoto').attr('src',
                    `{{ asset('storage/mobils/foto') }}/${detailCar.foto}`);
                $('#modal-car-detail #modalBodyCarDetailKategori').text(detailCar.kategori_mobil.nama);
                $('#modal-car-detail #modalBodyCarDetailNama').text(detailCar.nama);
                $('#modal-car-detail #modalBodyCarDetailJenis').text(detailCar.jenis);
                $('#modal-car-detail #modalBodyCarDetailMerk').text(detailCar.merk);
                $('#modal-car-detail #modalBodyCarDetailHarga').text(
                    `Rp. ${detailCar.harga.toLocaleString('id-ID')} / ${detailCar.satuan}`);
                $('#modal-car-detail #modalBodyCarDetailDenda').text(`Rp. ${detailCar.denda.toLocaleString('id-ID')}  / ${detailCar.satuan}`);

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
    <script>
        $(function() {
            $('#selectKategoriCar').on('change', function() {
                window.location.href = "{{ route('landing.car') }}?kategori_id=" + $(this).val();
            })
            const params = window.location.search.substring(1).split('&');
            if (params.length > 0) {
                const kategori_id = params[0].split('=')[1];
                $('#selectKategoriCar').val(kategori_id);
            }
        })
    </script>
@endpush
