<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\Admin\SubscribersController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/posts/{slug}', [HomeController::class, 'show'])->name('home.show');
Route::get('/category/{slug}', [HomeController::class, 'category'])->name('category.list');
Route::get('/tag/{slug}', [HomeController::class, 'tag'])->name('tag.list');

Route::post('/subscribe', [SubscriberController::class, 'add']);
Route::get('/subscriber/verify/{token}', [SubscriberController::class, 'verify'])->name('subscriber.verify');

Route::group(['middleware' => 'guest'], function() {
	Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
	Route::post('/register', [AuthController::class, 'register'])->name('register');
	Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
	Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::group(['middleware' => 'auth'], function() {
	Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
	Route::put('/profile', [AuthController::class, 'update'])->name('profile.update');
	Route::get('/logout', [AuthController::class, 'logout'])->name('profile.logout');
	Route::post('/comment/{postId}', [AuthController::class, 'sendComment']);
});


Route::group(['prefix' => 'admin', 'middleware' => AdminMiddleware::class], function() {
	Route::get('/', [DashboardController::class, 'index']);
	Route::resource('categories', CategoryController::class);
	Route::resource('tags', TagController::class);
	Route::resource('users', UserController::class);
	Route::resource('posts', PostController::class);
	Route::resource('subscribers', SubscribersController::class)->except(['edit', 'update', 'show']);
	Route::get('comments', [CommentsController::class, 'index'])->name('comments.index');
	Route::post('comments/togglestatus/{commentId}',[CommentsController::class, 'toggleStatus'])->name('comments.togglestatus');
	Route::delete('comments/destroy/{commentId}', [CommentsController::class, 'destroy'])->name('comments.destroy');
});