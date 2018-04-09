<?php

use Illuminate\Http\Request;

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

Route::post('/login', 'loginController@login');

Route::resource('/patient', 'patientController');
Route::resource('/tests', 'testController');
Route::resource('/reports', 'reportController', ['only'=>['store', 'show', 'update', 'destroy', 'edit']]);
Route::resource('/patientReports', 'patientReportsController', ['only'=>['index', 'show']]);