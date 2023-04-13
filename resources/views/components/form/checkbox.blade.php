@props(['name'])
<x-form.field>
    <div class="flex items-center gap-2">
        <input id="{{ $name }}" name="{{ $name }}" type="checkbox" class="accent-success">
        <label for="{{ $name }}" class="capitalize text-xs text-black font-bold">Remember this device</label>
    </div>
    <x-form.error name="{{ $name }}" />
</x-form.field>
