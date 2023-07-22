<div class="table-responsive-sm">
    <table class="table table-striped" id="mobils-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Kategori</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Merk</th>
                <th>Harga</th>
                <th>Denda</th>
                <th>Stock</th>
                <th aria-colspan="3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($mobils as $mobil)
                <tr>
                    <th>{{ $no++ }}</th>
                    <td>{{ $mobil->kategoriMobil->nama }}</td>
                    <td>{{ $mobil->nama }}</td>
                    <td>{{ $mobil->jenis }}</td>
                    <td>{{ $mobil->merk }}</td>
                    <td>Rp. {{ number_format($mobil->harga, 2, ',', '.') . ' / ' . $mobil->satuan }}</td>
                    <td>Rp. {{ number_format($mobil->denda, 2, ',', '.') . ' / ' . $mobil->satuan }}</td>
                    <td>
                        <span
                            class="badge bg-{{ count($mobil->detailMobils->where('status', 'tersedia')->whereNull('deleted_at')) > 0 ? 'success' : 'danger' }}">
                            {{ count($mobil->detailMobils->where('status', 'tersedia')->whereNull('deleted_at')) }}
                            Buah</span>
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
