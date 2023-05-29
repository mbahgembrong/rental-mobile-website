<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Favicons -->
    {{-- <link href="{{ asset('img/logo.ico') }}" rel="icon">
    <link href="{{ asset('img/logo.ico') }}" rel="apple-touch-icon"> --}}
    <!-- Bootstrap 4.1.1 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@coreui/coreui@2.1.16/dist/css/coreui.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@icon/coreui-icons-free@1.0.1-alpha.1/coreui-icons-free.css">

    <!-- PRO version // if you have PRO version licence than remove comment and use it. -->
    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@1.0.0/css/brand.min.css">
    <link rel="stylesheet" href="https://unpkg.com/@coreui/icons@1.0.0/css/flag.min.css">
    <!-- PRO version -->

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">
    <style>
        .navbar-brand img {
            width: -webkit-fill-available;
        }

        .dataTables_wrapper {
            width: -moz-available;
        }
    </style>
    {{-- filepond --}}
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />
    {{-- Datatables --}}
    @include('layouts.datatables_css')
    <style>
        .circular--square--index {
            border-radius: 5%;
            width: 20vh;
            height: 15vh;
            box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.6);
            -moz-box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.6);
            -webkit-box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.6);
            -o-box-shadow: 10px 10px 5px rgba(0, 0, 0, 0.6);
        }
    </style>
    @stack('css')
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="/">
            <img class="navbar-brand-full" src="{{ asset('img/logo.svg') }}"style="width: inherit;" alt="InfyOm Logo">
            <img class="navbar-brand-minimized" src="{{ asset('img/logo.svg') }}" alt="InfyOm Logo">
        </a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" style="margin-right: 10px" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="true" aria-expanded="false">
                    {{ Auth::guard('pelanggan')->check() ? Auth::guard('pelanggan')->user()->nama : Auth::user()->nama }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Account</strong>
                    </div>
                    <a href="{{ Auth::guard('pelanggan')->check() ? url('/pelanggan/logout') : url('/logout') }}"
                        class="dropdown-item btn btn-default btn-flat"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-lock"></i>Logout
                    </a>

                    <form id="logout-form"
                        action="{{ Auth::guard('pelanggan')->check() ? url('/pelanggan/logout') : url('/logout') }}"
                        method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </header>

    <div class="app-body">
        @include('layouts.sidebar')
        <main class="main">
            @yield('content')
        </main>
    </div>
    <footer class="app-footer">
        <div>
            <a href="https://infyom.com">{{ env('APP_NAME') }} </a>
            <span>&copy; {{ date('Y', time()) }}</span>
        </div>
        <div class="ml-auto">
            <span>Powered by</span>
            <a href="https://coreui.io">CoreUI</a>
        </div>
    </footer>
</body>
<!-- jQuery 3.1.1 -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
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
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
{{-- Datatables --}}
@include('layouts.datatables_js')

@stack('scripts')

</html>
