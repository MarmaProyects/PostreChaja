<x-guest-layout>
    <div class="vista_carrito">
        <div class="my-5">
            <h2 class="text-center mb-5">Carrito de Compras</h2>
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
        </div>
        @if (count($products) > 0)
        <div class="card mb-5">
            <div class="row">
                <div class="col-md-8 cart">
                    <div class="row">
                        <div class="d-flex justify-content-between mb-5">
                            <h4>Carrito de compras</h4>
                            <div class="row justify-content-end">{{count($cart)}} productos</div>
                        </div>
                    </div>
                    @foreach ($products as $product)
                    <div class="row border-top border-bottom">
                        <div class="main d-flex">
                            <div class="row">
                                <div class="col-5"><a href="/productos/{{$product->id}}"><img src="data:image/jpg;base64, {{ $product->images()->first()->base64 }}" class="card-img-top" alt="{{ $product->name }}"></a></div>
                                <div class="col">
                                    <div class="row fw-bold">{{ $product->name }}</div>
                                    <div class="row text-muted">{{ $product->category->name }}</div>
                                    <div class="row text-muted">${{ $product->price }} c/u</div>
                                </div>
                            </div>
                            <div class="col-4 d-flex justify-content-center align-items-center">
                                @if ($cart[$product->id] > 1)
                                <button class="decrement-btn" data-product-id="{{ $product->id }}">-</button>
                                @endif
                                <span>{{ $cart[$product->id] }}</span>
                                <button class="increment-btn" data-product-id="{{ $product->id }}">+</button>
                            </div>
                            <div class="col-2 d-flex justify-content-between align-items-center">${{ $product->price * $cart[$product->id] }}
                                <form action="{{ route('cart.remove', $product->id) }}" method="POST" class="d-flex align-items-center">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-remove">&#10005;</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="mt-5 back-button"><a href="/productos">&leftarrow;<span>Volver a la tienda</span></a></div>
                </div>
                <div class="col-md-4 summary">
                    <div>
                        <h5 class="mt-5"><b>Resumen</b></h5>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">Cantidad de productos: {{count($cart)}}</div>
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
                        <div class="col d-flex">Precio total: ${{$total}}</div>
                    </div>
                    <button class="btn">Pagar</button>
                </div>
                @else
                <p class="text-center">No hay productos en el carrito.</p>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>