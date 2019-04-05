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


use App\Http\Resources\CodeResource;
use App\Code;

Auth::routes();


// CODE routes
Route::get('/', 'HomeController@index')->name('home');
Route::get('/code/share', 'CodeController@share')->name('code_share')->middleware('auth');
Route::get('/code/{slug}/{id}', 'CodeController@view')->name('code_view');


// USER routes
Route::get('/user/info/{id}','UserController@info')->name('user_info');
Route::get('/user/pm/{id}','UserController@pm')->name('user_pm')->middleware('auth');

// API Routes
Route::post('/api/code/list', function () {
    return new CodeResource(Code::with(['user'])->get());
})->name('api_code_list');
Route::post('/api/code/save', 'CodeController@save')->name('api_code_save')->middleware('auth');
Route::post('/api/code/find', 'CodeController@find')->name('code_find');
Route::post('/api/pm/send','UserController@pm_send')->name('pm_send')->middleware('auth');