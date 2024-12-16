@extends('layouts.main') 

@section('title', $product->title) 
<!-- Define o título da página como o título do produto -->

@section('content') 

<div class="col-md-10 offset-md-1">
    <div class="row">
        <!-- Container da imagem do produto -->
        <div id="image-container" class="col-md-6">
            <img src="/img/products/{{$product->image}}" class="image-fluid" alt="{{$product->title}}">
        </div>

        <!-- Informações detalhadas do produto -->
        <div id="info-container" class="col-md-6">
            <h1>{{$product->title}}</h1>
            
            <!-- Link para contato via WhatsApp -->
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $product->user->phone) }}" 
               class="product-phone" target="_blank">
                <ion-icon name="call-outline"></ion-icon>
                @if($product->user && $product->user->phone)
                    {{ formatPhoneNumber($product->user->phone) }}
                @else
                    Número não disponível
                @endif
            </a>

            @php
                // Função para formatar o número de telefone no formato padrão brasileiro
                function formatPhoneNumber($phone)
                {
                    $phone = preg_replace('/[^0-9]/', '', $phone);
                    if (strlen($phone) == 11) {
                        return '(' . substr($phone, 0, 2) . ') ' . substr($phone, 2, 1) . substr($phone, 3, 4) . '-' . substr($phone, 7, 4);
                    }
                    return $phone;
                }
            @endphp

            <!-- Informações adicionais do produto -->
            <p class="product-city">
                <ion-icon name="location-outline"></ion-icon>{{$product->city}}
            </p>
            <p class="product-price">
                <ion-icon name="cash-outline"></ion-icon>R$ {{ number_format($product->price, 2, ',', '.') }}
            </p>
            <p class="product-participants">
                <ion-icon name="people-outline"></ion-icon> {{ count($product->users)}} Favorito(s)
            </p>
            <p class="product-owner">
                <ion-icon name="person-circle-outline"></ion-icon>{{ $productOwner['name'] }}
            </p>

            <!-- Botão para favoritar ou mensagem de já favoritado -->
            @if (!$hasUserJoined)
                <form action="/products/join/{{$product->id}}" method="POST">
                    @csrf
                    <a href="javascript:void(0);" class="btn btn-primary" id="event-submit"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Favorito
                    </a>
                </form>
            @else
                <p class="already-joined-msg">Você já favoritou este produto.</p>
            @endif

            <!-- Lista de categorias do produto -->
            <h3>Categorias do produto: </h3>
            <ul id="items-list">
                @foreach($product->items as $item)
                    <li><ion-icon name="play-outline"></ion-icon><span>{{$item}}</span></li>
                @endforeach
            </ul>
        </div>

        <!-- Descrição do produto -->
        <div class="col-md-12" id="description-container">
            <h3>Sobre o produto:</h3>
            <p class="event-description">{{ $product->description }}</p>
        </div>
    </div>
</div>

@endsection