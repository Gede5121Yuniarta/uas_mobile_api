<?php

use App\Http\Controllers\API\KostAPIController;
use App\Http\Controllers\API\KostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:api', 'checkType:user'])->group(function () {
    Route::get('user', function () {
        return response()->json(['message' => 'Welcome User'], 200);
    });
});

Route::middleware(['auth:api', 'checkType:admin'])->group(function () {
    Route::get('admin', function () {
        return response()->json(['message' => 'Welcome Admin'], 200);
    });
});

Route::middleware(['auth:api', 'checkType:super admin'])->group(function () {
    Route::get('super-admin', function () {
        return response()->json(['message' => 'Welcome Super Admin'], 200);
    });
});

// Route::resource('kost', KostController::class);
// Route::get('/kost', [KostController::class, 'index']);

// Route::group(['middleware'=>'auth:sanctum'], function(){
//     Route::resource('kost', KostController::class);
//     // Route::resource('matkul', MatkulController::class);
//     // Route::resource('dosen', DosenController::class);
//     // Route::resource('berita', DashboardPostController::class);
// });

// Route::group(['middleware' => 'auth:api'], function () {
//     Route::get('/kosts', [KostController::class, 'index'])->name('api.kosts.index');
//     Route::post('/kosts', [KostController::class, 'store'])->name('api.kosts.store');
//     Route::get('/kosts/{id}', [KostController::class, 'show'])->name('api.kosts.show');
//     Route::put('/kosts/{id}', [KostController::class, 'update'])->name('api.kosts.update');
//     Route::delete('/kosts/{id}', [KostController::class, 'destroy'])->name('api.kosts.destroy');
// });

Route::prefix('kosts')->group(function () {
    Route::get('/', [KostController::class, 'index']);
    Route::post('/', [KostController::class, 'store']);
    Route::get('/{id}', [KostController::class, 'show']);
    Route::put('/{id}', [KostController::class, 'update']);
    Route::delete('/{id}', [KostController::class, 'destroy']);
});

// In your routes/api.php file
// Route::get('/validate-token', 'AuthController@validateToken')->middleware('validate-token');
Route::get('/validate-token', [AuthController::class, 'validateToken'])->middleware('validate-token');
// Route::apiResource('kosts', KostAPIController::class);