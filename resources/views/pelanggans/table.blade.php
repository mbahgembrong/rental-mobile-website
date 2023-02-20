<div class="table-responsive-sm">
    <table class="table table-striped" id="pelanggans-table">
        <thead>
            <tr>
                <th>Nik</th>
        <th>Nama</th>
        <th>Tanggal Lahir</th>
        <th>Alamat</th>
        <th>Hp</th>
        <th>Ktp</th>
        <th>Email</th>
        <th>Password</th>
        <th>Foto</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($pelanggans as $pelanggan)
            <tr>
                <td>{{ $pelanggan->nik }}</td>
            <td>{{ $pelanggan->nama }}</td>
            <td>{{ $pelanggan->tanggal_lahir }}</td>
            <td>{{ $pelanggan->alamat }}</td>
            <td>{{ $pelanggan->hp }}</td>
            <td>{{ $pelanggan->ktp }}</td>
            <td>{{ $pelanggan->email }}</td>
            <td>{{ $pelanggan->password }}</td>
            <td>{{ $pelanggan->foto }}</td>
                <td>
                    {!! Form::open(['route' => ['pelanggans.destroy', $pelanggan->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('pelanggans.show', [$pelanggan->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('pelanggans.edit', [$pelanggan->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>