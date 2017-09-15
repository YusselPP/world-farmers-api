<?php

return [

	'grant_type' 	=> 'password',

    'client_id' 	=> env('PASSPORT_CLIENT_ID'),

    'client_secret' => env('PASSPORT_CLIENT_SECRET'),

    'username' 		=> env('PASSPORT_USERNAME'),

    'password' 		=> env('PASSPORT_PASSWORD'),

    'scope' 		=> '',

];
