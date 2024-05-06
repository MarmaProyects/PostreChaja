document.addEventListener('DOMContentLoaded', function() {
    const albumButtons = document.querySelectorAll('.album-btn');
    albumButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = button.getAttribute('id_imagen_album');
            const carouselItem = document.querySelector(`#main-carousel [id_imagen_carrusel="${id}"]`);
            if (carouselItem) {
                document.querySelectorAll('.carousel-item').forEach(item => {
                    item.classList.remove('active');
                });
                carouselItem.classList.add('active');
            }
        });
    });
});
