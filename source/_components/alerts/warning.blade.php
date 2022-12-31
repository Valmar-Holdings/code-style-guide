@props ([
    "message",
    "title",
])

<div
    class="p-4 border-l-4 border-yellow-400 bg-yellow-50"
>
    <div
        class="flex"
    >
        <div
            class="flex-shrink-0"
        >
            <x-icons.solid.triangle-exclamation
                class="w-5 h-5 text-yellow-400"
            />
        </div>
        <div class="ml-3">

            @if ($title ?? false)
                <h3
                    class="text-sm font-medium text-yellow-800"
                >
                    {{ $title }}
                </h3>
            @endif

            @if ($message ?? false)
                <p class="text-sm text-yellow-700">
                    {!! $message !!}
                </p>
            @endif

        </div>
    </div>
</div>
