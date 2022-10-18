<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use App\Item;
use App\Produto;
use App\Unidade;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $produtos = Item::with(['itemDetalhe', 'fornecedor'])->paginate('10');

        return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();

        return view('app.produto.create', ['unidades' => $unidades, 'fornecedores' => $fornecedores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $regras = [
            'nome'       => 'required|min:3|max:40',
            'descricao'  => 'required|min:3|max:2000',
            'peso'       => 'required|integer',
            'unidade_id' => 'exists:unidades,id',
            'fornecedor_id' => 'exists:fornecedores,id',
        ];

        $feedback = [
            'required'          => 'O campo :attribute deve ser preechido',
            'nome.min'          => 'O campo nome deve no mínimo 3 caracteres',
            'nome.max'          => 'O campo nome deve no máximo 40 caracteres',
            'descricao.min'     => 'O campo descricao deve no mínimo 3 caracteres',
            'descricao.max'     => 'O campo descricao deve no máximo 2000 caracteres',
            'peso.integer'      => 'O campo peso deve ser um numero inteiro',
            'unidade_id.exists' => 'A unidade de medida informada não existe',
            'fornecedor_id.exists' => 'O fornecedor informada não existe',
        ];

        $request->validate($regras, $feedback);

        Item::create($request->all());

        return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        return view('app.produto.show', ['produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();

        return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidades, 'fornecedores' => $fornecedores]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $produto)
    {

        $regras = [
            'nome'       => 'required|min:3|max:40',
            'descricao'  => 'required|min:3|max:2000',
            'peso'       => 'required|integer',
            'unidade_id' => 'exists:unidades,id',
            'fornecedor_id' => 'exists:fornecedores,id',
        ];

        $feedback = [
            'required'          => 'O campo :attribute deve ser preechido',
            'nome.min'          => 'O campo nome deve no mínimo 3 caracteres',
            'nome.max'          => 'O campo nome deve no máximo 40 caracteres',
            'descricao.min'     => 'O campo descricao deve no mínimo 3 caracteres',
            'descricao.max'     => 'O campo descricao deve no máximo 2000 caracteres',
            'peso.integer'      => 'O campo peso deve ser um numero inteiro',
            'unidade_id.exists' => 'A unidade de medida informada não existe',
            'fornecedor_id.exists' => 'O fornecedor informada não existe',
        ];

        $request->validate($regras, $feedback);

        $produto->update($request->all());

        return redirect()->route('produto.show', ['produto' => $produto->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route('produto.index');
    }
}
