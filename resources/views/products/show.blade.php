<x-guest-layout>
    <div class="product_container">
        <div class="product_body">
            <section class="product">
                <div class="product__photo">
                    <div class="photo-container">
                        <div class="photo-main">
                            <div class="controls">
                                <i class="material-icons"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share-fill" viewBox="0 0 16 16">
                                        <path d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.5 2.5 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5" />
                                    </svg></i>
                                <i class="material-icons"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                    </svg></i>
                            </div>
                            <div id="main-carousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://w7.pngwing.com/pngs/7/52/png-transparent-cheesecake-bavarian-cream-sponge-cake-torte-cheesecake-cream-food-strawberries.png" class="d-block w-100" alt="green apple slice">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://c0.klipartz.com/pngpicture/486/996/gratis-png-tarta-de-tarta-de-tarta-de-tarta-de-pastel-de-frutas-torta-de-crema-de-fresa-masa-para-pastel-thumbnail.png" class="d-block w-100" alt="green apple">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://e7.pngegg.com/pngimages/329/65/png-clipart-strawberry-cheesecake-fruitcake-chocolate-cake-cream-strawberry-cream-strawberries.png" class="d-block w-100" alt="half apple">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://w7.pngwing.com/pngs/369/94/png-transparent-strawberry-pie-fruitcake-tart-cheesecake-torte-cake-cream-food-strawberries.png" class="d-block w-100" alt="green apple">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://c0.klipartz.com/pngpicture/442/302/gratis-png-pastel-de-trufa-de-chocolate-strudel-brownie-de-chocolate-tiramisu-material-de-sandwich-de-helado-de-fresa.png" class="d-block w-100" alt="apple top">
                                    </div>
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
                        <div class="photo-album">
                            <ul>
                                <li><button class="album-btn" data-img="https://w7.pngwing.com/pngs/7/52/png-transparent-cheesecake-bavarian-cream-sponge-cake-torte-cheesecake-cream-food-strawberries.png" alt="green apple"> <img src="https://w7.pngwing.com/pngs/7/52/png-transparent-cheesecake-bavarian-cream-sponge-cake-torte-cheesecake-cream-food-strawberries.png" alt="alo"></button></li>
                                <li><button class="album-btn" data-img="https://c0.klipartz.com/pngpicture/486/996/gratis-png-tarta-de-tarta-de-tarta-de-tarta-de-pastel-de-frutas-torta-de-crema-de-fresa-masa-para-pastel-thumbnail.png" alt="green apple"> <img src="https://c0.klipartz.com/pngpicture/486/996/gratis-png-tarta-de-tarta-de-tarta-de-tarta-de-pastel-de-frutas-torta-de-crema-de-fresa-masa-para-pastel-thumbnail.png" alt="alo"></button></li>
                                <li><button class="album-btn" data-img="https://e7.pngegg.com/pngimages/329/65/png-clipart-strawberry-cheesecake-fruitcake-chocolate-cake-cream-strawberry-cream-strawberries.png" alt="green apple"> <img src="https://e7.pngegg.com/pngimages/329/65/png-clipart-strawberry-cheesecake-fruitcake-chocolate-cake-cream-strawberry-cream-strawberries.png" alt="alo"></button></li>
                                <li><button class="album-btn" data-img="https://w7.pngwing.com/pngs/369/94/png-transparent-strawberry-pie-fruitcake-tart-cheesecake-torte-cake-cream-food-strawberries.png" alt="green apple"> <img src="https://w7.pngwing.com/pngs/369/94/png-transparent-strawberry-pie-fruitcake-tart-cheesecake-torte-cake-cream-food-strawberries.png" alt="alo"></button></li>
                            </ul>
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