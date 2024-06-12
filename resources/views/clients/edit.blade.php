<x-auth-layout>
    <form method="POST" action="{{ route('clientes.update', $client->id) }}">
        @csrf
        @method('PUT')
        <div class="row d-flex justify-content-center align-items-center mt-5 mb-5">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card" style="border-radius: 15px; padding: 20px">
                    <div class="card-body p-5">
                        <h2 class="text-uppercase text-center text-red mb-5">Editar cuenta</h2>
                        <div data-mdb-input-init class="form-outline mb-4">
                            <x-input-label class="form-label" for="fullname" value="Nombre completo" />
                            <x-text-input id="fullname" class="input form-control form-control-lg" type="text"
                                name="fullname" :value="old('fullname', $client->fullname)" required autofocus autocomplete="fullname" />
                            <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <x-input-label class="form-label" for="email" value="Correo" />
                            <x-text-input id="email" class="input form-control form-control-lg" type="email"
                                name="email" :value="old('email', $client->user->email )" required autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <x-input-label class="form-label" for="phone" value="Teléfono/Celular" />
                            <x-text-input id="phone" class="input form-control form-control-lg" type="tel"
                                name="phone" :value="old('phone', $client->phone)" pattern="[0-9]{9}" maxlength="9"
                                title="Por favor, ingrese un número de teléfono válido de 9 dígitos" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <x-input-label class="form-label" for="address" value="Dirección" />
                            <x-text-input id="address" class="input form-control form-control-lg" type="tel"
                                name="address" :value="old('address', $client->address)"
                                title="Por favor, ingrese un número de teléfono válido de 9 dígitos" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <x-input-label class="form-label" for="password" value="Nueva contraseña" />
                            <x-text-input id="password" class="input form-control form-control-lg" type="password"
                                name="password" autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <x-input-label class="form-label" for="password_confirmation"
                                value="Confirmar contraseña" />
                            <x-text-input id="password_confirmation" class="input form-control form-control-lg"
                                type="password" name="password_confirmation" autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="form-check d-flex justify-content-center mb-5">
                            <div class="d-flex justify-content-center">
                                <x-primary-button class="button_register">
                                    Editar
                                </x-primary-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-auth-layout>
