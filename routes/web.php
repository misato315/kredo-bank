<?php

use Illuminate\Support\Facades\Route;

use App\HTTP\Controllers\AccountController;
use App\HTTP\Controllers\UserController;
use App\HTTP\Controllers\LoanController;
use App\HTTP\Controllers\HomeController;
use App\HTTP\Controllers\PaymentController;


Auth::routes();


##認証されたユーザーのみがアクセスできる
Route::group(['middleware'=>'auth'],function(){

    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    #ACCOUNT
    Route::group(['prefix'=>'account','as'=>'account.'],function(){

        Route::get('/index',[AccountController::class,'index'])->name('index');
        Route::get('/create/',[AccountController::class,'create'])->name('create');
        Route::post('/store',[AccountController::class,'store'])->name('store');
    });
    
    # Users Routes
    Route::group(['prefix'=>'user','as'=>'users.'], function(){
        Route::get('/deposit', [UserController::class, 'depositSlip'])->name('depositSlip');
        Route::patch('/deposit/deposit', [UserController::class,'deposit'])->name('deposit');
        Route::get('/withdrawal',[UserController::class,'withdrawal'])->name('withdrawal');
        Route::patch('/withdraw', [UserController::class,'withdraw'])->name('withdraw');
    });

    #LOAN
    Route::group(['prefix'=>'loan','as'=>'loan.'],function(){
        Route::get('/',[LoanController::class,'index'])->name('index');
        Route::get('/monthly-payment', [LoanController::class,'create'])->name('create');
        Route::get('/apply-loan',[LoanController::class,'applyLoan'])->name('apply');
        Route::post('/store', [LoanController::class, 'store'])->name('store');
    });

    #PAYMENT
    Route::group(['prefix'=>'payment','as'=>'payment.'],function(){
        Route::get('/',[PaymentController::class,'index'])->name('index');
        Route::get('/pay-loan', [PaymentController::class, 'payLoan'])->name('pay-loan');
        Route::post('/pay-loan/selection', [PaymentController::class, 'processSelection'])->name('selection');
        Route::post('/pay-loan/terms', [PaymentController::class, 'termsPayment'])->name('terms');
        Route::post('/pay-loan/confirm', [PaymentController::class, 'termsAmount'])->name('amount');
        Route::patch('/pay-loan/{id}/update', [PaymentController::class, 'update'])->name('update');

    });



});
