<x-app-layout>
    <div class="row my-3">
        <div class="col-3">
        </div>
        <div class="col-7">
            @include('profile.partials.update-profile-information-form')
        </div>
        <br>
        <div class="col-3">
        </div>
        <div class="col-7 mt-5">
            @include('profile.partials.update-password-form')
        </div>

        <!-- <div class="">
            <div class="">
                @include('profile.partials.delete-user-form')
            </div>
        </div> !-->
    </div>
    <br>
</x-app-layout>
