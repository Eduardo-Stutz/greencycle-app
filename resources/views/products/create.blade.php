@extends('layouts.main')
@section('title', 'Cadastrar produto')
@section ('content')


<div id="event-create-container" class="col-md-6 offset-md-3">

    <h1>Cadastre seu produto</h1>
    <form action="/products" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">Imagem do produto:</label>
            <input type="file" id="image" name="image" class="btn btn-primary" >
        </div>
        <div class="form-group">
            <label for="title">Produto:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do Produto">
        </div>
        <div class="form-group">
            <label for="price">Preço :</label>
            <input type="price" class="form-control" id="price" name="price">
        </div>
        <div class="form-group">
            <label for="title">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Local">
        </div>
        <div class="form-group">
            <label for="title">O item está funcionando?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">Descrição:</label>
            <textarea name="description" id="description" class="form-control"
                placeholder="Descrição do item"></textarea>
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
        <input type="submit" class="btn btn-primary" value="Cadastrar Produto">
    </form>
</div>


@endsection