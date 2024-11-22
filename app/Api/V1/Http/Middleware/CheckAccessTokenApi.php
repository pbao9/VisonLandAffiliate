<?php

namespace App\Api\V1\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAccessTokenApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->route() && $this->hasGuestMiddleware($request->route())) {
            return $next($request);
        }

        if ($request->header('X-TOKEN-ACCESS') == config('custom_api.X-TOKEN-ACCESS')) {
            return $next($request);
        }

        return response()->json([
            'status' => 403,
            'message' => __('Bạn không có quyền truy cập.')
        ], 403);
    }

    /**
     * Kiểm tra xem route có middleware api.guest hay không
     *
     * @param \Illuminate\Routing\Route $route
     * @return bool
     */
    protected function hasGuestMiddleware($route)
    {
        return in_array('api.guest', $route->middleware()) ||
            in_array('api.guest', $route->gatherMiddleware());
    }
}
