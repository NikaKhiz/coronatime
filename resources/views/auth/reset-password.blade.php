<x-layout>
    <div class="w-full h-screen md:h-auto">
        <div class="md:max-w-[400px] md:gap-14 mx-auto h-full">
            <x-navigation />
            <main class="px-4 py-6 md:px-0 md:py-28 h-[80%]">
                <form action="{{ route('password.update') }}" method="POST" class="flex flex-col gap-12 w-full h-[100%] ">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="email" name="email" id="email" hidden value='{{ request()->input('email') }}'>

                    <h1 class="text-black font-bold text-2xl md:text-3xl text-center">Reset Password
                    </h1>
                    <div class="w-full h-full flex flex-col md:gap-12  justify-between">
                        <div class="flex flex-col gap-4">
                            <x-form.field>
                                <label for="password" class="capitalize text-black font-bold text-[15px]">New
                                    password</label>
                                <div class="flex flex-col gap-3 relative">
                                    <input type="password" id="password" name="password"
                                        placeholder="Enter new password"
                                        class="px-6 py-4 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-500' }} focus:border-primary transition-all duration-300 rounded-md outline-none text-gray-700 w-full">
                                    @if ($errors->has('password'))
                                        <div class="flex items-center gap-2">
                                            <img src="{{ asset('images/error.svg') }}" alt="errorImg" class="">
                                            <x-form.error name="password" />
                                        </div>
                                    @endif
                                </div>
                            </x-form.field>
                            <x-form.field>
                                <label for="password_confirmation"
                                    class="capitalize text-black font-bold text-[15px]">New
                                    Repeat Password</label>
                                <div class="flex flex-col gap-3 relative">
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        placeholder="Enter new password"
                                        class="px-6 py-4 border {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-gray-500' }} focus:border-primary transition-all duration-300 rounded-md outline-none text-gray-700 w-full">
                                    @if ($errors->has('password_confirmation'))
                                        <div class="flex items-center gap-2">
                                            <img src="{{ asset('images/error.svg') }}" alt="errorImg" class="">
                                            <x-form.error name="password_confirmation" />
                                        </div>
                                    @endif
                                </div>
                            </x-form.field>
                        </div>
                        <x-form.button>Reset Password</x-form.button>
                    </div>
                </form>
            </main>
        </div>
</x-layout>
