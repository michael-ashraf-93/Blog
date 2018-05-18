<form method="POST" action="/admin/{{ $user->id }}/update">
    {{ csrf_field() }}

    <div class="form-group col-sm-6">
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-sm-6">
        {!! Form::label('email', 'Email:') !!}
        {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
    </div>


    <div class="form-group col-sm-6">

        <strong>Create Date:</strong>

        <input disabled class="form-control" type="date" name="created_at"
               value="{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d')}}">
    </div>


    <div class="form-group col-sm-6">

        <strong>Update Date:</strong>

        <input disabled class="form-control" type="date" name="updated_at"
               value="{{ \Carbon\Carbon::parse($user->updated_at)->format('Y-m-d')}}">
    </div>

    <div class="form-group col-md-6">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
    </div>
    <div class="form-group col-md-6">
        <label for="password_confirmation">Password Confirmation</label>
        <input type="password" class="form-control" name="password_confirmation"id="password_confirmation" placeholder="Password Confirmation">
    </div>

    <div class="form-check col-sm-6">

        @if("$user->role" == "admin")

            <input class="form-check-input" checked id="role" name="role" type="hidden" name="check[0]" value="user"/>
            <input class="form-check-input" checked id="role" name="role" type="checkbox" name="check[0]"
                   value="admin"/>
            <label class="form-check-label" for="role">
                Admin
            </label>

        @else

            <input class="form-check-input" id="role" name="role" type="hidden" name="check[0]" value="user"/>
            <input class="form-check-input" id="role" name="role" type="checkbox" name="check[0]" value="admin"/>
            <label class="form-check-label" for="role">
                Admin
            </label>

        @endif

    </div>


    <button class='btn btn-primary btn-xs'>Save</button>
    <a href="/admin" class='btn btn-default btn-xs'>Cancel</i></a>
</form>
