<x-guest-layout>
    <div class="historial-container">
        <h1>Historial de Compras</h1>

        @foreach ($completedCarts as $cart)
            <div class="cart-item">
                <p>Fecha: {{ $cart->updated_at->format('d/m/Y') }}</p>
                <p>Orden #{{ $cart->id }}</p>
                <p>Precio final: ${{ $cart->final_price }}</p>
                <p class="cart-estado  {{ $cart->status == 'completed' ? 'background-green' : 'background-orange' }}">
                    {{ $cart->status == 'completed' ? 'Completado' : 'En espera' }}</p>
                <ul>
                    @foreach ($cart->products as $product)
                        <li>
                            <a class="dropdown-item" href="{{ route('productos.show', $product->id) }}">
                                {{ $product->name }} - Cantidad:
                                {{ $product->pivot->quantity }} - Precio:
                                ${{ $product->price }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</x-guest-layout>
