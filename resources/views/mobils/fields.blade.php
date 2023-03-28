<!-- Kategori Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('kategori_id', 'Kategori Id:') !!}
    {!! Form::select('kategori_id', $kategori_mobils, null, ['class' => 'form-control']) !!}
</div>

<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Jenis Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jenis', 'Jenis:') !!}
    {!! Form::text('jenis', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::text('type', null, ['class' => 'form-control']) !!}
</div>

<!-- Merk Field -->
<div class="form-group col-sm-12">
    {!! Form::label('merk', 'Merk:') !!}
    {!! Form::text('merk', null, ['class' => 'form-control']) !!}
</div>

<!-- Harga Field -->
<div class="form-group col-sm-6">
    {!! Form::label('harga', 'Harga:') !!}
    {!! Form::number('harga', null, ['class' => 'form-control']) !!}
</div>

<!-- Satuan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('satuan', 'Satuan:') !!}
    {!! Form::select('satuan', ['hari' => 'Hari', 'jam' => 'Jam'], null, ['class' => 'form-control']) !!}
</div>

<!-- Denda Field -->
<div class="form-group col-sm-12">
    {!! Form::label('denda', 'Denda:') !!}
    {!! Form::number('denda', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-12" id="layanan">
    <label for="jenis_kelaminModal" class="form-label">Detail Mobil</label>
    <div class="form-group fieldGroup" data-id="1">
        <div class="input-group">
            <input type="text" name="plat[]" class="form-control plat" placeholder="Plat" />
            <input type="text" name="stnk[]" class="form-control stnk" placeholder="Masukkan stnk" />
            <input type="text" name="tahun_mobil[]" class="form-control tahun_mobil" placeholder="Tahun Mobil" />
            <div class="input-group-addon ml-3">
                <a href="javascript:void(0)" class="btn btn-success addMore"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('mobils.index') }}" class="btn btn-secondary">Cancel</a>
</div>
@push('scripts')
    <script>
        $(function() {
            $(document).on('click', '.addMore', function() {
                var data = $(this).parents('.fieldGroup').data('id') + 1;
                var fieldHTML = '<div class="form-group fieldGroup" data-id="' + data + '">' +
                    '<div class="input-group">' +
                    '<input type="text" name="plat[]" class="form-control plat" placeholder="Plat" />' +
                    '<input type="text" name="stnk[]" class="form-control stnk" placeholder="Masukkan stnk" />' +
                    '<input type="text" name="tahun_mobil[]" class="form-control tahun_mobil" placeholder="Tahun Mobil" />' +
                    '<div class="input-group-addon ml-3">' +
                    '<a href="javascript:void(0)" class="btn btn-danger remove"><i class="fa fa-minus"></i></a>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $('.fieldGroup:last').after(fieldHTML);
            });
            $(document).on('click', '.remove', function() {
                $(this).parents('.fieldGroup').remove();
            });
            $(document).on('click', '.tahun_mobil', function() {
                $(this).datetimepicker({
                    format: 'YYYY',
                     useCurrent: true,
                });
            })
        })
    </script>
@endpush
