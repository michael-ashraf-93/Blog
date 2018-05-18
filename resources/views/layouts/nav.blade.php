<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    .dropbtn {
        background-color: #428bca;
        color: #cdddeb;
        padding: 20px;
        font-size: 17px;
        border: none;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 200px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: #428bca;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #ddd
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropbtn {
        background-color: #2d618b;
    }
</style>

<div class="blog-masthead">

    <div class="container">

        <nav class="nav blog-nav">

            @if (Auth::check())
                {{-- Blog--}}
                <div class="nav_link">
                    <div class="dropdown">
                        <button class="dropbtn"><a href="/"><span style="color: #FFFFFF">News Blog</span></a></button>
                        <div class="dropdown-content">
                            <a href="/posts/create">Create New Post</a>
                            <a href="/">Latest</a>
                            <a href="/posts/old">Oldest</a>
                        </div>
                    </div>
                </div>

                <div class="nav_link">
                    <div class="dropdown">
                        <button class="dropbtn"><a href="/"><span style="color: #FFFFFF">Archives</span></a></button>
                        <div class="dropdown-content">
                            @if(empty($archives))
                                <a href="#"> No Archives Yet </a>

                            @else
                                @foreach($archives as $stats)

                                    <li>
                                        <a href=" /?month={{$stats['Month']}}&year={{$stats['Year']}} ">
                                            {{ $stats['Month'] . ' ' . $stats['Year'] }}
                                        </a>
                                    </li>

                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>


                <div class="nav_link ml-auto">
                    @if( Auth::user()->role == 'admin' )
                        <div class="dropdown">
                            <a href="/user/{{Auth::user()->id}}/profile">
                                <button class="dropbtn"> {{ Auth::user()->name }} </button>
                            </a>
                            <div class="dropdown-content">
                                <a href="/admin">Admin</a>
                                <a href="/logout">Logout</a>
                            </div>
                        </div>
                    @else
                        <div class="dropdown">
                            <a href="/user/{{Auth::user()->id}}/profile">
                                <button class="dropbtn"> {{ Auth::user()->name }} </button>
                            </a>
                            <div class="dropdown-content">
                                <a href="/logout">Logout</a>
                            </div>
                        </div>
                    @endif
                </div>

            @else
                <div class="nav_link">
                    <div class="dropdown">
                        <button class="dropbtn"><a href="/"><span style="color: #FFFFFF">News Blog </span></a></button>
                        <div class="dropdown-content">
                            <a href="/">Latest</a>
                            <a href="/posts/old">Oldest</a>
                        </div>
                    </div>
                </div>

                <div class="nav_link">
                    <div class="dropdown">
                        <button class="dropbtn"><a href="/"><span style="color: #FFFFFF">Archives</span></a></button>
                        <div class="dropdown-content">

                            @if(empty($archives))
                                <a href="#"> No Archives Yet </a>

                            @else
                                @foreach($archives as $stats)

                                    <li>
                                        <a href=" /?month={{$stats['Month']}}&year={{$stats['Year']}} ">
                                            {{ $stats['Month'] . ' ' . $stats['Year'] }}
                                        </a>
                                    </li>

                                @endforeach
                            @endif


                        </div>
                    </div>
                </div>

                <a class="nav-link ml-auto" href="/login">Login</a>

                <a class="nav-link" href="/register">Register</a>


            @endif

        </nav>

    </div>

</div>