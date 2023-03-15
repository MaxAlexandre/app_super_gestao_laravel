<?php

namespace App\Http\Controllers;

use App\MotivoContato;
use App\SiteContato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function contato(Request $request)
    {
//        $contato = new SiteContato();
//        $contato->nome = $request->input('nome');
//        $contato->telefone = $request->input('telefone');
//        $contato->email = $request->input('email');
//        $contato->motivo_contato = $request->input('motivo_contato');
//        $contato->mensagem = $request->input('mensagem');
//        $contato->save();

//        $contato = new SiteContato();
//        $contato->fill($request->all());
//        $contato->save();

        $motivo_contatos = MotivoContato::all();
        return view('site.contato', ['motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request)
    {
        //validando dados vindos do request
        $regras = [
            'nome' => 'required|min:3|max:40|unique:site_contatos', //nomes com no máximo 3 caracteres e no máximo 40
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000'
        ];
        $feedback = [
            'nome.min' => 'O Campo nome precisa ter no mínimo 3 caracteres.',
            'nome.max' => 'O Campo nome precisa ter no máximo 40 caracteres.',
            'nome.unique' => 'O nome informado já está em uso.',
            'email.email' => 'O email informado não é válido.',
            'mensagem.max' => 'A mensagem deve ter no máximo 2000 caracteres',
            'required' => 'Campo :attribute é obrigatório.'
        ];
        $request->validate($regras, $feedback);

        SiteContato::create($request->all());
        return redirect()->route('site.index');
    }
}
