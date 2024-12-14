@extends('layouts.main')

@section('title', 'dashboard')

@section ('content')


<style>
   
   .btn {
    display: inline-flex;
    align-items: center;
    gap: 10px; /* Ajusta o espaçamento entre os ícones e os textos */
}

.table {
    width: 100%;
    table-layout: fixed; /* Impede que as colunas tenham tamanhos variáveis */
}
.table th, .table td {
    white-space: nowrap; /* Evita que os conteúdos sejam quebrados */
    text-align: center; /* Alinha os conteúdos */
}
</style>

<div style="margin-top:50px;" class="col-md-10 offset-md-1 dashboard-title-container">
    <h1 style="color: #386641;">Meus Produtos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if (count($products) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Favoritos</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td scope="row">{{ $loop->index + 1}}</td>
                        <td><a href="/products/{{ $product->id}}">{{$product->title}}</a></td>
                        <td>{{count($product->users)}}</td>
                        <td class="d-flex justify-content-between">
                            <a style="margin-left: 50px;" href="/products/edit/{{$product->id}}" class="btn btn-info edit-btn">
                                <ion-icon name="create-outline"></ion-icon> Editar
                            </a>
                            <form style="margin-right: 200px;"action="/products/{{ $product->id }}" method="POST">
                                @csrf
                                @method('DELETE')
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
        <h1 style="font-size: 20px;">Você não cadastrou nenhum produto <a href="/products/create">Cadastrar produto</a></h1>
    @endif
</div>

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1 style="color: #386641;">Meus produtos favoritos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-title-container">
    @if (count($productsAsParticipant) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Favoritos</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productsAsParticipant as $product)
                    <tr>
                        <td scope="row">{{ $loop->index + 1}}</td>
                        <td><a href="/products/{{ $product->id}}">{{$product->title}}</a></td>
                        <td>{{count($product->users)}}</td>
                        <td class="d-flex justify-content-between">
                            <form style="margin-left: 200px;" action="products/leave/{{$product->id}}" method="POST">
                                @csrf
                                @method('DELETE')
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
        <p style="margin-bottom:150px;">Você não tem nenhum produto. <a href="/">Ver todos os produtos</a></p>
    @endif
</div>

@endsection