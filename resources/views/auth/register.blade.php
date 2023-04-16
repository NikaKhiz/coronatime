<x-layout>
    <div class="flex justify-between">
        <div class="w-full">
            <x-navigation />
            <main class="px-4 py-6 md:px-0 md:pl-24 md:py-5">
                <form action="{{ route('register_user') }}" method="POST" class="flex flex-col gap-6 w-full md:w-[400px]">
                    @csrf
                    <div class="flex flex-col gap-2 md:gap-4">
                        <h1 class="text-black font-bold text-2xl md:text-3xl">Welcome to Coronatime</h1>
                        <p class="text-gray-600 font-normal text-lg mg:text-2xl">Please enter required info to sign up
                        </p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <x-form.input name="username" placeholder="Enter unique username" :value="old('username')" />
                        @if (!$errors->has('username'))
                            <p class="text-xs text-gray-600 font-normal">Username should be unique, min 3 symbols </p>
                        @endif
                    </div>
                    <div class="flex flex-col gap-2">
                        <x-form.input name="email" placeholder="Enter your email" :value="old('email')" />
                        @if (!$errors->has('email'))
                            <p class="text-xs text-gray-600 font-normal">Email should be unique, valid email </p>
                        @endif
                    </div>
                    <div class="flex flex-col gap-2">
                        <x-form.input name="password" type="password" placeholder="Fill in password" />
                        <p class="text-xs text-gray-600 font-normal">Password should be min 3 symbols </p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <x-form.field>
                            <label for="password_confirmation" class="capitalize text-black font-bold text-lg">Repeat
                                password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Repeat password"
                                class="px-6 py-4 border border-gray-400 focus:border-primary transition-all duration-300 rounded-md outline-none capitalize text-gray-700">
                        </x-form.field>
                        <p class="text-xs text-gray-600 font-normal">Repeat password must match password </p>
                    </div>
                    <x-form.button>Sign Up</x-form.button>
                </form>
                <p class="text-gray-400 font-normal text-lg mt-6 text-center md:max-w-[400px]"> Already have an
                    account? <a href="{{ route('view.login') }}" class="text-black font-bold ">Log in</a></p>
            </main>
        </div>
        <div class="hidden md:block lg:min-w-[600px]">
            <img src="{{ asset('images/medications.png') }}" alt="" class="min-h-screen h-full object-cover ">
        </div>
    </div>
</x-layout>
