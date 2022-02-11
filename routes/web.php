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

Route::get('/payments', [App\Http\Controllers\HomeController::class, 'showPaymentInformationPage'])->name('payment');

Route::middleware(['auth','active.user'])->group(function ()
{
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'referrals'], function(){
        Route::get('/', [App\Http\Controllers\ReferralController::class, 'index'])->name('referral');
    });

    Route::group(['prefix' => 'team'], function(){
        Route::get('/', [App\Http\Controllers\TeamController::class, 'index'])->name('team.level1');
        Route::get('/level_two', [App\Http\Controllers\TeamController::class, 'showLevelTwo'])->name('team.level2');
        Route::get('/level_three', [App\Http\Controllers\TeamController::class, 'showLevelThree'])->name('team.level3');
    });

    Route::group(['prefix' => 'transactions'], function(){
        Route::get('/', [App\Http\Controllers\TransactionController::class, 'index'])->name('transaction');
        Route::post('/', [App\Http\Controllers\TransactionController::class, 'getPaid'])->name('payment');
        Route::get('/me', [App\Http\Controllers\TransactionController::class, 'userTransactions'])->name('history');
        Route::get('/withdraw', [App\Http\Controllers\TransactionController::class, 'show'])->name('withdraw');
        Route::post('/withdraw/accept', [App\Http\Controllers\TransactionController::class, 'acceptWithdraw'])->name('withdraw.accept')->middleware('user.type');
        Route::post('/withdraw/decline', [App\Http\Controllers\TransactionController::class, 'declineWithdraw'])->name('withdraw.decline')->middleware('user.type');
        Route::get('/pay_for_client', [App\Http\Controllers\TransactionController::class, 'showInactiveClients'])->name('pay_for_client');
        Route::get('/settings', [App\Http\Controllers\TransactionController::class, 'settings'])->name('setting')->middleware('user.type');
        Route::post('/settings', [App\Http\Controllers\TransactionController::class, 'saveSettings'])->name('setting.save')->middleware('user.type');
    });
    
    Route::group(['prefix' => 'videos'], function(){
        Route::get('/', [App\Http\Controllers\VideoAndAdsController::class, 'index'])->name('video');
    });

    Route::group(['prefix' => 'questions'], function(){
        Route::get('/', [App\Http\Controllers\QuestionController::class, 'index'])->name('questions');
        Route::get('/create', [App\Http\Controllers\QuestionController::class, 'show'])->name('question.show')->middleware('user.type');
        Route::post('/create', [App\Http\Controllers\QuestionController::class, 'create'])->name('question.create')->middleware('user.type');
        Route::get('/list', [App\Http\Controllers\QuestionController::class, 'getList'])->name('question.list')->middleware('user.type');
        Route::get('/edit/{id}', [App\Http\Controllers\QuestionController::class, 'edit'])->name('question.edit')->middleware('user.type');
        Route::put('/edit', [App\Http\Controllers\QuestionController::class, 'update'])->name('question.update')->middleware('user.type');
        Route::delete('/delete', [App\Http\Controllers\QuestionController::class, 'delete'])->name('question.delete')->middleware('user.type');
        Route::post('/score', [App\Http\Controllers\QuestionController::class, 'addScore'])->name('question.score');
        Route::get('/participants', [App\Http\Controllers\QuestionController::class, 'getParticipants'])->name('question.participants')->middleware('user.type');
    });

    Route::group(['middleware' => 'user.type', 'prefix' => 'users'], function(){
        Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('users');
        Route::get('/{id}', [App\Http\Controllers\UserController::class, 'getUser'])->name('user.details');
        Route::post('/activate/{id}', [App\Http\Controllers\UserController::class, 'activateUser'])->name('user.activate');
        Route::post('/deactivate/{id}', [App\Http\Controllers\UserController::class, 'deactivateUser'])->name('user.deactivate');
        Route::get('/profile', [App\Http\Controllers\UserController::class, 'getProfile'])->name('profile');
        Route::post('/profile/edit', [App\Http\Controllers\UserController::class, 'editProfile'])->name('profile.edit');
    });

    Route::group(['prefix' => 'revenues'], function(){
        Route::get('/', [App\Http\Controllers\RevenueController::class, 'index'])->name('revenue')->middleware('user.type');
        Route::post('/', [App\Http\Controllers\RevenueController::class, 'create'])->name('revenue.create');
    });
});
