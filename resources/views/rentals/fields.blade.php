<!-- Pelanggan Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pelanggan_id', 'Pelanggan :') !!}
    @if (Auth::guard('pelanggan')->check())
        <p class="form-control">{{ Auth::guard('pelanggan')->user()->nama }}</p>
        <input type="hidden" name="pelanggan_id" value="{{ Auth::guard('pelanggan')->user()->id }}">
    @else
        {!! Form::select('pelanggan_id', $pelanggans, null, ['class' => 'form-control']) !!}
    @endif
</div>
<!-- Kategori Mobil Id Field -->
<div class="form-group col-sm-6" id="form_kategori_id">
    {!! Form::label('kategori_id', 'Kategori Mobil:') !!}
    {!! Form::select(
        'kategori_id',
        ['' => 'Pilih Kategori'] + $kategoris->toArray(),
        $request->kategori_id ?? null,
        [
            'class' => 'form-control',
        ],
    ) !!}
</div>
<!--  Mobil Id Field -->
<div class="form-group col-sm-12" id="form_mobil_id">
    {!! Form::label('mobil_id', 'Mobil:') !!}
    {!! Form::select('mobil_id', [], null, ['class' => 'form-control']) !!}
</div>
<!-- Waktu Mulai Field -->
<div class="form-group col-sm-6" id="form_waktu_mulai">
    {!! Form::label('waktu_mulai', 'Waktu Mulai:') !!}
    {!! Form::text('waktu_mulai', null, ['class' => 'form-control', 'id' => 'waktu_mulai']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#waktu_mulai').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
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
            sideBySide: true,
            minDate: moment(),

        });
    </script>
@endpush


<!-- Duration Field -->
<div class="form-group col-sm-6" id="form_duration">
    {!! Form::label('duration', 'Durasi :') !!}
    <div class="input-group mb-3">
        {!! Form::text('duration', null, [
            'class' => 'form-control',
            'id' => 'duration',
            'aria-describedby' => 'addon-duration',
            'placeholder' => 'Durasi',
        ]) !!}
        <span class="input-group-text" id="addon-duration">Jam</span>
    </div>
</div>
<div class="form-group col-sm-6" id="form_waktu_selesai">
    {!! Form::label('waktu_selesai', 'Waktu Selesai:') !!}
    {!! Form::text('waktu_selesai', null, ['class' => 'form-control', 'id' => 'waktu_selesai', 'readonly']) !!}
</div>
<!-- Detail Mobil Id Field -->
<div class="form-group col-sm-6" id="form_detail_mobil_id">
    {!! Form::label('detail_mobil_id', 'Detail Mobil:') !!}
    <input type="hidden" name="detail_mobil_id" value="">
    {!! Form::text('detail_mobil_plat', null, ['class' => 'form-control', 'readonly']) !!}
</div>


<!-- Sopir Id Field -->
<div class="form-group col-sm-12" id="form_sopir_id">
    {!! Form::label('sopir_id', 'Sopir :') !!}
    <div class="row">
        <div class="col-md-6">
            <input type="radio" name="sopir" id="radioSopir"value=true data-toggle="collapse" data-target="#sopir"
                aria-expanded="false" aria-controls="sopir"> Sopir
        </div>
        <div class="col-md-6">
            <input type="radio" name="sopir" id="radioNonSopir" value=false data-toggle="collapse"
                data-target="#nonSopir" aria-expanded="false" aria-controls="nonSopir"> Non Sopir
        </div>
    </div>
    {!! Form::select('sopir_id', [], null, ['class' => 'form-control col-sm-12']) !!}
</div>

<!-- Grand Total Field -->
<div class="form-group col-sm-12" id="form_grand_total">
    {!! Form::label('grand_total', 'Grand Total:') !!}
    {!! Form::number('grand_total', null, ['class' => 'form-control', 'readonly']) !!}
</div>
<input type="hidden" name="total">
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary', 'disabled']) !!}
    @if (!Auth::guard('pelanggan')->check())
        <a href="{{ route('rentals.index') }}" class="btn btn-secondary">Cancel</a>
    @endif
