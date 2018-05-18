<form method="POST" action="/admin/store/user">
    {{ csrf_field() }}


    <div class="form-row">

        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="name">
        </div>
        <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="email@example.com">
        </div>

        <div class="form-group col-md-6">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </div>
        <div class="form-group col-md-6">
            <label for="password_confirmation">Password Confirmation</label>
            <input type="password" class="form-control" name="password_confirmation"id="password_confirmation" placeholder="Password Confirmation">
        </div>
    </div>


    <div class="form-check col-sm-6">

            <input class="form-check-input" id="role" name="role" type="hidden" name="check[0]" value="user"/>
            <input class="form-check-input" id="role" name="role" type="checkbox" name="check[0]" value="admin"/>
            <label class="form-check-label" for="role">
                Admin
            </label>

    </div>


    <button class='btn btn-primary btn-xs'>Save</button>
    <a href="/admin" class='btn btn-default btn-xs'>Cancel</a>
    {{--</div>--}}
</form>
