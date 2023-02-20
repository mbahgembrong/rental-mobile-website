<div class="table-responsive-sm">
    <table class="table table-striped" id="rentals-table">
        <thead>
            <tr>
                <th>Pelanggan Id</th>
        <th>Detail Mobil Id</th>
        <th>Sopir Id</th>
        <th>Waktu Peminjaman</th>
        <th>Waktu Mulai</th>
        <th>Waktu Selesai</th>
        <th>Waktu Denda</th>
        <th>Total</th>
        <th>Denda</th>
        <th>Grand Total</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($rentals as $rental)
            <tr>
                <td>{{ $rental->pelanggan_id }}</td>
            <td>{{ $rental->detail_mobil_id }}</td>
            <td>{{ $rental->sopir_id }}</td>
            <td>{{ $rental->waktu_peminjaman }}</td>
            <td>{{ $rental->waktu_mulai }}</td>
            <td>{{ $rental->waktu_selesai }}</td>
            <td>{{ $rental->waktu_denda }}</td>
            <td>{{ $rental->total }}</td>
            <td>{{ $rental->denda }}</td>
            <td>{{ $rental->grand_total }}</td>
                <td>
                    {!! Form::open(['route' => ['rentals.destroy', $rental->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('rentals.show', [$rental->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('rentals.edit', [$rental->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>