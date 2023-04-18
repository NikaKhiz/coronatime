@props(['name'])
<x-form.field>
    <x-form.label name="{{ $name }}" />
    <div class="flex flex-col gap-3">
        <input id="{{ $name }}" name="{{ $name }}"
            class="px-6 py-4 border {{ $errors->has("$name") ? 'border-red-500' : 'border-gray-500' }} focus:border-primary transition-all duration-300 rounded-md outline-none text-gray-700 w-full"
            {{ $attributes(['value' => old('name')]) }}>
        @if ($errors->has("$name"))
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/error.svg') }}" alt="errorImg" class="">
                <x-form.error name="{{ $name }}" />
            </div>
        @endif
    </div>
</x-form.field>
