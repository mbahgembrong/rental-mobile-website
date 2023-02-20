<div class="table-responsive-sm">
    <table class="table table-striped" id="sopirs-table">
        <thead>
            <tr>
                <th>Nik</th>
        <th>Nomor Sim</th>
        <th>Nama</th>
        <th>Tanggal Lahir</th>
        <th>Alamat</th>
        <th>Hp</th>
        <th>Ktp</th>
        <th>Sim</th>
        <th>Email</th>
        <th>Password</th>
        <th>Foto</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($sopirs as $sopir)
            <tr>
                <td>{{ $sopir->nik }}</td>
            <td>{{ $sopir->nomor_sim }}</td>
            <td>{{ $sopir->nama }}</td>
            <td>{{ $sopir->tanggal_lahir }}</td>
            <td>{{ $sopir->alamat }}</td>
            <td>{{ $sopir->hp }}</td>
            <td>{{ $sopir->ktp }}</td>
            <td>{{ $sopir->sim }}</td>
            <td>{{ $sopir->email }}</td>
            <td>{{ $sopir->password }}</td>
            <td>{{ $sopir->foto }}</td>
                <td>
                    {!! Form::open(['route' => ['sopirs.destroy', $sopir->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('sopirs.show', [$sopir->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('sopirs.edit', [$sopir->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>