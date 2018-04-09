<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
use patholab\User;
use Illuminate\Support\Facades\Auth;

Route::get('/', function(){
	return view('app.views.login');
});
Route::get('/login', function(){
	return view('app.views.login');
});
Route::get('/login/{username}', function($username){
	return view('app.views.login')
	->with(['user'=>$username]);
});

Route::group(['prefix'=>'operator', 'middleware'=>['web', 'auth', 'operator']], function(){
	Route::get('/', function(){
		return view('app.views.operator');
	});
});

Route::group(['prefix'=>'patient', 'middleware'=>['web', 'auth', 'patient']], function(){
	Route::get('/', function(){
		$person = User::where(['username'=>Auth::user()->username])		
		->get();

		return view('app.views.patient')
		->with(['person'=>$person[0]['name']]);
	});
});

Route::group(['prefix'=>'reports', 'middleware'=>['web', 'auth', 'mindYourBusiness']], function($id){
	Route::get('/page/{id}/pdf', 'pdfController@reportPagePdf');
	Route::get('/page/{id}', 'pdfController@reportPage');
	Route::get('/page/{id}/email', 'pdfController@sendReporAsPdf');
});