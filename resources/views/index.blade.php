<x-guest-layout>
    <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" space-between="15" slides-per-view="5"
        autoplay-delay="2500" autoplay-disable-on-interaction="false">
        @foreach ($products as $index => $product)
            <swiper-slide>
                <div class='col' style="background: #9e5353">
                    <img src="data:image/jpg;base64, {{ $product->images()->first()->base64 }}" class=""
                        alt="Images">
                    <div class="swiper-body">
                        <h5>{{ ucfirst($product->name) }}</h5>
                        <p class="text-white" style="font: bold">${{ $product->price }} </p>
                    </div>
                </div>
            </swiper-slide>
        @endforeach
    </swiper-container>

    <div class="row align-items-center banner">
        <div class="col">
            <p class="lead">Descubre nuestras últimas ofertas y promociones.</p>
            <a href="#" class="btn btn-home">Ver ofertas</a>
        </div>
        <div class="col">
            <img class='cake-home' src="img/cake-home.png" alt="Cake Image" class="img-fluid">
        </div>
    </div>
    <br><br>
</x-guest-layout>
