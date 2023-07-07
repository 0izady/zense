<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/searches', [\App\Http\Controllers\ApiController::class,'searches']);
Route::get('/top_search', [\App\Http\Controllers\ApiController::class,'PopularSearch']);
Route::get('/GetSearch/{name}', [\App\Http\Controllers\ApiController::class,'GetSearch']);
Route::get('/search/{key_word}', [\App\Http\Controllers\ApiController::class, 'search'])->name('api.search');

Route::get('/postes', [\App\Http\Controllers\ApiController::class,'post']);
Route::get('/top_post', [\App\Http\Controllers\ApiController::class,'PupularPost']);
Route::get('/post/{name}', [\App\Http\Controllers\ApiController::class, 'GetPost']);

Route::get('/chat/{text}', [\App\Http\Controllers\ApiController::class, 'chat']);
Route::get('/translate/{language}/{text}', [\App\Http\Controllers\ApiController::class, 'translate']);

Route::get('/', function (){return redirect()->route('home');});
