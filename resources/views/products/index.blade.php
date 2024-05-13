<x-guest-layout>
    <h2>Lista de Productos</h2>
    <form id="orderForm" action="{{ route('productos.index') }}" method="GET" class="mb-3">
        <div class="row">
            <input type="search" class="d-none" placeholder="Buscar" name="search"
                value="{{ request('search') }}">
            <div class="col-md-6">
                <select id="orderSelect" name="order" class="form-select">
                    <option value="created_at_desc" {{ request('order') == 'created_at_desc' ? 'selected' : '' }}>
                        Recientes</option>
                    <option value="price_asc" {{ request('order') == 'price_asc' ? 'selected' : '' }}>Menor precio
                    </option>
                    <option value="price_desc" {{ request('order') == 'price_desc' ? 'selected' : '' }}>Mayor precio
                    </option>
                    <option value="category_asc" {{ request('order') == 'category_asc' ? 'selected' : '' }}>Categoria
                    </option>
                </select>
            </div>
        </div>
    </form>
    <div class="row justify-content-md-center">
        @foreach ($products as $product)
            <div class="col-md-3 m-3 px-0 card">
                <a href="{{ route('productos.show', $product->id) }}" class="card-button">
                    <img class="card-img-top" src="data:image/jpg;base64, {{ $product->images()->first()->base64 }}"
                        alt="Card image cap">
                    <!-- Change for $product->image -->
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-danger fw-bold">$ {{ $product->price }}</p>
                    </div>
                </a>
                <a href="#" class="btn btn-primary">Añadir al carrito</a>
            </div>
        @endforeach
    </div>
</x-guest-layout>
