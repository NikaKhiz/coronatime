<nav class="flex items-center justify-between px-4 py-6 md:px-24 md:py-10 mx-auto">
    @auth
        <a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/coronatime-neutral.svg') }}" alt="coronatimeImg" class="w-[140px] md:w-[170px]">
        </a>
        <div class="flex items-center gap-8 md:gap-12">
            <select name="lang" id="lang"
                class="block p-1 md:p-2 text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 capitalize">
                <option value="en" selected>english</option>
                <option value="ka">georgian</option>
            </select>
            <div class="items-center text-lg gap-4 hidden md:flex">
                <a href="#" class="font-bold text-black capitalize ">{{ auth()->user()->username }}</a>
                <div class="w-[1px] h-5 bg-gray-200"></div>
                <a href="{{ route('logout_user') }}" class="capitalize font-normal pointer">logout</a>
            </div>
            <x-dropdown>
                <a href="#" class="font-normal capitalize">{{ auth()->user()->username }}</a>
                <a href="{{ route('logout_user') }}" class="capitalize font-normal pointer">logout</a>
            </x-dropdown>
        </div>
    @else
        <a href="{{ route('view.login') }}">
            <img src="{{ asset('images/coronatime-dark.svg') }}" alt="coronatimeImg" />
        </a>
    @endauth

</nav>
