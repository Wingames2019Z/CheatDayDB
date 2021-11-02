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
// // show blog list
// Route::get('/', 'BlogController@showList')->name
// ('blogs');
// // show blog register
// Route::get('/blog/create', 'BlogController@showCreate')->name
// ('create');
// //blog register
// Route::post('/blog/store', 'BlogController@exeStore')->name
// ('store');
// // show blog detail
// Route::get('/blog/{id}', 'BlogController@showDetail')->name
// ('show');
// // show blog edit
// Route::get('/blog/edit/{id}', 'BlogController@showEdit')->name
// ('edit');
// //blog register
// Route::post('/blog/update', 'BlogController@exeUpdate')->name
// ('update');
// //blog delete
// Route::post('/blog/delete/{id}', 'BlogController@exeDelete')->name
// ('delete');

Route::get('registration', 'RegistrationController@Registration');