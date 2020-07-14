<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->group(function () {

	Route::get('/manager', 'UserController@index')->name('admin.manager');

	Route::get('export', 'CSVController@export')->name('admin.export');

	Route::post('/adduser', 'UserController@userfun')->name('admin.addUser');

	Route::get('/delete/{user}', 'UserController@delete')->name('admin.deleteuser');

	Route::post('/update', 'UserController@updatewithimage')->name('admin.updateuser');

	Route::get('/sort/{num?}', 'UserController@sortpage')->name('csv.CsvGenerate');

	
});	

