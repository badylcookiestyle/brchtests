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

Route::get('/',[App\Http\Controllers\welcomeController::class,'index'] );
Route::get('/contact', function () {
    return view('contact');
})->name("contact");
Route::get('/about', function () {
    return view('about');
})->name("about");
Auth::routes();


//test routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
	->name('home')
	->middleware("auth");

Route::get('/test/{id}', [App\Http\Controllers\TestController::class, 'index'])
	->name('testIndex');

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

Route::post('test/checkAnswers',[App\Http\Controllers\TestController::class,'checkAnswers'])->name('checkAnswers')->middleware();


Route::get('question/{id}', [App\Http\Controllers\QuestionController::class, 'create'])
	->name('questionIndex')
	->middleware("auth");

Route::post('question/update',[App\Http\Controllers\QuestionController::class,'update'])->name('questionEdit')->middleware("auth");
Route::post('question/store',[App\Http\Controllers\QuestionController::class,'store'])->middleware("auth");
Route::get('question/delete/{id}',[App\Http\Controllers\QuestionController::class,'destroy'])->middleware("auth")->name("questionDelete");
//*** img route
Route::post('question/changeImg',[App\Http\Controllers\TestController::class,'changeImg'])->middleware("auth");
//*** description route
Route::post('question/changeDescription',[App\Http\Controllers\DescriptionController::class,'change'])->middleware("auth");
Route::get('/notWorking', [App\Http\Controllers\TestController::class, 'notWorking'])
    ->name('notWorking');
