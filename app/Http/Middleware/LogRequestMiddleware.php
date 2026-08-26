<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $requestData = [
            "ip" => $request->ip(),
            "url" => $request->fullUrl(),
            "method" => $request->method(),
            "headers" => $request->headers->all(),
            "body" => $request->getContent()
        ];

        Log::info("Request Received: ", $requestData);

        return $next($request);
    }
}
