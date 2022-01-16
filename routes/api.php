<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/posts/{id}', [PostController::class, 'apiPostIndex'])
    -> name('api.posts.index');

Route::get('/comments', [PostController::class, 'apiCommentIndex'])
    -> name('api.comments.index');

Route::get('/users', [UserController::class, 'apiStore'])
    -> name('api.users.store');
   
Route::get('/users', [PostController::class, 'apiUserIndex'])
    -> name('api.users.index');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});