<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\LoginController;
// /*
// |--------------------------------------------------------------------------
// | API Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register API routes for your application. These
// | routes are loaded by the RouteServiceProvider within a group which
// | is assigned the "api" middleware group. Enjoy building your API!
// |
// */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::middleware('auth:sanctum')->get('/athenticated', function () {
//     return true;
// });
Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [\App\Http\Controllers\LoginController::class, 'user']);

});


// Route::get('home',[UserDataController::class,'home']);
// Route::get('logout',[UserDataController::class,'logout']);
    Route::post('user', [LoginController::class, 'user']);
    Route::post('logout', [LoginController::class, 'logout']);
    Route::post('users', [LoginController::class,'register']);
    Route::post('login', [LoginController::class,'login']);


    Route::post('submit', [PhotoController::class,'store']);
    Route::post('details', [PhotoController::class,'details']);
    Route::get('getItems', [PhotoController::class,'index']);
    Route::get('singlePost/{id}', [PhotoController::class,'singlePost']);
    Route::get('singleUser/{id}', [PhotoController::class,'singleUser']);
    Route::get('userData/{email}', [PhotoController::class,'userData']);
    Route::post('updateUser', [PhotoController::class,'userUpdate']);
    Route::get('oneData/{cat}', [PhotoController::class,'oneData']);
    Route::post('deleteUser/{del}', [PhotoController::class,'deleteUser']);

