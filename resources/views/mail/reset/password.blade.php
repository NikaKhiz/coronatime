<x-mail::message>
    <img src="{{ asset('images/statistics.svg') }}" alt="coronaStatistics">
    <h1>Recover Password</h1>
    <p>click this button to recover password</p>
    <x-mail::button :url="$url" color="success">
        Recover Password
    </x-mail::button>
</x-mail::message>
