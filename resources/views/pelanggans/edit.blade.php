@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! Auth::guard('pelanggan')->check() ? route('pelanggan.profile') : route('pelanggans.index') !!}">{{ Auth::guard('pelanggan')->check() ? 'Profile' : 'Pelanggan' }}</a>
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
                            <strong>Edit {{ Auth::guard('pelanggan')->check() ? 'Profile' : 'Pelanggan' }}</strong>
                        </div>
                        <div class="card-body">
                            {!! Form::model($pelanggan, [
                                'route' => [Auth::guard('pelanggan')->check() ? 'pelanggan.profile.update' : 'pelanggans.update', $pelanggan->id],
                                'method' => 'patch',
                                'files' => true,
                                'class' => 'row',
                            ]) !!}

                            @include('pelanggans.fields')

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
            $('input[name="ktp"]').filepond({
                labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
                storeAsFile: true,
                imagePreviewMaxHeight: 150,
                imagePreviewTransparencyIndicator: 'grid',
                acceptedFileTypes: ['image/*'],
                fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
                    resolve(type);
                }),
                files: [{
                    source: "{{ asset('storage/pelanggans/ktp/' . $pelanggan->ktp) }}",
                }, ]
            });
            $('input[name="foto"]').filepond({
                labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
                storeAsFile: true,
                imagePreviewMaxHeight: 150,
                imagePreviewTransparencyIndicator: 'grid',
                acceptedFileTypes: ['image/*'],
                fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
                    resolve(type);
                }),
                files: [{
                    source: "{{ asset('storage/pelanggans/foto/' . $pelanggan->foto) }}",
                }, ]
            });
            $('input[name="sim"]').filepond({
                labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
                storeAsFile: true,
                imagePreviewMaxHeight: 150,
                imagePreviewTransparencyIndicator: 'grid',
                acceptedFileTypes: ['image/*'],
                fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
                    resolve(type);
                }),
                @if ($pelanggan->sim != null)
                    files: [{
                        source: "{{ asset('storage/pelanggans/sim/' . $pelanggan->sim) }}",
                    }, ]
                @endif
            });
            $('input#tanggal_lahir').val("{{ $pelanggan->tanggal_lahir->format('d/m/Y') }}")
        })
    </script>
@endpush
