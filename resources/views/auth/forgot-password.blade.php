<x-layout>
    <div class="w-full h-screen md:h-auto">
        <div class="md:max-w-[400px] md:gap-14 mx-auto h-full">
            <x-navigation />
            <main class="px-4 py-6 md:px-0 md:py-28 h-[80%]">
                <form action="{{ route('password.email') }}" method="POST" class="flex flex-col gap-12 w-full h-[100%] ">
                    @csrf
                    <h1 class="text-black font-bold text-lg md:text-2xl text-center">Reset Password
                    </h1>
                    <div class="w-full h-[100%] flex flex-col gap-6 md:gap-14  justify-between">
                        <x-form.input name="email" placeholder="Enter your email" :value="old('email')" />
                        <x-form.button>Reset Password</x-form.button>
                    </div>
                </form>
            </main>
        </div>
</x-layout>
