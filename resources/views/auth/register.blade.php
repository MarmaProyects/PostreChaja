<x-guest-layout>
    <form method="POST" action="{{ route('registro') }}">
        @csrf

        <section class="vh-100 bg-image>
            <div class="mask d-flex align-items-center h-100 gradient-custom-3">
                <div class="container h-100">
                    <div class="fondorojo row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                            <div class="card" style="border-radius: 15px;">
                                <div class="card-body p-5">
                                    <h2 class="text-uppercase text-center text-red mb-5">Crear cuenta</h2>
                                    <!-- Name -->
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <x-input-label class="form-label" for="name" value="Nombre completo" />
                                        <x-text-input id="name" class="input form-control form-control-lg" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <!-- Email Address -->
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <x-input-label class="form-label" for="email" value="Correo" />
                                        <x-text-input id="email" class="input form-control form-control-lg" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <x-input-label class="form-label" for="phone" value="Teléfono/Celular" />
                                        <x-text-input id="phone" class="input form-control form-control-lg" type="tel" name="phone" :value="old('phone')" required pattern="[0-9]{9}" maxlength="9" title="Por favor, ingrese un número de teléfono válido de 9 dígitos" />
                                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                    </div>

                                    <!-- Password -->
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <x-input-label class="form-label" for="password" value="Contraseña" />
                                        <x-text-input id="password" class="input form-control form-control-lg" type="password" name="password" required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <!-- Confirm Password -->
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <x-input-label class="form-label" for="password_confirmation" value="Confirmar contraseña" />
                                        <x-text-input id="password_confirmation" class="input form-control form-control-lg" type="password" name="password_confirmation" required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>

                                    <div class="form-check d-flex justify-content-center mb-5">
                                        <div class="d-flex justify-content-center">
                                            <x-primary-button class="button_register">
                                                Registrarse
                                            </x-primary-button>
                                        </div>
                                    </div>
                                    <p class="text-center text-muted mt-5 mb-0">¿Ya tienes una cuenta? <a href="#!" class="fw-bold text-danger"><u>Iniciar sesión</u></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</x-guest-layout>