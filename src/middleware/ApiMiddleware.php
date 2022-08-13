<?php

namespace laililmahfud\starterkit\middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Route;
use laililmahfud\starterkit\helpers\JwtToken;
use laililmahfud\starterkit\Constanta\ErrorType;
use laililmahfud\starterkit\helpers\JsonResponse;

class ApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $token = $request->header('authorization');
        $regid = $request->header('regid');
        if (!$token) {
            return JsonResponse::Unauthorized('token not found', ErrorType::$UNAUTHORIZED);
        }
        if (!$regid) {
            return JsonResponse::Unauthorized('regid not found', ErrorType::$UNAUTHORIZED);
        }
        try {
            $decodedToken = JwtToken::decode($token);
            $routeName = Route::currentRouteName();
            if ($role !== 'all' && $role !== 'guest') {
                $user = $decodedToken->data;
                $userRole = @$user->role;
                if ($userRole != $role && !in_array($routeName, ['api.driver.login', 'api.customer.login', 'api.customer.register','api.customer.forgot-password'])) {
                    return JsonResponse::Forbidden("You don't have access to this url");
                }
            } else if ($role == 'all') {
                $user = $decodedToken->data;
                if (!$user) {
                    return JsonResponse::Forbidden("You don't have access to this url");
                }
            }

            return $next($request);

        } catch (\Exception $e) {
            if ($e instanceof ExpiredException) {
                return JsonResponse::Unauthorized('token expired', ErrorType::$EXPIRED_TOKEN);
            }
            return JsonResponse::Unauthorized('invalid token', ErrorType::$INVALID_TOKEN);
        }
    }
}
