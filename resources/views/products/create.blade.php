@extends('layouts.main') 
@section('title', 'Cadastrar produto') 
<!-- Define o layout principal e o título da página como "Cadastrar produto" -->

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Cadastre seu produto</h1>
    
    <!-- Formulário para cadastrar um novo produto -->
    <form action="/products" method="POST" enctype="multipart/form-data">
        @csrf <!-- Token de segurança para proteger contra ataques CSRF -->

        <!-- Campo para envio da imagem do produto -->
        <div class="form-group">
            <label for="image">Imagem do produto:</label>
            <input type="file" id="image" name="image" class="btn btn-primary">
        </div>

        <!-- Campo para informar o nome do produto -->
        <div class="form-group">
            <label for="title">Produto:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do Produto">
        </div>

        <!-- Campo para informar o preço do produto -->
        <div class="form-group">
            <label for="price">Preço :</label>
            <input type="price" class="form-control" id="price" name="price">
        </div>

        <!-- Campo para informar a cidade onde o produto está disponível -->
        <div class="form-group">
            <label for="title">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Local">
        </div>

        <!-- Opção para indicar se o produto está funcionando -->
        <div class="form-group">
            <label for="title">O item está funcionando?</label>
            <select name="private" id="private" class="form-control">
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>

        <!-- Campo para descrição detalhada do produto -->
        <div class="form-group">
            <label for="title">Descrição:</label>
            <textarea name="description" id="description" class="form-control" placeholder="Descrição do item"></textarea>
        </div>

        <!-- Lista de categorias para o produto -->
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

        <!-- Botão para enviar o formulário -->
        <input type="submit" class="btn btn-primary" value="Cadastrar Produto">
    </form>
</div>

@endsection
