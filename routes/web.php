<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login'); // Uygulama açılır açılmaz login’e yönlendir
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/showPosts', [PostController::class, 'showPosts'])->name('show.posts');
Route::get('/showMyPosts', [PostController::class, 'showMyPosts'])->name('show.my.posts');

route::get('/post/create', [PostController::class, 'createPost'])->name('post.create');
route::post('/addPost', [PostController::class, 'addPost'])->name('post.add');

Route::get('/showProfile/{id}', [ProfileController::class, 'showProfile'])->name('show.profile');

route::delete('/deletePost/{id}', [PostController::class, 'deletePost'])->name('post.delete');

route::post('/editPost/{id}', [PostController::class, 'editPost'])->name('post.edit');
route::post('/showEditPage/{id}', [PostController::class, 'showEditPage'])->name('show.edit.page');

route::post('/addComment/{post_id}', [CommentController::class, 'addComment'])->name('comment.add');
route::get('/showMyComments', [CommentController::class, 'showMyComments'])->name('show.my.comments');

Route::get('/showPostDetails/{id}', [PostController::class, 'showPostDetails'])->name('show.post.details');
Route::get('/likePost{post_id}', [LikeController::class, 'likePost'])->name('like.post');
Route::get('/countLike/{post_id}', [LikeController::class, 'countLike'])->name('count.like');
Route::get('/showMyLike', [LikeController::class, 'showMyLike'])->name('show.my.likes');

Route::get('/getComments', [PostController::class, 'getComments'])->name('get.comments');

