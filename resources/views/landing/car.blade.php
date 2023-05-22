@extends('landing.layouts.app')
@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{ asset('img/banner.png') }}');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('landing.index') }}">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i
                                class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-3 bread">Choose Your Car</h1>
                </div>
            </div>
        </div>
    </section>


    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                @foreach ($mobils as $mobil)
                    <div class="col-md-4">
                        <div class="car-wrap rounded ftco-animate">
                            <div class="img rounded d-flex align-items-end"
                                style="background-image: url('{{ asset('storage/mobils/foto/' . $mobil->foto) }}');">
                            </div>
                            <div class="text">
                                <h2 class="mb-0"><a href="car-single.html">{{ $mobil->nama }}</a></h2>
                                <div class="d-flex mb-3">
                                    <span class="cat">{{ $mobil->merk }}</span>
                                    <p class="price ml-auto">Rp. {{ $mobil->harga }} <span>/{{ $mobil->satuan }}</span></p>
                                </div>
                                <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1">Book
                                        now</a>
                                    <a href="car-single.html" class="btn btn-secondary py-2 ml-1">Details</a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
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
        </div>
    </section>
@endsection
