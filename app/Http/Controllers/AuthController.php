<?php

namespace App\Http\Controllers;

use App\AuthManager;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function login(Request $request) {

    	AuthManager::validateCredentials($request);

        // Prune expired tokens or do it in Events

    	return AuthManager::getTokenJson($request);
    }

    function refresh(Request $request) {

    	// Validate refresh token
        // request new token
    	
    }

    function logout(Request $request) {

    	// prune this token
    	
    }
}
