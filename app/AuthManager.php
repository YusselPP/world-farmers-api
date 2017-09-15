<?php

namespace App;

use Auth;
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

	static function getTokenJson($request) {

		$appUrl = config('app.url');
    	$scope = $request->input('scope', config('passport.scope'));
    	$http = new \GuzzleHttp\Client;

		$tokenResponse = $http->post($appUrl.'/oauth/token', [
		    'form_params' => [
		        'grant_type' => config('passport.grant_type'),
		        'client_id' => config('passport.client_id'),
		        'client_secret' => config('passport.client_secret'),
		        'username' => config('passport.username'),
		        'password' => config('passport.password'),
		        'scope' => $scope,
		    ],
		]);

		return json_decode((string) $tokenResponse->getBody(), true);
	}
}
