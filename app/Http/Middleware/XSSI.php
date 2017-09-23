<?php

namespace App\Http\Middleware;

use Closure;

class XSSI
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response->setContent(")]}',\n" . $response->getContent());

        return $response;
    }
}
