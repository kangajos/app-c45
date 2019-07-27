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

Route::get('/', 'DashboardController@index');
Route::get('/c45', 'C45Controller@index');
Route::get('/c45/add', 'C45Controller@add');
Route::post('/c45/save', 'C45Controller@save');
Route::post('/c45/update', 'C45Controller@update');
Route::get('/c45/edit/{no}', 'C45Controller@edit');
Route::get('/c45/delete/{no}', 'C45Controller@delete');
Route::post('/c45/import', 'C45Controller@import')->name('import');
