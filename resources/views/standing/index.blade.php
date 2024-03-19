<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Standings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-full">
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                            @session('status')
                            <div class="p-4 bg-green-100">
                                {{ $value }}
                            </div>
                             @endsession
                            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                <div class="max-w-full">
                                    <div class="relative overflow-x-auto">
                                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            <thead
                                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3">
                                                        No
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Klub
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Ma
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Me
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        S
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        K
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        GM
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        GK
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Poin
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @foreach ($clubStatus as $row)
                                                {{-- @dd($row) --}}

                                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                    <th scope="row"
                                                        class="px-6 py-4">
                                                        {{$i++}}
                                                    </th>
                                                    <td class="px-6 py-4">
                                                        {{ $row['club']->tim }}

                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $row['total_main'] }}

                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $row['menang'] }}

                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $row['seri'] }}

                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $row['kalah'] }}

                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $row['goal_for'] }}

                                                    <td class="px-6 py-4">
                                                        {{ $row['goal_against'] }}

                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $row['poin'] }}
                                                    </td>

                                                </tr>

                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>


{{-- @foreach ($clubStatus as $row)

@endforeach --}}
