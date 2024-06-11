{{-- resources/views/products/table.blade.php --}}
<x-auth-layout>
    <div class="dashboard-table">
        <div class="d-flex justify-content-between  mb-3">
            <div>
                <h1>{{ __('Products') }}</h1>
                <div class="mt-8 text-2xl">
                    {{ __('All Products') }}
                </div>
            </div>
            <div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div>
                <button class="dashboard-btn">
                    <a class="nav-link" href="{{ route('productos.create') }}">
                        {{ __('Add') }} <i class="bi bi-plus"></i>
                    </a>
                </button>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Cantidad de imagenes</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Sección</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->images->count() }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->section->name }}</td>
                        <td>
                            <a href="{{ route('productos.show', $product->id) }}"><button class="dashboard-btn">
                                    {{ __('View') }}
                                    <i class="bi bi-eye"></i>
                                </button></a>
                            <a href="{{ route('productos.edit', $product->id) }}"><button
                                    class="dashboard-btn">{{ __('Edit') }} <i class="bi bi-pencil"></i></button></a>
                            <form action="{{ route('productos.destroy', $product->id) }}" method="POST"
                                style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dashboard-btn">{{ __('Delete') }} <i
                                        class="bi bi-trash3"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    </div>
</x-auth-layout>
