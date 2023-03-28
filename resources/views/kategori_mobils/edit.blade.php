@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('kategoriMobils.index') !!}">Kategori Mobil</a>
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
                            <strong>Edit Kategori Mobil</strong>
                        </div>
                        <div class="card-body">
                            {!! Form::model($kategoriMobil, [
                                'route' => ['kategoriMobils.update', $kategoriMobil->id],
                                'method' => 'patch',
                                'class' => 'row',
                            ]) !!}

                            @include('kategori_mobils.fields')

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
