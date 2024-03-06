<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Avatar') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Add or Update your account's avatar.") }}
        </p>
        @php

        $position = strpos($user->avatar, 'avatars.githubusercontent.com');

        @endphp
        @if($position !== false)

        <img width="100" height="100" class="rounded-full mt-4" src="{{ $user->avatar }}" alt="user avatar"/>

        @else
        
        <img width="100" height="100" class="rounded-full mt-4" src="{{ asset('/storage/'.$user->avatar) }}" alt="user avatar"/>

        @endif

    </header>

    <form method="post" action="{{ route('profile.avatar.ai') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="avatar" :value="__('Generate Avatar from AI')" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Generate Avatar') }}</x-primary-button>

            @if (session('msg'))
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 5000)"
                    class="text-sm text-green-600 dark:text-green-400"
                >{{ session('msg') }}</p>
            @endif
        </div>
    </form>

    <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Or") }}
    </p>

    <form method="post" action="{{ route('profile.avatar') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="avatar" :value="__('Upload Avatar from computer')" />
            <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full" :value="old('avatar', $user->avatar)" autofocus autocomplete="avatar" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('message'))
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 5000)"
                    class="text-sm text-green-600 dark:text-green-400"
                >{{ session('message') }}</p>
            @endif
        </div>
    </form>
</section>
