<!-- Nik Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nik', 'Nik:') !!}
    {!! Form::text('nik', null, ['class' => 'form-control']) !!}
</div>

<!-- Nomor Sim Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nomor_sim', 'Nomor Sim:') !!}
    {!! Form::text('nomor_sim', null, ['class' => 'form-control']) !!}
</div>

<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>

<!-- Tanggal Lahir Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal_lahir', 'Tanggal Lahir:') !!}
    {!! Form::text('tanggal_lahir', null, ['class' => 'form-control','id'=>'tanggal_lahir']) !!}
</div>

@push('scripts')
   <script type="text/javascript">
           $('#tanggal_lahir').datetimepicker({
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


<!-- Alamat Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('alamat', 'Alamat:') !!}
    {!! Form::textarea('alamat', null, ['class' => 'form-control']) !!}
</div>

<!-- Hp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hp', 'Hp:') !!}
    {!! Form::text('hp', null, ['class' => 'form-control']) !!}
</div>

<!-- Ktp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ktp', 'Ktp:') !!}
    {!! Form::file('ktp') !!}
</div>
<div class="clearfix"></div>

<!-- Sim Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sim', 'Sim:') !!}
    {!! Form::file('sim') !!}
</div>
<div class="clearfix"></div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control','minlength' => 8]) !!}
</div>

<!-- Foto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('foto', 'Foto:') !!}
    {!! Form::file('foto') !!}
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('sopirs.index') }}" class="btn btn-secondary">Cancel</a>
</div>
