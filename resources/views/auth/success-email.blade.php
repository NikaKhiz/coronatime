<x-layout>
    <div class="w-full h-screen md:h-auto">
        <div class="md:max-w-[400px] md:gap-14 mx-auto ">
            <x-navigation />
            <div
                class="flex flex-col items-center gap-4 fixed top-[250px] left-[50%] transform -translate-x-[50%] -translate-y-[50%] w-full p-4 text-center md:text-left ">
                <img src="{{ asset('images/checkmark.gif') }}" alt="confirmationCheckmark">
                <p class="text-xl text-black font-normal">Your account is confirmed, you can sign in</p>
                <a href="{{ route('view.login') }}"
                    class="uppercase text-white bg-green-600 rounded-md p-4 mt-24 px-5 w-full max-w-[400px] text-center">sign
                    in</a>
            </div>
        </div>
</x-layout>
