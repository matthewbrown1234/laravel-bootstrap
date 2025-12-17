<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddContentLengthHeader
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only add Content-Length for JSON responses
        if ($response->headers->get('Content-Type') === 'application/json') {
            $content = $response->getContent();
            if ($content !== false) {
                $response->headers->set('Content-Length', strlen($content));
            }
        }

        return $response;
    }
}
