@extends('.user.layouts.master')

@section('content')
    <section class="content-header">
        @include('layouts.errors')
        @include('flash::message')

        <h1>
            Edit Comment
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">

                    @foreach($comment as $comment)

                        <form method="POST" action="/user/{{ $comment->id }}/updatecomment">
                            {{ csrf_field() }}


                            <div class="form-group col-sm-8">
                                {!! Form::label('body', 'Body:') !!}
                                {!! Form::textarea('body', $comment->body, ['class' => 'form-control']) !!}
                            </div>


                            <div class="form-group col-sm-8">

                                <strong>Create Date:</strong>

                                <input disabled class="form-control" type="date" name="created_at"
                                       value="{{ \Carbon\Carbon::parse($comment->created_at)->format('Y-m-d')}}">
                            </div>


                            <div class="form-group col-sm-8">

                                <strong>Update Date:</strong>

                                <input disabled class="form-control" type="date" name="updated_at"
                                       value="{{ \Carbon\Carbon::parse($comment->updated_at)->format('Y-m-d')}}">
                            </div>


                            <div class="form-group col-sm-8">
                                <button class='btn btn-primary btn-xs'>Save</button>
                                <a href="/user/{{ Auth::user()->id }}/comments"
                                   class='btn btn-default btn-xs'>Back</a>
                            </div>
                        </form>


                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection