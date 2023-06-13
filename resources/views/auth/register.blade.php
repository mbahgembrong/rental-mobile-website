<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Register | {{ config('app.name') }}</title>
    <meta name="description" content="CoreUI Template - InfyOm Laravel Generator">
    <meta name="keyword" content="CoreUI,Bootstrap,Admin,Template,InfyOm,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/css/coreui.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@icon/coreui-icons-free@1.0.1-alpha.1/coreui-icons-free.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">

</head>

<body class="app flex-row align-items-center">
    <div class="container">


        <div class="row justify-content-center">
            <div class="col-md-12 ">

                <div class="card mx-4 ">
                    <div class="card-body p-4">
                        <form method="post"class="row" action="{{ url('/pelanggan/register') }}"  enctype="multipart/form-data">
                            @csrf
                            <div class="col-sm-12">
                                <h1>Register</h1>
                                <p class="text-muted">Create your account</p>
                            </div>
                            <div class="col-sm-12">
                                @include('coreui-templates::common.errors')
                            </div>
                            <!-- Nik Field -->
                            <div class="form-group col-sm-6">
                                {!! Form::label('nik', 'NIK:') !!}
                                {!! Form::text('nik', null, ['class' => 'form-control']) !!}
                            </div>

                            <!-- Nama Field -->
                            <div class="form-group col-sm-6">
                                {!! Form::label('nama', 'Nama:') !!}
                                {!! Form::text('nama', null, ['class' => 'form-control']) !!}
                            </div>
                            <!-- Hp Field -->
                            <div class="form-group col-sm-6">
                                {!! Form::label('hp', 'HP:') !!}
                                {!! Form::text('hp', null, ['class' => 'form-control']) !!}
                            </div>

                            <!-- Tanggal Lahir Field -->
                            <div class="form-group col-sm-6">
                                {!! Form::label('tanggal_lahir', 'Tanggal Lahir:') !!}
                                {!! Form::text('tanggal_lahir', null, ['class' => 'form-control', 'id' => 'tanggal_lahir']) !!}
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
                                    <span class="input-group-text"><i class="fa fa-eye-slash"
                                            aria-hidden="true"></i></span>
                                </div>
                            </div>



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

                            <!-- Foto Field -->
                            <div class="form-group col-sm-6">
                                {!! Form::label('foto', 'Foto:') !!}
                                {!! Form::file('foto') !!}
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                                <a href="{{ url('/login') }}" class="text-center">I already have a
                                    membership</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/perfect-scrollbar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
    </script>
    {{-- coreui --}}
    <script src="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/js/coreui.min.js"" type=" text/javascript">
</script>
    {{-- <script src="vendors/simplebar/js/simplebar.min.js" type="text/javascript"></script> --}}
    {{-- tinymsce --}}
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- filepond --}}
    {{-- <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script> --}}
    <script type="text/javascript">
        $('#tanggal_lahir').datetimepicker({
            format: 'DD/MM/YYYY ',
            useCurrent: true,
            icons: {
                  up: "icon-arrow-up-circle icons font-2xl",
                                                down: "icon-arrow-down-circle icons font-2xl",
                                                previous: "fa fa-chevron-left",
                                                next: "fa fa-chevron-right",
            },
        })
    </script>
    <script>
        // $(function() {
        //     $('input[name="ktp"]').filepond({
        //         labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
        //         storeAsFile: true,
        //         imagePreviewMaxHeight: 150,
        //         imagePreviewTransparencyIndicator: 'grid',
        //         acceptedFileTypes: ['image/*'],
        //         fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
        //             resolve(type);
        //         }),
        //     });
        //     $('input[name="foto"]').filepond({
        //         labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
        //         storeAsFile: true,
        //         imagePreviewMaxHeight: 150,
        //         imagePreviewTransparencyIndicator: 'grid',
        //         acceptedFileTypes: ['image/*'],
        //         fileValidateTypeDetectType: (source, type) => new Promise((resolve, reject) => {
        //             resolve(type);
        //         }),
        //     });
        // })
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
            // FilePond.registerPlugin(
            //     FilePondPluginFileValidateType,
            //     FilePondPluginImagePreview,
            // );

        });
    </script>
</body>

</html>
