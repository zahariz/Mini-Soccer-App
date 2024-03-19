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
                    <form method="post" action="{{ route('football.matches.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="tim1" :value="__('Home Club')" />
                            <select name="tim1" id="tim1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                                <option selected>Choose Home Club</option>
                                @foreach ($clubs as $row)
                                <option value="{{ $row->id }}">{{ $row->tim }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('tim1')" />
                        </div>
                        <div>
                            <x-input-label for="goal1" :value="__('Goal Home Club')" />
                            <x-text-input id="goal1" name="goal1" type="text" class="mt-1 block w-full" aria-placeholder="Club" required autofocus autocomplete="goal1" />
                            <x-input-error class="mt-2" :messages="$errors->get('goal1')" />
                        </div>
                        <div>
                            <x-input-label for="city" :value="__('Away Club')" />
                            <select name="tim2" id="tim2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                                <option selected>Choose Home Club</option>
                                @foreach ($clubs as $row)
                                <option value="{{ $row->id }}">{{ $row->tim }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('city')" />
                        </div>
                        <div>
                            <x-input-label for="goal2" :value="__('Goals Away Club')" />
                            <x-text-input id="goal2" name="goal2" type="text" class="mt-1 block w-full" aria-placeholder="Club" required autofocus autocomplete="goal2" />
                            <x-input-error class="mt-2" :messages="$errors->get('goal2')" />
                        </div>


                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'Matches successfully created!')
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
