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
//*** settings
Route::get('/settings', function () {
    return view('settings');
})->name("settings")->middleware("auth");
Route::get('/settings/changePassword', function () {
    return view('settingsPanels.index');
})->name("changePasswordPanel")->middleware("auth");
Route::get('/settings/deleteAccount', function () {
    return view('settingsPanels.deleteAccount');
})->name("deleteAccountPanel")->middleware("auth");
Route::post('/settings/changePasswordRequest',[App\Http\Controllers\ChangePasswordController::class,"update"])->name("changePasswordRequest")->middleware("auth");
Route::post("settings/deleteAccount",[App\Http\Controllers\ChangePasswordController::class,'deleteAccount'])->name('deleteAccount')->middleware("auth");
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
Route::post('test/checkAnswers',[App\Http\Controllers\TestController::class,'checkAnswers'])
    ->name('checkAnswers')
    ->middleware();
//*** comment
Route::post('test/addComment',[App\Http\Controllers\CommentController::class,'store'])
    ->name("addComment")
    ->middleware("auth");
Route::post('test/editComment',[App\Http\Controllers\CommentController::class,'edit'])
    ->name("editComment")
    ->middleware("auth");
Route::delete('test/comment/delete/{id}',[App\Http\Controllers\CommentController::class,'destroy'])
    ->middleware("auth")
    ->name("commentDelete");
//*** subcomment
Route::post('test/getSubComments',[App\Http\Controllers\SubCommentController::class,'get'])
    ->name("getSubComments");
Route::post('test/addSubComment',[App\Http\Controllers\SubCommentController::class,'store'])
    ->name("addSubComment")
    ->middleware("auth");
Route::post('test/editSubComment',[App\Http\Controllers\SubCommentController::class,'edit'])
    ->name("editSubComment")
    ->middleware("auth");
Route::delete('test/subComment/delete/{id}',[App\Http\Controllers\SubCommentController::class,'destroy'])
    ->middleware("auth")
    ->name("subCommentDelete");
//**likes
Route::post('test/testLike',[App\Http\Controllers\LikeController::class,'testLike'])->name("likeTest")->middleware("auth");
Route::post('test/commentLike',[App\Http\Controllers\LikeController::class,'commentLike'])->name("likeComment")->middleware("auth");
//*** question
Route::get('question/{id}', [App\Http\Controllers\QuestionController::class, 'create'])
    ->name('questionIndex')
    ->middleware("auth");
Route::post('question/update',[App\Http\Controllers\QuestionController::class,'update'])
    ->name('questionEdit')->middleware("auth");
Route::post('question/store',[App\Http\Controllers\QuestionController::class,'store'])
    ->middleware("auth");
Route::get('question/delete/{id}',[App\Http\Controllers\QuestionController::class,'destroy'])
    ->middleware("auth")
    ->name("questionDelete");
//*** img route
Route::post('question/changeImg',[App\Http\Controllers\TestController::class,'changeImg'])
    ->middleware("auth");
//*** description route
Route::post('question/changeDescription',[App\Http\Controllers\DescriptionController::class,'change'])
    ->middleware("auth");
Route::get('/notWorking', [App\Http\Controllers\TestController::class, 'notWorking'])
    ->name('notWorking');
