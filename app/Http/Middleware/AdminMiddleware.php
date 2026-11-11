<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Usertoken;
use App\Models\Admin;
use Carbon\Carbon;
use App\Models\usuariotoken;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
     {
            if($request->has('token') && $request->has('usuario_id')){
            $token = Usuariotoken::Where('usuario_id', $request->usuario_id)
            ->where('token', $request->token)
            ->where('valido_ate', '>', Carbon::now())
            ->first();
                if($token){

                    $admin = Admin::where('usuario_id','=', $request->usuario_id)->first();
                    if($admin){
                    return $next($request);
                    }
                }
                return response()->json(['message' => 'Token invalido ou expirado', 'erro' => 's'],200 );

        }else{
            return response()->json(['message' => 'Token não fornecido', 'erro' => 's'],200);
         }

           
        }
}
