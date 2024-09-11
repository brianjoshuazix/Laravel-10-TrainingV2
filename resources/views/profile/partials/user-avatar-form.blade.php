<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">

            {{ __('User Avatar') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">

            {{ __("Add or Update User Avatar") }}
        </p>
    </header>

    <form method="post" action="{{route('profile.avatar')}}">
        @method('patch')
        @csrf

        {{-- <input type="hidden" name="_method" value="patch"> --}}

        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}

        <div>
            <x-input-label for="name" :value="_('Avatar')" />
            <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full" :value="old('avatar', $user->avatar)" required autofocus autocomplete="avatar" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        </div>

        <div class="flex items-center gap-4 mt-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
