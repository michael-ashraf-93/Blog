<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Post;

class PostsController extends Controller
{


    public function __construct()

    {

        $this->middleware('auth')->except(['index', 'show', 'index_oldest', 'check', 'check_create']);

    }


    public function index()
    {


        $posts = Post::latest()
            ->where('status', 'A-activated')
            ->orWhere('status', 'U-activated')
            ->filter(request(['month','year']))
            ->get();

//        $posts = Post::latest()->where('status', 'activated');
//
//
//        if($month = request('month'))
//        {
//            $posts->whereMonth('created_at', Carbon::parse($month)->month);
//        }
//
//        if($year = request('year'))
//        {
//            $posts->whereYear('created_at', $year);
//        }
//
//        $posts=$posts->get();


        $archives = Post::where('status', 'activated')->selectraw('YEAR(created_at) Year,MONTHNAME(created_at) Month,count(*) Published')
            ->groupBy('year','month')
            ->orderByRaw('min(created_at) asc')
            ->get()
            ->toArray();


        return view('posts.index', compact('posts','archives'));

    }


    public function index_oldest()
    {
        $posts = Post::oldest()->where('status', 'activated')->get();

        $archives = Post::where('status', 'activated')->selectraw('YEAR(created_at) Year,MONTHNAME(created_at) Month,count(*) Published')
            ->groupBy('year','month')
            ->orderByRaw('min(created_at) asc')
            ->get()
            ->toArray();

        return view('posts.index', compact('posts','archives'));

    }


    public function show(Post $post)
    {
        $archives = Post::where('status', 'activated')->selectraw('YEAR(created_at) Year,MONTHNAME(created_at) Month,count(*) Published')
            ->groupBy('year','month')
            ->orderByRaw('min(created_at) asc')
            ->get()
            ->toArray();
            return view('posts.show', compact('post','archives'));

    }


    public function create()
    {

        return view('posts.create');

    }


    public function store()
    {

        $this->validate(request(), [
            'title' => 'required|max:250',
            'body' => 'required|max:10000'
        ]);


        auth()->user()->publish(
            new Post(request(['title', 'body']))
        );


        return redirect()->home();

    }


    public function check()
    {

        return redirect()->home();

    }



}
