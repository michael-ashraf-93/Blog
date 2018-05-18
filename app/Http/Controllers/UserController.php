<?php

namespace App\Http\Controllers;

use Laracasts\Flash\Flash;
use App\User;
use App\Post;
use App\Comment;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{


    protected $fieldSearchable = [
        'name',
        'email',
        'role',
        'created_at',
        'updated_at'
    ];

////////////////////    Show User's Profile     ////////////////////
    public function profile($id)
    {
        $user = User::find($id);

        if (empty($user)) {
            Flash::error('User Not Found');

            return redirect(route('/'));
        }

        return view('user.show', compact('user'));

    }


////////////////////    Edit User     ////////////////////
    public function edit($id)
    {
        if (auth()->user()->id == $id) {
            $user = User::find($id);

            if (empty($user)) {
                Flash::error('User not found');

                return redirect('/');
            }

            return view('user.edit')->with('user', $user);

        }
        else
            return redirect('/');
    }

////////////////////    Update User     ////////////////////
    public function update($id, UpdateUserRequest $request)
    {
        if (auth()->user()->id == $id) {
            $user = User::find($id);
            $password = $request->password;
            if (isset($password)) {
                $this->validate(request(), [
                    'name' => 'required',
                    'email' => 'required|email',
                    'password' => 'confirmed|min:6',

                ]);

                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt(request('password'))
                ]);
            } else {
                $this->validate(request(), [
                    'name' => 'required',
                    'email' => 'required|email',

                ]);
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
            }
            Flash::success('User Updated successfully.');

            return redirect()->back();
        }
        else
        {
            return redirect('/');
        }
    }


////////////////////    Delete User And Deactivate All Posts and Comments     ////////////////////
    public function destroy($id)
    {
        if (auth()->user()->id == $id) {
            $user = User::find($id);

            if (empty($user)) {

                Flash::error('User not found');

                return redirect()->back();

            } else {

                $post = Post::all()->where('user_id', $id);

                if (empty($post)) {
                    Flash::error('No Posts found');

                } else {

                    Post::where('user_id', $id)->update(['status' => 'U-D-deactivated']);
                    Flash::success('All Posts Deactivated');

                    $comment = Comment::all()->where('user_id', $id);

                    if (empty($comment)) {
                        Flash::error('No Comments found');

                    } else {
                        Comment::where('user_id', $id)->update(['status' => 'U-D-deactivated']);
                        Flash::success('All Comments Deactivated');


                        $user->delete($id);

                        Flash::success('User Deleted Successfully.');
                    }
                }
            }

            return redirect('/');
        }
        else
            return redirect('/');

    }


////////////////////  Admin Posts Controllers   ////////////////////

////////////////////    Show And Manage All  Post     ////////////////////
    public function posts($id)
    {
//        $post = Post::where('user_id', $id)->latest()->get();
        $post = Post::where('status','<>','A-deactivated')->where(['user_id'=> $id])->latest()->get();
//        $post = Post::whereNotIn('status', 'A-deactivated')->where(['user_id'=> $id])->latest()->get();
//        $post = Post::where(['user_id'=> $id,'status'=> 'A-activated','status'=> 'U-activated','status'=> 'U-deactivated','status'=> 'waiting'])->latest()->get();
        return view('user.posts', compact('post'));

    }

////////////////////    Show Post And it's Comments    ////////////////////
    public function showPost($uid, $pid)
    {
        if (auth()->user()->id == $uid) {

            $post = POST::where([
                'user_id' => $uid,
                'id' => $pid
            ])->get();
            return view('user.showPost', compact('post'));
        }
        else
            return redirect('/');
    }

////////////////////    Edit Post     ////////////////////
    public function editPost($uid, $pid)
    {
        if (auth()->user()->id == $uid) {
            $post = POST::where([
                'user_id' => $uid,
                'id' => $pid
            ])->get();

            if (empty($post)) {
                Flash::error('Post Not Found');

                return redirect('/');
            }

            return view('user.editPost', compact('post'));
        } else
            return redirect('/');

    }

////////////////////    Update Post     ////////////////////
    public function updatepost($id, UpdatePostRequest $request)
    {
        $post = Post::find($id);
        $uid = $post->user_id;
        if (auth()->user()->id == $uid) {

            $post->update([
                'title' => $request->title,
                'body' => $request->body,
                'status' => 'U-updated'
            ]);

            Flash::success('Post Updated successfully.');

            return redirect()->back();
        } else
            return redirect('/');

    }

