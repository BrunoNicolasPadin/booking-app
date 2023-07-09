<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your bookings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Id
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Hotel
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Room number
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Guest name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                From
                            </th>
                            <th scope="col" class="px-6 py-3">
                                End
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking => $b)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $b['id'] }} 
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $b['room']['hotel']['name'] }} 
                                </th>
                                <td class="px-6 py-4">
                                    {{ $b['room']['number'] }} 
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $b['nameGuest'] }} 
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ Carbon\Carbon::parse($b['from'])->format('Y-m-d') }} 
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ Carbon\Carbon::parse($b['end'])->format('Y-m-d') }} 
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <span 
                                        class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">
                                        {{ $b['status'] }}
                                    </span>
                                </th>
                                <td class="px-6 py-4">
                                    <form action="{{ route('bookings.clone') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="room_id" value="{{ $b['room_id'] }}">
                                        <input type="hidden" name="status" value="{{ $b['status'] }}">
                                        <input type="hidden" name="from" value="{{  Carbon\Carbon::parse($b['from'])->format('Y-m-d') }}">
                                        <input type="hidden" name="end" value="{{  Carbon\Carbon::parse($b['end'])->format('Y-m-d') }}">
                                        <button
                                            type="submit" 
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            Clone
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

@vite('resources/js/app.js')