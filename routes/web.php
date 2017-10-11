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
Route::group(['middleware' => 'auth'], function(){
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/usuarios', 'UsersController@index')->name('users_path');
  Route::get('/usuarios/nuevo', 'UsersController@create')->name('create_user_path');
  Route::post('/usuarios/nuevo', 'UsersController@save')->name('create_user_path');
  Route::get('/usuarios/{user}/perfil', 'UsersController@profile')->name('user_profile_path');
  Route::get('/usuarios/{user}/editar', 'UsersController@edit')->name('edit_user_path');
  Route::post('/usuarios/{user}/editar', 'UsersController@update')->name('edit_user_path');
  Route::get('/usuarios/{user}/activar', 'UsersController@active_user')->name('active_user');
  Route::get('/usuarios/{user}/desactivar', 'UsersController@disable_user')->name('disable_user');
  Route::delete('/usuarios/{user}/borrar', 'UsersController@delete')->name('delete_user_path');
});
