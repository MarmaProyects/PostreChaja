@extends('layouts.app')

@section('content')
    <h1>Historial de Compras</h1>

    @foreach ($completedCarts as $cart)
        <div class="cart">
            <h2>Carrito #{{ $cart->id }}</h2>
            <p>Precio final: ${{ $cart->final_price }}</p>
            <p>Estado: {{ $cart->status }}</p>
            <p>Fecha de compra: {{ $cart->updated_at->format('d/m/Y') }}</p>
            <ul>
                @foreach ($cart->products as $product)
                    <li>{{ $product->name }} - Cantidad: {{ $product->pivot->quantity }} - Precio: ${{ $product->price }}</li>
                @endforeach
            </ul>
        </div>
    @endforeach
@endsection
