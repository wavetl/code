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
use Illuminate\Http\Request;

Auth::routes();


// CODE routes
Route::get('/', 'CodeController@index')->name('home');
Route::get('/code/language/{language}', 'CodeController@index')->name('code_language');
Route::get('/code/share', 'CodeController@share')->name('code_share')->middleware('auth');
Route::get('/code/{slug}/{id}', 'CodeController@view')->name('code_view');
Route::get('/edit/{id}', 'CodeController@edit')->name('code_edit');



// USER routes
Route::get('/user/center', 'UserController@center')->name('user_center')->middleware('auth');
Route::get('/user/info/{id}', 'UserController@info')->name('user_info');
Route::get('/auth/edit_info', 'UserController@edit_info')->name('user_edit_info');
Route::post('/auth/update_info', 'UserController@update_info')->name('user_update_info')->middleware('auth');



// PM routes
Route::get('/pm', 'PMController@inbox')->name('pm_inbox')->middleware('auth');
Route::get('/pm/send/{id}', 'PMController@form')->name('pm_form')->middleware('auth');
Route::get('/pm/{id}', 'PMController@show')->name('pm_show')->middleware('auth');




// API Routes
Route::post('/api/code/list', function (Request $request) {

    $users = app('code')::with(['user']);
    if ($request->input('language')) {
        $users->where('language', $request->input('language'));
    }
    if ($request->input('user_id')) {
        $users->where('user_id',$request->input('user_id'));
    }
    $users->orderBy('created_at', 'DESC');
    return new CodeResource($users->paginate(config()->get('app.per_page')));
})->name('api_code_list');
Route::post('/api/code/save', 'CodeController@save')->name('api_code_save')->middleware('auth');
Route::post('/api/code/find', 'CodeController@find')->name('api_code_find');
Route::post('/api/code/delete', 'CodeController@delete')->name('api_code_delete')->middleware('auth');
Route::post('/api/pm/send', 'PMController@send')->name('api_pm_send')->middleware('auth');
Route::post('/api/pm/delete', 'PMController@delete')->name('api_pm_delete')->middleware('auth');
