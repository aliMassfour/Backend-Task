<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\MyFacade\Store;
use App\MyFacade\StoreFacade;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/test', function (Request $request) {
    return StoreFacade::StoreImage($request->image);
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('article/store', [ArticleController::class, 'store']);
    Route::get('/article/index', [ArticleController::class, 'index']);
    Route::get('/article/{article}', [ArticleController::class, 'show']);
    Route::delete('/article/delete/{article}', [ArticleController::class, 'delete']);
    Route::put('/article/update/{article}',[ArticleController::class,'update']);
});
