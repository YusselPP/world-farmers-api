<?php

namespace App\Http\Controllers;

use Auth;
use App\AuthManager;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function login(Request $request) {

    	AuthManager::validateCredentials($request);

    	return AuthManager::getToken($request);
    }

    function logout(Request $request) {

        AuthManager::logout();
    }
}
