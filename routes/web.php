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
        Route::get('/', [App\Http\Controllers\TransactionController::class, 'index'])->name('transaction');
        Route::post('/', [App\Http\Controllers\TransactionController::class, 'getPaid'])->name('payment');
        Route::get('/me', [App\Http\Controllers\TransactionController::class, 'userTransactions'])->name('history');
        Route::get('/withdraw', [App\Http\Controllers\TransactionController::class, 'show'])->name('withdraw');
        Route::get('/pay_for_client', [App\Http\Controllers\TransactionController::class, 'showInactiveClients'])->name('pay_for_client');
    });
    
    Route::group(['prefix' => 'video'], function(){
        Route::get('/', [App\Http\Controllers\VideoAndAdsController::class, 'index'])->name('video');
    });

    Route::group(['prefix' => 'questions'], function(){
        Route::get('/', [App\Http\Controllers\QuestionController::class, 'index'])->name('questions');
    });

    Route::group(['prefix' => 'user'], function(){
        Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('users');
        Route::get('/{id}', [App\Http\Controllers\UserController::class, 'getUser'])->name('user.details');
        Route::post('/activate/{id}', [App\Http\Controllers\UserController::class, 'activateUser'])->name('user.activate');
        Route::post('/deactivate/{id}', [App\Http\Controllers\UserController::class, 'deactivateUser'])->name('user.deactivate');
        Route::get('/profile', [App\Http\Controllers\UserController::class, 'getProfile'])->name('profile');
        Route::post('/profile/edit', [App\Http\Controllers\UserController::class, 'editProfile'])->name('profile.edit');
    });
});
