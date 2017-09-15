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
    // $user = new \App\User;
    // $user->name = 'Yussel Paredes';
    // $user->password = Hash::make('fakepass');
    // $user->email = 'test@mail.com';
    // $user->save();
    // dd(Hash::check('123admin', '$2y$10$K7KoXmNv.IXnaEUgg/chIuEeM5HIoyEot13HeAuygRe6LH4tpTyd2'));
});

Route::resource('contacts', 'ContactController', ['except' => [
	'create', 'edit'
]]);
