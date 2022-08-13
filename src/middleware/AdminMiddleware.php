<?php

namespace laililmahfud\starterkit\middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(!auth_user()){
            return to_route('admin.login', ['auth_message' => 'Silahkan login untuk melanjutkan']);
        }
        $path = getModulePath();
        if(str_contains($path,'/add') && !canAdd()){
            abort(403, 'FORBIDEN');
        }else if(str_contains($path,'/edit') && !canEdit()){
            abort(403, 'FORBIDEN');
        }
        return $next($request);
    }
}
