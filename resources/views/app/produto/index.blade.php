@extends('app.layouts.basico')

@section('titulo' ,'Produto')

@section('conteudo')

    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Listar Produtos</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{route('produto.create')}}">Novo</a></li>
                <li><a href="">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width:90%; margin-left: auto; margin-right: auto;">

                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Fornecedor</th>
                            <th>Peso</th>
                            <th>Unidade ID</th>
                            <th>Comprimento</th>
                            <th>Altura</th>
                            <th>Largura</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>{{ $produto->fornecedor->nome }}</td>
                                <td>{{ $produto->peso }}</td>
                                <td>{{ $produto->unidade_id }}</td>
                                <td>{{ $produto->itemDetalhe->comprimento ?? '' }}</td>
                                <td>{{ $produto->itemDetalhe->altura ?? ''  }}</td>
                                <td>{{ $produto->itemDetalhe->largura ?? ''  }}</td>
                                <th><a href="{{ route('produto.show', ['produto' => $produto->id]) }}">Visualizar</a></th>
                                <th>
                                    <form id="form_{{$produto->id}}" action="{{ route('produto.destroy', ['produto' => $produto->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="#" onclick="document.getElementById('form_{{$produto->id}}').submit()"> Excluir</a>
                                    </form>
                                </th>
                                <th><a href="{{ route('produto.edit', ['produto' => $produto->id]) }}">Editar</a></th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{$produtos->appends($request)->links()}}

                <br>
                Exibindo {{$produtos->count()}} produtos de {{$produtos->total()}} (de  {{$produtos->firstItem()}} a {{$produtos->lastItem()}})

            </div>
        </div>

    </div>

@endsection