////////////////////    Activate/Approve Post     ////////////////////
    public function activePost($uid, $pid)
    {
        if (auth()->user()->id == $uid) {

            $post = Post::find($pid);

            if (empty($post)) {
                Flash::error('Post not found');

                return redirect()->back();
            }
            if ($post->status == 'waiting') {
                Flash::error('You Must Wait For Activation');
                return redirect('/');
            }

            Post::where('id', $pid)->update(['status' => 'U-activated']);
            Flash::success('Post Published.');
            return redirect()->back();
        } else
            return redirect()->back();
    }

////////////////////    Deactivate/Disapprove Post     ////////////////////
    public function deactivePost($uid, $pid)
    {
        if (auth()->user()->id == $uid) {

            $post = Post::find($pid);

            if (empty($post)) {
                Flash::error('Post not found');

                return redirect()->back();
            }
            if ($post->status == 'waiting') {
                Flash::error('You Must Wait For Activation');
                return redirect('/');
            }

            Flash::success('Post Not Published.');
            Post::where('id', $pid)->update(['status' => 'U-deactivated']);

            return redirect()->back();
        } else
            return redirect()->back();
    }


////////////////////    Delete Post     ////////////////////
    public function destroyPost($uid, $pid)
    {
        if (auth()->user()->id == $uid) {

            $post = Post::find($pid);
            $comments = Comment::where('post_id', $pid);

            if (empty($post)) {
                Flash::error('Post Not Found');

                return redirect()->back();
            } else {

                if (empty($comments)) {
                    Flash::error('No Related Comments Found');
                } else {
                    $comments->delete();

                    Flash::success('All Related Comments Deleted Successfully.');
                }


                $post->delete($pid);

                Flash::success('Post Deleted Successfully.');

                return redirect()->back();
            }
        } else
            return redirect('/');

    }


////////////////////  Admin Comments Controllers   ////////////////////

////////////////////    Show All Comments     ////////////////////
    public function comments($id)
    {
//        $comments = Comment::where('user_id', $id)->latest()->get();
        $comments = Comment::where('status','<>','A-deactivated')->where(['user_id'=> $id])->latest()->get();
        return view('user.comments', compact('comments'));

    }

////////////////////    Show Post and It's Comments    ////////////////////
    public function showComment(Post $post)
    {
        return view('posts.show', compact('post'));

    }

////////////////////    Edit Comment     ////////////////////
    public function editComment($uid, $cid)
    {

        if (auth()->user()->id == $uid) {
            $comment = Comment::where([
                'user_id' => $uid,
                'id' => $cid
            ])->get();

            if (empty($comment)) {
                Flash::error('Comment Not Found');

                return redirect('/');
            }

            return view('user.editComment', compact('comment'));
        } else {
            return redirect('/');
        }
    }

////////////////////    Update Comment     ////////////////////
    public function updateComment($id, UpdateCommentRequest $request)
    {
        $comment = Comment::find($id);
        $uid = $comment->user_id;
        if (auth()->user()->id == $uid) {
            $comment->update([
                'body' => $request->body,
                'status' => 'U-updated'
            ]);

            Flash::success('Comment Updated successfully.');

            return redirect()->back();
        } else
            return redirect('/');
    }

////////////////////    Activate/Approve Comment     ////////////////////
    public function activecomment($uid, $cid)
    {
        if (auth()->user()->id == $uid) {

            $comment = Comment::find($cid);

            if (empty($comment)) {
                Flash::error('Comment Not Found');

                return redirect()->back();
            }
            if ($comment->status == 'waiting') {
                Flash::error('You Must Wait For Activation');
                return redirect('/');
            }
            Flash::success('Comment Published');
            Comment::where('id', $cid)->update(['status' => 'U-activated']);

            return redirect()->back();
        } else
            return redirect()->back();
    }

////////////////////    Deactivate/Disapprove Comment     ////////////////////
    public function deactiveComment($uid, $cid)
    {
        if (auth()->user()->id == $uid) {
            $comment = Comment::find($cid);

            if (empty($comment)) {
                Flash::error('Comment Not Found');

                return redirect()->back();
            }
            if ($comment->status == 'waiting') {
                Flash::error('You Must Wait For Activation');
                return redirect('/');
            }

            Flash::success('Comment Not Published');
            Comment::where('id', $cid)->update(['status' => 'U-deactivated']);

            return redirect()->back();
        } else
            return redirect()->back();
    }

////////////////////    Delete Comment     ////////////////////
    public function destroyComment($uid, $cid)
    {
        if (auth()->user()->id == $uid) {
            $comment = Comment::find($cid);

            if (empty($comment)) {
                Flash::error('Comment Not Found');

                return redirect()->back();
            }

            $comment->delete($cid);

            Flash::success('Comment Deleted Successfully');

            return redirect()->back();
        } else
            return redirect('/');
    }
}
