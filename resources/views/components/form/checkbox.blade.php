@props(['name'])
<x-form.field>
    <div class="flex items-center gap-2">
        <input id="{{ $name }}" name="{{ $name }}" type="checkbox" class="accent-success w-5 h-5">
        <label for="{{ $name }}"
            class="capitalize text-black font-semibold">{{ __('login.remember_device') }}</label>
    </div>
    <x-form.error name="{{ $name }}" />
</x-form.field>
