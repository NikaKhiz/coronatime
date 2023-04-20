<div x-data="{ show: false }" class="block md:hidden relative">
    <button @click="show = ! show"><img src="{{ asset('images/hamburger.svg') }}" alt="hamburgerIcon"
            class="w-5 h-5" /></button>

    <div x-show="show" class="flex flex-col gap-2 p-4 rounded-md absolute top-[150%] right-0  bg-gray-50 text-gray-500">
        {{ $slot }}
    </div>

</div>
