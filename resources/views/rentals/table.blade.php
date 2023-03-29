<div class="table-responsive-sm">
    <table class="table table-striped" id="rentals-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Pelanggan</th>
                <th>Mobil</th>
                <th>Sopir</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Jenis Transaksi</th>
                <th>Status</th>
                <th>Grand Total</th>
                <th aria-colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($rentals as $rental)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $rental->pelanggan->nama }}</td>
                    <td>{{ $rental->detailMobil->mobil->nama . ' / ' . $rental->detailMobil->plat }}</td>
                    <td>{{ isset($rental->sopir_id) ? $rental->sopir->nama : '-' }}</td>
                    <td>{{ date('d/m/Y', $rental->waktu_mulai) }}</td>
                    <td>{{ date('d/m/Y', $rental->waktu_selesai) }}</td>
                    <td> <span
                            class="badge bg-{{ $rental->jenis_transaksi == 'offline' ? 'success' : 'primary' }}">{{ $rental->jenis_transaksi }}</span>
                    </td>
                    <td> <span
                            class="badge bg-{{ (($rental->status == 'pemesananan' ? 'primary' : $rental->status == 'berjalan') ? 'secondary' : $rental->status == 'selesai') ? 'success' : 'danger' }}">{{ $rental->status }}</span>
                    </td>
                    <td>Rp. {{ $rental->grand_total }}</td>
                    <td>
                        {!! Form::open(['route' => ['rentals.destroy', $rental->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('rentals.show', [$rental->id]) }}" class='btn btn-ghost-secondary'><i
                                    class="fa fa-eye"></i></a>
                            <a href="{{ route('rentals.show', [$rental->id]) }}"
                                class='btn btn-ghost-warning {{ $rental->waktu_mulai <= time() ? 'disabled' : '' }}'><i
                                    class="fa fa-paper-plane-o"></i></a>
                            <a href="{{ route('rentals.edit', [$rental->id]) }}"
                                class='btn btn-ghost-success  {{ $rental->waktu_mulai <= time() ? 'disabled' : '' }}'><i
                                    class="fa fa-money"></i></a>
                            <a href="{{ route('rentals.edit', [$rental->id]) }}"
                                class='btn btn-ghost-info  {{ $rental->waktu_mulai <= time() ? 'disabled' : '' }}'><i
                                    class="fa fa-edit"></i></a>
                            {!! Form::button('<i class="fa fa-times-circle-o"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-ghost-danger',
                                'onclick' => "return confirm('Are you sure?')",
                                'disabled' => $rental->waktu_mulai <= time() ? true : false,
                            ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
