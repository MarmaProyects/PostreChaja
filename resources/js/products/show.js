document.addEventListener("DOMContentLoaded", function () {
    const shareIcon = document.getElementById("shareIcon");
    const albumButtons = document.querySelectorAll(".album-btn");
    const favoriteButton = document.getElementById("favoriteButton");
    const heartIcon = document.getElementById("heartIcon");
    let isFavorite = favoriteButton.getAttribute("favorite") === "yes";

    shareIcon.addEventListener("click", function () {
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(function () {
            shareIcon.classList.remove("bi-share-fill");
            shareIcon.classList.add("bi-check2");
            setTimeout(function () {
                shareIcon.classList.remove("bi-check2");
                shareIcon.classList.add("bi-share-fill");
            }, 2000);
        }, function () {
            alert("Error al copiar la URL");
        });
    });

    function handleHeartHover() {
        if (!isFavorite) {
            $("#favoriteButton").hover(
                function () {
                    $("#heartIcon")
                        .removeClass("bi-heart")
                        .addClass("bi-heart-fill");
                },
                function () {
                    $("#heartIcon")
                        .removeClass("bi-heart-fill")
                        .addClass("bi-heart");
                }
            );
        } else {
            $("#favoriteButton").off("mouseenter mouseleave");
        }
    }

    handleHeartHover();

    albumButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const id = button.getAttribute("id_imagen_album");
            const carouselItem = document.querySelector(
                `#main-carousel [id_imagen_carrusel="${id}"]`
            );
            if (carouselItem) {
                document.querySelectorAll(".carousel-item").forEach((item) => {
                    item.classList.remove("active");
                });
                carouselItem.classList.add("active");
            }
        });
    });

    var favoriteForm = document.getElementById("favoriteForm");
    if (favoriteForm) {
        favoriteForm.addEventListener("submit", function (event) {
            event.preventDefault();
            var form = this;
            var formData = new FormData(form);

            fetch(form.action, {
                method: "POST",
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        isFavorite = !isFavorite;
                        favoriteButton.setAttribute(
                            "favorite",
                            isFavorite ? "yes" : "no"
                        );
                        toggleHeartIcon();
                        handleHeartHover();
                    } else {
                        alert(data.message);
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        });
    }

    function toggleHeartIcon() {
        if (isFavorite) {
            heartIcon.classList.remove("bi-heart");
            heartIcon.classList.add("bi-heart-fill");
        } else {
            heartIcon.classList.remove("bi-heart-fill");
            heartIcon.classList.add("bi-heart");
        }
    }
});
