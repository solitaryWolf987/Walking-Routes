<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\MapController;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;


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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/post/{user?}', function($user = null){
    //return view('post', ['user'=>$user]);
//});


Route::get('/dashboard', function () {
    $users = User::all();
        //dump($users);
    return view('dashboard', ['users' => $users]);
})->middleware(['auth'])->name('dashboard');

Route::get('auth.register', function () {
    return view('register');
})->middleware(['auth'])->name('register');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');


Route::get('/maps', [MapController::class, 'index'])
    ->name('maps.testMap');

Route::get('/users', [UserController::class, 'index'])
    ->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])
    ->name('users.create');
Route::post('/users', [UserController::class, 'store'])
    ->name('users.store');
Route::get('/users/{id}', [UserController::class, 'show'])
    ->name('users.show');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])
    ->name('users.edit');
Route::post('/users/{id}', [UserController::class, 'update'])
    ->name('users.update');


Route::get('/posts', [PostController::class, 'index'])
    ->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])
    ->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])
    ->name('posts.store');
Route::get('/posts/{id}', [PostController::class, 'show'])
    ->name('posts.show');
Route::get('/posts/edit/{id}', [PostController::class, 'edit'])
    ->name('posts.edit');
Route::post('/posts/{id}', [PostController::class, 'update'])
    ->name('posts.update');
Route::get('/posts/destroy/{id}', [PostController::class, 'destroy'])
    ->name('posts.destroy');

Route::get('/comments', [CommentController::class, 'index'])
    ->name('comments.index');
Route::get('/comments/create/{id}', [CommentController::class, 'create'])
    ->name('comments.create');
Route::post('/comments', [CommentController::class, 'store'])
    ->name('comments.store');
Route::get('/comments/edit/{id}', [CommentController::class, 'edit'])
    ->name('comments.edit');
Route::post('/comments/{id}', [CommentController::class, 'update'])
    ->name('comments.update');
Route::post('/comments/{id}', [CommentController::class, 'update'])
    ->name('comments.update');
Route::get('/comments/destroy/{id}', [CommentController::class, 'destroy'])
    ->name('comments.destroy');

Route::get('/search', [SearchController::class, 'index'])
    ->name('search');


Route::resource('post', PostController::class);




require __DIR__.'/auth.php';