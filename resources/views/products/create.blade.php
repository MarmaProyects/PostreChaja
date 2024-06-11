<x-auth-layout>
    <form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row d-flex justify-content-center align-items-center mt-5 mb-5">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card" style="border-radius: 15px; padding: 20px">
                    <div class="card-body p-5">
                        <h2 class="text-uppercase text-center text-red mb-5">Nuevo Producto</h2>
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
                        <div data-mdb-input-init class="form-outline mb-2">
                            <x-input-label class="form-label" for="price" value="{{__('Price')}}" />
                            <x-text-input id="price" class="input form-control form-control-lg"
                                placeholder="Ingrese el precio del producto" type="number" name="price"
                                :value="old('price')" required autofocus autocomplete="price" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                        <div data-mdb-input-init class="form-outline mb-2">
                            <x-input-label class="form-label" for="amount" value="{{__('Amount')}}" />
                            <x-text-input id="amount" class="input form-control form-control-lg"
                                placeholder="Ingrese el precio del producto" type="number" name="amount"
                                :value="old('amount')" required autofocus autocomplete="amount" />
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>
                        <div data-mdb-input-init class="form-outline mb-2">
                            <x-input-label class="form-label" for="description" value="{{__('Description')}}" />
                            <textarea id="description" class="text-area form-control form-control-lg"
                                placeholder="Ingrese la descripcion del producto" name="description" :value="old('description')" required autofocus
                                autocomplete="description" cols="15" rows="5"></textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div data-mdb-input-init class="form-outline mb-2">
                            <x-input-label class="form-label" for="section_id" value="{{__('Sections')}}" />
                            <select id="section_id" name="section_id" required
                                class="select form-select form-select-lg">
                                <option>Seleccione una sección</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('sections')" class="mt-2" />
                        </div>
                        <div data-mdb-input-init class="form-outline mb-2">
                            <x-input-label class="form-lael" for="category_id" value="{{__('Categories')}}" />
                            <select id="category_id" name="category_id" required required
                                class="select form-select form-select-lg">
                                <option>Seleccione una categoría</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('categories')" class="mt-2" />
                        </div>
                        <div data-mdb-input-init class="form-outline mb-2">
                            <x-input-label class="form-label" for="images" value="{{__('Images')}}" />

                            <input type="file" id="images" name="images[]" accept="image/*"
                                class="input form-control form-control-lg" multiple />
                            <x-input-error :messages="$errors->get('sections')" class="mt-2" />
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
