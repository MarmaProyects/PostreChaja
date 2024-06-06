{{-- resources/views/categories/table.blade.php --}}
<x-auth-layout>
    <div class="dashboard-table">
        <div class="d-flex justify-content-between mb-3">
            <div>
                <h1>{{ __('Categories') }}</h1>
                <div class="mt-8 text-2xl">
                    {{ __('All Categories') }}
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
                    <a class="nav-link" href="{{ route('categorias.create') }}">
                        {{ __('Add') }}
                    </a>
                </button>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $categoria)
                    <tr>
                        <td>{{ $categoria->name }}</td>
                        <td>
                            <button href="{{ route('categorias.edit', $categoria->id) }}"
                                class="dashboard-btn">{{ __('Edit') }}</button>
                            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST"
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
            {{ $categories->links() }}
        </div>
    </div>
</x-auth-layout>
