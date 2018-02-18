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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
//Route::get('/test1', function () {
//    return view('test');
//});

Auth::routes();
Route::resource('admin','AdminController');
Route::resource('test','TestController');
Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('employee')->group(function (){

    Route::get('/login', 'Auth\EmployeeLoginController@showLoginForm')->name('employee.login');
    Route::post('/login', 'Auth\EmployeeLoginController@login')->name('employee.login.submit');

    Route::get('/', 'EmployeeController@index')->name('employee.dashboard');
    Route::get('/activity', 'EmployeeController@store')->name('employee.activity.submit');
    Route::put('/stopped', 'EmployeeController@update')->name('activity.stop.submit');

});
