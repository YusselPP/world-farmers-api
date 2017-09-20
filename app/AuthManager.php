<?php

namespace App;

use Auth;
use Request;
use Route;
use Illuminate\Auth\AuthenticationException;

class AuthManager
{
	static function validateCredentials($request) {

		$email = $request->input('email');
        if (is_null($email)) {
            throw new AuthenticationException('email');
        }

        $password = $request->input('password');
        if (is_null($password)) {
            throw new AuthenticationException('password');
        }

        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
		    throw new AuthenticationException('Invalid credentials');
		}
	}

	static function getToken() {

    	return requestToken([
		        'grant_type' => 'password',
		        'username' => $request->input('email'),
		        'password' => $request->input('password'),
		        'scope' => $request->input('scope', ''),
		    ]);
	}

	static function refreshToken() {
		$refreshToken = DB::table('oauth_refresh_tokens')->where('name', 'John')->first();

		return requestToken([
		        'grant_type' => 'refresh_token',
		        'refresh_token' => $refreshToken,
		        'scope' => $request->input('scope', ''),
		    ]);
	}

	static function requestToken($params) {
		$appUrl = config('app.url');

		$params = array_merge([
		        'client_id' => config('passport.client_id'),
		        'client_secret' => config('passport.client_secret'),
		    ], $params);	

		$http = new \GuzzleHttp\Client;
		$tokenResponse = $http->post($appUrl.'/oauth/token', [
		    'form_params' => $params,
		]);

		$token = json_decode((string) $tokenResponse->getBody(), true);

		return array_only($token, ['access_token', 'expires_in']);
	}

	static function getTokenJson($request) {

		$appUrl = config('app.url');
    	$scope = $request->input('scope', '');
    	$email = $request->input('email');
    	$password = $request->input('password');

    	// $tokenRequest = $request->duplicate();
    	// $tokenRequest->request->replace([
		   //      'grant_type' => 'password',
		   //      'client_id' => config('passport.client_id'),
		   //      'client_secret' => config('passport.client_secret'),
		   //      'username' => $email,
		   //      'password' => $password,
		   //      'scope' => $scope,
		   //  ]);

    	// $tokenRequest->server->set("REQUEST_URI", "/oauth/token");

    	// ready the request
		// $tokenRequest = Request::create('oauth/token', 'POST', [
		//         'grant_type' => 'password',
		//         'client_id' => config('passport.client_id'),
		//         'client_secret' => config('passport.client_secret'),
		//         'username' => $email,
		//         'password' => $password,
		//         'scope' => $scope,
		//     ]);
		//$tokenRequest->headers->set('Content-Type', 'application/json');
		//$tokenRequest->headers->set('X-Requested-With', 'XMLHttpRequest');
		// dd([$request, $tokenRequest]);

		// // handle the response
		// $tokenResponse = Route::dispatch($tokenRequest);

		$http = new \GuzzleHttp\Client;
		$tokenResponse = $http->post($appUrl.'/oauth/token', [
		    'form_params' => [
		        'grant_type' => 'password',
		        'client_id' => config('passport.client_id'),
		        'client_secret' => config('passport.client_secret'),
		        'username' => $email,
		        'password' => $password,
		        'scope' => $scope,
		    ],
		]);

		$token = json_decode((string) $tokenResponse->getBody(), true);

		return array_only($token, ['access_token', 'expires_in']);
	}
}
