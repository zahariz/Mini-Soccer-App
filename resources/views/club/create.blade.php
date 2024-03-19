<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Master Car
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('football.clubs.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="tim" :value="__('Club')" />
                            <x-text-input id="tim" name="tim" type="text" class="mt-1 block w-full" aria-placeholder="Club" required autofocus autocomplete="tim" />
                            <x-input-error class="mt-2" :messages="$errors->get('tim')" />
                        </div>
                        <div>
                            <x-input-label for="city" :value="__('City')" />
                            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" aria-placeholder="City" required autofocus autocomplete="city" />
                            <x-input-error class="mt-2" :messages="$errors->get('city')" />
                        </div>


                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'Cars succesfully created!')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600"
                                >{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
