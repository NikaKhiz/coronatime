<x-layout>
    <div class="flex justify-between">
        <div class="w-full">
            <x-navigation />
            <main class="px-4 py-6 md:px-0 md:pl-24 md:py-5">
                <div class="flex flex-col gap-2 md:gap-4 mb-6">
                    <h1 class="text-black  font-black text-2xl md:text-3xl">{{ __('login/login.welcome_back') }}</h1>
                    <p class="text-gray-600 font-normal text-[15px] md:text-[20px]">
                        {{ __('login/login.welcome_details') }}
                    </p>
                </div>
                <form action="{{ route('login_user') }}" method="POST"
                    class="flex flex-col gap-6 w-full md:max-w-[400px]">
                    @csrf

                    <x-form.input name="username" label="{{ __('login/form.username') }}"
                        placeholder="{{ __('login/form.username_placeholder') }}" :value="old('username')" />
                    <x-form.input name="password" label="{{ __('login/form.password') }}" type="password"
                        placeholder="{{ __('login/form.password_placeholder') }}" />
                    <div class="flex justify-between items-center text-[15px]">
                        <x-form.checkbox name="remember" />
                        <a href="{{ route('view.forgot_password') }}"
                            class="capitalize font-semibold text-primary">{{ __('login/login.forgot_password') }}</a>
                    </div>
                    <x-form.button>{{ __('login/login.log_in') }}</x-form.button>
                </form>
                <p class="text-gray-400 font-normal text-[15px] mt-6 text-center md:max-w-[400px]">
                    {{ __('login/login.not_user') }}
                    <a href="{{ route('view.register') }}"
                        class="text-black font-bold ">{{ __('login/login.register_link') }}</a>
                </p>
            </main>
        </div>
        <div class="hidden md:block lg:min-w-[600px]">
            <img src="{{ asset('images/medications.png') }}" alt="" class="min-h-screen  object-cover ">
        </div>
    </div>
</x-layout>
