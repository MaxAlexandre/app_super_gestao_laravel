<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $erro = '';

        if($request->get('erro') == 1 ){
            $erro = 'Usuário e/ou senha não existem!';
        }
        return view('site.login', ['titulo' => 'Login','erro' => $erro]);
    }

    public function autenticar(Request $request)
    {
        //regras de validação
        $regras = [
            'usuario' => 'email',
            'senha' => 'required'
        ];
        // mensagem de feedback de validação
        $feedback = [
            'usuario.email' => 'O campo usuário (e-mail) é obrigatório',
            'senha.required' => 'O campo senha é obrigatório'
        ];

        $request->validate($regras, $feedback);

        //recuperamos os parâmetros do formulário
        $email = $request->get('usuario');
        $password = $request->get('senha');

        echo " Usuário: $email | Senha: $password ";
        echo " <br/> ";

        //iniciar o Model User
        $user = new User();
        $usuario = $user->where('email', $email)
            ->where('password', $password)
            ->get()
            ->first();

        if (isset($usuario->name)){
            echo 'Usuário existe';
        } else {
            return redirect()->route('site.login',['erro'=> 1]);
        }

    }
}
