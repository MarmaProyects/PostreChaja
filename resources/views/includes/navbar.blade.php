<header>
    <div class="row p-2 mx-5">
        <div class="col-4 d-flex justify-content-center justify-content-md-start mb-3 mb-md-0">
            <nav class="navbar navbar-expand-lg navbar-light bg-white">
                <ul class="navbar-nav flex-row">
                    <a href="/" class="ms-md-2">
                        <img src="/logo.png" height="45" />
                    </a>
                </ul>
                <ul class="navbar-nav flex-row">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownSections" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Categorías
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownSections">
                            <li><a class="dropdown-item"
                                    href="{{ route('productos.index', ['categories' => [1]]) }}">Salados</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ route('productos.index', ['categories' => [2]]) }}">Coca cola</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ route('productos.index', ['categories' => [3]]) }}">Vinos</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ route('productos.index', ['categories' => [4]]) }}">Alfajores</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ route('productos.index', ['categories' => [5]]) }}">Postres</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav flex-row">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownSections" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Secciones
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownSections">
                            <li><a class="dropdown-item"
                                    href="{{ route('productos.index', ['sections' => [2]]) }}">Confitería</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ route('productos.index', ['sections' => [3]]) }}">Rotisería</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ route('productos.index', ['sections' => [4]]) }}">Panadería</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="{{ route('productos.index', ['sections' => [5]]) }}">Cafetería</a>
                            </li>
                            <li><a class="dropdown-item" href="#">Catering</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav flex-row">
                    <a class="nav-link" href="/#about-section">Sobre nosotros</a>
                </ul>
            </nav>
        </div>

        <div class="col-4 d-flex justify-content-center align-items-center">
            <form action="{{ route('productos.index') }}" method="GET" class=" ">
                <div class="search">
                    <input autocomplete="off" class="search__input" placeholder="Buscar..." name="search"
                        value="{{ request('search') }}">
                    <button class="search__button">
                        <i class="bi bi-search search__icon"></i>
                    </button>
                </div>
                <div class="d-none">
                    <select name="order" class="form-select">
                        <option value="created_at_desc" {{ request('order') == 'created_at_desc' ? 'selected' : '' }}>
                            Recientes</option>
                        <option value="price_asc" {{ request('order') == 'price_asc' ? 'selected' : '' }}>Menor
                            precio
                        </option>
                        <option value="price_desc" {{ request('order') == 'price_desc' ? 'selected' : '' }}>
                            Mayor precio
                        </option>
                        <option value="category_asc" {{ request('order') == 'category_asc' ? 'selected' : '' }}>
                            Categoría
                        </option>
                    </select>
                </div>
            </form>
        </div>
        <div class="col-4 d-flex justify-content-center justify-content-md-end align-items-center">
            <div class="d-flex">
                <a href="/favoritos" class="cart-container">
                    <button class="btn-navbar mx-1" type="button">
                        <i class="bi bi-heart"></i>
                    </button>
                </a>
                <a href="/carrito" class="cart-container">
                    <button class="btn-navbar mx-1" type="button">
                        <i class="bi bi-cart"></i>
                        @if (auth()->check())
                            <span class="cart-count">{{ auth()->user()->countCartProducts() }}</span>
                        @endif
                    </button>
                </a>
                <button class="btn-navbar mx-1" type="button">
                    <i class="bi bi-bell"></i>
                </button>
                @if (auth()->check())
                    <div class="dropdown">
                        <button class="btn-navbar dropdown-toggle" type="button" id="navbarDropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person"></i>
                            {{ Auth::user()->client->fullname }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{ route('perfil.edit') }}">Perfil</a></li>
                            <li><a class="dropdown-item" href="{{ route('carrito.historial') }}">Historial de
                                    compras</a>
                            </li>
                            @if (Auth::user()->hasRole('Admin'))
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                                </li>
                            @endif
                            <li><a class="dropdown-item" href="#">Configuración</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" :href="route('logout')"
                                        onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                        Salir
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a class="btn-navbar mx-1" href="{{ route('ingreso') }}">Mi cuenta</a>
                @endif
            </div>
        </div>
    </div>
</header>
