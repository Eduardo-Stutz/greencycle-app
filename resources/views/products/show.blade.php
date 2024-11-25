@extends('layouts.main')

@section('title', $product->title)

@section ('content')

<div class="col-md-10 offset-md-1">
    <div class="row">
        <div id="image-container" class="col-md-6">
            <img src="/img/products/{{$product->image}}" class="image-fluid" alt="{{$product->title}}">
        </div>
        <div id="info-container" class="col-md-6">
            <h1>{{$product->title}}</h1>
            <p class="product-city"><ion-icon name="location-outline"></ion-icon>{{$product->city}}</p>
            <p class="product-participants"><ion-icon name="people-outline"></ion-icon> {{ count($product->users)}}
                Favorito(s) </p>
            <p class="product-owner"><ion-icon name="star-outline"></ion-icon>{{ $productOwner['name'] }}</p>
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
            <h3>Categorias do produto: </h3>
            <ul id="items-list">
                @foreach($product->items as $item)
                    <li><ion-icon name="play-outline"></ion-icon><span>{{$item}}</span></li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-12" id="description-container">
            <h3>Sobre o produto:</h3>
            <p class="event-description">{{ $product->description }}</p>
        </div>
    </div>
</div>

@endsection