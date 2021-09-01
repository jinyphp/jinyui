@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-4 py-2 border-b">
        <div class="text-lg">
            {{ $title }}
        </div>
    </div>

    <div class="px-4 py-2">
        <div class="mt-4">
            {{ $content }}
        </div>
    </div>

    <div class="px-4 py-2 bg-gray-100 text-right">
        {{ $footer }}
    </div>
</x-modal>
