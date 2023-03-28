<div class="table-responsive-sm">
    <table class="table table-striped" id="pelanggans-table">
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Hp</th>
                <th>Email</th>
                <th>Alamat</th>
                {{-- <th>Ktp</th>
                <th>Foto</th> --}}
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pelanggans as $pelanggan)
                <tr>
                    <td>{{ $pelanggan->nik }}</td>
                    <td>{{ $pelanggan->nama }}</td>
                    <td>{{ $pelanggan->tanggal_lahir->format('d/m/Y') }}</td>
                    <td>{{ $pelanggan->hp }}</td>
                    <td>{{ $pelanggan->email }}</td>
                    {{-- <td>{{ $pelanggan->ktp }}</td> --}}
                    {{-- <td>{{ $pelanggan->foto }}</td> --}}
                    <td>{!! $pelanggan->alamat !!}</td>
                    <td>
                        {!! Form::open(['route' => ['pelanggans.destroy', $pelanggan->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            {{-- <a href="{{ route('pelanggans.show', [$pelanggan->id]) }}" class='btn btn-ghost-success'><i
                                    class="fa fa-eye"></i></a> --}}
                            <a href="{{ route('pelanggans.edit', [$pelanggan->id]) }}" class='btn btn-ghost-info'><i
                                    class="fa fa-edit"></i></a>
                            {!! Form::button('<i class="fa fa-trash"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-ghost-danger',
                            ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@push('scripts')
    <script>
        $(function() {
            $('.btn-ghost-danger').click(function(event) {
                var form = $(this).closest("form")[0];
                event.preventDefault();
                Swal.fire({
                    title: "Are you sure!",
                    icon: 'warning',
                    confirmButtonText: "Yes!",
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                }).catch((err) => {
                    console.log(err);
                });
            });
        })
    </script>
@endpush
