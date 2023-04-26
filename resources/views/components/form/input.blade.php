@props(['name','label'])
@php
    $error = $errors->has("$name");
    $success = !$error && !empty(old("$name"));
@endphp
<x-form.field>
    <x-form.label name="{{ $label }}" />
    <div class="flex flex-col gap-3 relative">
        <input id="{{ $name }}" name="{{ $name }}"
            class="px-6 py-4 border {{ $error ? 'border-red-500' : ($success ? 'border-success' : 'border-gray-500') }} focus:border-primary transition-all duration-300 rounded-md outline-none text-gray-700 w-full"
            {{ $attributes(['value' => old('name')]) }}>
        @if ($success)
            <img src="{{ asset('images/success.svg') }}" alt="successImg"
                class="absolute top-1/2 right-5 transform -translate-y-[50%]">
        @endif
        @if ($errors->has("$name"))
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/error.svg') }}" alt="errorImg" class="">
                <x-form.error name="{{ $name }}" />
            </div>
        @endif
    </div>
</x-form.field>
