<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::redirect('/', '/login', 301);

Auth::routes([
    'verify'   => true,
    'register' => false,
    'reset'    => false,
]);

Route::middleware(['auth', 'verified', '2fa'])->prefix('/profile')->group(function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::post('/updateAvatar', [App\Http\Controllers\UserController::class, 'updateAvatar'])->name('user.updateAvatar')->middleware(['password.confirm']);
    Route::post('/updateProfileName', [App\Http\Controllers\UserController::class, 'updateProfileName'])->name('user.updateProfileName')->middleware(['password.confirm']);
    Route::post('/updateProfileUsername', [App\Http\Controllers\UserController::class, 'updateProfileUsername'])->name('user.updateProfileUsername')->middleware(['password.confirm']);
    Route::post('/updateProfilePhone', [App\Http\Controllers\UserController::class, 'updateProfilePhone'])->name('user.updateProfilePhone')->middleware(['password.confirm']);
    Route::post('/changeUserPassword', [App\Http\Controllers\UserController::class, 'changePassword'])->name('user.changeUserPassword')->middleware(['password.confirm']);

});
Route::group(['prefix' => '2fa'], function () {
    Route::post('/generateSecret', [App\Http\Controllers\TwoFactorAuthController::class, 'generate2faSecret'])->name('generate2faSecret');
    Route::post('/enable2fa', [App\Http\Controllers\TwoFactorAuthController::class, 'enable2fa'])->name('enable2fa');
    Route::post('/disable2fa', [App\Http\Controllers\TwoFactorAuthController::class, 'disable2fa'])->name('disable2fa');

    // 2fa middleware
    Route::post('/2faVerify', function () {
        return redirect()->back()->with('success', 'Login Successful.');
    })->name('2faVerify')->middleware('2fa');

});

Route::middleware(['auth', 'verified', '2fa'])->prefix('/')->group(function () {
    Route::get('/files', [App\Http\Controllers\FileController::class, 'index'])->name('files.index');
    Route::get('/starred', [App\Http\Controllers\FileController::class, 'starred'])->name('files.starred');
    Route::post('/files/upload', [App\Http\Controllers\FileController::class, 'store'])->name('files.upload');
});
