<x-layout>
    <div class="w-full h-screen md:h-auto">
        <div class="md:max-w-[400px] md:gap-14 mx-auto ">
            <x-navigation />
            <main class="px-4 py-6 md:px-0 md:py-28 h-[80%]">
                <form action="{{ route('password.update') }}" method="POST" class="flex flex-col gap-6 w-full h-[100%] ">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="email" name="email" id="email" hidden value='{{ request()->input('email') }}'>

                    <h1 class="text-black font-bold text-2xl md:text-3xl text-center">Reset Password
                    </h1>
                    <div class="w-full h-[100%] flex flex-col gap-6 md:gap-14  justify-between">
                        <x-form.field>
                            <label for="password" class="capitalize text-black font-bold text-lg">New
                                password</label>
                            <input type="password" id="password" name="password" placeholder="Enter new password"
                                class="px-6 py-4 border border-gray-400 focus:border-primary transition-all duration-300 rounded-md outline-none capitalize text-gray-700">
                        </x-form.field>
                        <x-form.field>
                            <label for="password_confirmation" class="capitalize text-black font-bold text-lg">Repeat
                                password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Repeat password"
                                class="px-6 py-4 border border-gray-400 focus:border-primary transition-all duration-300 rounded-md outline-none capitalize text-gray-700">
                        </x-form.field>
                        <x-form.button>Reset Password</x-form.button>
                    </div>
                </form>
            </main>
        </div>
</x-layout>
