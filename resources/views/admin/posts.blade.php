@extends('.admin.layouts.master')

@section('content')




    <section class="content-header">
        <h1 class="pull-left">Posts :</h1>
        <h1 class="pull-left">
            <a href="/admin/post" title="All Posts"><span class="btn btn-default">{{ count(App\Post::allposts()) }}</span></a>
            <a href="/admin/waitingPosts" title="Waiting"><span class="btn btn-warning">{{ count(App\Post::allWaitingPosts()) }}</span></a>
            <a href="/admin/updatedPosts" title="Updated"><span class="btn btn-info">{{ count(App\Post::allUpdatedPosts()) }}</span></a>
            <a href="/admin/activePosts" title="Activated"><span class="btn btn-success">{{ count(App\Post::allActivePosts()) }}</span></a>
            <a href="/admin/deactivePosts" title="Deactivated"><span class="btn btn-danger">{{ count(App\Post::allDeactivePosts()) }}</span></a>
        </h1>
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
                            <td width="">{!! $post->body !!}</td>

                            <td>

                                {{--@if($post->status == 'waiting')--}}
                                    {{--<span style="color:orange"> Waiting </span>--}}
                                {{--@elseif($post->status == 'activated')--}}
                                    {{--<span style="color:#33cc33"> Activated </span>--}}
                                {{--@elseif($post->status == 'deactivated')--}}
                                    {{--<span style="color:#ff0000"> Deactivated </span>--}}
                                {{--@endif--}}



                                @if($post->status == 'waiting')
                                    <span style="color:orange"> Waiting </span>
                                @elseif($post->status == 'U-updated')
                                    <span style="color:#50c1ff"> Post Updated By The Owner</span>
                                @elseif($post->status == 'A-activated')
                                    <span style="color:#33cc33"> Activated By Admin</span>
                                @elseif($post->status == 'A-deactivated')
                                    <span style="color:#ff0000"> Deactivated By Admin</span>
                                @elseif($post->status == 'U-activated')
                                    <span style="color:#33cc33"> Activated By User</span>
                                @elseif($post->status == 'U-deactivated')
                                    <span style="color:#ff0000"> Deactivated By User</span>
                                @elseif($post->status == 'A-D-deactivated')
                                    <span style="color:#ff0000"> User Deleted By Admin And The Post Is Deactivated</span>
                                @elseif($post->status == 'U-D-deactivated')
                                    <span style="color:#ff0000"> User Deleted By The Owner And The Post Is Deactivated</span>
                                @endif



                            </td>

                            <td>{!! $post->created_at->diffForHumans() !!}</td>
                            <td>{!! $post->updated_at->diffForHumans() !!}</td>

                            <td>

                                <a href="/admin/{{$post->id}}/editpost" class='btn btn-default btn-xs'><i
                                            class="glyphicon glyphicon-edit"></i></a>

                                <a href="/admin/{{$post->id}}/showpost" class='btn btn-default btn-xs'><i
                                            class="glyphicon glyphicon-eye-open"></i></a>


                                @if($post->status == 'waiting'|| $post->status == 'U-updated')

                                    <a href="/admin/{{$post->id}}/activepost" class='btn btn-success btn-xs'><i
                                                class="glyphicon glyphicon-ok"></i></a>
                                    <a href="/admin/{{$post->id}}/deactivepost" class='btn btn-danger btn-xs'><i
                                                class="glyphicon glyphicon-remove"></i></a>

                                @elseif($post->status == 'A-deactivated' || $post->status == 'U-deactivated'
                                || $post->status == 'A-D-deactivated' || $post->status == 'U-D-deactivated'
                                || $post->status == 'U-updated')
                                    <a href="/admin/{{$post->id}}/activepost" class='btn btn-success btn-xs'><i
                                                class="glyphicon glyphicon-ok"></i></a>

                                @elseif($post->status == 'A-activated' || $post->status == 'U-activated')
                                    <a href="/admin/{{$post->id}}/deactivepost" class='btn btn-danger btn-xs'><i
                                                class="glyphicon glyphicon-remove"></i></a>

                                @endif

                                <a href="/admin/{{$post->id}}/destroypost" class='btn btn-danger btn-xs' type="submit"
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