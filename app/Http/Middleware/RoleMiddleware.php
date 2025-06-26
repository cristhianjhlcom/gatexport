<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, $role, $permission = null): Response
    {
        if (! $request->user()->hasRole($role)) {
            abort(404);
        }

        if ($permission !== null && ! $request->user()->can($permission)) {
            abort(404);
        }

        return $next($request);
    }
}
