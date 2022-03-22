<?php

use App\Http\Controllers\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')
    ->group(function () {
        // Payment
        Route::prefix('payment')
            ->name('payment.')
            ->group(function () {
                Route::get('/', 'PaymentController@all')->name('all');
                Route::get('/{payment}', 'PaymentController@show')->name('show');
                Route::post('/store', 'PaymentController@store')->name('store');
                Route::put('/{payment}/update', 'PaymentController@update')->name('update');
                Route::delete('/{payment}/delete', 'PaymentController@destroy')->name('delete');
            });

        // Travel Payment
        Route::prefix('travel-payment')
            ->name('travel-payment.')
            ->group(function () {
                Route::get('/', 'TravelPaymentController@all')->name('all');
                Route::get('/{TravelPayment}', 'TravelPaymentController@show')->name('show');
                Route::post('/store', 'TravelPaymentController@store')->name('store');
                Route::put('/{TravelPayment}/update', 'TravelPaymentController@update')->name('update');
                Route::delete('/{TravelPayment}/delete', 'TravelPaymentController@destroy')->name('delete');
            });

        // Payment Approval
        Route::post('/payment-approval/store', 'PaymentApprovalController@approvePayments')->name('payment-approval.approve-all');
    });

// Report
Route::get('/report', ReportController::class)->name('report');


