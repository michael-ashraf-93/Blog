@extends('.user.layouts.master')

@section('content')




    <section class="content-header">
        <h1 class="pull-left">Posts :</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="/posts/create">Add
                New Post</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">

                <table class="table table-responsive" id="clients-table">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Title</th>
                        <th>Body</th>
                        <th>Status</th>
                        <th>Create_Date</th>
                        <th>Update_Date</th>
                        <th>Tools</th>


                    </tr>
                    </thead>
                    <tbody>

                    @foreach($post as $post)
                        <tr>


                            <td>


                                @if(isset($post->user->name))

                                    <span style="color:#33cc33">{{ $post->user->name }} </span>

                                @else

                                    <span style="color:#ff0000">Unknown </span>

                                @endif


                            </td>
                            <td>{!! $post->title !!}</td>
                            <td>{!! $post->body !!}</td>

                            <td>

                                @if($post->status == 'waiting')
                                    <span style="color:orange"> Waiting </span>
                                @elseif($post->status == 'U-updated')
                                    <span style="color:#50c1ff"> Post Updated And Waiting Admin Approval </span>
                                @elseif($post->status == 'A-activated')
                                    <span style="color:#33cc33"> Activated </span>
                                @elseif($post->status == 'U-activated')
                                    <span style="color:#33cc33"> Activated </span>
                                @elseif($post->status == 'U-deactivated')
                                    <span style="color:#ff0000"> Deactivated </span>
                                @endif

                            </td>

                            <td>{!! $post->created_at->diffForHumans() !!}</td>
                            <td>{!! $post->updated_at->diffForHumans() !!}</td>


                            <td>

                                <a href="/user/{{ Auth::user()->id }}/{{$post->id}}/editpost" class='btn btn-default btn-xs'><i
                                            class="glyphicon glyphicon-edit"></i></a>

                                <a href="/user/{{ Auth::user()->id }}/{{$post->id}}/showpost" class='btn btn-default btn-xs'><i
                                            class="glyphicon glyphicon-eye-open"></i></a>


                                @if($post->status == 'waiting')



                                @elseif($post->status == 'U-deactivated')
                                    <a href="/user/{{ Auth::user()->id }}/{{$post->id}}/activepost" class='btn btn-success btn-xs'><i
                                                class="glyphicon glyphicon-ok"></i></a>

                                @elseif($post->status == 'A-activated' || $post->status == 'U-activated')
                                    <a href="/user/{{ Auth::user()->id }}/{{$post->id}}/deactivepost" class='btn btn-danger btn-xs'><i
                                                class="glyphicon glyphicon-remove"></i></a>

                                @endif

                                <a href="/user/{{ Auth::user()->id }}/{{$post->id}}/destroypost" class='btn btn-danger btn-xs' type="submit"
                                   name="Delete" value="Delete" onclick="return confirm('Are you sure?')"><i
                                            class="glyphicon glyphicon-trash"></i></a>


                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>


        <div class="text-center">

        </div>
    </div>



@endsection