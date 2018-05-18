@extends('.user.layouts.master')

@section('content')
<section class="content-header">
    <h1>
        Show User
    </h1>
</section>
<div class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="row" style="padding-left: 20px">



                <!-- Name Field -->
                <div class="form-group">
                    {!! Form::label('name', 'Name:') !!}
                    <p>{!! $user->name !!}</p>
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    {!! Form::label('email', 'Email:') !!}
                    <p>{!! $user->email !!}</p>
                </div>


                <!-- Created at Field -->
                <div class="form-group">
                    {!! Form::label('created_at', 'Created:') !!}
                    <p>{!! $user->created_at->diffForHumans() !!}</p>
                </div>

                <!-- Updated at Field -->
                <div class="form-group">
                    {!! Form::label('updated_at', 'Update:') !!}
                    <p>{!! $user->updated_at->diffForHumans() !!}</p>
                </div>

                <a href="/" class="btn btn-default">Back</a>
                <a href="/user/{{ Auth::user()->id }}/edit" class='btn btn-primary'><i class="glyphicon glyphicon-edit"></i></a>
                <a href="/user/{{ Auth::user()->id }}/destroy" class='btn btn-danger'onclick="return confirm('Are you sure?')">
                    <i class="glyphicon glyphicon-trash"></i></a>

            </div>
        </div>
    </div>
</div>
@endsection