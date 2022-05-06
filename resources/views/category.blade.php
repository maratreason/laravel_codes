@extends('layouts.main')

@section('title', 'Категория ' . $category->name)

@section('content')
    <h1>{{ $category->name }}. Всего {{ $category->products->count() }} товаров</h1>
    <p>{{ $category->description }}</p>

    <div class="row">
        @foreach ($category->products as $product)
            @include('card', compact('product'))
        @endforeach
    </div>
@endsection
