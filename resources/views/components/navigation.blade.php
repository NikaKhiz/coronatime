<nav class="flex items-center justify-between px-4 py-6 md:px-0 md:pl-24 md:py-10">
    @auth
    @else
        <a href="{{ route('view.login') }}">
            <img src="{{ asset('images/coronatime-dark.svg') }}" alt="coronatimeImg">
        </a>
    @endauth
    <div class="items-center gap-12 hidden">
        <select name="lang" id="lang"
            class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 capitalize">
            <option value="en" selected>english</option>
            <option value="ka">georgian</option>
        </select>
        <div class="flex items-center text-lg gap-4">
            <p class="font-bold text-black capitalize ">john doe</p>
            <div class="w-[1px] h-5 bg-gray-500"></div>
            <button class="capitalize">log out</button>
        </div>
        <button class="block md:hidden"><img src="{{ asset('images/hamburger.svg') }}" alt="hamburgerIcon"></button>
    </div>
</nav>
