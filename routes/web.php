<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\NewsletterController;
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

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('showPost');
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store'])->name('saveComment');

Route::post('newsletter', NewsletterController::class)->name('newsletter');

Route::get('register', [RegisterController::class, 'create'])->middleware('guest')->name('registerPage');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest')->name('saveUser');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest')->name('loginPage');
Route::post('sessions', [SessionsController::class, 'store'])->middleware('guest')->name('loginUser');

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware('can:admin')->group(function () {
	Route::resource('admin/posts', AdminPostController::class)->except('show');
});