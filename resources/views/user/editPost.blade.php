@extends('.user.layouts.master')

@section('content')
    <section class="content-header">
        @include('layouts.errors')
        @include('flash::message')

        <h1>
            Edit Post
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">

                    @foreach($post as $post)
                        <form method="POST" action="/user/{{ $post->id }}/updatepost">
                            {{ csrf_field() }}


                            <div class="form-group col-sm-8">
                                {!! Form::label('title', 'Title:') !!}
                                {!! Form::text('title', $post->title, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group col-sm-8">
                                {!! Form::label('body', 'Body:') !!}
                                {!! Form::textarea('body', $post->body, ['class' => 'form-control']) !!}
                            </div>


                            <div class="form-group col-sm-8">

                                <strong>Create Date:</strong>

                                <input disabled class="form-control" type="date" name="created_at"
                                       value="{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d')}}">
                            </div>


                            <div class="form-group col-sm-8">

                                <strong>Update Date:</strong>

                                <input disabled class="form-control" type="date" name="updated_at"
                                       value="{{ \Carbon\Carbon::parse($post->updated_at)->format('Y-m-d')}}">
                            </div>



                            <div class="form-group col-sm-8">
                                <button class='btn btn-primary btn-xs'>Save</button>
                                <a href="/user/{{ Auth::user()->id }}/posts" class='btn btn-default btn-xs'>Back</a>
                            </div>
                        </form>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection