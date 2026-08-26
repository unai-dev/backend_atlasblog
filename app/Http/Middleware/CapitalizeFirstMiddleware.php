<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CapitalizeFirstMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has("name")) {
            $name = $request->input("name");
            $name[0] = strtoupper($request->input("name")[0]);
            $request->merge([
                "name" => $name
            ]);
        }

        return $next($request);
    }
}
