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
    @php
    @endphp
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('coreui-templates::common.errors')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6"><i class="fa fa-plus-square-o fa-lg"></i>
                                    <strong>Tambah Rental</strong>
                                </div>
                                <div class="col-sm-6 d-flex  justify-content-end">
                                    @if (!Auth::guard('pelanggan')->check())
                                        {!! Form::submit('Tambah Pelanggan', [
                                            'class' => 'btn btn-success',
                                            'data-toggle' => 'modal',
                                            'data-target' => '#addPelangganeModal',
                                        ]) !!}
                                    @endif
                                </div>
                            </div>
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
@if (!Auth::guard('pelanggan')->check())
    {{-- // modall add pelanggan --}}
    <div class="modal" id="addPelangganeModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Pelanggan</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form role="form" action="{{ route('pelanggans.store_api') }}" method="POST"
                        enctype="multipart/form-data">
                        <div id="errorModal"></div>
                        @csrf
                        <div class="container row">
                            @include('pelanggans.fields')
                        </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm shadow-sm"><i
                            class="fa fa-check fa-sm text-white-50"></i> Submit</button>
                    <button type="button" class="btn btn-danger btn-sm shadow-sm" data-dismiss="modal"><i
                            class="fa fa-times fa-sm text-white-50"></i> Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div id="spinner-div" class="pt-5">
        <div class="spinner-border text-primary" role="status">
        </div>
    </div>
    @push('css')
        <style>
            #spinner-div {
                display: block;
                position: fixed;
                z-index: 100000;
                /* High z-index so it is on top of the page */
                top: 50%;
                right: 50%;
                /* or: left: 50%; */
                margin-top: -..px;
                /* half of the elements height */
                margin-right: -..px;

            }
        </style>
    @endpush
    @push('scripts')
        <script>
            $(function() {
                $('#spinner-div').hide();
                $('#addPelangganeModal input.btn').hide();
                $('#addPelangganeModal a.btn').hide();
                $('#addPelangganeModal .modal-footer button[type="submit"]').click(function(e) {
                    e.preventDefault();
                    const form = $('#addPelangganeModal form');
                    const data = new FormData(form[0])
                    const url = form.attr('action');
                    $('#spinner-div').show();
                    $.ajax({
                        type: "POST",
                        url,
                        data,
                        dataType: "json",
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            console.log(response);
                            $('#spinner-div').hide()
                            const result = response.data;
                            if (result) {
                                $('#addPelangganeModal form').trigger('reset');
                                $('#addPelangganeModal').modal('hide');
                                $('#pelanggan_id').append(
                                    `<option value="${result.id}" selected>${result.nama}</option>`
                                )
                                $('#pelanggan_id').val(result.id)
                                $('#pelanggan_id').trigger('change');
                                Swal.fire({
                                    title: `Success Tambah Pelanggan ${result.nama}`,
                                    icon: 'success',
                                    confirmButtonText: "Yes!",
                                })

                            }
                        },
                        error: function(response) {
                            $('#spinner-div').hide()
                            console.log(response.responseJSON);
                            const err = response.responseJSON.errors
                            const errModal = $('#addPelangganeModal #errorModal')
                            if (err) {
                                errModal.html('')
                                $.each(err, function(key, value) {
                                    value.forEach((mess) => {
                                        errModal.append(
                                            `<div class="alert alert-danger" role="alert">${mess}</div>`
                                        )
                                    })
                                });

                            }
                        }
                    });
                });
            })
        </script>
    @endpush
@endif
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
                $('#waktu_mulai').data('DateTimePicker').minDate(moment('{{ $request->waktu_mulai }}'));
                $('#waktu_selesai').data('DateTimePicker').minDate(moment('{{ $request->waktu_selesai }}'));
                cekKetersediaanMobil("{{ $request->mobil_id }}", moment('{{ $request->waktu_mulai }}').unix(),
                    moment('{{ $request->waktu_selesai }}').unix());
            }

        })
    </script>
@endpush
