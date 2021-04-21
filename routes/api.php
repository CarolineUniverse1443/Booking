<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//================= Users ================//
Route::get('getUsers', 'App\Http\Controllers\UsersController@getUsers');
Route::post('signUp', 'App\Http\Controllers\UsersController@register');
Route::post('signIn', 'App\Http\Controllers\UsersController@login');
Route::patch('updateUser', 'App\Http\Controllers\UsersController@updateUser');
Route::post('deleteUser', 'App\Http\Controllers\UsersController@deleteUser');

//================= Cities ================//
Route::get('getCities', 'App\Http\Controllers\CitiesController@getCities');
Route::post('addCity', 'App\Http\Controllers\CitiesController@addCity');
Route::patch('updateCity', 'App\Http\Controllers\CitiesController@updateCity');
Route::post('deleteCity', 'App\Http\Controllers\CitiesController@deleteCity');

//================= Flights ================//
Route::get('getFlights', 'App\Http\Controllers\FlightsController@getFlights');
Route::post('addFlight', 'App\Http\Controllers\FlightsController@addFlight');
Route::patch('updateFlight', 'App\Http\Controllers\FlightsController@updateFlight');
Route::post('deleteFlight', 'App\Http\Controllers\FlightsController@deleteFlight');

//================= Books ================//
Route::get('getBooks', 'App\Http\Controllers\BooksController@getBooks');
Route::post('addBook', 'App\Http\Controllers\BooksController@addBook');
Route::patch('updateBook', 'App\Http\Controllers\BooksController@updateBook');
Route::post('deleteBook', 'App\Http\Controllers\BooksController@deleteBook');




