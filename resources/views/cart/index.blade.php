<x-guest-layout>
    <div class="vista_carrito">
        <div class="my-5">
            <h2 class="text-center mb-5">Carrito de Compras</h2>
            @if (session('success'))
                <div class="d-flex justify-content-center mt-3">
                    <div class="alert alert-success w-25">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
        </div>
        @if ($products != null && $cart->products->count() > 0)
            <div class="card mb-5">
                <div class="row">
                    <div class="col-md-8 cart">
                        <div class="row">
                            <div class="d-flex justify-content-between mb-5">
                                <h4>Carrito de compras</h4>
                                <div class="row justify-content-end">{{ $cart->products->count() }} productos</div>
                            </div>
                        </div>
                        @foreach ($cart->products as $product)
                            <div class="row border-top border-bottom">
                                <div class="main d-flex">
                                    <div class="row">
                                        <div class="col-5">
                                            <a href="/productos/{{ $product->id }}">
                                                <img src="data:image/jpg;base64, {{ $product->images()->first()->base64 }}"
                                                    class="card-img-top" alt="{{ $product->name }}">
                                            </a>
                                        </div>
                                        <div class="col">
                                            <div class="row fw-bold">{{ $product->name }}</div>
                                            <div class="row text-muted">{{ $product->category->name }}</div>
                                            <div class="row text-muted">${{ $product->price }} c/u</div>
                                        </div>
                                    </div>
                                    <div class="col-4 d-flex justify-content-center align-items-center">
                                        @if ($product->pivot->quantity > 1)
                                            <form action="{{ route('carrito.update', $product->id) }}" method="POST">
                                                @csrf
                                                <input type="text" name="action" value="decrease" class="d-none">
                                                <button class="decrement-btn">-</button>
                                            </form>
                                        @endif
                                        <span>{{ $product->pivot->quantity }}</span>
                                        <form action="{{ route('carrito.update', $product->id) }}" method="POST">
                                            @csrf
                                            <input type="text" name="action" value="increase" class="d-none">
                                            <button class="increment-btn">+</button>
                                        </form>
                                    </div>
                                    <div class="col-2 d-flex justify-content-between align-items-center">
                                        ${{ $product->price * $product->pivot->quantity }}
                                        <form action="{{ route('carrito.remove', $product->id) }}" method="POST"
                                            class="d-flex align-items-center">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-remove">&#10005;</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="mt-5 back-button"><a href="/productos">&leftarrow;<span>Volver a la
                                    tienda</span></a></div>
                    </div>
                    <div class="col-md-4 summary">
                        <div>
                            <h5 class="mt-5"><b>Resumen</b></h5>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">Cantidad de productos: {{ $cart->products->count() }}</div>
                        </div>
                        <br>
                        <form>
                            <figure>
                                <blockquote class="blockquote">
                                    <p>Envío (no disponible)</p>
                                </blockquote>
                                <figcaption class="blockquote-footer">
                                    Retiro en sucursal.
                                </figcaption>
                            </figure>
                            <p>Código de descuento</p>
                            <input placeholder="Ingresar código">
                        </form>
                        <div class="row mt-5 mb-3">
                            <div class="col d-flex">Precio total: ${{ $cart->final_price }}</div>
                        </div>
                        <button onclick="window.location.href='{{ route('cart.checkout') }}'" class="btn">Pagar</button>
                    </div>
                @else
                    <p class="text-center">No hay productos en el carrito.</p>
        @endif
    </div>
</x-guest-layout>
