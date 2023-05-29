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
                            class="badge bg-{{ $rental->status == 'pemesanan' ? 'primary' : ($rental->status == 'berjalan' ? 'secondary' : ($rental->status == 'selesai' ? 'success' : ($rental->status == 'terlambat' ? 'warning' : 'danger'))) }}">{{ $rental->status }}</span>
                    </td>
                    <td>Rp. {{ $rental->grand_total }}</td>

                    <td>
                        {!! Form::open([
                            'route' => [Auth::guard('pelanggan')->check() ? 'pelanggan.rentals.destroy' : 'rentals.destroy', $rental->id],
                            'method' => 'delete',
                        ]) !!}
                        <div class='btn-group'>
                            <a href="{{ route(Auth::guard('pelanggan')->check() ? 'pelanggan.rentals.show' : 'rentals.show', [$rental->id]) }}"
                                class='btn btn-ghost-secondary'><i class="fa fa-eye"></i></a>
                            @if (!Auth::guard('pelanggan')->check())
                                <a href="#" data-id="{{ $rental->id }}" data-status="{{ $rental->status }}"
                                    class='btn btn-ghost-warning status {{ $rental->waktu_mulai <= time() || $rental->status_pembayaran != 'lunas' || in_array($rental->status, ['batal', 'selesai']) ? 'disabled' : '' }}'><i
                                        class="fa fa-paper-plane-o"></i></a>
                            @endif
                            <a href="{{ route('rentals.bayar', [$rental->id]) }}"
                                class='btn btn-ghost-success  {{ $rental->waktu_mulai <= time() || $rental->status_pembayaran == 'lunas' || in_array($rental->status, ['batal', 'selesai', 'berjalan']) ? 'disabled' : '' }}'><i
                                    class="fa fa-money"></i></a>
                            {{-- <a href="{{ route('rentals.edit', [$rental->id]) }}"
                                class='btn btn-ghost-info  {{ $rental->waktu_mulai <= time() ? 'disabled' : '' }}'><i
                                    class="fa fa-edit"></i></a> --}}
                            {!! Form::button('<i class="fa fa-times-circle-o"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-ghost-danger',
                                'disabled' =>
                                    $rental->waktu_mulai <= time() || $rental->status != 'pemesanan' || $rental->status_pembayaran == 'lunas'
                                        ? true
                                        : false,
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
            $('.btn-group').on('click', '.status', function() {
                const id = $(this).data('id');
                const status = $(this).data('status');
                Swal.fire({
                    title: "Apakah anda yakin?",
                    text: `Rental akan ${status == 'pemesanan' ? 'berjalan':'selesai'} !`,
                    icon: 'warning',
                    confirmButtonText: "Ya!",
                    showCancelButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('rentals.status') }}",
                            type: "POST",
                            data: {
                                id: id,
                                _token: "{{ csrf_token() }}",
                                status: status == 'pemesanan' ? 'berjalan' : 'selesai'
                            },
                            success: function(data) {
                                Swal.fire({
                                    title: "Berhasil!",
                                    text: `Mobil telah ${status == 'pemesanan' ? 'berjalan' : 'selesai'} !`,
                                    icon: 'success',
                                    confirmButtonText: "Ok!",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                }).catch((err) => {
                                    console.log(err);
                                });
                            },
                            error: function(err) {
                                console.log(err);
                            }
                        })
                    }
                }).catch((err) => {
                    console.log(err);
                })
            })
        })
    </script>
@endpush
