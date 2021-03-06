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

Route::get('/login/{provider}/', 'Auth\LoginController@redirectToProvider');
Route::get('/login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::post('/register/faculty', 'Auth\FacultyController@addDetails')->middleware('auth')->name('login.details.faculty');
Route::post('/register/student', 'Auth\StudentController@addDetails')->middleware('auth')->name('login.details.student');

Route::get('/home', 'HomeController@index')->name('home');

Route::view('/test', 'test');

Route::resource('faculties', 'FacultyController');

Route::resource('students', 'StudentController');

Route::resource('modules.subModules', 'SubModuleController');
Route::post('modules/{module}/subModules/createVideo', 'SubModuleController@storeVideo');
Route::get('modules/{module}/subModules/createVideo', 'SubModuleController@createVideo');
Route::resource('modules', 'ModuleController');
