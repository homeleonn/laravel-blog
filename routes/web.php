<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/posts/{slug}', [HomeController::class, 'show'])->name('home.show');
Route::get('test', [TestController::class, 'hello']);

Route::group(['prefix' => 'admin'], function() {
	Route::get('/', [DashboardController::class, 'index']);
	Route::resource('categories', CategoryController::class);
	Route::resource('tags', TagController::class);
	Route::resource('users', UserController::class);
	Route::resource('posts', PostController::class);
	Route::resource('comments', PostController::class);
	Route::resource('subscribers', PostController::class);
});