</div>
@push('scripts')
    <script>
        $(function() {
            $('#form_mobil_id').hide();
            $('#form_detail_mobil_id').hide();
            $('#form_sopir_id').hide();
            $('select[name="sopir_id"]').hide();
            $('#form_waktu_selesai').hide();
            $('#form_waktu_mulai').hide();
            $('#form_duration').hide();
            $('#form_grand_total').hide();
            let grandTotal = 0;
            let totalCar = 0;
            let totalSopir = 0;
            let countTime = 0;
            let priceCar = 0;
            let priceSopir = 0;
            let typeCar = 'hari';
            let waktuMulai = 0;
            let waktuSelesai = 0;
            let sopir = [];
            // script pencarian mobil
            $('#form_kategori_id').on('change', function() {
                var kategori_id = $(this).find('select').val();
                $.ajax({
                    url: `/mobil/${kategori_id}`,
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
                            $('#form_detail_mobil_id select').find('option')
                                .remove()
                                .end()
                            $('#form_detail_mobil_id select').append(
                                '<option value="" disabled selected>Pilih Detail Mobil</option>'
                            );
                        }
                    }
                });
            });

            function updateGrandTotal() {
                priceCar = $('select[name="mobil_id"]').find(':selected').data('price') || 0;
                typeCar = $('select[name="mobil_id"]').find(':selected').data('satuan') || 'hari';
                countTime = typeCar == 'hari' ? Math.round((waktuSelesai - waktuMulai) / 86_400) : Math
                    .round((waktuSelesai - waktuMulai) / 3_600);
                totalCar = countTime * priceCar;
                totalSopir = countTime * priceSopir;
                grandTotal = totalCar + totalSopir;
                console.log(grandTotal, totalCar, countTime, priceCar, typeCar, priceSopir, totalSopir);
                if (grandTotal > 0) {
                    $('#form_grand_total').show();
                    $('input[name="total"]').val(grandTotal);
                    $('#grand_total').val(grandTotal);
                    $('input[type="submit"]').prop('disabled', false)
                } else {
                    $('#form_grand_total').hide();
                    $('input[type="submit"]').prop('disabled', true)
                }
            }

            $('#form_mobil_id').on('change', function() {
                var mobilId = $(this).find('select').val();
                waktuMulai = moment($('#waktu_mulai').val()).unix();
                typeCar = $(this).find('select').find('option:selected').data('satuan');
                if (typeCar == 'hari') {
                    waktuSelesai = moment($('#waktu_mulai').val()).add(countTime, 'days').unix();
                } else {
                    waktuSelesai = moment($('#waktu_mulai').val()).add(countTime, 'hours').unix();
                }
                $('#addon-duration').html(typeCar);
                $('#form_waktu_mulai').show();
                $('#form_duration').show();

                if (mobilId && waktuMulai && waktuSelesai)
                    cekKetersediaanMobil(mobilId, waktuMulai, waktuSelesai);
            });
            $('#form_waktu_mulai').on('dp.change', function(e) {
                var mobilId = $('#form_mobil_id').find('select').val();
                waktuMulai = moment(e.date.format(e.date._f)).unix();
                if (typeCar == 'hari') {
                    waktuSelesai = moment($('#waktu_mulai').val()).add(countTime, 'days').unix();
                } else {
                    waktuSelesai = moment($('#waktu_mulai').val()).add(countTime, 'hours').unix();
                }
                if (mobilId && waktuMulai && waktuSelesai)
                    cekKetersediaanMobil(mobilId, waktuMulai, waktuSelesai);
            });
            $('input[name="duration"]').on('change', function(e) {
                countTime = $(this).val();
                if (countTime == '') {
                    countTime = 0;
                }
                if (!`${countTime}`.match(/^\d+$/)) {
                    countTime = 0;
                    Swal.fire(
                        'Oops!',
                        'Durasi harus angka!',
                        'error'
                    );
                    $(this).val(countTime)
                } else {
                    var mobilId = $('#form_mobil_id').find('select').val();
                    countTime = parseInt(countTime);
                    if (typeCar == 'hari') {
                        waktuSelesai = moment($('#waktu_mulai').val()).add(countTime, 'days').unix();
                    } else {
                        waktuSelesai = moment($('#waktu_mulai').val()).add(countTime, 'hours').unix();
                    }
                    console.log(mobilId, waktuMulai, waktuSelesai);
                    if (mobilId && waktuMulai && waktuSelesai)
                        cekKetersediaanMobil(mobilId, waktuMulai, waktuSelesai);

                }
            });
            // cek ketersedian mobil
            function cekKetersediaanMobil(mobilId, waktuMulai, waktuSelesai) {
                $.ajax({
                    url: "{{ route('rentals.cekKetersediaanMobil') }}",
                    type: "GET",
                    data: {
                        mobil_id: mobilId,
                        waktu_mulai: waktuMulai,
                        waktu_selesai: waktuSelesai
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            console.log(data.data, countTime);
                            if (data.data.length > 0) {
                                console.log(data.data, countTime);
                                if (countTime != 0) {
                                    updateGrandTotal()
                                    $('#form_sopir_id').show();
                                    $('#form_waktu_selesai').show();
                                    $('#form_detail_mobil_id').show();
                                    $('input[name="waktu_selesai"]').val(moment.unix(waktuSelesai)
                                        .format('YYYY-MM-DD HH:mm:ss'))
                                    $('input[name="detail_mobil_id"]').val(data.data[0].id)
                                    $('input[name="detail_mobil_plat"]').val(data.data[0].plat)
                                    cekKetersedianSopir()
                                }
                            } else {
                                $('#form_detail_mobil_id').hide();
                                $('#form_sopir_id').hide();
                                $('#form_waktu_selesai').hide();
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Mobil tidak tersedia!',
                                })
                                $('#form_grand_total').hide();
                                $('input[type="submit"]').prop('disabled', true)
                            }
                        }
                    },
                });
            }

            $('#radioSopir').click(function() {
                $('select[name="sopir_id"]').show();
                cekKetersedianSopir();
            });

            $('#radioNonSopir').click(function() {
                $('select[name="sopir_id"]').hide();
                $('select[name="sopir_id"]').val('');
                priceSopir = 0;
                updateGrandTotal()
            });
            $('select[name="sopir_id"]').on('change', function() {
                if (typeCar == 'hari') {
                    priceSopir = {{ env('PRICE_SOPIR_DAY', 100000) }};
                } else {
                    priceSopir = {{ env('PRICE_SOPIR_HOUR', 1000) }};
                }
                priceSopir = {{ env('PRICE_SOPIR_DAY', 100000) }};
                // $(this).find('option').
                // each(function() {
                //     // if ($(this).val() == $(this).parent().val()) {
                //     //     priceSopir = $(this).data('price');
                //     // }
                //     if ($(this).val() == '') {
                //         $(this).attr('selected', false)
                //     }
                // });
                updateGrandTotal()
            })

            // cek ketersedian sopir
            function cekKetersedianSopir() {
                $.ajax({
                    url: "{{ route('rentals.cekKetersediaanSopir') }}",
                    type: "GET",
                    data: {
                        waktu_mulai: waktuMulai,
                        waktu_selesai: waktuSelesai
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            sopir = data.data;
                            $('select[name="sopir_id"]').click(function(e) {
                                e.preventDefault();
                                $(this).find('option')
                                    .remove()
                                    .end();
                                if (sopir.length > 0) {
                                    // $(this).append(
                                    //     '<option value="" disabled selected>Pilih Sopir</option>'
                                    // );
                                    sopir.forEach(sopir => {
                                        $(this).append(
                                            '<option value="' +
                                            sopir.id + '">' + sopir.nama +
                                            '</option>'
                                        );
                                    });
                                } else {
                                    $(this).hide();
                                    $(this).val('');
                                    $('#radioSopir').attr('checked', false)
                                    $('#radioNonSopir').attr('checked', true)
                                    priceSopir = 0;
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Sopir tidak tersedia!',
                                    });
                                }
                            });
                        }
                    },
                });
            }
        });
    </script>
@endpush
