<x-layout>
    <div class="flex justify-between">
        <div class="w-full">
            <x-navigation />
            <main class="px-4 py-6 md:px-0 md:pl-24 md:py-5">
                <div class="flex flex-col gap-2 md:gap-4 mb-6">
                    <h1 class="text-black font-black text-2xl md:text-3xl">{{ __('register/register.welcome_back') }}
                    </h1>
                    <p class="text-gray-600 font-normal text-[15px] md:text-[20px]">
                        {{ __('register/register.welcome_details') }}
                    </p>
                </div>
                <form action="{{ route('register_user') }}" method="POST" class="flex flex-col gap-6 w-full md:w-[400px]">
                    @csrf

                    <div class="flex flex-col gap-2">
                        <x-form.input name="username" label="{{ __('register/form.username') }}"
                            placeholder="{{ __('register/form.username_ph') }}" :value="old('username')" />
                        @if (!$errors->has('username'))
                            <p class="text-xs text-gray-600 font-normal">{{ __('register/form.username_ref') }}</p>
                        @endif
                    </div>
                    <div class="flex flex-col gap-2">
                        <x-form.input name="email" label="{{ __('register/form.email') }}"
                            placeholder="{{ __('register/form.email_ph') }}" :value="old('email')" />
                        @if (!$errors->has('email'))
                            <p class="text-xs text-gray-600 font-normal">{{ __('register/form.email_ref') }}</p>
                        @endif
                    </div>
                    <div class="flex flex-col gap-2">
                        <x-form.input name="password" label="{{ __('register/form.password') }}" type="password"
                            placeholder="{{ __('register/form.password_ph') }}" />
                        @if (!$errors->has('password'))
                            <p class="text-xs text-gray-600 font-normal">{{ __('register/form.password_ref') }}</p>
                        @endif
                    </div>
                    <div class="flex flex-col gap-2">
                        <x-form.field>
                            <label for="password_confirmation"
                                class="capitalize text-black font-bold text-lg">{{ __('register/form.password_repeat') }}</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="{{ __('register/form.password_repeat') }}"
                                class="px-6 py-4 border {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-gray-500' }}  focus:border-primary transition-all duration-300 rounded-md outline-none capitalize text-gray-700">
                        </x-form.field>
                        @if (!$errors->has('password_confirmation'))
                            <p class="text-xs text-gray-600 font-normal">{{ __('register/form.password_repeat_ref') }}
                            </p>
                        @else
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('images/error.svg') }}" alt="errorImg" class="">
                                <x-form.error name="password_confirmation" />
                            </div>
                        @endif

                    </div>
                    <x-form.button>{{ __('register/register.register') }}</x-form.button>
                </form>
                <p class="text-gray-400 font-normal text-[15px] mt-6 text-center md:max-w-[400px]">
                    {{ __('register/register.registered') }} <a href="{{ route('view.login') }}"
                        class="text-black font-bold ">{{ __('register/register.login_link') }}</a></p>
            </main>
        </div>
        <div class="hidden md:block lg:min-w-[600px]">
            <img src="{{ asset('images/medications.png') }}" alt="" class="min-h-screen h-full object-cover ">
        </div>
    </div>
</x-layout>
