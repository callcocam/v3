<x-tall-form-section submit="updateProfileInformation" class="grid grid-cols-1 gap-4 sm:grid-cols-6 md:grid-cols-12">
    <!-- Profile Photo -->
    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div class="col-span-12">
            @if ($field = avatar('Avatar', 'profile_photo_path', 'profile_photo_url')->span(12))
                <x-dynamic-component component="{{ $field->component }}" :field="$field" />
            @endif
        </div>
        <div class="my-2 h-px bg-slate-50 dark:bg-navy-500 col-span-12"></div>
    @endif

    <!-- Name -->
    @if ($field = field('Full Nome','name'))
        <x-tall-label for="name" :field="$field">
            <x-tall-input :field="$field" />
            <x-tall-input-error for="name" class="mt-2" />
        </x-tall-label>
    @endif
    @if ($field = email('Email Address'))
        <x-tall-label for="email" :field="$field">
            <x-tall-input :field="$field" />
            <x-tall-input-error for="email" class="mt-2" />
        </x-tall-label>
    @endif
    <!-- Email -->
    <div class="col-span-6 sm:col-span-12">

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
            !$this->user->hasVerifiedEmail())
            <p class="text-sm mt-2">
                {{ __('Your email address is unverified.') }}

                <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900"
                    wire:click.prevent="sendEmailVerification">
                    {{ __('Click here to re-send the verification email.') }}
                </button>
            </p>

            @if ($this->verificationLinkSent)
                <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
            @endif
        @endif
    </div>
    <x-slot name="actions">
        <x-tall-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-tall-action-message>

        <x-tall-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-tall-button>
    </x-slot>
</x-tall-form-section>
