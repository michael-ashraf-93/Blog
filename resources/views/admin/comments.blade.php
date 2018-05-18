@extends('.admin.layouts.master')

@section('content')




    <section class="content-header">
        <h1 class="pull-left">Comments : </h1>
        <h1 class="pull-left">
            <a href="/admin/comments" title="All Comments"><span class="btn btn-default">{{ count(App\Comment::allComments()) }}</span></a>
            <a href="/admin/waitingComments" title="Waiting"><span class="btn btn-warning">{{ count(App\Comment::allWaitingComments()) }}</span></a>
            <a href="/admin/updatedComments" title="Updated"><span class="btn btn-info">{{ count(App\Comment::allUpdatedComments()) }}</span></a>
            <a href="/admin/activeComments" title="Activated"><span class="btn btn-success">{{ count(App\Comment::allActiveComments()) }}</span></a>
            <a href="/admin/deactiveComments" title="Deactivated"><span class="btn btn-danger">{{ count(App\Comment::allDeactiveComments()) }}</span></a>
        </h1>
        <h1 class="pull-right">
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
                        <th>Post</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Create_Date</th>
                        <th>Update_Date</th>
                        <th>Tools</th>


                    </tr>
                    </thead>
                    <tbody>

                    @foreach($comments as $comment)


                        <td>
                            @if(isset($comment->user->name))

                                <span style="color:#33cc33">{{ $comment->user->name }} </span>

                            @else

                                <span style="color:#ff0000">Unknown User</span>

                            @endif
                            {{-- {!! $comment->user->name !!} --}}


                        </td>

                        <td>
                            @if(isset($comment->post->title))
                                {!! $comment->post->title !!}
                            @else
                                <span style="color:#ff0000">Unknown </span>
                            @endif
                        </td>
                        <td>
                        @if(isset($comment->body))
                            {!! $comment->body !!}
                        @else
                            <td><span style="color:#ff0000">Unknown </span>
                                @endif
                            </td>


                            <td>

                                @if($comment->status == 'waiting')
                                    <span style="color:orange"> Waiting </span>
                                @elseif($comment->status == 'U-updated')
                                    <span style="color:#50c1ff"> Comment Updated By The Owner</span>
                                @elseif($comment->status == 'A-activated')
                                    <span style="color:#33cc33"> Activated By Admin</span>
                                @elseif($comment->status == 'A-deactivated')
                                    <span style="color:#ff0000"> Deactivated By Admin</span>
                                @elseif($comment->status == 'U-activated')
                                    <span style="color:#33cc33"> Activated By User</span>
                                @elseif($comment->status == 'U-deactivated')
                                    <span style="color:#ff0000"> Deactivated By User</span>
                                @elseif($comment->status == 'A-D-deactivated')
                                    <span style="color:#ff0000"> User Deleted By Admin And The Comment Is Deactivated</span>
                                @elseif($comment->status == 'U-D-deactivated')
                                    <span style="color:#ff0000"> User Deleted By The Owner And The Comment Is Deactivated</span>
                                @endif

                            </td>
                            <td>{!! $comment->created_at->diffForHumans() !!}</td>
                            <td>{!! $comment->updated_at->diffForHumans() !!}</td>




                            <td>
                                <a href="/admin/{{$comment->id}}/editcomment" class='btn btn-default btn-xs'><i
                                            class="glyphicon glyphicon-edit"></i></a>

                                @if(isset($comment->post_id))
                                    <a href="/admin/{{$comment->post_id}}/showcomments"
                                       class='btn btn-default btn-xs'><i
                                                class="glyphicon glyphicon-eye-open"></i></a>
                                @endif

                                @if($comment->status == 'waiting' || $comment->status == 'U-updated')

                                    <a href="/admin/{{$comment->id}}/activecomment" class='btn btn-success btn-xs'><i
                                                class="glyphicon glyphicon-ok"></i></a>
                                    <a href="/admin/{{$comment->id}}/deactivecomment" class='btn btn-danger btn-xs'><i
                                                class="glyphicon glyphicon-remove"></i></a>

                                @elseif($comment->status == 'A-deactivated' || $comment->status == 'U-deactivated'
                                || $comment->status == 'A-D-deactivated' || $comment->status == 'U-D-deactivated'
                                || $comment->status == 'U-updated')
                                    <a href="/admin/{{$comment->id}}/activecomment" class='btn btn-success btn-xs'><i
                                                class="glyphicon glyphicon-ok"></i></a>

                                @elseif($comment->status == 'A-activated' || $comment->status == 'U-activated')
                                    <a href="/admin/{{$comment->id}}/deactivecomment" class='btn btn-danger btn-xs'><i
                                                class="glyphicon glyphicon-remove"></i></a>

                                @endif

                                <a href="/admin/{{$comment->id}}/destroycomment" class='btn btn-danger btn-xs'
                                   type="submit"
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