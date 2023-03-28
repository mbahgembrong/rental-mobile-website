<div class="table-responsive-sm">
    <table class="table table-striped" id="sopirs-table">
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nomor SIM</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>HP</th>
                <th>Email</th>
                <th>Alamat</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sopirs as $sopir)
                <tr>
                    <td>{{ $sopir->nik }}</td>
                    <td>{{ $sopir->nomor_sim }}</td>
                    <td>{{ $sopir->nama }}</td>
                    <td>{{ $sopir->tanggal_lahir->format('d/m/Y') }}</td>
                    <td>{{ $sopir->hp }}</td>
                    <td>{{ $sopir->email }}</td>
                    <td>{!! $sopir->alamat !!}</td>
                    <td>
                        {!! Form::open(['route' => ['sopirs.destroy', $sopir->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            {{-- <a href="{{ route('sopirs.show', [$sopir->id]) }}" class='btn btn-ghost-success'><i
                                    class="fa fa-eye"></i></a> --}}
                            <a href="{{ route('sopirs.edit', [$sopir->id]) }}" class='btn btn-ghost-info'><i
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
