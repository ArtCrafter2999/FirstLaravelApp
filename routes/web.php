<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;

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

Route::get('/', [MainController::class, 'home']);
Route::get('/products', [MainController::class, 'productsByCategory']);
Route::get('/contacts', [MainController::class, 'contacts']);
Route::get('/hotels', [MainController::class, 'hotels']);
Route::post('/send-email', [MainController::class, 'send']);
Route::get('/feedback', [FeedbackController::class, 'index']);
Route::post('/feedback', [FeedbackController::class, 'store']);

Route::get('/category/{category:slug}', [MainController::class, 'category']);
Route::get('/product/{product:slug}', [MainController::class, 'product']);
Route::get('/tag/{tag}', [MainController::class, 'tag']);

Route::group(['prefix'=>'admin', 'middleware' => ['auth', 'admin']], function (){
    Route::resource("/categories", CategoryController::class);
    Route::resource("/products", ProductController::class);
    Route::resource("/tags", TagController::class);
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
    Lfm::routes();
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
