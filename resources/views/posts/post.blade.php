<div class="col-sm-8 blog-main">
    <nav class="blog-pagination">
        <div class="blog-post">
            <p class="blog-post-meta">
            <h2 class="blog-post-title"><a href="/posts/{{ $post->id }}"> {{ $post->title }}</a></h2>

            @if(isset($post->user->name))

                <span style="color:#33cc33">{{ $post->user->name }} </span>

            @else

                <span style="color:#ff0000">Unknown </span>

            @endif

            on
            <span style="color:#6aaae2">{{ $post->created_at->toFormattedDateString() }}</span><br>
            <span style="color: #a9a9a9;">{{ $post->body }}</span>
            <hr>
        </div>
    </nav>
</div>

