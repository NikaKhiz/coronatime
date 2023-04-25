<x-layout>
    <div class="flex justify-between">
        <div class="w-full">
            <x-navigation />
            <main class="px-4 py-6 md:px-0 md:pl-24 md:py-5">
                <form action="{{ route('login_user') }}" method="POST"
                    class="flex flex-col gap-6 w-full md:max-w-[400px]">
                    @csrf
                    <div class="flex flex-col gap-2 md:gap-4">
                        <h1 class="text-black  font-black text-2xl md:text-3xl">{{ __('login.welcome_back') }}</h1>
                        <p class="text-gray-600 font-normal text-[15px] md:text-[20px]">{{ __('login.welcome_details') }}
                        </p>
                    </div>
                    <x-form.input name="username" label="{{ __('form.username') }}"
                        placeholder="{{ __('form.username_ph') }}" :value="old('username')" />
                    <x-form.input name="password" label="{{ __('form.password') }}" type="password"
                        placeholder="{{ __('form.password_ph') }}" />
                    <div class="flex justify-between items-center text-[15px]">
                        <x-form.checkbox name="remember" />
                        <a href="{{ route('password.request') }}"
                            class="capitalize font-semibold text-primary">{{ __('login.forgot_pwd') }}</a>
                    </div>
                    <x-form.button>{{ __('login.log_in') }}</x-form.button>
                </form>
                <p class="text-gray-400 font-normal text-[15px] mt-6 text-center md:max-w-[400px]">
                    {{ __('login.not_user') }}
                    <a href="{{ route('view.register') }}"
                        class="text-black font-bold ">{{ __('login.register_link') }}</a>
                </p>
            </main>
        </div>
        <div class="hidden md:block lg:min-w-[600px]">
            <img src="{{ asset('images/medications.png') }}" alt="" class="min-h-screen  object-cover ">
        </div>
    </div>
</x-layout>
