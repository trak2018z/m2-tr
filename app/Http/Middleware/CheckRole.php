<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Get the required roles from the route
        $roles = $this->getRequiredRoleForRoute($request->route());
        // Check if a role is required for the route, and
        // if so, ensure that the user has that role.
        if(!$roles || $request->user()->hasRole($roles))
        {
            return $next($request);
        }
        return abort(403,'Unauthorized');
    }

    private function getRequiredRoleForRoute(Route $route)
    {
        $actions = $route->getAction();
        return isset($actions['roles']) ? $actions['roles'] : null;
    }
}
