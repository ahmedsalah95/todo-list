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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware'=>['web']],function(){


    Route::Resource('notes','NoteController');
    Route::Post('addNote','NoteController@addNote');
    Route::Post('editNote','NoteController@editNote');
    Route::Post('deleteNote','NoteController@deleteNote');

});

Route::get('sendMail','MailController@index');

Route::get('addAlt/{id}','NoteController@addAlt');

Route::post('submitAlt','NoteController@submitAlt');

Route::get('addFile/{id}','NoteController@addFile');

Route::post('submitFile','NoteController@submitFile');

