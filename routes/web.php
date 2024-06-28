<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomClassController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('homepage');
});

Route::get('/',[HomeController::class, 'indexHP'])->name('homepage');
// Route::get('detail/{property:slug}',[DetailController::class, 'show'])->name('detail');
// Route::get('/detail',[DetailController::class, 'show'])->name('detail');
// Route::get('/detail/{id}', [DetailController::class, 'show'])->name('detail');
// In your routes file
// Route::get('/detail/{name_kost}', [DetailController::class, 'show'])->name('detail');
Route::get('/detail/{slug}', [DetailController::class, 'show'])->name('detail');
// Route::get('/rooms/{room:slug}', [DetailController::class, 'showRoom'])->name('rooms.show');

// Rute untuk dashboard berdasarkan jenis pengguna
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->type === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->type === 'super admin') {
            return redirect()->route('superAdmin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    })->name('dashboard');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Rute untuk admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
});

// Rute untuk super admin
Route::middleware(['auth', 'super admin'])->group(function () {
    Route::get('superAdmin/dashboard', [HomeController::class, 'indexSA'])->name('superAdmin.dashboard');
});

// Rute untuk pengguna biasa
Route::middleware(['auth'])->group(function () {
    Route::get('user/dashboard', [HomeController::class, 'userDashboard'])->name('user.dashboard');
});

Route::get('/register/admin', [RegisteredUserController::class, 'createAdmin'])
    ->name('register.admin');
Route::post('/register/admin', [RegisteredUserController::class, 'storeAdmin']);

Route::get('/register/user', [RegisteredUserController::class, 'createUser'])
    ->name('register.user');
Route::post('/register/user', [RegisteredUserController::class, 'storeUser']);

Route::post('/register/superAdmin', [RegisteredUserController::class, 'storeSA']);

Route::get('auth/google/login', [SocialLoginController::class, 'googleLoginPage'])->name('login.google');
Route::get('auth/google/register/admin', [SocialLoginController::class, 'googleRegisterAdminPage'])->name('register.google.admin');
Route::get('auth/google/register/user', [SocialLoginController::class, 'googleRegisterUserPage'])->name('register.google.user');

Route::get('auth/google/callback', [SocialLoginController::class, 'handleGoogleCallback'])->name('google.callback');

// Route::get('/admin/dashboard/kosts', [KostController::class, 'index'])->name('kosts.index');
// Route::get('/admin/dashboard/addkosts', [KostController::class, 'create'])->name('kosts.create');
Route::get('/input-brand-page', [RegisteredUserController::class, 'inputBrandPage'])->name('input.brand.page');
Route::post('/store-brand', [RegisteredUserController::class, 'storeBrand'])->name('store.brand');

Route::get('/admin/dashboard/kosts', [KostController::class, 'index'])->name('kosts.index')->middleware('auth');
Route::get('/admin/dashboard/kosts/create', [KostController::class, 'create'])->name('kosts.create')->middleware('auth');
Route::post('/admin/dashboard/kosts', [KostController::class, 'store'])->name('kosts.store')->middleware('auth');
Route::get('/admin/dashboard/kosts/{id}/edit', [KostController::class, 'edit'])->name('kosts.edit')->middleware('auth');
Route::put('/admin/dashboard/kosts/{id}', [KostController::class, 'update'])->name('kosts.update')->middleware('auth');
Route::delete('/admin/dashboard/kosts/{id}', [KostController::class, 'destroy'])->name('kosts.destroy')->middleware('auth');

Route::patch('kosts/{id}/update-status', [KostController::class, 'updateStatus'])->name('kosts.update.status');
Route::get('super-admin/kosts', [KostController::class, 'indexKost'])->name('superAdmin.indexKost');

Route::get('super-admin/kosts/detail/{slug}', [KostController::class, 'showDetailForSuperAdmin'])->name('kosts.show');

Route::resource('room_classes', RoomClassController::class);

// Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
// Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
// Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');
// Route::get('/rooms/{room}', [RoomController::class, 'show']);
// Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
// Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
// Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');
// Route::patch('/rooms/{room}/update-status', [RoomController::class, 'updateStatus']);

Route::resource('rooms', RoomController::class);
Route::patch('rooms/{room}/status', [RoomController::class, 'updateStatus'])->name('rooms.update.status');
Route::patch('/rooms/{room}/update-jumlah-kamar', [RoomController::class, 'updateJumlahKamar'])->name('rooms.update.jumlah_kamar');
// Route::get('/rooms/{room:slug}', [RoomController::class, 'show']);
Route::get('/rooms/{room:slug}', [RoomController::class, 'showRoom'])->name('rooms.show');