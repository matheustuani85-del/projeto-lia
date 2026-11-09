<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\usuariotoken;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use carbon\Carbon;


class LoginApiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->has ('token')&& $request->has('usuario_id')){ 
            $token = usuariotoken::where('usuario_id', $request->usuario_id)
            ->where('token', $request->token)
            ->where('valido_ate', '>', Carbon::now())
            ->first(); 
             if ($token ) {
                  
             return $next($request);

        
            }

            if ($token) {
                return $next($request);
            }
            return response()->json(['message' => 'Token inválido', 'erro' => 's'],200);


        }else{ 
             return response()->json(['message' => 'Token não fornecido',
              'erro' => 's'],200);
        
        }
       
        
        
    }
}

