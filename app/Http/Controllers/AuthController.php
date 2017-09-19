<?php

namespace App\Http\Controllers;

use App\AuthManager;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function login(Request $request) {

    	AuthManager::validateCredentials($request);

    	return AuthManager::getTokenJson($request);
    }

    function refresh(Request $request) {

    	AuthManager::validateCredentials($request);

    	return AuthManager::getTokenJson($request);
    }

    function logout(Request $request) {

    	AuthManager::validateCredentials($request);

    	return AuthManager::getTokenJson($request);
    }
}
