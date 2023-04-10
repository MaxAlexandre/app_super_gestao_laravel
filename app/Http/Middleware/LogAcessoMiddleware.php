<?php

namespace App\Http\Middleware;

use App\LogAcesso;
use Closure;

class LogAcessoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ip = $request->server->get('REMOTE_ADDR');
        $rota = $request->getRequestUri();
        LogAcesso::create(['log' => "Ip $ip xyz requisitou a rota $rota"]);
        //return $next($request);
        $resposta = $next($request);
        $resposta->setStatusCode(201, 'O status da resposta e o texto foram modificados!!!');
        return $resposta;
    }
}