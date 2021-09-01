@props(['id' => null, 'maxWidth'=>null, 'zindex'=>null ])

<x-jinyui::modal :id="$id" :maxWidth="$maxWidth" :zindex="$zindex" 
    {{ $attributes->merge(['class' => '']) }} >

    <div class="flex flex-row justify-between items-center px-4 py-2 border-b">
        <div class="text-lg">
            @if (isset($title))
                {{ $title }}
            @endif
        </div>
        <div>
            @if (isset($close))
                {{ $close }}
            @endif
            
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
