@extends('layouts.main')
@section('title', 'Editando: '. $product->title)
@section ('content')


<div id="event-create-container" class="col-md-6 offset-md-3">

    <h1>Editando: {{ $product->title }}</h1>
    <form action="/products/update/{{$product->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div id="image-container" class="form-group">
            <label for="image">Imagem do produto:</label>
            <input type="file" id="image" name="image" class="form-control-file">
            <img src="/img/products/{{$product->image}}" alt="{{$product->title}}" class="img-preview">
        </div>
        <div class="form-group">
            <label for="title">Evento:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do produto" value="{{$product->title}}">
        </div>
        <div class="form-group">
            <label for="date">Preço: </label>
            <input type="price" class="form-control" id="price" name="price" value="{{$product->price}}">
        </div>
        <div class="form-group">
            <label for="title">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Local do producto" value="{{$product->city}}">
        </div>
        <div class="form-group">
            <label for="title">O produto funciona?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">Descrição:</label>
            <textarea name="description" id="description" class="form-control"
                placeholder="Descreva o produto">{{$product->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="title">Adicione as categorias do produto:</label>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Dispositivo de comunicação"> Dispositivos de comunicação
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Equipamentos de informática"> Equipamentos de informática
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Eletrodomésticos portáteis"> Eletrodomésticos portáteis
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Equipamentos de áudio e vídeo"> Equipamentos de áudio e vídeo
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Componentes de iluminação"> Componentes de iluminação
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Confirmar edição">
    </form>
</div>


@endsection