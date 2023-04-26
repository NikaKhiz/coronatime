<h1 class="text-xl md:text-2xl font-black capitalize">{{ __('dashboard.worldwide') . ' ' . __('dashboard.statistics') }}
</h1>
<div class="flex gap-6 md:gap-16 capitalize mt-5 md:mt-10">
    <a href="{{ route('dashboard') }}"
        class="pb-2 {{ request()->routeIs('dashboard') ? ' border-black border-b-4' : '' }}">{{ __('dashboard.worldwide') }}</a>
    <a href="{{ route('statistics') }}"
        class="pb-2 {{ request()->routeIs('statistics') ? ' border-black border-b-4' : '' }}">{{ __('dashboard.by_country') }}</a>
</div>
