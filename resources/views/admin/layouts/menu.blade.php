<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="/admin"><i class="fa fa-edit"></i><span>Users</span></a>
</li>





@if(count(App\Post::allWaitingPosts()))
    <li>

        <a href="/admin/post"><span style="color:orange"><i class="fa fa-edit"></i> Posts </span>
            <span class="label label-warning">{{ count(App\Post::allWaitingPosts()) }}</span>
        </a>

    </li>

@else
    <li class="{{ Request::is('posts*') ? 'active' : '' }}">
        <a href="/admin/post"><i class="fa fa-edit"></i><span>Posts</span></a>
    </li>
@endif





@if(count(App\Comment::allWaitingComments()))
    <li>

        <a href="/admin/comments"><span style="color:orange"><i class="fa fa-edit"></i> Comments </span>
            <span class="label label-warning">{{ count(App\Comment::allWaitingComments()) }}</span>
        </a>

    </li>
@else

    <li>
        <a href="/admin/comments"><i class="fa fa-edit"></i><span>Comments</span></a>
    </li>
@endif
