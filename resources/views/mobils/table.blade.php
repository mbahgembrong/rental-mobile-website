<div class="table-responsive-sm">
    <table class="table table-striped" id="mobils-table">
        <thead>
            <tr>
                <th>Kategori Id</th>
        <th>Nama</th>
        <th>Jenis</th>
        <th>Type</th>
        <th>Merk</th>
        <th>Harga</th>
        <th>Satuan</th>
        <th>Denda</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($mobils as $mobil)
            <tr>
                <td>{{ $mobil->kategori_id }}</td>
            <td>{{ $mobil->nama }}</td>
            <td>{{ $mobil->jenis }}</td>
            <td>{{ $mobil->type }}</td>
            <td>{{ $mobil->merk }}</td>
            <td>{{ $mobil->harga }}</td>
            <td>{{ $mobil->satuan }}</td>
            <td>{{ $mobil->denda }}</td>
                <td>
                    {!! Form::open(['route' => ['mobils.destroy', $mobil->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('mobils.show', [$mobil->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('mobils.edit', [$mobil->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>