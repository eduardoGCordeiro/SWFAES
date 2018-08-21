<?php

namespace App\Http\Middleware;

use Closure;

class VerifyAccess
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
        $user = Funcionario::where($field,$key)->first();
        if(!$user->acesso_sistema){
            reurn redirect()->back();
        }

        return $next($request);
    }
}
