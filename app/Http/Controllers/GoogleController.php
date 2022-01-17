<?php

namespace App\Http\Controllers;

use App\Models\User;
use FFI\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();
            $getId = User::where('google_id', $user->id)->pluck('id')->first();

            if ($finduser) {

                Auth::login($finduser);
                session([
                    'hasLogin' => true,
                    'user_id' => $getId,
                    'user_name' => $user->name,
                    'user_email' => $user->email
                ]);
                return redirect()->intended('/');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('123456dummy')
                ]);

                Auth::login($newUser);
                session([
                    'hasLogin' => true,
                    'user_id' => $getId,
                    'user_name' => $user->name,
                    'user_email' => $user->email
                ]);
                return redirect()->intended('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
