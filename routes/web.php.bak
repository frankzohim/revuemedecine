<?php

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
})->name('homepage');

Auth::routes();

//Route::get('/home', 'HomeController@index')->middleware('verified')->name('home');
Route::get('/home', 'App\Http\Controllers\HomeController@index')->middleware('verified')->name('home');
Route::get('/dashboard', 'App\Http\Controllers\HomeController@dashboard')->middleware('verified')->name('dashboard');
Auth::routes();

Auth::routes(['verify' => true]);

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth','verified']], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    Route::get('manuscript/create', ['as' => 'manuscript.create', 'uses' => 'App\Http\Controllers\ManuscriptController@create']);
    Route::get('manuscript/edit{manuscriptId}', ['as' => 'manuscript.edit', 'uses' => 'App\Http\Controllers\ManuscriptController@edit']);
    Route::get('manuscript/delete{manuscriptId}', ['as' => 'manuscript.delete', 'uses' => 'App\Http\Controllers\ManuscriptController@delete']);
    Route::get('manuscript/publish{manuscriptId}', ['as' => 'manuscript.publish', 'uses' => 'App\Http\Controllers\ManuscriptController@publish']);
    Route::post('manuscript', ['as' => 'manuscript.save', 'uses' => 'App\Http\Controllers\ManuscriptController@save']);
    Route::post('manuscript/update', ['as' => 'manuscript.update', 'uses' => 'App\Http\Controllers\ManuscriptController@update']);
    Route::post('manuscript/letter', ['as' => 'manuscript.letter', 'uses' => 'App\Http\Controllers\ManuscriptController@letter']);
    
    //Route for showing manuscripts depending on status
    Route::get('manuscript/{status}', ['as' => 'manuscript.list', 'uses' => 'App\Http\Controllers\ManuscriptController@list']);
    
    //Route for manage authors for a manuscript
    Route::post('manuscript/authors', ['as' => 'manuscript.authors', 'uses' => 'App\Http\Controllers\ManuscriptController@authors']);
    
    //Route to save corresponding author
    Route::post('manuscript/author', ['as' => 'manuscript.corresponding_author', 'uses' => 'App\Http\Controllers\ManuscriptController@corresponding_author']);
    
    Route::post('manuscript/figures', ['as' => 'manuscript.figures', 'uses' => 'App\Http\Controllers\ManuscriptController@figures']);
    Route::post('manuscript/storeFile', ['as' => 'manuscript.storeFile', 'uses' => 'App\Http\Controllers\ManuscriptController@storeFile']);
    
    //route for submitting a manuscript
    Route::post('manuscript/submission', ['as' => 'manuscript.submission', 'uses' => 'App\Http\Controllers\ManuscriptController@submission']);
    
    //route for processing a manuscript
    Route::get('manuscript/processing{manuscriptId}', ['as' => 'manuscript.processing', 'uses' => 'App\Http\Controllers\ManuscriptController@processing']);

    //route for visualizing a manuscript
    Route::get('visualize{manuscriptId}', ['as' => 'visualize', 'uses' => 'App\Http\Controllers\ManuscriptController@visualize']);
    
    
    //route for updating manuscript's status
    Route::post('manuscript/statusUpdate', ['as' => 'manuscript.statusUpdate', 'uses' => 'App\Http\Controllers\ManuscriptController@statusUpdate']);
    
    //route for sending mail to authors to ask them to confirm if they know about this manuscript
    Route::get('authors/notify{manuscriptId}', ['as' => 'authors.notify', 'uses' => 'App\Http\Controllers\ManuscriptController@notifyAuthors']);
    
    Route::get('manuscript/download{manuscriptId}', ['as' => 'manuscript.download', 'uses' => 'App\Http\Controllers\ManuscriptController@download']);
    Route::get('manuscript/supprimer{id}', ['as' => 'manuscript.supprimer', 'uses' => 'App\Http\Controllers\ManuscriptController@supprimer']);
    Route::get('reviewer/create', ['as' => 'reviewer.create', 'uses' => 'App\Http\Controllers\ReviewerController@create']);
    Route::get('reviewer/list', ['as' => 'reviewer.list', 'uses' => 'App\Http\Controllers\ReviewerController@list']);
    Route::post('reviewer/store', ['as' => 'reviewer.store', 'uses' => 'App\Http\Controllers\ReviewerController@store']);
    Route::get('review', ['as' => 'review', 'uses' => 'App\Http\Controllers\ReviewController@index']);
    Route::get('review/add{manuscriptId}', ['as' => 'review.add', 'uses' => 'App\Http\Controllers\ReviewController@add']);
    Route::get('review/edit{reviewId}', ['as' => 'review.edit', 'uses' => 'App\Http\Controllers\ReviewController@edit']);
    Route::post('review/save', ['as' => 'review.save', 'uses' => 'App\Http\Controllers\ReviewController@save']);
    Route::post('review/part2', ['as' => 'review.part2', 'uses' => 'App\Http\Controllers\ReviewController@part2']);
    Route::post('review/part3', ['as' => 'review.part3', 'uses' => 'App\Http\Controllers\ReviewController@part3']);
    Route::post('review/part4', ['as' => 'review.part4', 'uses' => 'App\Http\Controllers\ReviewController@part4']);
    Route::post('review/update', ['as' => 'review.update', 'uses' => 'App\Http\Controllers\ReviewController@update']);
    Route::get('assign/{type}', ['as' => 'assign', 'uses' => 'App\Http\Controllers\AssignController@index']);
    
    //route for assigning manuscript to Editor or Reviewer
    Route::get('assign/selectItems/{manuscriptId}/{type}', ['as' => 'assign.selectitems', 'uses' => 'App\Http\Controllers\AssignController@selectItems']);
    
    Route::post('assign/save', ['as' => 'assign.save', 'uses' => 'App\Http\Controllers\AssignController@save']);
    
    Route::post('assign/saveEditor', ['as' => 'assign.editosave', 'uses' => 'App\Http\Controllers\AssignController@saveEditor']);
    
    Route::post('subcat', ['as' => 'subcat', 'uses' => 'App\Http\Controllers\ManuscriptController@subcat']);
    Route::get('editor/create', ['as' => 'editor.create', 'uses' => 'App\Http\Controllers\EditorController@create']);
    Route::post('editor/store', ['as' => 'editor.store', 'uses' => 'App\Http\Controllers\EditorController@store']);
    Route::get('editor/list', ['as' => 'editor.list', 'uses' => 'App\Http\Controllers\EditorController@list']);
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('lang/{locale}', ['as' => 'lang', 'uses' => 'App\Http\Controllers\LocalizationController@index']);



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
