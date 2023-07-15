<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\LikeController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController as PostControllerAdmin;
use App\Http\Controllers\Admin\UserController as UserControllerAdmin;

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
Route::prefix('auth')->middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'viewLogin'])->name('view.login');
    Route::post('/login', [AuthController::class, 'login'])->name('post.login');
    Route::get('/register', [AuthController::class, 'viewRegister'])->name('view.register');
    Route::post('/register', [AuthController::class, 'register'])->name('post.register');
    Route::get('/formForgotPassword', [AuthController::class, 'formForgotPassword'])->name('view.forgot.password');
    Route::post('/forgotPassword', [AuthController::class, 'forgotPassword'])->name('post.forgot.password');
    Route::get('/getPassword/{token}', [AuthController::class, 'getPassword'])->name('get.password');
    Route::get('/verify/{token}', [AuthController::class, 'verifyEmail'])->name('verify.email');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [PostController::class, 'allBlogPublic'])->name('blogs.home');
Route::post('likes/{idBlog}', [LikeController::class, 'interactive'])->name('interactive');

Route::group(['as' => 'blog.', 'prefix' => 'blogs'],function () {
    Route::get('/search', [PostController::class, 'allBlogPublic'])->name('search');
    Route::get('/{blog}/details', [PostController::class, 'detail'])->name('detail')->middleware('view.blog.not.approved');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/store', [PostController::class, 'store'])->name('store');
    Route::get('/{blog}/edit', [PostController::class, 'edit'])->name('edit');
    Route::put('/{blog}/update', [PostController::class, 'update'])->name('update');
    Route::delete('/{blog}/delete', [PostController::class, 'destroy'])->name('delete');    
});

Route::group(['as' => 'comment.', 'prefix' => 'comments'],function () {
    Route::get('/viewMore', [CommentController::class, 'viewMore'])->name('view.more');
    Route::post('{blog}/comment', [CommentController::class, 'store'])->name('store');
    Route::put('{comment}/update', [CommentController::class, 'update'])->name('update');
    Route::delete('{comment}/delete', [CommentController::class, 'destroy'])->name('delete');
});

Route::group(['as' => 'user.', 'prefix' => 'users'],function () {
    Route::get('/myBlog', [UserController::class, 'myBlog'])->name('blog');
    Route::get('/password/edit', [UserController::class, 'editChangePassword'])->name('password.edit');
    Route::put('/password/update', [UserController::class, 'updatePassword'])->name('password.update');
    Route::get('/profile', [UserController::class, 'editProfile'])->name('profile');
    Route::put('{user}/update', [UserController::class, 'updateUser'])->name('update');
});

Route::group(['as' => 'admin.', 'prefix' => 'admin'],function () {
    Route::get('/', [HomeController::class, 'viewDashboard'])->name('dashboard');
    Route::group(['as' => 'blog.', 'prefix' => 'blogs'],function () {
        Route::get('/{status}', [PostControllerAdmin::class, 'viewBlog'])->name('index');
        Route::put('{blog}/update', [PostControllerAdmin::class, 'approvedBlog'])->name('update.status');
        Route::put('/approvedAll', [PostControllerAdmin::class, 'approvedAllBlog'])->name('approved.all');
        Route::delete('{blog}/delete', [PostControllerAdmin::class, 'deleteBlog'])->name('delete');
    });
    Route::group(['as' => 'user.', 'prefix' => 'users'],function () {
        Route::get('/', [UserControllerAdmin::class, 'viewUser'])->name('index');
        Route::get('{user}/profile', [UserControllerAdmin::class, 'viewProfileUser'])->name('profile');
        Route::delete('{user}/delete', [UserControllerAdmin::class, 'deleteUser'])->name('delete');
    });
});
