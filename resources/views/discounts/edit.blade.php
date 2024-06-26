<x-auth-layout>
    <form method="POST" action="{{ route('discounts.update', $discount->id) }}">
        @csrf
        @method('PUT')
        <div class="row d-flex justify-content-center align-items-center mt-5 mb-5">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card" style="border-radius: 15px; padding: 20px">
                    <div class="card-body p-5">
                        <h2 class="text-uppercase text-center text-red mb-5">Editar Descuento</h2>
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div data-mdb-input-init class="form-outline mb-2">
                            <x-input-label class="form-label" for="code" value="Código" />
                            <x-text-input type="text" class="form-control" id="code" name="code"
                                :value="old('code', $discount->code)" autofocus autocomplete="code" />
                            <x-input-error :messages="$errors->get('code')" class="mt-2" />
                        </div>
                        <div data-mdb-input-init class="form-outline mb-2">
                            <x-input-label class="form-label" for="percentage" value="Porcentaje de Descuento" />
                            <x-text-input type="number" step="0.01" class="form-control" id="percentage"
                                name="percentage" min="0" max="100" :value="old('percentage', $discount->percentage)" autofocus
                                autocomplete="percentage" />
                            <x-input-error :messages="$errors->get('percentage')" class="mt-2" />
                        </div>
                        <div data-mdb-input-init class="form-outline mb-4">
                            <x-input-label class="form-label" for="amount" value="Monto de Descuento" />
                            <x-text-input type="number" step="0.01" class="form-control" id="amount"
                                name="amount" min="0" :value="old('amount', $discount->amount)" autofocus
                                autocomplete="amount" />
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>
                        <div data-mdb-input-init class="form-outline mb-4">
                            <x-input-label class="form-label" for="description" value="Nueva contraseña" />
                            <x-text-input type="text" class="form-control" id="description" name="description"
                                :value="old('description', $discount->description)" required />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div data-mdb-input-init class="form-outline mb-2">
                            <x-input-label class="form-label" for="uses" value="Usos" />
                            <x-text-input type="number" step="1" class="form-control" id="uses"
                                name="uses" min="0" :value="old('uses', $discount->uses)" autofocus autocomplete="uses" />
                            <x-input-error :messages="$errors->get('uses')" class="mt-2" />
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="active" name="active"
                                {{ $discount->active ? 'checked' : '' }}>
                            <label class="form-check-label" for="active">Activo</label>
                        </div>
                        <div class="form-check d-flex justify-content-center mb-5">
                            <x-primary-button class="button_register">
                                {{ __('Edit') }}
                            </x-primary-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-auth-layout>
