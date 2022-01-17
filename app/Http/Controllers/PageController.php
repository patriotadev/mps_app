<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{

    public function main(Request $request)
    {
        // $getPost = file_get_contents('php://input');
        // $data = json_decode($getPost);
        $data = [
            'title' => 'Home | My Programming Space',
            'post' =>  User::join('post', 'users.id', '=', 'post.id_user')->orderByDesc('post.created_at')->get(),
            'comment' => Post::join('comment', 'post.post_id', '=', 'comment.to_post_id')->orderByDesc('comment.created_at')->get(),
            'users' => User::all(),
            // 'getPostId' => Post::get('post_id')->first(),
            'commentCount' => Comment::all(),


            // 'post' => DB::table('post')->join('users', 'users.id', '=', 'post.id_user')->join('comment', 'comment.to_post_id', '=', 'post.post_id')->get(),
            'count_post' => Post::all()->count()
        ];

        return view('forum.main', $data);
    }

    public function addPost()
    {
        $data = [
            'title' => 'Add Post | My Programming Space'
        ];

        return view('forum.add_post', $data);
    }

    public function editPost($id)
    {
        $data = [
            'title' => 'Edit Post | My Programming Space',
            'post' => Post::where('post_id', $id)->get()
        ];

        return view('forum.edit_post', $data);
    }

    public function article()
    {
        return view('page.article');
    }

    public function tutorial()
    {
        return view('page.tutorial');
    }

    public function forum(Request $request)
    {
        $data = [
            'title' => 'Forum | ',
        ];

        if (session('hasLogin')) {
            return view('page.forum', $data);
        } else {
            print_r('login first!');
        }
    }

    public function signin()
    {
        $data = [
            'title' => 'Sign In | Title'
        ];
        return view('auth.signin', $data);
    }

    public function signupForm()
    {
        $data = [
            'title' => 'Sign Up | Title'
        ];
        return view('auth.signup_form', $data);
    }

    public function signinForm()
    {
        $data = [
            'title' => 'Sign In Form | Title'
        ];

        return view('auth.signin_form', $data);
    }

    public function signout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
