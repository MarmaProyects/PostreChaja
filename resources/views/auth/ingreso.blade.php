<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('ingreso') }}">
        @csrf
        <div class="row d-flex justify-content-center align-items-center mt-5 mb-5">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card" style="border-radius: 15px; padding: 20px">
                    <div class="card-body p-5">
                        <h2 class="text-uppercase text-center text-red mb-5">Iniciar sesión</h2>
                        <!-- Email Address -->
                        <div data-mdb-input-init class="form-outline mb-2">
                            <x-input-label class="form-label" for="email" value="Correo" />
                            <x-text-input id="email" class="input form-control form-control-lg" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div data-mdb-input-init class="form-outline mb-2">
                            <x-input-label class="form-label" for="password" value="Contraseña" />
                            <x-text-input id="password" class="input form-control form-control-lg" type="password" name="password" required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <div class="form-check d-flex justify-content-center mb-2">
                                @if (Route::has('password.request'))
                                <a class="underline text-sm text-danger hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                    {{ __('¿Olvidaste tu contraseña?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="form-check d-flex justify-content-center mb-5">
                            <x-primary-button class="button_register">
                                {{ __('Iniciar sesión') }}
                            </x-primary-button>
                        </div>
                        <div class="form-check d-flex justify-content-center mb-5">
                            <p>¿No tienes cuenta? <a href="{{Route('registro')}}" class="fw-bold text-danger">Crear cuenta</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>