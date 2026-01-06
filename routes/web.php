<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostController;

Route::get('/',[PostController::class,'home']);

Route::post('/one',[PostController::class,'store'])
->name('post.store');

Route::post('/',[PostController::class,'secondStore'])
->name('post.secondStore');

Route::post('/three',[PostController::class,'thirdStore'])
->name('post.thirdStore');

Route::post('/four',[PostController::class,'fourthStore'])
->name('post.fourthStore');

//sample
Route::get('/test', [TestController::class, 'test'])->name('test');

require __DIR__.'/auth.php';
