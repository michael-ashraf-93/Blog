@extends('.user.layouts.master')

@section('content')
    <section class="content-header">
        @include('layouts.errors')
        @include('flash::message')
        <h1>
            Edit User
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">

                    <form method="POST" action="/user/{{ $user->id }}/update">
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
                            <input type="password" class="form-control" name="password" id="password"
                                   placeholder="Password">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirmation">Password Confirmation</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                   id="password_confirmation" placeholder="Password Confirmation">
                        </div>


                        <div class="box-body"s>
                            <button class='btn btn-primary btn-xs'>Save</button>
                            <a href="/user/{{ Auth::user()->id }}/profile" class='btn btn-default btn-xs'>Back</i></a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection