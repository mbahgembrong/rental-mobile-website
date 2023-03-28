@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('mobils.index') !!}">Mobil</a>
        </li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('coreui-templates::common.errors')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-edit fa-lg"></i>
                            <strong>Edit Mobil</strong>
                        </div>
                        <div class="card-body">
                            {!! Form::model($mobil, ['route' => ['mobils.update', $mobil->id], 'method' => 'patch', 'class' => 'row']) !!}

                            @include('mobils.fields')

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
            const detailMobils = {!! json_encode($mobil->detailMobils) !!};
            detailMobils.forEach((value, index) => {
                if (index == 0) {
                    $('.plat').val(value.plat);
                    $('.stnk').val(value.stnk);
                    $('.tahun_mobil').val(value.tahun_mobil);
                    if (value.status != 'tersedia') {
                        $('.addMore').attr('disabled', true);
                        $('.plat').attr('disabled', true);
                        $('.stnk').attr('disabled', true);
                        $('.tahun_mobil').attr('disabled', true);
                    }
                } else {
                    var fieldHTML = '<div class="form-group fieldGroup" data-id="' + value.id + '">' +
                        '<div class="input-group">' +
                        '<input type="text" name="plat[]" class="form-control plat" placeholder="Plat" value="' +
                        value.plat + '" ' + (value.status != 'tersedia' ? 'disabled="disabled"' : '') +
                        ' />' +
                        '<input type="text" name="stnk[]" class="form-control stnk" placeholder="Masukkan stnk" value="' +
                        value.stnk + '" ' + (value.status != 'tersedia' ? 'disabled="disabled"' : '') +
                        '/>' +
                        '<input type="text" name="tahun_mobil[]" class="form-control tahun_mobil" placeholder="Tahun Mobil" value="' +
                        value.tahun_mobil + '" ' + (value.status != 'tersedia' ? 'disabled="disabled"' :
                            '') + '/>' +
                        '<div class="input-group-addon ml-3">' +
                        '<a href="javascript:void(0)" class="btn btn-danger remove" ' + (value.status !=
                            'tersedia' ? 'disabled="disabled"' : '') + '><i class="fa fa-minus"></i></a>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    $('.fieldGroup:last').after(fieldHTML);
                }
            });
        })
    </script>
@endpush
