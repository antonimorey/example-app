<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Post;

Route::resource('/post', PostController::class);
Route::resource('/category', CategoryController::class);
Route::resource('/tag', TagController::class);

Route::get('api/users/{user}', function (User $user) {
return $user;
});

Route::get('api/post/{post:url_clean}', function (Post $post) {
return $post;
});

Route::post('post/{post}/edit/images',[PostController::class,'image'])->name('post.image');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/perfil/{user}', function (User $user) {
    return view('perfil', ['user' => $user]);
})->name('perfil');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
