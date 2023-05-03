<x-layout>
    <x-navigation />
    <div class="px-4 py-6 md:px-24 md:py-10">
        @include('components.statistics._header')
        <div class="mt-6 md:mt-10">
            <form action="">
                <div class="flex gap-2 md:gap-4 py-4 px-6 max-w-[250px] rounded-md border border-gray-300">
                    <img src="{{ asset('images/search.svg') }}" alt="">
                    <input type="text" name="search" id="search" placeholder="{{ __('dashboard.search_country') }}"
                        class="w-full outline-none capitalize">
                </div>
            </form>
            <div class="mt-10">
                <table class="w-full text-left">
                    <thead
                        class="text-[10px] md:text-[16px] text-black font-semibold capitalize bg-gray-100  p-4 md:px-10 md:py-5 flex w-full">
                        <tr class="flex w-full gap-2">
                            <th scope="col" class="break-all flex items-center gap-1 md:gap-2 w-1/4">
                                {{ __('dashboard.location') }}
                                <a
                                    href="{{ route('statistics', ['column' => 'name', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                    <x-statistics.arrows :desc="request('column') === 'name' && request('order') === 'desc'" />
                                </a>
                            </th>
                            <th scope="col" class="break-all flex items-center gap-1 md:gap-2 w-1/4">
                                {{ __('dashboard.cases') }}
                                <a
                                    href="{{ route('statistics', ['column' => 'confirmed', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                    <x-statistics.arrows :desc="request('column') === 'confirmed' && request('order') === 'desc'" />
                                </a>
                            </th>
                            <th scope="col" class="break-all flex items-center gap-1 md:gap-2 w-1/4">
                                {{ __('dashboard.recovered') }}
                                <a
                                    href="{{ route('statistics', ['column' => 'recovered', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                    <x-statistics.arrows :desc="request('column') === 'recovered' && request('order') === 'desc'" />
                                </a>
                            </th>
                            <th scope="col" class="break-all flex items-center gap-1 md:gap-2 w-1/4">
                                {{ __('dashboard.deaths') }}
                                <a
                                    href="{{ route('statistics', ['column' => 'deaths', 'order' => $order === 'asc' ? 'desc' : 'asc']) }}">
                                    <x-statistics.arrows :desc="request('column') === 'deaths' && request('order') === 'desc'" />
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody
                        class="flex flex-col items-center justify-between overflow-y-scroll w-full max-h-[250px] md:max-h-[450px]">
                        <tr
                            class="flex w-full  border-b-[1px] border-gray-200 text-[11px] md:text-[15px] text-black font-normal p-4 md:px-10 md:py-5 capitalize">
                            <td class="break-all w-1/4">{{ $worldwideStats['name'][app()->getLocale()] }}</td>
                            <td class="break-all w-1/4">{{ number_format($worldwideStats['confirmed']) }}</td>
                            <td class="break-all w-1/4">{{ number_format($worldwideStats['recovered']) }}</td>
                            <td class="break-all w-1/4">{{ number_format($worldwideStats['deaths']) }}</td>
                        </tr>
                        @foreach ($statistics as $statistic)
                            <tr
                                class="flex w-full  border-b-[1px] border-gray-200 text-[11px] md:text-[15px] text-black font-normal p-4 md:px-10 md:py-5 capitalize">
                                <td class="break-all w-1/4">{{ $statistic->name }}</td>
                                <td class="break-all w-1/4">{{ number_format($statistic->confirmed) }}</td>
                                <td class="break-all w-1/4">{{ number_format($statistic->recovered) }}</td>
                                <td class="break-all w-1/4">{{ number_format($statistic->deaths) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
