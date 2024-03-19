<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Matches
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-full">
                    <form method="post" action="{{ route('football.matches.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <!-- Table for Matches Inputs -->
                        <div class="overflow-x-auto">
                            <table id="matches-table" class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Home Club
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Goal Home Club
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Away Club
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Goals Away Club
                                        </th>
                                        <th scope="col" class="px-6 py-3"></th> <!-- Empty column for Remove button -->
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td>
                                            <select name="matches[0][tim1]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                                                <option selected>Choose Home Club</option>
                                                @foreach ($clubs as $club)
                                                <option value="{{ $club->id }}">{{ $club->tim }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input name="matches[0][goal1]" type="text" class="block w-full rounded-lg" required>
                                        </td>
                                        <td>
                                            <select name="matches[0][tim2]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                                                <option selected>Choose Away Club</option>
                                                @foreach ($clubs as $club)
                                                <option value="{{ $club->id }}">{{ $club->tim }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input name="matches[0][goal2]" type="text" class="block w-full rounded-lg" required>
                                        </td>
                                        <td>
                                            <button type="button" class="text-red-600 hover:text-red-900 focus:outline-none" onclick="removeMatchRow(this)">Remove</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Button to Add More Matches -->
                        <div class="flex items-center gap-4">
                            <button type="button" id="add-match" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Match</button>
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

<script>
    // JavaScript to add more matches
    const addMatchButton = document.getElementById('add-match');
    const matchesTable = document.getElementById('matches-table');

    let matchIndex = 1;

    addMatchButton.addEventListener('click', () => {
        const newRow = matchesTable.insertRow();
        newRow.innerHTML = `
            <td>
                <select name="matches[${matchIndex}][tim1]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                    <option selected>Choose Home Club</option>
                    @foreach ($clubs as $club)
                    <option value="{{ $club->id }}">{{ $club->tim }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input name="matches[${matchIndex}][goal1]" type="text" class="mt-1 block w-full rounded-lg" required>
            </td>
            <td>
                <select name="matches[${matchIndex}][tim2]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                    <option selected>Choose Away Club</option>
                    @foreach ($clubs as $club)
                    <option value="{{ $club->id }}">{{ $club->tim }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input name="matches[${matchIndex}][goal2]" type="text" class="mt-1 block w-full rounded-lg" required>
            </td>
            <td>
                <button type="button" class="text-red-600 hover:text-red-900 focus:outline-none" onclick="removeMatchRow(this)">Remove</button>
            </td>
        `;
        matchIndex++;
    });

    function removeMatchRow(button) {
        const row = button.closest('tr');
        row.remove();
    }
</script>
