<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function insertPost(Request $request)
    {
        if ($request->hasFile('post_img')) {

            $file = $request->file('post_img');
            $destinationFolder = 'images';
            $imgName = time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationFolder, $imgName);
        }

        $data = [
            'post_title' => $request->post_title,
            'post_img' => isset($imgName) ? $imgName : '',
            'post_desc' => $request->post_desc,
            'id_user' => session('user_id'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        Post::create($data);
        return redirect('/');
    }

    public function updatePost(Request $request)
    {
        if ($request->hasFile('post_img')) {

            $findPath = Post::where('post_id', $request->post_id)->pluck('post_img')->first();
            $image_path = "images/" . $findPath;

            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('post_img');
            $destinationFolder = 'images';
            $imgName = time() . '.' . $file->getClientOriginalExtension();
            $file->move($destinationFolder, $imgName);
        }

        $data = [
            'post_title' => $request->post_title,
            'post_img' =>  isset($request->post_img) ? $imgName : $request->post_img_default,
            'post_desc' => $request->post_desc,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        Post::where('post_id', $request->post_id)->update($data);
        return redirect('/');
    }

    public function deletePost($id)
    {

        $findPath = Post::where('post_id', $id)->pluck('post_img')->first();
        $image_path = "images/" . $findPath;

        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        Post::where('post_id', $id)->delete();
        return redirect('/');
    }

    public function addLikes(Request $request)
    {
        $user_condition = $request->user_conditional;
        $getPostId = $request->post_id;
        $getCurrentLikes = Post::where('post_id', $getPostId)->pluck('post_num_likes')->first();
        $data = [
            'post_num_likes' => $getCurrentLikes + 1
        ];

        if ($user_condition == false) {
            $userCondition = [
                'user_condition_like' => true
            ];
        } else {
            $userCondition = [
                'user_condition_like' => false
            ];
        }

        Post::where('post_id', $getPostId)->update($data);
        Post::where([
            'post_id' => $getPostId,
            'id_user' => session('user_id')
        ])->update($userCondition);

        // return print_r($user_condition);
    }

    public function unLike(Request $request)
    {
        $user_condition = $request->user_conditional;
        $getPostId = $request->post_id;
        $getCurrentLikes = Post::where('post_id', $getPostId)->pluck('post_num_likes')->first();
        $data = [
            'post_num_likes' => $getCurrentLikes - 1
        ];

        if ($user_condition == false) {
            $userCondition = [
                'user_condition_like' => true
            ];
        } else {
            $userCondition = [
                'user_condition_like' => false
            ];
        }

        Post::where('post_id', $getPostId)->update($data);
        Post::where([
            'post_id' => $getPostId,
            'id_user' => session('user_id')
        ])->update($userCondition);
    }
}
