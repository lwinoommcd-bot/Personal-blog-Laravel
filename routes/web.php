<?php

use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ExperienceCountController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\ProjectController;
use App\Http\Controllers\admin\SkillController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeDislike;
use App\Http\Controllers\UiController;
use App\Models\Comment;
use Illuminate\Support\Facades\Route;


// UI
Route::get('/', [UiController::class, 'index']);
Route::get('/posts/{post}/details', [UiController::class, 'postDetails']);
Route::get('/posts', [UiController::class, 'postIndex']);
Route::post('/post/like/{post_id}',[LikeDislike::class,'like']);
Route::post('/post/dislike/{post_id}',[LikeDislike::class,'DisLike']);
Route::post('/post/comments/{post}',[CommentController::class,'comment']);
Route::get('/search',[UiController::class,'search']);
Route::get('/search_category/{id}',[UiController::class,'searchByCategory']);



// Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'is_admin']], function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}/edit', [UserController::class, 'edit']);
    Route::post('/users/{id}/update', [UserController::class, 'update']);
    Route::post('/users/{id}/delete', [UserController::class, 'delete']);

    // Skill
    Route::resource('/skills', SkillController::class);

    // Project
    Route::resource('/projects', ProjectController::class);

    //Experience
    Route::get('/experiences', [ExperienceCountController::class, 'index']);
    Route::get('/experiences/{id}/edit', [ExperienceCountController::class, 'edit']);
    Route::post('/experiences/{experienceCount}/update', [ExperienceCountController::class, 'update']);

    //Category
    Route::resource('/categories', CategoryController::class);

    // Post
    Route::resource('/posts', PostController::class);
    Route::post('comment/{id}/show_hide',[PostController::class,'showHide']);



});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
