<x-guest-layout>
    <div class="product_container">
        <div class="product_body">
            @if (session('success'))
            <div class="d-flex justify-content-center mt-3">
                <div class="alert alert-success w-25">
                    {{ session('success') }}
                </div>
            </div>
            @endif
            <section class="product my-5">
                <div class="product__photo">
                    <div class="photo-container">
                        <div class="photo-container-content">
                            <div class="photo-main">
                                <div class="controls">
                                    <i class="bi bi-share-fill" id="shareIcon"></i>
                                    <form id="favoriteForm" action="{{ route('productos.add_removeFavorite', ['product' => $product->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-icon" favorite="{{$isFavorite ? "yes" : "no"}}" id="favoriteButton"><i id="heartIcon" class="bi bi-heart{{$isFavorite ? "-fill" : ""}}"></i></button>
                                    </form>
                                </div>
                                <div class="Carrusel">
                                    <div id="main-carousel" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($product->images as $index => $image)
                                            <div id_imagen_carrusel="{{ $index }}" class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                <img src="data:image/jpg;base64, {{ $image->base64 }}" class="d-block w-100" alt="green apple slice">
                                            </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#main-carousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#main-carousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="photo-album">
                                <ul>
                                    @foreach ($product->images as $index => $image)
                                    <li><button class="album-btn" id_imagen_album="{{ $index }}"><img src="data:image/jpg;base64, {{ $image->base64 }}" alt="alo"></button></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product__info">
                    <div class="title">
                        <h1>{{ ucfirst($product->name) }}</h1>
                    </div>
                    <div class="price">
                        <p>$</p>
                        <span>{{ $product->price }}</span>
                    </div>
                    <div class="size d-none">
                        <h3>Seleccionar tamaño</h3>
                        <ul>
                            <li><img src="https://w7.pngwing.com/pngs/369/94/png-transparent-strawberry-pie-fruitcake-tart-cheesecake-torte-cake-cream-food-strawberries.png" alt="green apple"></li>
                            <li><img src="https://w7.pngwing.com/pngs/369/94/png-transparent-strawberry-pie-fruitcake-tart-cheesecake-torte-cake-cream-food-strawberries.png" alt="yellow apple"></li>
                            <li><img src="https://w7.pngwing.com/pngs/369/94/png-transparent-strawberry-pie-fruitcake-tart-cheesecake-torte-cake-cream-food-strawberries.png" alt="orange apple"></li>
                            <li><img src="https://w7.pngwing.com/pngs/369/94/png-transparent-strawberry-pie-fruitcake-tart-cheesecake-torte-cake-cream-food-strawberries.png" alt="red apple"></li>
                        </ul>
                    </div>
                    <div class="description">
                        <h3>Descripción</h3>
                        <p>{{ $product->description }}</p>
                    </div>
                    <div class="buy">
                        <form action="{{ route('carrito.add') }}" method="POST">
                            @csrf
                            <div class="quantity">
                                <input name="productId" type="text" class="d-none" value="{{ $product->id }}">
                                <label>Cantidad</label>
                                <select name="quantity">
                                    @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                </select>
                                <button class="buy--btn">Añadir al carrito</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <h2 class="text-center mt-2">Productos recomendados</h2>
    <swiper-container class="mySwiper px-5" pagination="true" pagination-clickable="true" space-between="20" slides-per-view="5" autoplay-delay="2500" autoplay-disable-on-interaction="false">
        @foreach ($products as $index => $product)
        <swiper-slide class="card-shadow my-5">
            <a href="{{ route('productos.show', $product->id) }}" class="card-button bg-white p-0 m-0 w-100">
                <div class='col bg-white'>
                    <img src="data:image/jpg;base64, {{ $product->images()->first()->base64 }}" class="" alt="Images">
                    <div class="col swiper-body align-content-center justify-content-center">
                        <h5>{{ ucfirst($product->name) }}</h5>
                        <p class="text-black" style="font: bold">${{ $product->price }} </p>
                    </div>
                </div>
            </a>
        </swiper-slide>
        @endforeach
    </swiper-container>
    <script>
        function changeText(button) {
            var originalText = button.textContent;
            button.textContent = 'Producto añadido!';
            setTimeout(function() {
                button.textContent = originalText;
            }, 3000);
        }
    </script>
</x-guest-layout>