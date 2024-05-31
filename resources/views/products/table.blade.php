{{-- resources/views/products/table.blade.php --}}
<x-auth-layout>
    <div class="dashboard-table">
        <div class="d-flex justify-content-between">
            <div class="">
                <h1>{{ __('Products') }}</h1>
                <div class="mt-8 text-2xl">
                    {{ __('All Products') }}
                </div>
            </div>
            <div class="">
                <button href="{{ route('productos.create') }}" class="dashboard-btn">{{ __('Add') }}</button>
            </div>
        </div>
        <div class="d-flex mt-3 alerts-dashboard">
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
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
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
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->section->name }}</td>
                        <td>
                            <button href="{{ route('productos.edit', $product->id) }}"
                                class="dashboard-btn">{{ __('Edit') }}</button>
                            <form action="{{ route('productos.destroy', $product->id) }}" method="POST"
                                style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dashboard-btn">{{ __('Delete') }}</button>
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
