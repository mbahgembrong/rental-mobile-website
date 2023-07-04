@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Laporan</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('flash::message')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i>
                            Laporan
                        </div>
                        <div class="card-body">
                            <div class="form-group col-sm-6">
                                {!! Form::label('date', 'Pilih Bulan:') !!}
                                <div class="row">
                                    {!! Form::text('date', null, ['class' => 'form-control mb-2 col-8 mr-2', 'id' => 'date']) !!}
                                    <button class='btn btn-primary col-3' id="btn-cari"
                                        style="margin-bottom: 0.5rem!important;">Cari</button>
                                </div>
                                @push('scripts')
                                    <script>
                                        $(function() {
                                            $('#date').datetimepicker({
                                                format: 'YYYY-MM',
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
                                            });
                                            let date = 0;
                                            $('#date').on('dp.change', function(e) {
                                                date = e.date.unix();
                                            });
                                            $('#btn-cari').click(function(e) {
                                                if (date > 0) {
                                                    window.location.href = `?date=${date}`;
                                                }

                                            });
                                        })
                                    </script>
                                @endpush
                            </div>
                            @include('laporan.table')
                            <div class="pull-right mr-3">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
