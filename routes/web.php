<?php

use App\Http\Controllers\ChapterController;
use App\Http\Controllers\NovelController;
use App\Http\Controllers\ReadingListController;
use App\Http\Controllers\UserController;
use App\Models\ReadingList;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/novels',[NovelController::class,'scrape']);
Route::get('/',[NovelController::class,'scrape']);
Route::get('/load',[NovelController::class,'load']);
Route::get('/novels/cat',[NovelController::class,'catalog']);
Route::get('/novel/{novel}',[NovelController::class,'show']);


Route::get('/users/register',[UserController::class,'create'])->middleware('guest');
Route::post('/users',[UserController::class,'store']);
Route::post('/users/logout',[UserController::class,'logout'])->middleware('auth');
Route::get('/users/login',[UserController::class,'login'])->name('login');
Route::post('/users/auth',[UserController::class,'auth']);

Route::get('/novels/reading_list',[ReadingListController::class,'index'])->middleware('auth');
Route::post('/novel/{novel}/add',[ReadingListController::class,'store'])->middleware('auth');
Route::delete('/readinglist/delete/{novel}',[ReadingListController::class,'delete'])->middleware('auth');

Route::get('/novel/{novel}/chapter/{chapter}',[ChapterController::class,'show']);
Route::get('/novel/{novel}/next/{chapter}',[ChapterController::class,'next']);
Route::get('/novel/{novel}/prev/{chapter}',[ChapterController::class,'prev']);

Route::fallback(function () {
    return redirect('/');
});