<header>
    <div class="p-3 text-center bg-white border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-8 d-flex justify-content-center justify-content-md-start mb-3 mb-md-0">
                    <a href="/" class="ms-md-2">
                        <img src="/logo.png" height="45" />
                    </a>
                    <nav class="navbar navbar-expand-lg navbar-light bg-white">
                        <div class="container justify-content-center justify-content-md-between">
                            <ul class="navbar-nav flex-row">
                                <li class="nav-item me-2 me-lg-0 d-none d-md-inline-block">
                                    <a class="nav-link" href="#">Confitería</a>
                                </li>
                                <li class="nav-item me-2 me-lg-0 d-none d-md-inline-block">
                                    <a class="nav-link" href="#">Rotisería</a>
                                </li>
                                <li class="nav-item me-2 me-lg-0 d-none d-md-inline-block">
                                    <a class="nav-link" href="#">Pandería</a>
                                </li>
                                <li class="nav-item me-2 me-lg-0 d-none d-md-inline-block">
                                    <a class="nav-link" href="#">Cafetería</a>
                                </li>
                                <li class="nav-item me-2 me-lg-0 d-none d-md-inline-block">
                                    <a class="nav-link" href="#">Catering</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6"> 
                            <form action="{{ route('productos.index') }}" method="GET"
                                class="d-flex input-group w-auto my-auto mb-3 mb-md-0">
                                <input autocomplete="off" class="input input-search"
                                    placeholder="Search" name="search" value="{{ request('search') }}">
                                <button type="submit" class="input-group-text border-0 d-none d-lg-flex"><i class="bi bi-search"></i></button>
                                <div class="d-none">
                                    <select name="order" class="form-select">
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
                            </form>
                        </div>
                    </nav>
                </div>
                <div class="col-md-4 d-flex justify-content-center justify-content-md-end align-items-center">
                    <div class="d-flex">
                        <button class="btn-navbar mx-1" type="button">
                            <i class="bi bi-cart"></i>
                        </button>
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
                                    <li><a class="dropdown-item" href="#">Perfil</a></li>
                                    <li><a class="dropdown-item" href="#">Configuración</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item" href="#" :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                                Salir
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a class="btn-navbar mx-1" href="{{ route('login') }}">Mi cuenta</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
