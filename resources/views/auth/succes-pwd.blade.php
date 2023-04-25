<x-layout>
    <div class="w-full h-screen md:h-auto">
        <div class="md:max-w-[400px] md:gap-14 mx-auto ">
            <x-navigation />
            <div
                class="fixed -z-10 top-0 left-0 w-full h-full flex flex-col items-center justify-center text-center text-[15px] md:text-lg font-normal md:gap-24 px-4 py-6  md:px-24 md:py-10">
                <div class="flex flex-col items-center justify-center gap-4 h-full md:h-auto">
                    <img src="{{ asset('images/checkmark.gif') }}" alt="confirmationCheckmark" class="w-14 h-14">
                    <p class="text-xl text-black font-normal">{{ __('email/success.password') }}</p>
                </div>
                <a href="{{ route('view.login') }}"
                    class="uppercase text-white bg-green-600 rounded-md p-4 px-5 w-full max-w-[400px] text-center font-black">{{ __('login/login.log_in') }}</a>
            </div>
        </div>
</x-layout>
