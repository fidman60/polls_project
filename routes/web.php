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

Route::resource('poll','Poll\PollController');

Auth::routes();

Route::get('/vote/{n}','Poll\VoteController@create')->name('create.vote')->where('n','^[0-9]+$');

Route::post('/vote','Poll\VoteController@store')->name('store.vote');