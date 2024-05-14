<x-guest-layout>
    <div class="product_container">
        <div class="product_body">
            <section class="product my-5">
                <div class="product__photo">
                    <div class="photo-container">
                        <div class="photo-container-content">
                            <div class="photo-main">
                                <div class="controls">
                                    <i class="material-icons"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share-fill" viewBox="0 0 16 16">
                                            <path d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.5 2.5 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5" />
                                        </svg></i>
                                    <i class="material-icons"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                        </svg></i>
                                </div>
                                <div class="Carrusel">
                                    <div id="main-carousel" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($product->images as $index => $image)
                                            <div id_imagen_carrusel="{{$index}}" class="carousel-item {{$index == 0 ? 'active' : ''}}">
                                                <img src="data:image/jpg;base64, {{$image->base64}}" class="d-block w-100" alt="green apple slice">
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
                                    <li><button class="album-btn" id_imagen_album="{{$index}}"><img src="data:image/jpg;base64, {{$image->base64}}" alt="alo"></button></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product__info">
                    <div class="title">
                        <h1>{{$product->name}}</h1>
                    </div>
                    <div class="price">
                        <p>$U</p>
                        <span>{{$product->price}}</span>
                    </div>
                    <div class="size">
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
                        <p>{{$product->description}}</p>
                    </div>
                    <div class="buy">
                        <div class="quantity">
                            <label for="quantity">Cantidad</label>
                            <select id="quantity" name="quantity">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </div>
                        <button class="buy--btn">Añadir al carrito</button>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-guest-layout>