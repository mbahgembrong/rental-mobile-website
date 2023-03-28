<div class="table-responsive-sm">
    <table class="table table-striped" id="mobils-table">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Type</th>
                <th>Merk</th>
                <th>Harga</th>
                <th>Denda</th>
                <th>Stock</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mobils as $mobil)
                <tr>
                    <td>{{ $mobil->kategoriMobil->nama }}</td>
                    <td>{{ $mobil->nama }}</td>
                    <td>{{ $mobil->jenis }}</td>
                    <td>{{ $mobil->type }}</td>
                    <td>{{ $mobil->merk }}</td>
                    <td>Rp. {{ $mobil->harga . ' / ' . $mobil->satuan }}</td>
                    <td>Rp. {{ $mobil->denda }}</td>
                    <td>
                        <span
                            class="badge bg-{{ count($mobil->detailMobils->where('status', 'tersedia')) > 0 ? 'success' : 'danger' }}">
                            {{ count($mobil->detailMobils->where('status', 'tersedia')) }} Buah</span>
                    </td>
                    <td>
                        {!! Form::open(['route' => ['mobils.destroy', $mobil->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('mobils.show', [$mobil->id]) }}" class='btn btn-ghost-success'><i
                                    class="fa fa-eye"></i></a>
                            <a href="{{ route('mobils.edit', [$mobil->id]) }}" class='btn btn-ghost-info'><i
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
