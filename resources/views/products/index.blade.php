<x-guest-layout>
    <div class="my-5">
        <h2>Lista de Productos</h2>
        <form id="orderForm" action="{{ route('productos.index') }}" method="GET" class="mb-3">
            <div class="row">
                <input type="search" class="d-none" placeholder="Buscar" name="search" value="{{ request('search') }}">
                <div class="col-md-6">
                    <select id="orderSelect" name="order" class="form-select">
                        <option value="created_at_desc" {{ request('order') == 'created_at_desc' ? 'selected' : '' }}>
                            Recientes</option>
                        <option value="price_asc" {{ request('order') == 'price_asc' ? 'selected' : '' }}>Menor precio
                        </option>
                        <option value="price_desc" {{ request('order') == 'price_desc' ? 'selected' : '' }}>Mayor precio
                        </option>
                        <option value="category_asc" {{ request('order') == 'category_asc' ? 'selected' : '' }}>
                            Categoria
                        </option>
                    </select>
                </div>
            </div>
        </form>
        <div class="row justify-content-md-center">
            @foreach ($products as $product)
                <div class="row col-md-3 m-3 px-0 product-card">
                    <a href="{{ route('productos.show', $product->id) }}" class="card-button p-0 m-0">
                        <img src="data:image/jpg;base64, {{ $product->images()->first()->base64 }}"
                            alt="Card image cap">
                        <div class=" text-center">
                            <h5 class="">{{ $product->name }}</h5>
                            <p class="text-danger fw-bold">$ {{ $product->price }}</p>
                        </div>
                    </a>
                    <div class="align-self-end p-0 m-0">
                        <button class="buy--btn">Añadir al carrito</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-guest-layout>
