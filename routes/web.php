<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/payment', [App\Http\Controllers\HomeController::class, 'showPaymentInformationPage'])->name('payment');

Route::middleware(['auth','active.user'])->group(function ()
{
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'referral'], function(){
        Route::get('/', [App\Http\Controllers\ReferralController::class, 'index'])->name('referral');
    });

    Route::group(['prefix' => 'team'], function(){
        Route::get('/', [App\Http\Controllers\TeamController::class, 'index'])->name('team');
    });

    Route::group(['prefix' => 'transaction'], function(){
        Route::get('/', [App\Http\Controllers\TransactionController::class, 'index'])->name('history');
        Route::post('/', [App\Http\Controllers\TransactionController::class, 'getPaid'])->name('payment');
        Route::get('/withdraw', [App\Http\Controllers\TransactionController::class, 'show'])->name('withdraw');
    });
    
    Route::group(['prefix' => 'video'], function(){
        Route::get('/', [App\Http\Controllers\VideoAndAdsController::class, 'index'])->name('video');
    });

    Route::group(['prefix' => 'questions'], function(){
        Route::get('/', [App\Http\Controllers\QuestionController::class, 'index'])->name('questions');
    });
});
