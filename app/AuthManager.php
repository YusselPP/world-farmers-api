<?php

namespace App;

use App;
use Auth;
use DB;
use Request;
use Route;
use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;
use Laravel\Passport\Passport;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Symfony\Bridge\PsrHttpMessage\Factory\DiactorosFactory;
use Defuse\Crypto\Crypto;
use League\OAuth2\Server\CryptKey;
use Firebase\JWT\JWT;
use Lcobucci\JWT\Parser as JwtParser;

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

	static function getToken($request) {

		self::pruneInvalidTokens();

		$scope = '';
		$scopes = json_decode(Auth::user()->scopes);

		if (is_array($scopes)) {
			$scope = implode(' ', $scopes);
		}
          
    	return self::requestToken($request, [
		        'grant_type' => 'password',
		        'username' => $request->input('email'),
		        'password' => $request->input('password'),
		        'scope' => $scope,
		    ]);
	}

	static function refreshToken($request) {
		$encoded_access_token = $request->input('access_token');

		$access_token = (new JwtParser)->parse($encoded_access_token);

		$access_token_id = $access_token->getClaim('jti');

		$refreshToken = DB::table('oauth_refresh_tokens')
							->where('access_token_id', $access_token_id)
							->where('revoked', 0)
							->first();

		if (is_null($refreshToken)) {
            throw new AuthenticationException('Invalid refresh token');
        }

        $expires_at = Carbon::parse($refreshToken->expires_at);

        if ($expires_at->lt(Carbon::now())) {
        	throw new AuthenticationException('refresh_token_expired');
        }

        $user = User::find($access_token->getClaim('sub'));

		return $token = $user->createToken(NULL, $access_token->getClaim('scopes'))->accessToken;;
	}

	static function requestToken($request, $params) {

		$params = array_merge([
		        'client_id' => config('passport.client_id'),
		        'client_secret' => config('passport.client_secret'),
		    ], $params);	

		$request->request->add($params);		

		$tokenResponse = App::make('Laravel\Passport\Http\Controllers\AccessTokenController')
							->issueToken((new DiactorosFactory)->createRequest($request));

		$token = json_decode((string) $tokenResponse->content(), true);

		return $token;
		return array_only($token, ['access_token', 'expires_in']);
	}

	static function logout() {
		$token = Auth::user()->token();

		DB::table('oauth_refresh_tokens')
			->where('access_token_id', $token->id)
			->delete();

        $token->delete();
	}

	static function pruneInvalidTokens() {

		DB::table('oauth_access_tokens')
			->where('expires_at', '<', Carbon::now())
			->delete();

		DB::table('oauth_refresh_tokens')
			->where('expires_at', '<', Carbon::now())
			->delete();
	}
}
