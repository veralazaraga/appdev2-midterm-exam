<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UploadFileController;
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

Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');


Route::group(['middleware' => 'checkToken'], function () {
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{id}', [ProductController::class, 'delete'])->name('products.delete');
});

Route::post('products/upload/local', [UploadFileController::class, 'uploadLocal'])->name('upload.local');
Route::post('products/upload/public', [UploadFileController::class, 'uploadPublic'])->name('upload.public');

