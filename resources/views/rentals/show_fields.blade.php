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
    <p>{{ $rental->detailMobil->mobil->satuan == 'hari' ? date('d/m/Y', $rental->waktu_mulai) : date('d/m/Y H:i', $rental->waktu_mulai) }}
    </p>
</div>

<!-- Waktu Selesai Field -->
<div class="form-group col-sm-6">
    {!! Form::label('waktu_selesai', 'Waktu Selesai:') !!}
    <p>{{ $rental->detailMobil->mobil->satuan == 'hari' ? date('d/m/Y', $rental->waktu_selesai) : date('d/m/Y H:i', $rental->waktu_selesai) }}
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
        <p>Rp. {{ $rental->total }}
        </p>
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('waktu_denda', 'Waktu Denda:') !!}
        <p>{{ round(($rental->waktu_denda - $rental->waktu_selesai) / ($rental->detailMobil->mobil->satuan == 'hari' ? 86_400 : 3_600)) . ' ' . $rental->detailMobil->mobil->satuan }}
        </p>
    </div>
    <div class="form-group col-sm-6">
        {!! Form::label('denda', ' Denda:') !!}
        <p>Rp. {{ $rental->denda }}
        </p>
    </div>
@endif
<!-- Grand Total Field -->
<div class="form-group col-sm-12 ">
    {!! Form::label('grand_total', 'Grand Total :  ') !!}
    <p style="display: contents;">{{ $rental->grand_total }}</p>
</div>
@isset($bayar)
    <form action="{{ route('rentals.pembayaran', $rental->id) }}" method="post" class="col-sm-12 row">
        @csrf
        <input type="hidden" name="grand_total" value="{{ $rental->grand_total }}">
        <!-- Grand Total Field -->
        <div class="form-group col-sm-12" id="form_bayar">
            {!! Form::label('bayar', 'Bayar:') !!}
            {!! Form::number('bayar', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-sm-12" id="form_kembalian">
            {!! Form::label('kembalian', 'Kembalian:') !!}
            {!! Form::text('kembalian', null, ['class' => 'form-control', 'readonly']) !!}
        </div>
        <!-- Submit Field -->
        <div class="form-group col-sm-12">
            {!! Form::submit('Save', ['class' => 'btn btn-primary', 'disabled']) !!}
            <a href="{{ route('rentals.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
    @push('scripts')
        <script>
            $(function() {
                const grand_total = {{ $rental->grand_total }};
                $('#form_bayar').on('keyup', 'input', function(e) {
                    const bayar = $(this).val();
                    const kembalian = $('#form_kembalian input');
                    if (bayar >= grand_total) {
                        kembalian.val(`Rp. ${bayar - grand_total}`);
                        $('input[type="submit"]').prop('disabled', false);
                    } else {
                        kembalian.val('');
                        $('input[type="submit"]').prop('disabled', true);
                    }
                })
            })
        </script>
    @endpush
@endisset
