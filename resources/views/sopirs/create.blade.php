@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('sopirs.index') !!}">Sopir</a>
        </li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('coreui-templates::common.errors')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-plus-square-o fa-lg"></i>
                            <strong>Tambah Sopir</strong>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['route' => 'sopirs.store', 'files' => true, 'class' => 'row']) !!}

                            @include('sopirs.fields')

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
            });
        })
    </script>
@endpush
