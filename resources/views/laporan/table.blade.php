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
                <th>Denda</th>
                {{-- <th>Total</th> --}}
                <th>Grand Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentals as $index => $rental)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $rental->pelanggan->nama }}</td>
                    <td>{{ $rental->detailMobil->mobil->nama . ' / ' . $rental->detailMobil->plat }}</td>
                    <td>{{ isset($rental->sopir_id) ? $rental->sopir->nama : '-' }}</td>
                    <td>{{ date('d/m/Y H:m:i', $rental->waktu_mulai) }}</td>
                    <td>{{ date('d/m/Y H:m:i', $rental->waktu_selesai) }}</td>
                    <td>
                        Rp. {{ number_format($rental->denda, 2, ',', '.') }}
                    </td>
                    {{-- <td>
                        Rp. {{ $rental->total }}
                    </td> --}}
                    <td>Rp. {{ number_format($rental->grand_total, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6"></td>
                <td>Total : </td>
                <td>Rp. {{number_format($rentals->sum('grand_total') , 2, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</div>
@push('scripts')
    <script>
        $(function() {
            $('.table').DataTable().destroy();
            $('.table').DataTable({
                responsive: true,
                paging: false,
                searching: false,
                ordering: false,
                "sScrollX": "100%",
                "sScrollXInner": "110%",
                "bScrollCollapse": true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ]
            });
        })
    </script>
@endpush
