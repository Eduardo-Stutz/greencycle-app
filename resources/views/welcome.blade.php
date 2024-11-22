@extends('layouts.main')

@section('title', 'GreenCycle e-Waste')

@section ('content')

<div id="search-container" class="col-md-12">
    <h1>Busque um produto</h1>
    <form action="/" method="GET">
        <input type="text" id="search" name="search" class="form-control" placeholder="Procurar...">
    </form>
</div>
<div id="events-container" class="col-md-12">
    @if ($search)
    <h2>Buscando por:{{ $search }}</h2>
    @else
    <h2>Produtos disponíveis</h2>
    <p class="subtitle">Veja os produtos adicionados recentemente </p>
    @endif
    <div id="cards-container" class="row">
        @foreach ($products as $product)
            <div class="card col-md-3">
                <img src="/img/events/{{$product->image}}" alt="{$event->title}}">
                <div class="card-body">
                    <p class="card-date">{{date('d/m/y',strtotime($product->date))}}</p>
                    <h5 class="card-title">{{$product->title}}</h5>
                    <p class="card-participants">{{ count($product->users)}} Participantes</p>
                    <a href="/events/{{$product->id}}" class="btn btn-primary">Saber mais</a>
                </div>
            </div>
        @endforeach
        @if (count($products)==0 && $search)
        <p>Não foi possível encontrar nenhum produto com {{$search}}! <a href="/">Ver todos</a> </p>
        @elseif (count($products)==0)
        <p>Não há produtos disponíveis. </p>
        @endif
    </div>
</div>
@endsection