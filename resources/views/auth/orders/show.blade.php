@extends('auth.layouts.admin')

@section('title', 'Заказ ' . $order->id)

@section('content')
    <div class="col-md-12">
        <h1>Заказ №{{ $order->id }}</h1>
        <p>Заказчик №{{ $order->id }}</p>
        <p>Номер телефона <b>{{ $order->phone }}</b></p>
        <table class="table">
            <tbody>
            <tr>
                <th>Название</th>
                <th>Количество</th>
                <th>Цена</th>
                <th>Стоимость</th>
            </tr>
            @foreach($order->products as $product)
                <tr>
                    <td>
                        <a href="{{ route('product', $product) }}">
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" style="height: 50px;" />
                            {{ $product->name }}
                        </a>
                    </td>
                    <td><span class="badge">{{ $product->count }}</span></td>
                    <td>{{ $product->price }} руб.</td>
                    <td>{{ $product->getPriceForCount() }} руб.</td>
                </tr>
            @endforeach
                <tr>
                    <td colspan="3">Общая стоимость</td>
                    <td>{{ $order->getFullPrice() }} руб.</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
