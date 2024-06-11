<x-auth-layout>
    <div class="dashboard-table">
        <div class="d-flex justify-content-between  mb-3">
            <div>
                <h1>{{ __('Clients') }}</h1>
                {{ __('All Clients') }}
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
                    <a class="nav-link" href="{{ route('clientes.create') }}">
                        {{ __('Add') }} <i class="bi bi-plus"></i>
                    </a>
                </button>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    <tr>
                        <td>{{ $client->fullname }}</td>
                        <td>{{ $client->user->email }}</td>
                        <td>{{ $client->address }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>
                            <a href="{{ route('clientes.edit', $client->id) }}"><button
                                    class="dashboard-btn">{{ __('Edit') }} <i class="bi bi-pencil"></i></button></a>
                            <form action="{{ route('clientes.destroy', $client->id) }}" method="POST"
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
            {{ $clients->links() }}
        </div>
    </div>
</x-auth-layout>
