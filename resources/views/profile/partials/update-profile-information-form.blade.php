<section class="">
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form method="POST" action="{{ route('perfil.update', $client->id) }}">
        @csrf
        @method('PUT')
        <div class="card-body pt-5">
            <h2 class="text-uppercase text-center text-red mb-5">{{ __('Profile Information') }}</h2>
            <p class="cliente-estrellas">Tus estrellas acumuladas: <span>{{ $client->available_stars }}</span> <i class="bi bi-star-fill"></i></p>
            <p class=" ">
                {{ __("Update your account's profile information and email address.") }}
            </p>
            <div data-mdb-input-init class="form-outline mb-4">
                <x-input-label class="form-label" for="fullname" value="Nombre completo" />
                <x-text-input id="fullname" class="input form-control form-control-lg" type="text" name="fullname"
                    :value="old('fullname', $client->fullname)" required autofocus autocomplete="fullname" />
                <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <x-input-label class="form-label" for="email" value="Correo" />
                <x-text-input id="email" class="input form-control form-control-lg" type="email" name="email"
                    :value="old('email', $client->user->email)" required autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <x-input-label class="form-label" for="phone" value="Teléfono/Celular" />
                <x-text-input id="phone" class="input form-control form-control-lg" type="tel" name="phone"
                    :value="old('phone', $client->phone)" pattern="[0-9]{9}" maxlength="9"
                    title="Por favor, ingrese un número de teléfono válido de 9 dígitos" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <x-input-label class="form-label" for="address" value="Dirección" />
                <x-text-input id="address" class="input form-control form-control-lg" type="tel" name="address"
                    :value="old('address', $client->address)" title="Por favor, ingrese un número de teléfono válido de 9 dígitos" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>
            <div class="flex items-center gap-4">
                <button class="buy--btn">{{ __('Edit') }}</button>
            </div>
        </div>
    </form>
</section>
