<x-auth-layout>
    <div class="dashboard-table">
        <div class="d-flex justify-content-between mb-3">
            <div>
                <h1>{{ __('Discounts') }}</h1>
                <div class="mt-8 text-2xl">
                    {{ __('All discounts') }}
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
                    <a class="nav-link" href="{{ route('discounts.create') }}">
                        {{ __('Add') }} <i class="bi bi-plus"></i>
                    </a>
                </button>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Porcentaje</th>
                    <th>Monto</th>
                    <th>Activo</th>
                    <th>Usos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($discounts as $discount)
                    <tr>
                        <td>{{ $discount->code }}</td>
                        <td>{{ $discount->description }}</td>
                        <td>{{ $discount->percentage ? $discount->percentage . '%' : 'N/A' }}</td>
                        <td>{{ $discount->amount ? '$' . $discount->amount : 'N/A' }}</td>
                        <td>{{ $discount->active ? 'Sí' : 'No' }}</td>
                        <td>{{ $discount->uses }}</td>
                        <td> 
                            <a href="{{ route('discounts.edit', $discount->id) }}"><button
                                    class="dashboard-btn">{{ __('Edit') }} <i class="bi bi-pencil"></i></button></a>
                            <form action="{{ route('discounts.destroy', $discount->id) }}" method="POST"
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
            {{ $discounts->links() }}
        </div>
    </div>
</x-auth-layout>
