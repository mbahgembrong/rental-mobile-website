@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Profile</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('flash::message')
            @include('coreui-templates::common.errors')
            <div class="row">
                <div class="col-lg-6">
                    <div class="card border-left-success shadow mb-4">
                        <!-- Card Body -->
                        <div class="card-body">
                            <center>
                                <div class="containerr">
                                    @if (Auth::guard('pelanggan')->user()->foto == null)
                                        <img src="{{ asset('img/default-user.jpg') }}"
                                            style="border-radius: 50%; border: 3px solid #ffffff;width:170px; height:170px"
                                            alt="image" class="image">
                                        <button class="btn-circle btn" data-toggle="modal"
                                            data-target="#Uploadpelanggans"><i class="fa fa-camera"></i>
                                        @else
                                            <img src="{{ asset('storage/pelanggans/foto/' . Auth::guard('pelanggan')->user()->foto) }}"
                                                style="border-radius: 50%; border: 3px solid #ffffff;width:170px; height:170px"
                                                alt="image" class="image">
                                            <button class="btn-circle btn" data-toggle="modal"
                                                data-target="#Uploadpelanggans"><i class="fa fa-camera"></i>
                                            </button>
                                    @endif
                                </div>
                                <br>
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    <h4><strong> {{ Auth::guard('pelanggan')->user()->name }} </strong></h4>
                                </div>
                            </center>
                        </div>
                    </div>
                    {{-- Modal --}}
                    <div class="modal" id="Uploadpelanggans">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Change Photo Profile</h4>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form role="form" action="{{ route('pelanggan.profile.update_foto') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="container">
                                            <div class="col-md-12 mb-2">
                                                {{-- <label>Nick Name</label> --}}
                                                <input type="file" class="form-control" placeholder="Enter Nick Name"
                                                    type="text" name="foto" accept="image/*">
                                            </div>
                                        </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success btn-sm shadow-sm"><i
                                            class="fa fa-check fa-sm text-white-50"></i> Submit</button>
                                    <button type="button" class="btn btn-danger btn-sm shadow-sm" data-dismiss="modal"><i
                                            class="fa fa-times fa-sm text-white-50"></i> Close</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header bg-default py-3 d-flex flex-row align-items-center justify-content-between">

                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                <h6><strong>Profile</h6></strong>
                            </div>
                            <a href="{{ route('pelanggan.profile.edit', ['id' => Auth::guard('pelanggan')->user()->id]) }}"
                                class="btn btn-success btn-sm">
                                <i class="fa fa-user-edit fa-sm text-white-50"></i>
                                Edit Profile
                            </a>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <strong>Nama </strong><br><br>
                                    <strong>NIK </strong><br><br>
                                    <strong>email </strong><br><br>
                                    <strong>Tanggal Lahir </strong><br><br>
                                    <strong>No Hp </strong><br><br>
                                    <strong>Alamat </strong>
                                </div>
                                <div class="col-8">
                                    {{ Auth::guard('pelanggan')->user()->nama }} <br><br>
                                    {{ Auth::guard('pelanggan')->user()->nik }} <br><br>
                                    {{ Auth::guard('pelanggan')->user()->email }} <br><br>
                                    {{ Auth::guard('pelanggan')->user()->tanggal_lahir->format('d/m/Y') }} <br><br>
                                    {{ Auth::guard('pelanggan')->user()->hp }} <br><br>
                                    {!! Auth::guard('pelanggan')->user()->alamat !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function() {

        })
    </script>
@endpush
