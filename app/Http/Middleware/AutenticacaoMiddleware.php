<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\View\Compilers\Concerns\CompilesEchos;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $metodo_autenticacao, $perfil)
    {
        //verifica se o usuário possui acesso a rota
        echo $metodo_autenticacao .' - '.$perfil.'<br>';
        if ($metodo_autenticacao == 'padrao') {
            echo 'Verificar usuário e senha no banco de dados'.$perfil.'<br>';
        }

        if ($metodo_autenticacao == 'ldap') {
            echo 'Verificar usuário e senha no AD'.$perfil.'<br>';
        }

        if ($perfil == 'visitante') {
            echo 'Exibir apenas alguns recursos';
        } else {
            echo 'Carregar o perfil do banco de dados';
        }

        if (true) {
            return $next($request);
        } else {
            return Response('Acesso Negado! Rota exige autenticação!!!');
        }
    }
}