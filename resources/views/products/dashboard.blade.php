@extends('layouts.main')

@section('title', 'dashboard')

@section ('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Produtos</h1>
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
                        <td><a href="/products/edit/{{$product->id}}" class="btn btn-info edit-btn"> <ion-icon name="create-outline"></ion-icon> Editar</a> 
                        <form action="/products/{{ $product->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger delete-btn"> <ion-icon name="trash-outline"></ion-icon> Deletar</button>
                        </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <h1>Você não cadastrou nenhum produto<a href="/products/create">Cadastrar produto</a></h1>

    @endif

    

</div>
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus produtos favoritos</h1>
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
                        <td>
                        <form action="products/leave/{{$product->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                            class="btn btn-danger delete-btn">
                            <ion-icon name="trash-outline"></ion-icon>
                        </button>
                        </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
    <p>Você não tem nenhum produto. <a href="/">Ver todos os produtos</a></p>
    @endif
</div>



@endsection