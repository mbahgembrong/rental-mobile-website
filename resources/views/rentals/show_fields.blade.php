<!-- Pelanggan Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pelanggan_id', 'Pelanggan :') !!}
    <p>{{ $rental->pelanggan->nama }}</p>
</div>

<!-- Mobil Field -->
<div class="form-group col-sm-6">
    {!! Form::label('detail_mobil_id', 'Mobil:') !!}
    <p>{{ $rental->detailMobil->mobil->nama . ' / ' . $rental->detailMobil->plat }}</p>
</div>
@isset($rental->sopir_id)
    <!-- Sopir Id Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('sopir_id', 'Sopir :') !!}
        <p>{{ $rental->sopir->nama }}</p>
    </div>
@endisset

<!-- Waktu Mulai Field -->
<div class="form-group col-sm-6">
    {!! Form::label('waktu_mulai', 'Waktu Mulai:') !!}
    <p>{{ $rental->detailMobil->mobil->satuan == 'hari' ? date('d/m/Y  H:m:i', $rental->waktu_mulai) : date('d/m/Y H:i', $rental->waktu_mulai) }}
    </p>
</div>

<!-- Waktu Selesai Field -->
<div class="form-group col-sm-6">
    {!! Form::label('waktu_selesai', 'Waktu Selesai:') !!}
    <p>{{ $rental->detailMobil->mobil->satuan == 'hari' ? date('d/m/Y  H:m:i', $rental->waktu_selesai) : date('d/m/Y H:i', $rental->waktu_selesai) }}
    </p>
</div>
@if ($rental->waktu_denda > 0)
    <div class="form-group col-sm-6">
        {!! Form::label('waktu_rental', 'Waktu Rental:') !!}
        <p>{{ round(($rental->waktu_selesai - $rental->waktu_mulai) / ($rental->detailMobil->mobil->satuan == 'hari' ? 86_400 : 3_600)) . ' ' . $rental->detailMobil->mobil->satuan }}
        </p>
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('waktu_rental', ' Total Peminjaman:') !!}
        <p>Rp. {{ number_format($rental->total, 2, ',', '.') }}
        </p>
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('waktu_denda', 'Waktu Denda:') !!}
        <p>{{ round(($rental->waktu_denda - $rental->waktu_selesai) / ($rental->detailMobil->mobil->satuan == 'hari' ? 86_400 : 3_600)) . ' ' . $rental->detailMobil->mobil->satuan }}
        </p>
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('denda', ' Denda:') !!}
        <p>Rp. {{ number_format($rental->denda, 2, ',', '.') }}
        </p>
    </div>
@endif
<!-- Grand Total Field -->
<div class="form-group col-sm-6 ">
    {!! Form::label('grand_total', 'Grand Total :  ') !!}
    <p style="display: contents;">Rp. {{ number_format($rental->grand_total, 2, ',', '.') }}</p>
