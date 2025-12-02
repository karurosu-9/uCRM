<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SearchCustomerController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// 顧客検索のApiコントローラー
/*
* bootstrap/app.phpの
*　withMiddleware(function (Middleware $middleware): void {...}内に
* $middleware->api(prepend: [
*           \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
* ]);
* の追加をしないと動かない
*/
Route::get('/search-customers', SearchCustomerController::class)->middleware('auth:sanctum');

