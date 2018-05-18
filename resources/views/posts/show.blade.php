@extends ('layouts.master')


@section ('content')

    <div class="col-sm-10 blog-main">
        <h1> {{ $post->title }} </h1>
        <font size="2">
            @if (isset( $post->user->name ))
                <span style="color:#6aaae2">
           {{ $post->user->name }}
            </span>
            @else
                <span style="color:red"> Unknown </span>
            @endif

            on
            {{ $post->created_at->toFormattedDateString() }}
        </font>

        <hr>
        <p>
            {{ $post->body }}
        </p>
        <hr>
        <div class="comments">
            <ul class="list-group">

                @foreach ($post->comments as $comment)
                    @if($comment->status == 'activated')
                        <strong>
                            <li class="list-group-item">

                                @if(isset($comment->user->name))
                                    <span style="color:#6AAAE2"> {{ $comment->user->name }} </span>
                                @else
                                    <span style="color:#ff0000">Unknown</span>
                                @endif
                                Commented
                                <span style="color:#6aaae2"> {{ $comment->created_at->diffForHumans() }} </span>
                                <hr>
                        </strong>
                        <div class="col-sm-12 blog-main">
                            {{ $comment->body }}
                        </div>
                        </li>
                    @endif
                @endforeach
            </ul>

        </div>
        <br>

    @if (Auth::check())
        <!-- Add Comment -->

            <div class="card">

                <div class="card-block">


                    <form method="POST" action="/posts/{{ $post->id }}/comments">

                        {{ csrf_field() }}

                        <div class="form-group">

                            <textarea name='body' placeholder="Your comment here." class="form-control"
                                      required></textarea>

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add Comment</button>
                        </div>

                    </form>

                    @include('layouts.errors')


                </div>

            </div>

        @endif


    </div>

@endsection
