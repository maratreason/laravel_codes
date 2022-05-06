@extends('layouts.main')

@section('title', 'Товар')

@section('content')
    <h1>{{ $product->name }}</h1>
    <p>Цена: <b>{{ $product->price }} руб.</b></p>
    <img src="/img/product/{{ $product->image }}">
    <p>{{ $product->description }}</p>
    <a class="btn btn-success" href="http://laravel-diplom-1.rdavydov.ru/basket/1/add">Добавить в корзину</a>
@endsection
