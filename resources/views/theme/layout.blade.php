{{-- sidebar --}}
<x-layout-sidebar>
    @include("theme.sidebar")
</x-layout-sidebar>

{{-- content --}}
<x-layout-content style="background-color: #ebeef0">
    <x-flex-item class="bg-white p-4 flex">
        {{-- Left --}}
        <x-sidebar-button />

        {{-- right --}}
        <div class="flex-grow">                    
            @include("theme.header")
        </div>
    </x-flex-item>
    
    <x-flex-auto class="p-3">
        {{$slot}}
    </x-flex-item>

    <x-flex-item>
        @include("theme.footer")
    </x-flex-item>
</x-layout-content>