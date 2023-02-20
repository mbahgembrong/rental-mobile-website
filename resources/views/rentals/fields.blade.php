<!-- Pelanggan Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pelanggan_id', 'Pelanggan Id:') !!}
    {!! Form::select('pelanggan_id', $pelanggans, null, ['class' => 'form-control']) !!}
</div>

<!-- Detail Mobil Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('detail_mobil_id', 'Detail Mobil Id:') !!}
    {!! Form::select('detail_mobil_id', $detail_mobils, null, ['class' => 'form-control']) !!}
</div>

<!-- Sopir Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sopir_id', 'Sopir Id:') !!}
    {!! Form::select('sopir_id', $sopirs, null, ['class' => 'form-control']) !!}
</div>

<!-- Waktu Peminjaman Field -->
<div class="form-group col-sm-6">
    {!! Form::label('waktu_peminjaman', 'Waktu Peminjaman:') !!}
    {!! Form::number('waktu_peminjaman', null, ['class' => 'form-control']) !!}
</div>

<!-- Waktu Mulai Field -->
<div class="form-group col-sm-6">
    {!! Form::label('waktu_mulai', 'Waktu Mulai:') !!}
    {!! Form::text('waktu_mulai', null, ['class' => 'form-control', 'id' => 'waktu_mulai']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#waktu_mulai').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            icons: {
                up: "icon-arrow-up-circle icons font-2xl",
                down: "icon-arrow-down-circle icons font-2xl"
            },
            sideBySide: true
        })
    </script>
@endpush


<!-- Waktu Selesai Field -->
<div class="form-group col-sm-6">
    {!! Form::label('waktu_selesai', 'Waktu Selesai:') !!}
    {!! Form::text('waktu_selesai', null, ['class' => 'form-control', 'id' => 'waktu_selesai']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#waktu_selesai').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            icons: {
                up: "icon-arrow-up-circle icons font-2xl",
                down: "icon-arrow-down-circle icons font-2xl"
            },
            sideBySide: true
        })
    </script>
@endpush


<!-- Waktu Denda Field -->
<div class="form-group col-sm-6">
    {!! Form::label('waktu_denda', 'Waktu Denda:') !!}
    {!! Form::number('waktu_denda', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total', 'Total:') !!}
    {!! Form::number('total', null, ['class' => 'form-control']) !!}
</div>

<!-- Denda Field -->
<div class="form-group col-sm-6">
    {!! Form::label('denda', 'Denda:') !!}
    {!! Form::number('denda', null, ['class' => 'form-control']) !!}
</div>

<!-- Grand Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('grand_total', 'Grand Total:') !!}
    {!! Form::number('grand_total', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('rentals.index') }}" class="btn btn-secondary">Cancel</a>
</div>
