<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cookie;
use App\Models\UsuarioToken;
use App\Models\Usuario;

class LogadoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
   {
        if(Cookie::has('token') && Cookie::has('usuario_id')) {
        return $next($request);
    } else {
        return redirect()->route('login');
    }
    
}
}