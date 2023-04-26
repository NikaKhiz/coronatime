<nav class="flex items-center justify-between px-4 py-6 md:px-24 md:py-10 mx-auto">
    @auth
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('images/coronatime-neutral.svg') }}" alt="coronatimeImg" class="w-[140px] md:w-[170px]">
        </a>
        <div class="flex items-center gap-8 md:gap-12">
            <div x-data="{ show: false }" @click="show = !show"
                class="flex items-center justify-between p-1 md:p-2 text-sm text-black font-normal  rounded-md capitalize cursor-pointer relative min-w-[100px]">
                <p>{{ app()->getlocale() === 'en' ? 'english' : 'georgian' }}</p>
                <img src="{{ asset('images/dropdown.svg') }}" alt="dropdownImg">
                <div x-show="show"
                    class="flex flex-col w-full absolute top-[100%] left-0  gap-1 py-2 px-1 text-sm text-gray-500 border rounded-md bg-gray-50 capitalize">
                    <a href="{{ route('change_language', 'en') }}">english</a>
                    <a href="{{ route('change_language', 'ka') }}">georgian</a>
                </div>
            </div>
            <div class="items-center text-lg gap-4 hidden md:flex">
                <p class="font-bold text-black capitalize ">{{ auth()->user()->username }}</p>
                <div class="w-[1px] h-5 bg-gray-200"></div>
                <a href="{{ route('logout_user') }}"
                    class="capitalize text-black font-normal pointer">{{ __('dashboard.logout') }}</a>
            </div>
            <x-dropdown>
                <a href="#" class="font-normal capitalize">{{ auth()->user()->username }}</a>
                <a href="{{ route('logout_user') }}"
                    class="capitalize font-normal pointer">{{ __('dashboard.logout') }}</a>
            </x-dropdown>
        </div>
    @else
        <a href="{{ route('view.login') }}">
            <img src="{{ asset('images/coronatime-dark.svg') }}" alt="coronatimeImg" />
        </a>
    @endauth

</nav>
