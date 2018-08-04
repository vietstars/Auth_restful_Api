<?php

use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;

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
	if($request->user()->activated){
		return response()->json([
	        'data'     => $request->user(),
	    ], 400);
	}else{
		throw new AuthenticationException('Unauthenticated.');
	}
});

// Route::apiResource('contact','Api\ContactController');
Route::middleware('auth:api')->get('contact',['as' => 'contact.all', 'uses' => 'Api\ContactController@index']);
Route::middleware('auth:api')->get('contact/{contact}',['as' => 'contact.detail', 'uses' => 'Api\ContactController@show']);
Route::middleware('auth:api')->post('contact',['as' => 'contact.new', 'uses' => 'Api\ContactController@store']);
Route::middleware('auth:api')->put('contact',['as' => 'contact.update', 'uses' => 'Api\ContactController@update']);
Route::middleware('auth:api')->delete('contact/{contact}',['as' => 'contact.delete', 'uses' => 'Api\ContactController@destroy']);