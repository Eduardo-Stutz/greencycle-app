@extends('layouts.main')
@section('title', 'dashboard')
@section('content')


<style>
    /* Estilos personalizados para a página de dashboard */
   
    .btn {
        display: inline-flex; 
        align-items: center; 
        gap: 10px;
    }

    .table {
        width: 100%; 
        table-layout: fixed; 
    }

    .table th, .table td {
        white-space: nowrap; 
        text-align: center; 
    }
</style>

<div style="margin-top:50px;" class="col-md-10 offset-md-1 dashboard-title-container">
    {{-- Define um título para a seção de produtos cadastrados --}}
    <h1 style="color: #386641;">Meus Produtos</h1>
</div>

<div class="col-md-10 offset-md-1 dashboard-events-container">
    {{-- Verifica se o usuário tem produtos cadastrados --}}
    @if (count($products) > 0)
        <table class="table">
            <thead>
                <tr>
                    {{-- Cabeçalho da tabela --}}
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Favoritos</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop para exibir todos os produtos cadastrados --}}
                @foreach ($products as $product)
                    <tr>
                        <td scope="row">{{ $loop->index + 1}}</td> 
                        {{-- Exibe o número da linha, começando de 1 --}}
                        <td><a href="/products/{{ $product->id}}">{{$product->title}}</a></td> 
                        {{-- Exibe o nome do produto e cria um link para a página de detalhes do produto --}}
                        <td>{{count($product->users)}}</td>
                        {{-- Exibe o número de usuários que favoritaram o produto --}}
                        <td class="d-flex justify-content-between">
                            {{-- Link para editar o produto --}}
                            <a style="margin-left: 50px;" href="/products/edit/{{$product->id}}" class="btn btn-info edit-btn">
                                <ion-icon name="create-outline"></ion-icon> Editar
                            </a>
                            {{-- Formulário para deletar o produto --}}
                            <form style="margin-right: 200px;" action="/products/{{ $product->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                {{-- Botão para excluir o produto, com confirmação no servidor --}}
                                <button type="submit" class="btn btn-danger delete-btn">
                                    <ion-icon name="trash-outline"></ion-icon> Deletar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        {{-- Caso não haja produtos cadastrados, exibe mensagem com link para cadastrar um novo produto --}}
        <h1 style="font-size: 20px;">Você não cadastrou nenhum produto <a href="/products/create">Cadastrar produto</a></h1>
    @endif
</div>

{{-- Título para a seção de produtos favoritos --}}
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1 style="color: #386641;">Meus produtos favoritos</h1>
</div>

<div class="col-md-10 offset-md-1 dashboard-title-container">
    {{-- Verifica se o usuário tem produtos favoritos --}}
    @if (count($productsAsParticipant) > 0)
        <table class="table">
            <thead>
                <tr>
                    {{-- Cabeçalho da tabela para os produtos favoritos --}}
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Favoritos</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                {{-- Loop para exibir todos os produtos favoritos --}}
                @foreach ($productsAsParticipant as $product)
                    <tr>
                        <td scope="row">{{ $loop->index + 1}}</td>
                        {{-- Exibe o número da linha, começando de 1 --}}
                        <td><a href="/products/{{ $product->id}}">{{$product->title}}</a></td> 
                        {{-- Exibe o nome do produto e cria um link para a página de detalhes --}}
                        <td>{{count($product->users)}}</td>
                        {{-- Exibe o número de usuários que favoritaram o produto --}}
                        <td class="d-flex justify-content-between">
                            {{-- Formulário para o usuário deixar de ser participante do produto --}}
                            <form style="margin-left: 200px;" action="products/leave/{{$product->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                {{-- Botão para deixar de ser participante, removendo o produto dos favoritos --}}
                                <button type="submit" class="btn btn-danger delete-btn">
                                    <ion-icon name="trash-outline"></ion-icon> Deletar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        {{-- Caso não haja produtos favoritos, exibe mensagem com link para visualizar todos os produtos --}}
        <p style="margin-bottom:150px;">Você não tem nenhum produto. <a href="/">Ver todos os produtos</a></p>
    @endif
</div>

@endsection
{{-- Fim da seção de conteúdo --}}