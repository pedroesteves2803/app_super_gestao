<?php

namespace App\Http\Controllers;

use App\MotivoContato;
use App\SiteContato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function contato()
    {
        $motivo_contatos = $motivo_contatos = MotivoContato::all();

        return view('site.contato', ['motivo_contatos' => $motivo_contatos]);
    }

    public function salvar(Request $request)
    {
        // validação de dados
        $regras = [
            'nome'               => 'required|min:3|max:40|unique:site_contatos',
            'telefone'           => 'required',
            'email'              => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem'           => 'required|max:2000',
        ];

        $feedback = [
            'nome.min'    => 'O campo nome precisa ter no minimo 3 caracteres',
            'nome.max'    => 'O campo nome precisa ter no maximo 40 caracteres',
            'nome.unique' => 'O nome informado já esta em uso',

            'email.email' => 'O E-mail informado não é valido',

            'mensagem.max' => 'A mensagem precisa ter no maximo 2000 caracteres',

            'required' => 'O campo :attribute precisa ser preenchido',
        ];

        $request->validate($regras, $feedback);

        SiteContato::create($request->all());

        return redirect()->route('site.index');
    }
}
