@extends('app.layouts.basico')

@section('titulo' ,'Fornecedor')

@section('conteudo')

    <div class="conteudo-pagina">

        <div class="titulo-pagina-2">
            <p>Listar Fornecedor</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href="{{route('app.fornecedor.adicionar')}}">Novo</a></li>
                <li><a href="{{ route('app.fornecedor') }}">Consulta</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width:90%; margin-left: auto; margin-right: auto;">

                <table border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Site</th>
                            <th>UF</th>
                            <th>Email</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($fornecedores as $fornecedor)
                            <tr>
                                <td>{{ $fornecedor->nome }}</td>
                                <td>{{ $fornecedor->site }}</td>
                                <td>{{ $fornecedor->uf }}</td>
                                <td>{{ $fornecedor->email }}</td>
                                <th><a href="{{route('app.fornecedor.excluir', $fornecedor->id)}}">Excluir</a></th>
                                <th><a href="{{route('app.fornecedor.editar', $fornecedor->id)}}">Editar</a></th>
                            </tr>

                            <tr>
                                <td colspan="6">
                                    <p>Lista de produto</p>
                                    <table border="1" style="margin:20px">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $fornecedor->produtos as $key => $produto)
                                                <tr>
                                                    <th>{{$produto->id}}</th>
                                                    <th>{{$produto->nome}}</th>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{$fornecedores->appends($request)->links()}}
                {{--
                <br>
                {{$fornecedores->count()}} - Total de registros por página
                <br>
                {{$fornecedores->total()}} - Total de registros da consulta
                <br>
                {{$fornecedores->firstItem()}} - Numero do primeiro registros da página
                <br>
                {{$fornecedores->lastItem()}} - Numero do ultimo registros da página --}}


                <br>
                Exibindo {{$fornecedores->count()}} fornecedores de {{$fornecedores->total()}} (de  {{$fornecedores->firstItem()}} a {{$fornecedores->lastItem()}})

            </div>
        </div>

    </div>

@endsection
