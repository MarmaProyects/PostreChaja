$(document).ready(function() {
    $('.buy--btn').on('click', function(event) {
        event.preventDefault();
        
        let productId = $(this).data('product-id');
        let form = $('#add-to-cart-form-' + productId);
        let url = form.attr('action');
        let token = form.find('input[name="_token"]').val();
        
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                _token: token
            },
            error: function(response) {
                alert('Hubo un problema al añadir el producto al carrito.');
            }
        });
    });

    $('.btn-remove').on('click', function(event) {
        event.preventDefault();
        let productId = $(this).closest('.main').data('product-id');
        
        $.ajax({
            type: 'DELETE',
            url: $(this).closest('form').attr('action'),
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function(response) {
                alert('Hubo un problema al eliminar el producto del carrito.');
            }
        });
    });

    $('.decrement-btn').on('click', function(event) {
        event.preventDefault();
        let productId = $(this).data('product-id');
        updateCart(productId, 'decrease');
    });

    $('.increment-btn').on('click', function(event) {
        event.preventDefault();
        let productId = $(this).data('product-id');
        updateCart(productId, 'increase');
    });

    function updateCart(productId, action) {
        let url = 'cart/update/' + productId;
        let token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: url,
            data: {
                _token: token,
                action: action
            },
            success: function(response) {
                location.reload(); // Recarga la página después de la actualización
            },
            error: function(response) {
                alert('Hubo un problema al actualizar el carrito.');
            }
        });
    }
});
