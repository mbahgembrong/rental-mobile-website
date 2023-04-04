@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('rentals.index') }}">Rental</a>
        </li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('coreui-templates::common.errors')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Detail
                                {{ $rental->pelanggan->nama . ' - ' . $rental->detailMobil->mobil->nama . ' / ' . $rental->detailMobil->plat }}</strong>
                        </div>
                        <div class="card-body row">
                            @include('rentals.show_fields')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
