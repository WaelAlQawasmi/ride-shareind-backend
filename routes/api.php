<?php

use App\Http\Controllers\Auth\UserAuthController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(UserAuthController::class)->prefix('/user')->group(function () {
    Route::post('/register', 'register')->name('user.reg');
    
    Route::post('/login', 'login')->name('user.login');

    // Route::post('/add', 'store')->name('branch.add');

    // Route::delete('softdelete/{id}', 'destroy')->name('branch.delete');

    // Route::delete('harddelete/{id}', 'hdelete')->name('branch.hdelete');
});

// Route::post('/register', [UserAuthController::class,'register']);
// Route::post('/login', [UserAuthController::class,'login']);