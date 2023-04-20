<x-layout>
    <div class="flex justify-between">
        <div class="w-full">
            <x-navigation />
            <main class="px-4 py-6 md:px-0 md:pl-24 md:py-5">
                <form action="{{ route('login_user') }}" method="POST" class="flex flex-col gap-6 w-full md:w-[400px]">
                    @csrf
                    <div class="flex flex-col gap-2 md:gap-4">
                        <h1 class="text-black  font-black text-2xl md:text-3xl">Welcome back</h1>
                        <p class="text-gray-600 font-normal text-[15px] md:text-[20px]">Welcome back! Please enter your
                            details
                        </p>
                    </div>
                    <x-form.input name="username" placeholder="Enter unique username or email" :value="old('username')" />
                    <x-form.input name="password" type="password" placeholder="Fill in password" />
                    <div class="flex justify-between items-center text-[15px]">
                        <x-form.checkbox name="remember" />
                        <a href="{{ route('password.request') }}" class="capitalize font-semibold text-primary">Forgot
                            password?</a>
                    </div>
                    <x-form.button>Log In</x-form.button>
                </form>
                <p class="text-gray-400 font-normal text-[15px] mt-6 text-center md:max-w-[450px]">Don’t have and
                    account?
                    <a href="{{ route('view.register') }}" class="text-black font-bold ">Sign up for free</a>
                </p>
            </main>
        </div>
        <div class="hidden md:block lg:min-w-[600px]">
            <img src="{{ asset('images/medications.png') }}" alt="" class="min-h-screen  object-cover ">
        </div>
    </div>
</x-layout>
