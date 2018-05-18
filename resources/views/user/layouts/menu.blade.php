<li>
    <a href="/user/{{ Auth::user()->id }}/profile"><i class="fa fa-edit"></i><span>Profile</span></a>
</li>


{{--<li class="{{ Request::is('posts*') ? 'active' : '' }}">--}}
<li>
    <a href="/user/{{ Auth::user()->id }}/posts"><i class="fa fa-edit"></i><span>Posts</span></a>
</li>


<li>
    <a href="/user/{{ Auth::user()->id }}/comments"><i class="fa fa-edit"></i><span>Comments</span></a>
</li>
