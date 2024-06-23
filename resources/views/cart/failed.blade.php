<x-guest-layout>
    <div class="checkout-container">
        <h2 class="text-center mt-5">Pago Fallido</h2>
        <p class="text-center">Lo sentimos, tu pago no pudo ser procesado. Por favor, inténtalo de nuevo.</p>
        <div class="text-center mt-3">
            <a href="{{ route('carrito.index') }}" class="btn">Volver al carrito</a>
        </div>
    </div>
</x-guest-layout>
