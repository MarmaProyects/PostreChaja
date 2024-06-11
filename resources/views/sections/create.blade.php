<x-auth-layout>
    <form method="POST" action="{{ route('secciones.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row d-flex justify-content-center align-items-center mt-5 mb-5">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card" style="border-radius: 15px; padding: 20px">
                    <div class="card-body p-5">
                        <h2 class="text-uppercase text-center text-red mb-5">Nueva Sección</h2>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div data-mdb-input-init class="form-outline mb-2">
                            <x-input-label class="form-label" for="name" value="{{__('Name')}}" />
                            <x-text-input id="name" class="input form-control form-control-lg"
                                placeholder="Ingrese el nombre del producto" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="form-check d-flex justify-content-center mb-5">
                            <x-primary-button class="button_register">
                                {{ __('Create') }}
                            </x-primary-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-auth-layout>
