<?php

namespace App\Http\Controllers;

// namespace App\Http\Controllers\userController;

use App\Http\Requests\UpdateCommentRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdatePostRequest;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use App\Http\Requests\UpdateclientsRequest;
//use Flash;
use App\User;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Activity;


class AdminController extends Controller
{


    private $userController;

    public function __construct(userController $usercontroller)
    {
        $this->userController = $usercontroller;

        $this->middleware('auth');

    }


////////////////////  Admin Users Controllers   ////////////////////

////////////////////    Show and Manage All Users     ////////////////////
    public function index()
    {
        $users = User::all();
        $posts = Post::all();
        $comments = Comment::all();

//        return view('admin.dashboard', compact('users'));
        return view('admin.dashboard', compact('users', 'posts', 'comments'));
    }

////////////////////    Show All User's Data     ////////////////////
    public function show($id)
    {

        $user = User::find($id);

        if (empty($user)) {
            Flash::error('User Not Found');

            return redirect(route('/admin'));
        }

        return view('admin.show', compact('user'));


    }

////////////////////    Edit User     ////////////////////
    public function edit($id)
    {

        $user = User::find($id);

        if (empty($user)) {
            Flash::error('Clients not found');

            return redirect('/admin');
        }

        return view('admin.edit')->with('user', $user);

    }

////////////////////    Update User     ////////////////////
    public function update($id, UpdateUserRequest $request)
    {
        $user = User::find($id);
        $password = $request->password;
        if (isset($password)) {
            $this->validate(request(), [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'confirmed|min:6',
                'role' => 'required'

            ]);

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => bcrypt(request('password'))
            ]);
        } else {
            $this->validate(request(), [
                'name' => 'required',
                'email' => 'required|email',
                'role' => 'required'

            ]);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role
            ]);
        }
        Flash::success('User Updated successfully.');

        return redirect('/admin');
    }

////////////////////    Delete User And Deactivate All Posts and Comments     ////////////////////
    public function destroy($id)
    {
        $user = User::find($id);

        if (empty($user)) {

            Flash::error('User not found');

            return redirect('/admin');

        } else {

            $post = Post::all()->where('user_id', $id);

            if (empty($post)) {
                Flash::error('No Posts found');

                return redirect('admin');
            } else {

                Post::where('user_id', $id)->update(['status' => 'A-D-deactivated']);
                Flash::success('All Posts Deactivated');

                $comment = Comment::all()->where('user_id', $id);

                if (empty($comment)) {
                    Flash::error('No Comments found');

                    return redirect('admin');
                } else {
                    Comment::where('user_id', $id)->update(['status' => 'A-D-deactivated']);
                    Flash::success('All Comments Deactivated');


                    $user->delete($id);

                    Flash::success('User Deleted Successfully.');
                }
            }
        }

        return redirect('admin');


    }

////////////////////    Add User     ////////////////////
    public function getUserField()
    {
        return view('admin.addUser');
    }

    public function createUser(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (isset($user)) {
            Flash::error('Email is already been taken');
            return redirect('/admin');
        }
        $this->validate(request(), [

            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'role' => 'required'

        ]);
        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt(request('password')),
            'role' => $request->role
        ]);

        Flash::success('User added successfully.');

        return redirect('/admin');
    }


////////////////////  Admin Posts Controllers   ////////////////////

////////////////////    Show And Manage All  Post     ////////////////////
    public function posts()
    {
        $post = Post::latest()->get();
        return view('.admin.posts', compact('post', 'userr'));

    }

////////////////////    Show Post And it's Comments    ////////////////////
    public function showPost(Post $post)
    {

        return view('posts.show', compact('post'));

    }

////////////////////    Edit Post     ////////////////////
    public function editPost($id)
    {

        $post = POST::find($id);

        if (empty($post)) {
            Flash::error('Post Not Found');

            return redirect('/admin/post');
        }

        return view('admin.editPost', compact('post'));

    }

////////////////////    Update Post     ////////////////////
    public function updatepost($id, UpdatePostRequest $request)
    {
        $post = Post::find($id);
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'status' => $request->status
        ]);

        Flash::success('Post Updated successfully.');

        return redirect('/admin/post');
    }

////////////////////    Activate/Approve Post     ////////////////////
    public function activePost($id)
    {

        $post = Post::find($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect('admin/post');
        }

        Post::where('id', $id)->update(['status' => 'A-activated']);
        Flash::success('Post Published.');
        return redirect('admin/post');

    }

