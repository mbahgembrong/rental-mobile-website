<div class="table-responsive-sm">
    <table class="table table-striped" id="rentals-table">
        <thead>
            <tr>
                <th>Pelanggan</th>
                <th>Mobil</th>
                <th>Sopir</th>
                {{-- <th>Waktu Peminjaman</th> --}}
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Grand Total</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentals as $rental)
                <tr>
                    <td>{{ $rental->pelanggan->nama }}</td>
                    <td>{{ $rental->detailMobil->mobil->nama . ' / ' . $rental->detailMobil->plat }}</td>
                    <td>{{ isset($rental->sopir_id) ? $rental->sopir->nama : '' }}</td>
                    {{-- <td>{{ date('d/m/Y H:i:s', $rental->waktu_peminjaman) }}</td> --}}
                    <td>{{ date('d/m/Y H:i:s', $rental->waktu_mulai) }}</td>
                    <td>{{ date('d/m/Y H:i:s', $rental->waktu_selesai) }}</td>
                    <td>Rp. {{ $rental->grand_total }}</td>
                    <td>
                        {!! Form::open(['route' => ['rentals.destroy', $rental->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('rentals.show', [$rental->id]) }}" class='btn btn-ghost-success'><i
                                    class="fa fa-eye"></i></a>
                            <a href="{{ route('rentals.edit', [$rental->id]) }}"
                                class='btn btn-ghost-info  {{ $rental->waktu_mulai <= time() ? 'disabled' : '' }}'><i
                                    class="fa fa-edit"></i></a>
                            {!! Form::button('<i class="fa fa-trash"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-ghost-danger',
                                'onclick' => "return confirm('Are you sure?')",
                                'disabled' => $rental->waktu_mulai <= time() ? 'disabled' : '',
                            ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
