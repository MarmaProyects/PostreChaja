<x-guest-layout>
    <h1 class="titulo-swipper">Productos más vendidos</h1>
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
    <section id="products-section" class="my-5">
        <h1 class="d-flex justify-content-center mt-5">Nuestros productos y servicios</h1>
        <p class="d-flex justify-content-center mb-5">Si bien nuestra especialidad son los postres, también ofrecemos
            una amplia variedad de productos.</p>
        <div class="row justify-content-around mx-5">
            <a href="{{ route('productos.index', ['sections' => [3]]) }}" class="col-md-2 home-card p-3 text-decoration-none card-shadow">
                <img src="img/rotiseria.jpg" alt="Cake Image" class="img-fluid">
                <h2 class="d-flex justify-content-center my-2">Rotisería</h2>
                <p class="d-flex justify-content-center my-2">Descubre nuestro sabor casero y auténtico. Platos
                    tradicionales con un toque especial, preparados con amor y dedicación. ¡Una experiencia que te hará
                    sentir como en casa!</p>
            </a>
            <a href="{{ route('productos.index', ['sections' => [4]]) }}" class="col-md-2 home-card text-decoration-none p-3">
                <img src="img/panaderia.jpg" alt="Cake Image" class="img-fluid">
                <h2 class="d-flex justify-content-center my-2">Panadería</h2>
                <p class="d-flex justify-content-center my-2">El arte del pan hecho realidad. Deliciosos panes y
                    pasteles recién horneados con ingredientes de calidad. ¡Disfruta de cada bocado con nosotros!</p>
            </a>
            <a href="{{ route('productos.index', ['sections' => [5]]) }}" class="col-md-2 home-card text-decoration-none p-3">
                <img src="img/cafeteria.jpg" alt="Cake Image" class="img-fluid">
                <h2 class="d-flex justify-content-center my-2">Cafetería</h2>
                <p class="d-flex justify-content-center my-2">Un momento de placer en cada taza. Café fresco y
                    aromático, preparado con maestría. ¡Vive una experiencia sensorial única en nuestra cafetería!</p>
            </a>
            <a href="{{ route('productos.index', ['sections' => [2]]) }}" class="col-md-2 home-card text-decoration-none p-3">
                <img src="img/confiteria.jpg" alt="Cake Image" class="img-fluid">
                <h2 class="d-flex justify-content-center my-2">Confitería</h2>
                <p class="d-flex justify-content-center my-2">Descubre pronto nuestra selección exquisita de dulces y postres, preparados con atención al detalle y amor por la tradición. Cada sabor te transportará a momentos de deleite inigualable.</p>
            </a>
        </div>
        <br>
        <br>
        <a class="d-flex justify-content-center text-decoration-none" href="/productos">
            <button class="details-button">Ver productos</button>
        </a>
    </section>
    <br>
    <br>
    <section id="about-section">
        <h1 class="d-flex justify-content-center my-5">Sobre nosotros</h1>
        <div class="row justify-content-center m-5 home-presentation">
            <div class="col texto1_sobreNosotros card-shadow p-5">
                <h2>Nuestra Historia</h2>
                <p>Desde nuestros inicios, nos hemos dedicado a llevar lo mejor de la tradición dulce uruguaya a todo el mundo. Inspirados por el icónico postre Chajá, decidimos compartir su sabor único y la calidez de nuestra cultura a través de nuestros productos. Cada bocado cuenta una historia de amor por la repostería artesanal y el compromiso con la calidad que nos distingue.</p>
                <h2>Nuestros Valores y Misión</h2>
                <p>En Chajá, nos enorgullecemos de ofrecer productos auténticos que capturan la esencia de Uruguay. Nos comprometemos con la excelencia en cada paso, desde la selección de ingredientes frescos hasta la atención al detalle en cada receta. Nuestra misión es brindar momentos de placer y conexión a través de nuestras delicias, superando las expectativas de nuestros clientes en cada pedido.</p>
            </div>
            <div class="col image1_sobreNosotros">
                <img src="img/cake-home.jpg" alt="Cake Image" class="img-fluid card-shadow">
            </div>
        </div>
        <div class="row justify-content-center m-5 home-presentation">
            <div class="col image2_sobreNosotros">
                <img src="img/cake-home2.jpg" alt="Cake Image" class="img-fluid card-shadow">
            </div>
            <div class="col texto2_sobreNosotros card-shadow p-5">
                <h2>Nuestro Equipo</h2>
                <p>Somos un equipo apasionado por compartir nuestra herencia culinaria con el mundo. Cada miembro de nuestro equipo aporta habilidades únicas y una dedicación inquebrantable para asegurar que cada experiencia con Chajá sea memorable y satisfactoria para nuestros clientes.</p>
                <h2>Compromiso con los Clientes</h2>
                <p>En Chajá, nuestros clientes son nuestra prioridad. Nos esforzamos por ofrecer un servicio al cliente excepcional y garantizar la plena satisfacción con nuestros productos. Tu confianza en nosotros nos impulsa a mejorar continuamente y a superar tus expectativas en cada compra.</p>
            </div>
        </div>
        <div class="row justify-content-center m-5 home-presentation">
            <div class="col texto1_sobreNosotros card-shadow p-5">
                <h2>Impacto Social y Comunitario</h2>
                <p>Nos preocupamos por nuestra comunidad y por el impacto que tenemos en ella. A través de prácticas sostenibles y el apoyo a iniciativas locales, buscamos contribuir positivamente al entorno que nos rodea y promover un futuro más saludable y consciente.</p>
                <h2>Visión a Futuro</h2>
                <p>Mirando hacia adelante, aspiramos a expandir nuestra oferta de productos y a llegar a más personas que desean experimentar la autenticidad y el sabor único de Chajá. Nuestro compromiso con la calidad y la innovación nos guiará mientras seguimos creciendo y compartiendo nuestra pasión por la repostería uruguaya con el mundo.</p>
            </div>
            <div class="col image1_sobreNosotros">
                <img src="img/cake-home3.jpg" alt="Cake Image" class="img-fluid card-shadow">
            </div>
        </div>
    </section>
</x-guest-layout>