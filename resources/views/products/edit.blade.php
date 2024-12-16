@extends('layouts.main') 
@section('title', 'Editando: '. $product->title) 
<!-- Define o layout principal e o título da página como "Editando: [nome do produto]" -->

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Editando: {{ $product->title }}</h1>
    
    <!-- Formulário para editar o produto -->
    <form action="/products/update/{{$product->id}}" method="POST" enctype="multipart/form-data">
        @csrf <!-- Token de segurança contra ataques CSRF -->
        @method('PUT') <!-- Define o método HTTP como PUT para atualizar os dados -->

        <!-- Campo para alterar a imagem do produto -->
        <div id="image-container" class="form-group">
            <label for="image">Imagem do produto:</label>
            <input type="file" id="image" name="image" class="btn btn-primary">
            <!-- Exibe a imagem atual do produto -->
            <img src="/img/products/{{$product->image}}" alt="{{$product->title}}" class="img-preview">
        </div>

        <!-- Campo para editar o nome do produto -->
        <div class="form-group">
            <label for="title">Produto:</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Nome do produto" value="{{$product->title}}">
        </div>

        <!-- Campo para editar o preço do produto -->
        <div class="form-group">
            <label for="date">Preço: </label>
            <input type="price" class="form-control" id="price" name="price" value="{{$product->price}}">
        </div>

        <!-- Campo para editar a cidade -->
        <div class="form-group">
            <label for="title">Cidade:</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Local do produto" value="{{$product->city}}">
        </div>

        <!-- Opção para editar o status de funcionamento do produto -->
        <div class="form-group">
            <label for="title">O produto funciona?</label>
            <select name="private" id="private" class="form-control">
                <option value="0" {{ $product->private == 0 ? 'selected' : '' }}>Não</option>
                <option value="1" {{ $product->private == 1 ? 'selected' : '' }}>Sim</option>
            </select>
        </div>

        <!-- Campo para editar a descrição do produto -->
        <div class="form-group">
            <label for="title">Descrição:</label>
            <textarea name="description" id="description" class="form-control" placeholder="Descreva o produto">{{$product->description}}</textarea>
        </div>

        <!-- Lista de categorias com os checkboxes -->
        <div class="form-group">
            <label for="title">Adicione as categorias do produto:</label>
            <!-- Para exibir os checkboxes já marcados, você pode verificar se o item está presente em $product->items -->
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Dispositivo de comunicação" 
                {{ in_array('Dispositivo de comunicação', $product->items) ? 'checked' : '' }}> Dispositivos de comunicação
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Equipamentos de informática" 
                {{ in_array('Equipamentos de informática', $product->items) ? 'checked' : '' }}> Equipamentos de informática
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Eletrodomésticos portáteis" 
                {{ in_array('Eletrodomésticos portáteis', $product->items) ? 'checked' : '' }}> Eletrodomésticos portáteis
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Equipamentos de áudio e vídeo" 
                {{ in_array('Equipamentos de áudio e vídeo', $product->items) ? 'checked' : '' }}> Equipamentos de áudio e vídeo
            </div>
            <div class="form-group">
                <input type="checkbox" name="items[]" value="Componentes de iluminação" 
                {{ in_array('Componentes de iluminação', $product->items) ? 'checked' : '' }}> Componentes de iluminação
            </div>
        </div>

        <!-- Botão para confirmar a edição -->
        <input type="submit" class="btn btn-primary" value="Confirmar edição">
    </form>
</div>

@endsection