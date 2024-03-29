<!-- Nik Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nik', 'NIK:') !!}
    {!! Form::text('nik', null, ['class' => 'form-control']) !!}
</div>

<!-- Nomor Sim Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nomor_sim', 'Nomor SIM:') !!}
    {!! Form::text('nomor_sim', null, ['class' => 'form-control']) !!}
</div>

<!-- Nama Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama', 'Nama:') !!}
    {!! Form::text('nama', null, ['class' => 'form-control']) !!}
</div>
<!-- Hp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('hp', 'Hp:') !!}
    {!! Form::text('hp', null, ['class' => 'form-control']) !!}
</div>


<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    <div class="input-group" id="show_hide_password">
        {!! Form::password('password', ['class' => 'form-control', 'minlength' => 8]) !!}
        <span class="input-group-text"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
    </div>
</div>
<!-- Tanggal Lahir Field -->
<div class="form-group col-sm-12">
    {!! Form::label('tanggal_lahir', 'Tanggal Lahir:') !!}
    {!! Form::text('tanggal_lahir', null, ['class' => 'form-control', 'id' => 'tanggal_lahir']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#tanggal_lahir').datetimepicker({
            format: 'DD/MM/YYYY',
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
            // sideBySide: true
        })
    </script>
@endpush

<!-- Alamat Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('alamat', 'Alamat:') !!}
    {!! Form::textarea('alamat', null, ['class' => 'form-control']) !!}
</div>

<!-- Ktp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ktp', 'KTP:') !!}
    {!! Form::file('ktp') !!}
</div>
<div class="clearfix"></div>

<!-- Sim Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sim', 'SIM:') !!}
    {!! Form::file('sim') !!}
</div>
<div class="clearfix"></div>

<!-- Foto Field -->
<div class="form-group col-sm-12">
    {!! Form::label('foto', 'Foto:') !!}
    {!! Form::file('foto') !!}
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('sopirs.index') }}" class="btn btn-secondary">Cancel</a>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('input[name="nik"]').keyup(e => {
                let nik = e.target.value;
                if (nik.match(/^[0-9]+$/)) {
                    if (nik.length < 16)
                        $('input[name="nik"]').val(nik)
                    else
                        $('input[name="nik"]').val(nik.substring(0, 16))
                } else
                    $('input[name="nik"]').val(nik.replace(/[^\d.-]+/g, ''))
            });
            $('input[name="nomor_sim"]').keyup(e => {
                let nomor_sim = e.target.value;
                if (nomor_sim.match(/^[0-9]+$/)) {
                    if (nomor_sim.length < 12)
                        $('input[name="nomor_sim"]').val(nomor_sim)
                    else
                        $('input[name="nomor_sim"]').val(nomor_sim.substring(0, 12))
                } else
                    $('input[name="nomor_sim"]').val(nomor_sim.replace(/[^\d.-]+/g, ''))
            });
            $('input[name="hp"]').keyup(e => {
                let hp = e.target.value;
                if (hp.match(/^[0-9]+$/)) {
                    if (hp.length < 13)
                        $('input[name="hp"]').val(hp)
                    else
                        $('input[name="hp"]').val(hp.substring(0, 13))
                } else
                    $('input[name="hp"]').val(hp.replace(/[^\d.-]+/g, ''))
            });
            $("#show_hide_password span").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("fa-eye-slash");
                    $('#show_hide_password i').removeClass("fa-eye");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("fa-eye-slash");
                    $('#show_hide_password i').addClass("fa-eye");
                }
            });
            tinymce.init({
                selector: 'textarea',
                init_instance_callback: function(editor) {
                    var freeTiny = document.querySelector('.tox .tox-notification--in');
                    freeTiny.style.display = 'none';
                }
            });
            FilePond.registerPlugin(
                FilePondPluginFileValidateType,
                FilePondPluginImagePreview,
            );

        });
    </script>
@endpush
