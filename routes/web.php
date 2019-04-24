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

Route::get('/', 'CardsController@index');
Route::get('/card', 'CardsController@getCard');
Route::get('/curso', 'CardsController@curso');
Route::get('/disciplina', 'CardsController@disciplina');
Route::get('/aula', 'CardsController@aula');
Route::get('/professor', 'CardsController@professor');
Route::post('/fitro', 'CardsController@search');
Route::post('/cadastrar', 'CardsController@create');
Route::post('/upload', 'FilesController@upload');
Route::put('/mover', 'CardsController@mover');
Route::put('/editar', 'CardsController@update');
