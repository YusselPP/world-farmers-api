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
    $user = new \App\User;
    $user->name = 'Y Paredes';
    $user->password = Hash::make('123admin');
    $user->email = 'yparedes@gmail.com';
    $user->scopes = json_encode(['write-contacts']);
    $user->save();
    // dd(Hash::check('', '$2y$10$K7KoXmNv.IXnaEUgg/chIuEeM5HIoyEot13HeAuygRe6LH4tpTyd2'));
});



// Auth
Route::post('/login', 'AuthController@login');
Route::middleware('auth:api')->post('/logout', 'AuthController@logout');



// Contacts
Route::resource('contacts', 'ContactController', ['except' => [
	'create', 'edit'
]]);
