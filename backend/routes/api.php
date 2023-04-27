<?php

use App\Http\Actions\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/storage/media/{name}', Media\FileAction::class)
    ->name('storage.media');

Route::get('/storage/media/preview/{name}', Media\FilePreviewAction::class)
    ->name('storage.media.preview');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
