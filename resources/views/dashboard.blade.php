<x-layout>
    <x-navigation />
    <div class="px-4 py-6 md:px-24 md:py-10">
        @include('components.statistics._header')
        <div class="mt-6 md:mt- grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 capitalize">
            <x-statistics.stats-card class="bg-primary bg-opacity-10 p-8 md:p-10 col-span-2 md:col-span-1">
                <img src="{{ asset('images/cases.svg') }}" alt="" class="w-24 h-12 md:h-16">
                <div class="flex flex-col gap-4 text-center">
                    <p class="text-sm md:text-xl font-semibold">{{ __('dashboard.cases') }}</p>
                    <p class="text-2xl md:text-5xl text-primary font-black">
                        {{ number_format($worldwideStats['confirmed']) }}</p>
                </div>
            </x-statistics.stats-card>
            <x-statistics.stats-card class="bg-success bg-opacity-10 p-8 md:p-10">
                <img src="{{ asset('images/recovery.svg') }}" alt="" class="w-24 h-12 md:h-16">
                <div class="flex flex-col gap-4 text-center">
                    <p class="text-sm md:text-xl font-semibold">{{ __('dashboard.cases') }}</p>
                    <p class="text-2xl md:text-5xl text-success font-black">
                        {{ number_format($worldwideStats['recovered']) }}</p>
                </div>
            </x-statistics.stats-card>
            <x-statistics.stats-card class="bg-tertiary bg-opacity-10 p-8 md:p-10">
                <img src="{{ asset('images/death.svg') }}" alt="" class="w-24 h-12 md:h-16">
                <div class="flex flex-col gap-4 text-center">
                    <p class="text-sm md:text-xl font-semibold">{{ __('dashboard.deaths') }}</p>
                    <p class="text-2xl md:text-5xl text-tertiary font-black">
                        {{ number_format($worldwideStats['deaths']) }}</p>
                </div>
            </x-statistics.stats-card>
        </div>
    </div>
</x-layout>
