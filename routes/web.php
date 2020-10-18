<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestController;

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

// dd(__NAMESPACE__);
// dd($errors);
// dd($app, $errors, $__env);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/posts/{slug}', [HomeController::class, 'show'])->name('home.show');
Route::get('/category/{slug}', [HomeController::class, 'category'])->name('category.list');
Route::get('/tag/{slug}', [HomeController::class, 'tag'])->name('tag.list');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

Route::group(['prefix' => 'admin'], function() {
	Route::get('/', [DashboardController::class, 'index']);
	Route::resource('categories', CategoryController::class);
	Route::resource('tags', TagController::class);
	Route::resource('users', UserController::class);
	Route::resource('posts', PostController::class);
	Route::resource('comments', PostController::class);
	Route::resource('subscribers', PostController::class);
});



Route::get('test', [TestController::class, 'hello']);