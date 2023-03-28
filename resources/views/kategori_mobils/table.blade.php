<div class="table-responsive-sm">
    <table class="table table-striped" id="kategoriMobils-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategoriMobils as $kategoriMobil)
                <tr>
                    <td>{{ $kategoriMobil->nama }}</td>
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