</div>
{{-- form selesai --}}
@if ($rental->status == 'selesai' && ($rental->ulasan()->first() != null || Auth::guard('pelanggan')->check()))
    <form action="{{ route('rentals.ulasan', $rental->id) }}" method="post" class="col-sm-12 row"
        enctype="multipart/form-data">
        @csrf
        <div class="form-group col-sm-12" id="form_bayar">
            {!! Form::label('star', 'Rating :', ['class' => 'd-block']) !!}
            <div class="stars">
                <input class="star star-5" value="5" id="star-5" type="radio" name="star" />
                <label class="star star-5" for="star-5"></label>
                <input class="star star-4" value="4" id="star-4" type="radio" name="star" />
                <label class="star star-4" for="star-4"></label>
                <input class="star star-3" value="3" id="star-3" type="radio" name="star" />
                <label class="star star-3" for="star-3"></label>
                <input class="star star-2" value="2" id="star-2" type="radio" name="star" />
                <label class="star star-2" for="star-2"></label>
                <input class="star star-1" value="1" id="star-1" type="radio" name="star" />
                <label class="star star-1" for="star-1"></label>
            </div>
        </div>
        <div class="form-group col-sm-12" id="form_ulasan">
            {!! Form::label('ulasan', 'Ulasan:') !!}
            @if ($rental->ulasan()->first() != null || !Auth::guard('pelanggan')->check())
                <p>{!! $rental->ulasan()->first()->ulasan !!}</p>
            @else
                {!! Form::textarea('ulasan', null, ['class' => 'form-control']) !!}
            @endif
        </div>
        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            @if ($rental->ulasan()->first() == null)
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            @endif
            <a href="{{ Auth::guard('pelanggan')->check() ? route('pelangan.rentals.index') : route('rentals.index') }}"
                class="btn btn-secondary">Cancel</a>
        </div>
    </form>
    @push('css')
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <style>
            div.stars {
                width: 270px;
                display: inline-block;
            }

            input.star {
                display: none;
            }

            label.star {
                float: right;
                padding: 10px;
                font-size: 36px;
                color: #444;
                transition: all .2s;
            }

            input.star:checked~label.star:before {
                content: '\f005';
                color: #FD4;
                transition: all .25s;
            }

            input.star-5:checked~label.star:before {
                color: #FE7;
                text-shadow: 0 0 20px #952;
            }

            input.star-1:checked~label.star:before {
                color: #F62;
            }

            label.star:hover {
                transform: rotate(-15deg) scale(1.3);
            }

            label.star:before {
                content: '\f006';
                font-family: FontAwesome;
            }
        </style>
    @endpush
    @push('scripts')
        <script>
            $(function() {
                if ({!! json_encode($rental->ulasan()->first() != null || !Auth::guard('pelanggan')->check()) !!}) {
                    for (let index = 1; index <= {{ $rental->ulasan()->first()->star ?? 0 }}; index++) {
                        $(`input.star-${index}`).prop('checked', true);
                    }
                    $('input.star').prop('disabled', true)
                } else {
                    tinymce.init({
                        selector: 'textarea',
                        init_instance_callback: function(editor) {
                            var freeTiny = document.querySelector('.tox .tox-notification--in');
                            freeTiny.style.display = 'none';
                        }
                    });
                }
            })
        </script>
    @endpush
