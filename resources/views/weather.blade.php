<x-layout>
    <h1>hello world</h1>

    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">Search for a weather in your region!</h1>

            <form method="POST" action="/weather" class="mt-10">
                @csrf

                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                           for="name"
                    >
                        City
                    </label>

                    <input class="border border-gray-400 p-2 w-full"
                           type="text"
                           name="city"
                           id="city"
                           value="{{ old('city') }}"
                           required
                    >

                    @error('city')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <button type="submit"
                            class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
                    >
                        Submit
                    </button>
                </div>
            </form>

        </main>
    </section>
</x-layout>
