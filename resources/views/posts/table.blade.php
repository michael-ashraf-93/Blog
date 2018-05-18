    <table class="table table-responsive" id="clients-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created</th>
                <th>Updated</th>


            </tr>
        </thead>
        <tbody>

            @foreach($users as $user)
            <tr>



            <td>{!! $user->name !!}</td>
            <td>{!! $user->email !!}</td>
            <td>{!! $user->role !!}</td>
            <td>{!! $user->created_at->diffForHumans() !!}</td>
            <td>{!! $user->updated_at->diffForHumans() !!}</td>




{{--             <td>
                {!! Form::open(['route' => ['admin.destroy', $user->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('admin.show', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('admin.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>  --}}
        </tr>
        @endforeach
    </tbody>
    </table