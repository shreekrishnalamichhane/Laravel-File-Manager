<?php

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

// Route::middleware(['auth', 'api'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/')->middleware(['auth', 'api', '2fa', 'verified'])->group(function () {
    Route::post('/files/toggleFileStarred', [App\Http\Controllers\FileController::class, 'toggleFileStarred'])->name('files.toggleFileStarred');
    Route::delete('/files/delete', [App\Http\Controllers\FileController::class, 'destroy'])->name('files.delete');
});
