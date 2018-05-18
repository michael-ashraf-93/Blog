@extends ('layouts.master')

@section ('content')

<div class="col-sm-8 blog-main">

  @foreach ($posts as $post)

  @include('posts.post')

  @endforeach

  <nav class="blog-pagination">
  	<a class="btn btn-outline-primary" href="/">Newest</a>
    <a class="btn btn-outline-primary" href="/posts/old">Oldest</a>
  </nav>

</div><!-- /.blog-main -->

@endsection