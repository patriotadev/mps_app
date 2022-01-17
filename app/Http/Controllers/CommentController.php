<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function postComment(Request $request)
    {
        $data = [
            'comment_desc' => $request->comment_desc,
            'from_user_id' => session('user_id'),
            'created_at' => date('Y-m-d H:i:s'),
            'to_post_id' => $request->to_post_id,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        Comment::create($data);

        return redirect('/');
    }

    // public function getComment(Request $request)
    // {
    //     $data = [
    //         'comments' => Comment::all()
    //     ];

    //     return view('forum.main', $data);
    // }
}
