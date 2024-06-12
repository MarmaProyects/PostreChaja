<x-guest-layout>
    <h1 class="my-5 d-flex justify-content-center">Productos más vendidos</h1>
    <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" space-between="15" slides-per-view="5" autoplay-delay="2500" autoplay-disable-on-interaction="false">
        @foreach ($products as $index => $product)
        <swiper-slide>
            <div class='col' style="background: #9e5353">
                <img src="data:image/jpg;base64, {{ $product->images()->first()->base64 }}" class="" alt="Images">
                <div class="swiper-body">
                    <h5>{{ ucfirst($product->name) }}</h5>
                    <p class="text-white" style="font: bold">${{ $product->price }} </p>
                </div>
            </div>
        </swiper-slide>
        @endforeach
    </swiper-container>
    <div class="row justify-content-between home-presentation mb-5">
        <div class="col">
            <h1>Descubre los deliciosos sabores de nuestra confitería.</h1>
            <p class="my-5">Visita nuestra confitería para disfrutar de nuestros exquisitos productos. Ubicados en Uruguay, ofrecemos una variedad de dulces que deleitarán tu paladar. Ven y prueba nuestras especialidades.</p>
        </div>
        <div class="col">
            <img class='cake-home' src="img/cake-home.jpg" alt="Cake Image" class="img-fluid">
        </div>
    </div>
    <section class="my-5">
        <h1 class="d-flex justify-content-center mt-5">Nuestros productos</h1>
        <p class="d-flex justify-content-center mb-5">Si bien nuestra especialidad son los postres, también ofrecemos una amplia variedad de productos.</p>
        <div class="row justify-content-between">
            <div class="col-md-3 home-section p-3">
                <img class='cake-home' src="img/rotiseria.jpg" alt="Cake Image" class="img-fluid">
                <h2 class="d-flex justify-content-center my-2">Rotisería</h2>
                <p class="d-flex justify-content-center my-2">Descubre nuestro sabor casero y auténtico. Platos tradicionales con un toque especial, preparados con amor y dedicación. ¡Una experiencia que te hará sentir como en casa!</p>
            </div>
            <div class="col-md-3 home-section p-3">
                <img class='cake-home' src="img/panaderia.jpg" alt="Cake Image" class="img-fluid">
                <h2 class="d-flex justify-content-center my-2">Panadería</h2>
                <p class="d-flex justify-content-center my-2">El arte del pan hecho realidad. Deliciosos panes y pasteles recién horneados con ingredientes de calidad. ¡Disfruta de cada bocado con nosotros!</p>
            </div>
            <div class="col-md-3 home-section p-3">
                <img class='cake-home' src="img/cafeteria.jpg" alt="Cake Image" class="img-fluid">
                <h2 class="d-flex justify-content-center my-2">Cafetería</h2>
                <p class="d-flex justify-content-center my-2">Un momento de placer en cada taza. Café fresco y aromático, preparado con maestría. ¡Vive una experiencia sensorial única en nuestra cafetería!</p>
            </div>
        </div>
    </section>
</x-guest-layout>