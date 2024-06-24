<x-guest-layout>
    <div class="my-5">
        <h2 class="text-center mb-5">Lista de favoritos</h2>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if ($products->isEmpty())
                        <div class="text-center">
                            <h4>No hay productos en tu lista de favoritos</h4>
                        </div>
                    @else
                        @foreach ($products as $product)
                            <div class="row bg-white my-4 p-3 card-shadow rounded">
                                <div class="col-3 d-flex justify-content-center align-items-center py-3">
                                    <a href="/productos/{{ $product->id }}">
                                        <img src="data:image/jpg;base64, {{ $product->images()->first()->base64 }}"
                                            class="img-fluid rounded" alt="{{ $product->name }}">
                                    </a>
                                </div>
                                <div class="col-7 pt-2">
                                    <a class="text-danger text-decoration-none" href="/productos/{{ $product->id }}">
                                        <div class="fw-bold fs-5">{{ $product->name }}</div>
                                    </a>
                                    <div class="text-muted fs-5">{{ $product->category->name }}</div>
                                    <div class="text-muted fs-5">${{ $product->price }} c/u</div>
                                </div>
                                <div class="col d-flex justify-content-between align-items-center fs-5">
                                    <form action="{{ route('carrito.add') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-danger btn-lg">Añadir al carrito</button>
                                    </form>
                                    <form
                                        action="{{ route('productos.add_removeFavorite', ['product' => $product->id]) }}"
                                        method="POST" class="d-inline ms-2">
                                        @csrf
                                        <button type="submit" class="btn text-danger btn-lg"><i
                                                class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
