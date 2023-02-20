<div class="table-responsive-sm">
    <table class="table table-striped" id="kategoriMobils-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($kategoriMobils as $kategoriMobil)
            <tr>
                <td>{{ $kategoriMobil->nama }}</td>
                <td>
                    {!! Form::open(['route' => ['kategoriMobils.destroy', $kategoriMobil->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('kategoriMobils.show', [$kategoriMobil->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                        <a href="{{ route('kategoriMobils.edit', [$kategoriMobil->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>