<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use app\http\Requests\UpdatePostRequest;
use app\http\Requests\UpdateUserRequest;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;


class ApiPostsController extends AppBaseController
{
    private $jwtauth;

    public function __construct(JWTAuth $jwtauth)

    {

        $this->jwtauth = $jwtauth;
        $this->middleware('jwt.auth');
    }

////////////////////    Show All Posts Only DESC     ///////////////////////

    public function index()
    {
        return Post::all();
    }

////////////////////    Show All Active Posts Only DESC     ////////////////////

    public function index_latest()
    {
        return Post::latest()->where('status', 'activated')->get();
    }

////////////////////    Show All Active Posts Only ASC     ////////////////////

    public function index_oldest()
    {
        return Post::oldest()->where('status', 'activated')->get();
    }

////////////////////    Show Post With All Comments    ////////////////////

    public function show($post)
    {
        $int = (int)$post;
        $data['post'] = Post::find($post);
        $data['comment'] = Comment::where('post_id', $int)->get();

        return response()->json($data);
    }

////////////////////    Store New Post     ////////////////////

    public function store(Request $request)
    {
        $post = Post::create($request->all());

        return response()->json($post);
    }

////////////////////    Edit Post     ////////////////////

    public function updatepost($id, Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return $this->sendError('You Are Not Authorized', 500);
        }
        $post = Post::find($id);
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'status' => $request->status

        ]);
        return response()->json($post);
    }

////////////////////    Edit Comment Post     ////////////////////

    public function updatecomment($id, Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return $this->sendError('You Are Not Authorized', 500);
        }
        $comment = Comment::find($id);
        $comment->update([
            'body' => $request->body,
            'status' => $request->status

        ]);
        return response()->json($comment);
    }

////////////////////    Store Comment To Specific Post     ////////////////////

    public function storecomment(Post $post)
    {

        $this->validate(request(), ['body' => 'required']);

        Comment::create([

            'body' => request('body'),
            'post_id' => $post->id,
            'user_id' => request('user_id'),

        ]);

        $data['post'] = Post::find($post);
        $data['comment'] = Comment::where('post_id', $post->id)->get();

        return response()->json($data);
    }


}