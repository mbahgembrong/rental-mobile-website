@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        @if (Auth::guard('pelanggan')->check())
            <li class="breadcrumb-item active">Pesan Rental</li>
        @else
            <li class="breadcrumb-item">
                <a href="{!! route('rentals.index') !!}">Rental</a>
            </li>
        @endif
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('coreui-templates::common.errors')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-plus-square-o fa-lg"></i>
                            <strong>Tambah Rental</strong>
                        </div>
                        <div class="card-body">
                            {!! Form::open([
                                'route' => Auth::guard('pelanggan')->check() ? 'pelanggan.rentals.store' : 'rentals.store',
                                'class' => 'row',
                            ]) !!}

                            @include('rentals.fields')

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            if ("{{ $request->kategori_id }}") {
                $.ajax({
                    url: `/mobil/${"{{ $request->kategori_id }}"}`,
                    type: "GET",
                    success: function(data) {
                        if (data.status == 'success') {
                            $('#form_mobil_id').show();
                            $('#form_mobil_id select').find('option')
                                .remove()
                                .end()
                            $('#form_mobil_id select').append(
                                '<option value="" disabled selected>Pilih Mobil</option>'
                            );

                            data.data.forEach(mobil => {
                                $('#form_mobil_id select').append('<option value="' +
                                    mobil.id + '" data-price="' + mobil.harga +
                                    '" data-satuan="' + mobil.satuan + '">' + mobil
                                    .nama + ' - Rp. ' +
                                    mobil.harga + ' / ' + mobil.satuan + '</option>'
                                );
                            });
                             $('#form_mobil_id select').val("{{ $request->mobil_id }}").change()
                            $('#form_waktu_mulai').show();
                            $('#form_waktu_selesai').show();
                        }
                    }
                });
            }
        })
    </script>
@endpush
