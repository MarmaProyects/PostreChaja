// Función para cambiar la imagen principal del carrusel al hacer clic en los botones del photo-album
document.querySelectorAll('.album-btn').forEach((button) => {
    button.addEventListener('click', () => {
        const imgUrl = button.getAttribute('data-img');
        document.querySelector('.carousel-inner').innerHTML = `<div class="carousel-item active"><img src="${imgUrl}" class="d-block w-100" alt="${button.alt}"></div>`;
    });
});