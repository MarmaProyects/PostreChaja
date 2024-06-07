<x-guest-layout>
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
                            <div class="col-3"><img src="data:image/jpg;base64, {{ $product->images()->first()->base64 }}" class="card-img-top" alt="{{ $product->name }}"></div>
                            <div class="col">
                                <div class="row">{{ $product->name }}</div>
                                <div class="row text-muted">{{ $product->category->name }}</div>
                            </div>
                        </div>
                        <div class="col-4 d-flex justify-content-center align-items-center">
                            <button class="decrement-btn" data-product-id="{{ $product->id }}">-</button>
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
                <div class="mt-5"><a href="#">&leftarrow;</a><span class="text-muted">Volver a la tienda</span></div>
            </div>
            <div class="col-md-4 summary">
                <div>
                    <h5 class="mt-5"><b>Resumen</b></h5>
                </div>
                <hr>
                <div class="row">
                    <div class="col" style="padding-left:0;">{{count($cart)}} productos</div>
                    <div class="col text-right">${{ $product->price * $cart[$product->id] }}</div>
                </div>
                <form>
                    <figure>
                        <blockquote class="blockquote">
                            <p>Envío</p>
                        </blockquote>
                        <figcaption class="blockquote-footer">
                            Retiro en sucursal.
                        </figcaption>
                    </figure>
                    <p>Código de descuento</p>
                    <input id="code" placeholder="Ingresar código">
                </form>
                <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                    <div class="col">Precio total</div>
                    <div class="col text-right">${{$total}}</div>
                </div>
                <button class="btn">Pagar</button>
            </div>
            @else
            <p class="text-center">No hay productos en el carrito.</p>
            @endif
        </div>
    </div>
</x-guest-layout>