<x-guest-layout>
    <div class="my-5">
        <h2 class="text-center mb-5">Lista de Productos</h2>
        <form id="filterForm" action="{{ route('products.index') }}" method="GET" class="mb-3">
            <div class="row justify-content-end mb-3">
                <input type="search" class="d-none" placeholder="Buscar" name="search" value="{{ request('search') }}">
                <div class="col-md-auto">
                    <select id="orderSelect" name="order" class="form-select">
                        <option value="created_at_desc" {{ request('order') == 'created_at_desc' ? 'selected' : '' }}>Recientes</option>
                        <option value="price_asc" {{ request('order') == 'price_asc' ? 'selected' : '' }}>Menor precio</option>
                        <option value="price_desc" {{ request('order') == 'price_desc' ? 'selected' : '' }}>Mayor precio</option>
                        <option value="category_asc" {{ request('order') == 'category_asc' ? 'selected' : '' }}>Categoría</option>
                    </select>
                </div>
                <div name="products-filters">
                    <div class="row">
                        <div class="col-md-3 mt-3">
                            <div name="filter-bar" class="bg-white p-3 rounded shadow-sm">
                                <div class="mb-3">
                                    <h4>Categorías</h4>
                                    @foreach ($categories as $category)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="categories[]" id="category_{{ $category->id }}" value="{{ $category->id }}" {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="category_{{ $category->id }}">{{ $category->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4>Secciones</h4>
                                    @foreach ($sections as $section)
                                    @if ($section->name !== 'Catering')
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="sections[]" id="section_{{ $section->id }}" value="{{ $section->id }}" {{ in_array($section->id, request('sections', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="section_{{ $section->id }}">{{ $section->name }}</label>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="mb-3">
                                    <h4>Precio</h4>
                                    <input type="range" class="form-range" min="100" max="1500" step="100" id="priceRange" name="price" value="{{ request('price', 1500) }}" oninput="updatePriceLabel(this.value)">
                                    <span id="priceLabel">{{ request('price', 'Cualquier precio') }}</span>
                                </div>
                                <button type="submit" class="btn btn-danger">Filtrar</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($products as $product)
                        <div class="row col-md-3 m-3 px-0 product-card">
                            <a href="{{ route('productos.show', $product->id) }}" class="card-button p-0 m-0">
                                <img src="data:image/jpg;base64, {{ $product->images()->first()->base64 }}" alt="Card image cap">
                                <div class="text-center">
                                    <h5 class="">{{ ucfirst($product->name) }}</h5>
                                    <p class="text-danger fw-bold">${{ $product->price }}</p>
                                </div>
                            </a>
                            <div class="align-self-end p-0 m-0">
                                <button class="buy--btn">Añadir al carrito</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>