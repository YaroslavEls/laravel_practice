@props(['comment'])

<x-panel class="bg-gray-50">
    <article class="flex space-x-4">
        <div class="flex-shrink-0">
            <img src="https://i.pravatar.cc/60?u={{ $comment->user_id }}" alt="" width="60" height="60" class="rounded-xl">
        </div>

        <div>
            <header class="mb-4">
                <h3 class="font-bold">{{ $comment->author->username }}</h3>

                <p class="text-xs">
                    Posted
                    <time>{{ $comment->created_at->format('F j, Y, g:i a') }}</time>
                </p>
            </header>

            <p>
                {{ $comment->body }}
            </p>
        </div>
    </article>

    <hr class="mt-5">

    <form class="mt-5" method="POST" action="/comments/{{ $comment->id }}/favorites">
        @csrf

        <button
            type="submit"
            class="bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600"
            {{ $comment->isFavorited() ? 'disabled' : '' }}>

            {{ $comment->favorites_count }} {{ Str::plural('Favorite', $comment->favorites_count) }}
        </button>
    </form>
</x-panel>
