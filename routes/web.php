<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MainController;
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

Route::get('/', [MainController::class, 'home']);
Route::get('/contacts', [MainController::class, 'contacts']);
Route::get('/hotels', [MainController::class, 'hotels']);
Route::post('/send-email', [MainController::class, 'send']);
Route::get('/feedback', [FeedbackController::class, 'index']);
Route::post('/feedback', [FeedbackController::class, 'store']);

Route::resource("/admin/categories", CategoryController::class);