////////////////////    Deactivate/Disapprove Post     ////////////////////
    public function deactivePost($id)
    {

        $post = Post::find($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect('admin/post');
        }

        Flash::success('Post Not Published.');
        Post::where('id', $id)->update(['status' => 'A-deactivated']);

        return redirect('admin/post');

    }

////////////////////    Delete Post     ////////////////////
    public function destroyPost($id)
    {

        $post = Post::find($id);
        $comments = Comment::where('post_id', $id);

        if (empty($post))
        {
            Flash::error('Post Not Found');

            return redirect('/admin/post');
        }


        else
        {

            if (empty($comments))
            {
                Flash::error('No Related Comments Found');
            }


            else
            {
                $comments->delete();

                Flash::success('All Related Comments Deleted Successfully.');
            }


            $post->delete($id);

            Flash::success('Post Deleted Successfully.');

            return redirect('/admin/post');
        }

    }
////////////////////  Show Waiting Posts   ////////////////////

    public function waitingPosts()
    {
        $post = Post::allWaitingPosts();
        return view('admin.posts',compact('post'));
    }

////////////////////  Show Updated Posts   ////////////////////

    public function updatedPosts()
    {
        $post = Post::allUpdatedPosts();
        return view('admin.posts',compact('post'));
    }

////////////////////  Show Activated Posts   ////////////////////

    public function activePosts()
    {
        $post = Post::allActivePosts();
        return view('admin.posts',compact('post'));
    }

////////////////////  Show Deactivated Posts   ////////////////////

    public function deactivePosts()
    {
        $post = Post::allDeactivePosts();
        return view('admin.posts',compact('post'));
    }

////////////////////  Admin Comments Controllers   ////////////////////

////////////////////    Show All Comments     ////////////////////
    public function comments()
    {
        $comments = Comment::all();
        return view('.admin.comments', compact('comments', 'userr'));

    }

////////////////////  Show Waiting Comments   ////////////////////

    public function waitingComments()
    {
        $comments = Comment::allWaitingComments();
        return view('admin.comments',compact('comments'));
    }

////////////////////  Show Updated Comments   ////////////////////

    public function updatedComments()
    {
        $comments = Comment::allUpdatedComments();
        return view('admin.comments',compact('comments'));
    }

////////////////////  Show Activated Comments   ////////////////////

    public function activeComments()
    {
        $comments = Comment::allActiveComments();
        return view('admin.comments',compact('comments'));
    }

////////////////////  Show Deactivated Comments   ////////////////////

    public function deactiveComments()
    {
        $comments = Comment::allDeactiveComments();
        return view('admin.comments',compact('comments'));
    }

////////////////////    Show Post and It's Comments    ////////////////////
    public function showComment(Post $post)
    {
        return view('posts.show', compact('post'));

    }

////////////////////    Edit Comment     ////////////////////
    public function editComment($id)
    {

        $comment = Comment::find($id);

        if (empty($comment)) {
            Flash::error('Comment Not Found');

            return redirect('/admin/comments');
        }

        return view('admin.editComment', compact('comment'));

    }

////////////////////    Update Comment     ////////////////////
    public function updateComment($id, UpdateCommentRequest $request)
    {
        $comment = Comment::find($id);
        $comment->update([
            'body' => $request->body,
            'status' => $request->status
        ]);

        Flash::success('Comment Updated successfully.');

        return redirect('/admin/comments');
    }

////////////////////    Activate/Approve Comment     ////////////////////
    public function activecomment($id)
    {

        $comment = Comment::find($id);

        if (empty($comment)) {
            Flash::error('Comment Not Found');

            return redirect('/admin/comments');
        }
        Flash::success('Comment Published');
        Comment::where('id', $id)->update(['status' => 'A-activated']);

        return redirect('/admin/comments');

    }

////////////////////    Deactivate/Disapprove Comment     ////////////////////
    public function deactiveComment($id)
    {

        $comment = Comment::find($id);

        if (empty($comment)) {
            Flash::error('Comment Not Found');

            return redirect('admin/comments');
        }

        Flash::success('Comment Not Published');
        Comment::where('id', $id)->update(['status' => 'A-deactivated']);

        return redirect('/admin/comments');

    }

////////////////////    Delete Comment     ////////////////////
    public function destroyComment($id)
    {
        $comment = Comment::find($id);

        if (empty($comment)) {
            Flash::error('Comment Not Found');

            return redirect('/admin/post');
        }

        $comment->delete($id);

        Flash::success('Comment Deleted Successfully');

        return redirect('/admin/comments');
    }


//
//    public function showS()
//    {
//        $activities = Activity::users()->get();
//        return view('admin.session',compact('activities'));
//
//    }

}
