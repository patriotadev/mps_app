<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'main']);

Route::get('/forum', [PageController::class, 'forum']);

Route::get('/forum/post/add', [PageController::class, 'addPost']);
Route::get('/forum/post/edit/{id}', [PageController::class, 'editPost']);
Route::get('/signin', [PageController::class, 'signin']);
Route::get('/article', [PageController::class, 'article']);
Route::get('/tutorial', [PageController::class, 'tutorial']);
Route::get('/auth/mps/signin', [PageController::class, 'signinForm']);
Route::get('/auth/mps/signup', [PageController::class, 'signupForm']);

Route::post('/forum/post/add', [PostController::class, 'insertPost']);
Route::get('/forum/post/delete/{id}', [PostController::class, 'deletePost']);
Route::post('/forum/post/update', [PostController::class, 'updatePost']);

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::post('auth/mps/signin', [AuthController::class, 'signin']);
Route::post('auth/mps/signup', [AuthController::class, 'signup']);
Route::get('/signout', [AuthController::class, 'signout']);

Route::post('/forum/comment/add', [CommentController::class, 'postComment']);
Route::post('/add-like', [PostController::class, 'addLikes']);
Route::post('/unlike', [PostController::class, 'unLike']);
