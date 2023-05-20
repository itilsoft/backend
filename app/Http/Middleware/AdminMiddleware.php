<?php

namespace App\Http\Middleware;

use App\Http\Resources\Resource;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && !$user->is_admin) {
            return \response(
                (new Resource(false, ['Admin iznin yok.']))->response()
            );
        }
        return $next($request);
    }
}
