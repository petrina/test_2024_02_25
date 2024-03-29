<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\QuizController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/login', [UserController::class, 'auth']);

Route::middleware([AuthMiddleware::class])->group(function () {
    Route::resource('/users', UserController::class);
    Route::prefix('/quizzes')->group( function () {
        Route::resource('/', QuizController::class);
        Route::put('/{id}/grade', [QuizController::class, 'setGrade']);
    });
});
