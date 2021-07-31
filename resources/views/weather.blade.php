<x-layout>
    <section class="px-6 py-8">
        <h1 class="font-bold text-xl mb-3">Weather in Kyiv</h1>

        <h2>Temperature: {{ $data->temperature }}</h2>
        <h2>Status: {{ $data->status }}</h2>

        <br>

        <a class="underline" href="/">Back to main page</a>
    </section>
</x-layout>
