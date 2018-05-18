<table class="table table-responsive" id="clients-table">
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Tools</th>


    </tr>
    </thead>
    <tbody>

    @foreach($users as $user)
        <tr>

            <td>{!! $user->name !!}</td>
            <td>{!! $user->email !!}</td>
            <td>{!! $user->role !!}</td>
            <td>
                @if($user->status == 'online')
                    @if($user->isOnline())
                    <span style="color:green">Online</span>
                    @else
                <span style="color:orange">Away</span>
                    @endif
                @elseif($user->status == 'offline')
                <span style="color:red">Offline</span>
                @endif
            </td>
            <td>{!! $user->created_at->diffForHumans() !!}</td>
            <td>{!! $user->updated_at->diffForHumans() !!}</td>

            <td>
                <form method="POST" action="/admin/{{$user->id}}/destroy">
                    {{ csrf_field() }}

                    <a href="/admin/{{$user->id}}/show" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-eye-open"></i></a>

                    <a href="/admin/{{$user->id}}/edit" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-edit"></i></a>

                    <button class='btn btn-danger btn-xs' type="submit" name="Delete" value="Delete"
                            onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash"></i></button>


                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>