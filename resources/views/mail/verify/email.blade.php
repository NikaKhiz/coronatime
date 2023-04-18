<x-mail::message>
    <img src="{{ asset('images/statistics.svg') }}" alt="coronaStatistics">
    <h1>Confirmation email</h1>
    <p>click this button to verify</p>
    <x-mail::button :url="$url" color="success">
        VERIFY EMAIL
    </x-mail::button>
</x-mail::message>
