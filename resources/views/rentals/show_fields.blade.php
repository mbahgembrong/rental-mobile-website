<!-- Pelanggan Id Field -->
<div class="form-group">
    {!! Form::label('pelanggan_id', 'Pelanggan Id:') !!}
    <p>{{ $rental->pelanggan_id }}</p>
</div>

<!-- Detail Mobil Id Field -->
<div class="form-group">
    {!! Form::label('detail_mobil_id', 'Detail Mobil Id:') !!}
    <p>{{ $rental->detail_mobil_id }}</p>
</div>

<!-- Sopir Id Field -->
<div class="form-group">
    {!! Form::label('sopir_id', 'Sopir Id:') !!}
    <p>{{ $rental->sopir_id }}</p>
</div>

<!-- Waktu Peminjaman Field -->
<div class="form-group">
    {!! Form::label('waktu_peminjaman', 'Waktu Peminjaman:') !!}
    <p>{{ $rental->waktu_peminjaman }}</p>
</div>

<!-- Waktu Mulai Field -->
<div class="form-group">
    {!! Form::label('waktu_mulai', 'Waktu Mulai:') !!}
    <p>{{ $rental->waktu_mulai }}</p>
</div>

<!-- Waktu Selesai Field -->
<div class="form-group">
    {!! Form::label('waktu_selesai', 'Waktu Selesai:') !!}
    <p>{{ $rental->waktu_selesai }}</p>
</div>

<!-- Waktu Denda Field -->
<div class="form-group">
    {!! Form::label('waktu_denda', 'Waktu Denda:') !!}
    <p>{{ $rental->waktu_denda }}</p>
</div>

<!-- Total Field -->
<div class="form-group">
    {!! Form::label('total', 'Total:') !!}
    <p>{{ $rental->total }}</p>
</div>

<!-- Denda Field -->
<div class="form-group">
    {!! Form::label('denda', 'Denda:') !!}
    <p>{{ $rental->denda }}</p>
</div>

<!-- Grand Total Field -->
<div class="form-group">
    {!! Form::label('grand_total', 'Grand Total:') !!}
    <p>{{ $rental->grand_total }}</p>
</div>

