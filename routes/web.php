<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\StorageFileController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
//test routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
	->name('home')
	->middleware("auth");

Route::get('/test', [App\Http\Controllers\TestController::class, 'index'])
	->name('testIndex')
	->middleware("auth");

 Route::get('/test', [App\Http\Controllers\TestController::class, 'create'])
 	->name('testCreate')
 	->middleware("auth");

Route::delete('/test/{id}', [App\Http\Controllers\TestController::class, 'destroy'])
	->name('testDelete')
	->middleware("auth");

Route::get('/test/edit/{id}',[App\Http\Controllers\TestController::class,'edit'])
   	->name("testEdit")
   	->middleware("auth");

Route::post('/test', [App\Http\Controllers\TestController::class, 'store'])
	->name('testStore')
	->middleware("auth");
Route::get('image/{filename}', [TestController::class,'testImg'])->name('testImg');
//question routes


Route::get('question/{id}', [App\Http\Controllers\QuestionController::class, 'create'])
	->name('questionIndex')
	->middleware("auth")->middleware("auth");

 Route::post('question/{id}',[App\Http\Controllers\QuestionController::class,'store'])->middleware("auth");
