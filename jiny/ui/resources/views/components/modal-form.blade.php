@props(['id' => null, 'maxWidth' => null])

<x-jinyui::modal :id="$id" :maxWidth="$maxWidth" {{ $attributes->merge(['class' => '']) }}>
    <div class="flex flex-row justify-between items-center px-4 py-2 border-b">
        <div class="text-lg">
            @if (isset($title))
                {{ $title }}
            @endif
        </div>
        <div>
            <button wire:click="modalClose">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <form>
        <div class="px-4 py-2">
            <div class="mt-4">
                {{ $content }}        
            </div>
        </div>

        <div class="px-4 py-2 bg-gray-100 text-right">
            {{ $footer }}
        </div>
    </form>

    {{$slot}}
</x-jinyui::modal>
