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
	if(Auth::user()->activated){
		return response()->json([
	        'data'     => $request->user(),
	    ], 400);
	}else{
		throw new AuthenticationException('Unauthenticated.');
	}
});
