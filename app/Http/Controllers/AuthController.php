<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function signup(Request $request)
    {

        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required|min:6',
                'confirm-password' => 'required|min:6|same:password'
            ],
            [
                'name.required' => 'Please input your name',
                'email.required' => 'Please input your email',
                'email.unique' => 'Email has already taken, please input another email',
                'password.required' => 'Please input your password',
                'password.min' => 'Password at least 6 characters',
                'confirm-password.required' => 'Please input your confirmation password',
                'confirm-password.same' => "Confirmation password don't match with password"
            ]
        );

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s')
        ];

        User::create($data);
        return redirect('/auth/mps/signin');
    }

    public function signin(Request $request)
    {
        $getUser = User::where('email', $request->email)->first();

        if ($getUser) {
            if (Hash::check($request->password, $getUser->password)) {
                session([
                    'hasLogin' => true,
                    'user_id' => $getUser->id,
                    'user_name' => $getUser->name,
                    'user_email' => $getUser->email
                ]);
                return redirect('/');
            }
        }

        return redirect('/auth/mps/signin');
    }

    public function signout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/');

        // print_r(session('user_id'));
    }
}