@endif
{{-- form pembayaran --}}
@isset($bayar)
    @php
        $kurangBayar =
            $rental->grand_total -
            $rental
                ->detailPembayaran()
                ->whereNotNull('user_validasi_id')
                ->orderBy('created_at', 'DESC')
                ->sum('jumlah');
    @endphp
    <div class="form-group col-sm-6 ">
        {!! Form::label('kurang_bayar', 'Kurang Bayar :  ') !!}
        <p style="display: contents;" id="kurangBayar">Rp. -
            {{ number_format($kurangBayar, 2, ',', '.') }}
        </p>
    </div>
    @if (
        $rental->detailPembayaran()->orderBy('created_at', 'DESC')->count() != 0 &&
            $rental->detailPembayaran()->orderBy('created_at', 'DESC')->first()->user_validasi_id == null)
        <form action="{{ route('rentals.validasi', $rental->id) }}" method="post" class="col-sm-12 row">
            @csrf
            <input type="hidden" name="valid" value="true">
            <!-- Grand Total Field -->
            <div class="form-group col-sm-12" id="form_bayar">
                {!! Form::label('bayar', 'Total Bayar:') !!}
                {!! Form::number(
                    'bayar',
                    $rental->detailPembayaran()->orderBy('created_at', 'DESC')->first()->jumlah,
                    ['class' => 'form-control', 'disabled'],
                ) !!}
            </div>
            <div class="form-group col-sm-12" id="form_bayar">
                {!! Form::label('bukti', 'Bukti Bayar:') !!}
                <p> <img class="circular--square--index" style="width: 50vh;
    height: 30vh;"
                        src="{{ asset('storage/rentals/bukti/' .$rental->detailPembayaran()->orderBy('created_at', 'DESC')->first()->bukti) }}" />
                </p>
            </div>
            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                @if (!Auth::guard('pelanggan')->check())
                    {!! Form::submit('Validasi Pembayaran', ['class' => 'btn btn-primary']) !!}
                @endif
                <a href="{{ Auth::guard('pelanggan')->check() ? route('pelangan.rentals.index') : route('rentals.index') }}"
                    class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    @else
        <form action="{{ route('rentals.pembayaran', $rental->id) }}" method="post" class="col-sm-12 row"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="grand_total" value="{{ $rental->grand_total }}">
            @if (Auth::guard('pelanggan')->check())
                <div class="m-2 alert alert-warning col-sm-12" role="alert">
                    Pembayaran minimal <b>50%</b> dari grand total, pembayaran dapat dilakukan dengan transfer ke rekening
                    BRI
                    <b>627001003192500</b> an <b>Wijaya Rental Car</b>.
                </div>
                <div class="form-group col-sm-12" id="form_bayar">
                    {!! Form::label('bayar', 'Bayar:') !!}
                    {!! Form::number(
                        'bayar',
                        $kurangBayar == $rental->grand_total ? ($rental->grand_total * 50) / 100 : $kurangBayar,
                        ['class' => 'form-control', 'readonly'],
                    ) !!}
                </div>
                <div class="form-group col-sm-12" id="form_bukti">
                    {!! Form::label('bukti', 'Bukti Pembayaran:') !!}
                    {!! Form::file('bukti') !!}
                    <div class="clearfix"></div>
                </div>
            @else
                <div class="form-group col-sm-12" id="form_bayar">
                    {!! Form::label('bayar', 'Bayar:') !!}
                    {!! Form::number('bayar', $kurangBayar, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-sm-12" id="form_kembalian">
                    {!! Form::label('kembalian', 'Kembalian:') !!}
                    {!! Form::text('kembalian', null, ['class' => 'form-control', 'readonly']) !!}
                </div>
            @endif
            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ Auth::guard('pelanggan')->check() ? route('pelangan.rentals.index') : route('rentals.index') }}"
                    class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        @push('scripts')
            <script>
                $(function() {
                    const grand_total =
                        {{ $rental->detailPembayaran()->orderBy('created_at', 'DESC')->first()->kurang ?? $rental->grand_total }};
                    $('#form_bayar').on('keyup', 'input', function(e) {
                        const bayar = $(this).val();
                        const kembalian = $('#form_kembalian input');
                        if (bayar >= grand_total) {
                            $('label[for="kembalian"]').text('Kembalian : ')
                            kembalian.val(`Rp. ${bayar - grand_total}`);
                            // $('input[type="submit"]').prop('disabled', false);
                        } else {
                            $('label[for="kembalian"]').text('Kurang Bayar : ')
                            kembalian.val(`Rp. - ${(grand_total - bayar).toLocaleString('id-ID')}`);
                            // $('input[type="submit"]').prop('disabled', true);
                        }
                    })
                    FilePond.registerPlugin(
                        FilePondPluginFileValidateType,
                        FilePondPluginImagePreview,
                    );
                    $('input[name="bukti"]').filepond({
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
    @endif
@endisset
{{-- Form addon --}}
@isset($addon)
    <form action="{{ route('rentals.store_addon', ['id' => $rental->id]) }}" method="post" class="col-sm-12 row">
        @csrf
        <div class="form-group col-sm-12" id="layanan">
            <label for="jenis_kelamin" class="form-label">Add On</label>
            <div class="form-group fieldGroup" data-id="1">
                <div class="input-group">
                    <input type="text" name="keterangan[]" class="form-control keterangan"
                        placeholder="keterangan" />
                    <input type="number" name="jumlah[]" class="form-control jumlah" placeholder="Masukkan jumlah" />
                    <div class="input-group-addon ml-3">
                        <a href="javascript:void(0)" class="btn btn-success addMore"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('rentals.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
    @push('scripts')
        <script>
            $(function() {
                $(document).on('click', '.addMore', function() {
                    var data = $(this).parents('.fieldGroup').data('id') + 1;
                    var fieldHTML = '<div class="form-group fieldGroup" data-id="' + data + '">' +
                        ' <div class="input-group">' +
                        ' <input type="text" name="keterangan[]" class="form-control keterangan" placeholder="keterangan" />' +
                        '<input type="number" name="jumlah[]" class="form-control jumlah" placeholder="Masukkan jumlah" />' +
                        '<div class="input-group-addon ml-3">' +
                        '<a href="javascript:void(0)" class="btn btn-danger remove"><i class="fa fa-minus btn-danger remove"></i></a>' +
                        '</div>' +
                        '</div>' +
                        '</div>';
                    $('.fieldGroup:last').after(fieldHTML);
                });
                $(document).on('click', '.remove', function() {
                    $(this).parents('.fieldGroup').remove();
                });
                if ({!! $rental->addon->count() !!}) {
                    const addOns = {!! json_encode($rental->addon) !!};
                    addOns.forEach((addOn, index) => {
                        if (index != 0) {
                            $('.addMore').click();
                        }
                        $('.keterangan:last').val(addOn.keterangan);
                        $('.jumlah:last').val(addOn.jumlah);
                    });
                }
            })
        </script>
    @endpush
@endisset
