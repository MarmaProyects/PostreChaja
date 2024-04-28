<x-guest-layout>
    <h2>Lista de Productos</h2>
    <div class="row justify-content-md-center">
        @foreach ($products as $product)
            <div class="col-md-3 m-3 px-0 card">
                <a href="{{ route('productos.show', $product->id) }}" class="card-button">
                    <img class="card-img-top" src="{{ asset('images/torta.png') }}" alt="Card image cap">
                    <!-- Change for $product->image -->
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-danger fw-bold">$ {{ $product->price }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</x-guest-layout>
