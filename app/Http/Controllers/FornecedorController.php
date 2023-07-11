<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index()
    {
        return view('app.fornecedor.index');
    }

    public function listar(Request $resquest)
    {

        $fornecedores = Fornecedor::where('nome', 'like', '%' . $resquest->input('nome') . '%')
            ->where('site', 'like', '%' . $resquest->input('site') . '%')
            ->where('uf', 'like', '%' . $resquest->input('uf') . '%')
            ->where('email', 'like', '%' . $resquest->input('email') . '%')
            ->paginate(2);
        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $resquest->all()]);
    }

    public function adicionar(Request $request)
    {
        $msg = '';
        //inclusão
        if ($request->input('_token') != '' && $request->input('id') == '') {
            //validação
            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email',
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido',
                'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
                'uf.min' => 'O campo nome deve ter no mínimo 2 caracteres',
                'uf.max' => 'O campo nome deve ter no máximo 2 caracteres',
                'email.email' => 'O campo email não foi preenchido corretamente',

            ];

            $request->validate($regras, $feedback);
            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());

            $msg = 'Cadastro realizado com sucesso!';
        }

        //edição
        if ($request->input('_token') != '' && $request->input('id') != '') {
            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            if ($update) {
                $msg = 'Atualização realizada com sucesso';
            } else {
                echo 'Erro ao tentar realizar o registro';
            }
            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);
        }
        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = '')
    {
        $fornecedor = Fornecedor::find($id);
        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }

    public function excluir($id)
    {
        Fornecedor::find($id)->delete();
        //Fornecedor::find($id)->forceDelete();

        return redirect()->route('app.fornecedor');
    }
}
