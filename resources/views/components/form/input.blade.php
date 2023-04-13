@props(['name'])
<x-form.field>
    <x-form.label name="{{ $name }}" />
    <input id="{{ $name }}" name="{{ $name }}"
        class="px-6 py-4 border border-gray-400 focus:border-primary transition-all duration-300 rounded-md outline-none capitalize text-gray-700 "
        {{ $attributes(['value' => old('name')]) }}>
    <p class="text-xs font-bold text-black"></p>
    <x-form.error name="{{ $name }}" />
</x-form.field>
