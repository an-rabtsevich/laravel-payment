<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SubscriptionController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/payments/pay', [PaymentController::class, 'pay'])->name('pay');
Route::get('/payments/approval', [PaymentController::class, 'approval'])->name('approval');
Route::get('/payments/cancelled', [PaymentController::class, 'cancelled'])->name('cancelled');

Route::group(['prefix' => 'subscribe', 'as' => 'subscribe.'],function(){
    Route::get('/', [SubscriptionController::class, 'show'])->name('show');
    Route::post('/', [SubscriptionController::class, 'store'])->name('store');
    Route::get('/approval', [SubscriptionController::class, 'approval'])->name('approval');
    Route::get('/cancelled', [SubscriptionController::class, 'cancelled'])->name('cancelled');
});