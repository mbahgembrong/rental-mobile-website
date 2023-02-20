<!-- Mobil Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mobil_id', 'Mobil Id:') !!}
    {!! Form::select('mobil_id', $mobils, null, ['class' => 'form-control']) !!}
</div>

<!-- Plat Field -->
<div class="form-group col-sm-6">
    {!! Form::label('plat', 'Plat:') !!}
    {!! Form::text('plat', null, ['class' => 'form-control']) !!}
</div>

<!-- Stnk Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stnk', 'Stnk:') !!}
    {!! Form::text('stnk', null, ['class' => 'form-control']) !!}
</div>

<!-- Tahun Mobil Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tahun_mobil', 'Tahun Mobil:') !!}
    {!! Form::text('tahun_mobil', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('detailMobils.index') }}" class="btn btn-secondary">Cancel</a>
</div>
