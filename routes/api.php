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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user', function (Request $request) {
	// dd(config('passport.client_secret'));
    // $user = new \App\User;
    // $user->name = 'Yussel Paredes';
    // $user->password = Hash::make('');
    // $user->email = 'yussel.paredes@gmail.com';
    // $user->save();
    // dd(Hash::check('', '$2y$10$K7KoXmNv.IXnaEUgg/chIuEeM5HIoyEot13HeAuygRe6LH4tpTyd2'));
});

Route::post('/login', 'AuthController@login');

Route::resource('contacts', 'ContactController', ['except' => [
	'create', 'edit'
]]);
