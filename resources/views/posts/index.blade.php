@extends ('layouts.master')

@section ('content')

    {{--<div class="col-sm-8 blog-main">--}}
        {{--<nav class="blog-pagination">--}}
            @if(count($posts))

                @foreach ($posts as $post)
                    @include('posts.post')
                @endforeach

            @else
                {{--<h1><span style="color:#6aaae2">Nothing To See Here.</span></h1>--}}
                @include('layouts.space')
            @endif
        {{--</nav>--}}

    {{--</div>--}}

@endsection