<!-- Kategori Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kategori_id', 'Kategori:') !!}
    <p>{{ $mobil->kategoriMobil->nama }}</p>
</div>

<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    <p>{{ $mobil->nama }}</p>
</div>

<!-- Jenis Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jenis', 'Jenis:') !!}
    <p>{{ $mobil->jenis }}</p>
</div>

<!-- Merk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('merk', 'Merk:') !!}
    <p>{{ $mobil->merk }}</p>
</div>

<!-- Harga Field -->
<div class="form-group col-sm-6">
    {!! Form::label('harga', 'Harga:') !!}
    <p>{{ number_format($mobil->harga, 2, ',', '.') . ' / ' . $mobil->satuan }}</p>
</div>


<!-- Denda Field -->
<div class="form-group col-sm-6">
    {!! Form::label('denda', 'Denda:') !!}
    <p>{{ number_format($mobil->denda, 2, ',', '.') . ' / ' . $mobil->satuan }}</p>
</div>
<div class="form-group col-sm-12">
    {!! Form::label('foto', 'Foto:') !!}
    <p> <img class="circular--square--index" style="width: 50vh;
    height: 30vh;"
            src="{{ asset('storage/mobils/foto/' . $mobil->foto) }}" /></p>
</div>
@if (count($mobil->detailMobils) > 0)
    <div class="form-group col-sm-12" id="layanan">
        <label for="jenis_kelaminModal" class="form-label">Detail Mobil</label>
        <div class="table-responsive-sm">
            <table class="table table-striped" id="mobils-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Plat</th>
                        <th>STNK</th>
                        <th>Tahun</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($mobil->detailMobils as $detailMobil)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $detailMobil->plat }}</td>
                            <td>{{ $detailMobil->stnk }}</td>
                            <td>{{ $detailMobil->tahun_mobil }}</td>
                            <td>
                                <span class="badge bg-{{ $detailMobil->status == 'tersedia' ? 'success' : 'danger' }}">
                                    {{ $detailMobil->status }} </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
