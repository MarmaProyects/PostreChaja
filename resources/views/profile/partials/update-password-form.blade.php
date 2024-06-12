<section>  
    <form method="post" action="{{ route('password.update') }}" class="d-flex">
        @csrf
        @method('put')
        <div class="card-body ">
            <h3 class="text-uppercase text-red">{{ __('Update Password') }}</h3>
            <p class=" ">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>

            <div data-mdb-input-init class="form-outline mb-4">
                <x-input-label class="form-label" for="update_password_current_password" :value="__('Current Password')" />
                <x-text-input id="update_password_current_password" name="current_password" type="password"
                    class="input form-control form-control-lg" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <x-input-label class="form-label" for="update_password_password" :value="__('New Password')" />
                <x-text-input id="update_password_password" name="password" type="password"
                    class="input form-control form-control-lg" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <x-input-label class="form-label" for="update_password_password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                    class="input form-control form-control-lg" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <button class="buy--btn">{{ __('Save') }}</button>

                @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                @endif
            </div>
        </div>
    </form>
</section>
