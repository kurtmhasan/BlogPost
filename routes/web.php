<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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
    return view('front.posts.index');
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


route::delete('/deletePost/{id}', [PostController::class, 'deletePost'])->name('post.delete');

route::post('/editPost/{id}', [PostController::class, 'editPost'])->name('post.edit');
route::post('/showEditPage/{id}', [PostController::class, 'showEditPage'])->name('show.edit.page');


