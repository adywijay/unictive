<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JWTAuthentication\AuthController;
use App\Http\Controllers\Api\ContentCRUD\MemberController;
use App\Http\Controllers\Api\ContentCRUD\HobbyController;


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

Route::prefix('auth')->group(

    function () {
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/logout', [AuthController::class, 'logout']);
    }
);

Route::prefix('hobby')->group(

    function () {
        Route::get('/getBy/{id}', [HobbyController::class, 'getsByIdHobby']);
        Route::put('/updateHobby', [HobbyController::class, 'actionUpdateHobby']);
    }
);

Route::prefix('member')->group(

    function () {
        Route::get('/getBy/{id}', [MemberController::class, 'getByIdMember']);
        Route::put('/updateMember', [MemberController::class, 'updateMember']);
    }
);
