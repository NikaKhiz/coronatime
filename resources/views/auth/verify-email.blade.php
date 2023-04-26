<x-layout>
    <div class="w-full h-screen md:h-auto">
        <div class="md:max-w-[400px] md:gap-14 mx-auto ">
            <x-navigation />
            <div
                class="flex flex-col items-center gap-4 fixed top-[250px] md:top-[300px] left-[50%] transform -translate-x-[50%] -translate-y-[50%] w-full p-4 text-center md:text-left ">
                <img src="{{ asset('images/checkmark.gif') }}" alt="confirmationCheckmark">
                <p class="text-xl text-black font-normal">{{ __('email/verify.email') }}</p>
            </div>
        </div>
</x-layout>
