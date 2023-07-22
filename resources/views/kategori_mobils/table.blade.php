<div class="table-responsive-sm">
    <table class="table table-striped" id="kategoriMobils-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Foto</th>
                <th aria-colspan="3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($kategoriMobils as $kategoriMobil)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $kategoriMobil->nama }}</td>
                    <td><img class="circular--square--index"
                            src="{{ asset('storage/kategoriMobils/foto/' . $kategoriMobil->foto) }}" /></td>
                    <td>
                        {!! Form::open(['route' => ['kategoriMobils.destroy', $kategoriMobil->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            {{-- <a href="{{ route('kategoriMobils.show', [$kategoriMobil->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a> --}}
                            <a href="{{ route('kategoriMobils.edit', [$kategoriMobil->id]) }}"
                                class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
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
