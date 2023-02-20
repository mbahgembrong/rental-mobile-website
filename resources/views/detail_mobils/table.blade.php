<div class="table-responsive-sm">
    <table class="table table-striped" id="detailMobils-table">
        <thead>
            <tr>
                <th>Mobil Id</th>
        <th>Plat</th>
        <th>Stnk</th>
        <th>Tahun Mobil</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($detailMobils as $detailMobil)
            <tr>
                <td>{{ $detailMobil->mobil_id }}</td>
            <td>{{ $detailMobil->plat }}</td>
            <td>{{ $detailMobil->stnk }}</td>
            <td>{{ $detailMobil->tahun_mobil }}</td>
            <td>{{ $detailMobil->status }}</td>
                <td>
                    {!! Form::open(['route' => ['detailMobils.destroy', $detailMobil->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('detailMobils.show', [$detailMobil->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('detailMobils.edit', [$detailMobil->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>