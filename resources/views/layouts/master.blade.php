
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">

  <title>News Blog</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/blog/">

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="/css/blog.css" rel="stylesheet">
</head>

<body>
  @include('layouts.nav')
  {{--@include('layouts.viewSpace')--}}
  {{--<div class="blog-header">--}}
    {{--<div class="container">--}}
      {{--<h3 class="blog-title">News Blog</h3>--}}
      {{--<p class="lead blog-description">Be in action with the latest news</p>--}}
    {{--</div>--}}
  {{--</div>--}}

  <div class="container">

    <div class="row">

      @yield('content')


      @include('layouts.sidebar')

    </div><!-- /.row -->

  </div><!-- /.container -->
{{--<footer>--}}
  {{--@include('layouts.footer')--}}
{{--</footer>--}}
</body>
</html>
