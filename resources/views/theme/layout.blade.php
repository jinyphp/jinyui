{{-- sidebar --}}
<x-layout-sidebar class="overflow-x-hidden overflow-y-auto">
    @include("theme.sidebar")
</x-layout-sidebar>

{{-- content --}}
<x-layout-content class="relative">
    <x-flex-item class="bg-white p-2 flex">
        {{-- Left --}}
        <x-sidebar-button />
    
        {{-- right --}}
        <div class="flex-grow">
            {{-- @include("theme.header", ['title' => $title, 'control'=>$control]) --}}
        </div>
    </x-flex-item>
        
    <x-flex-auto>
        {{$slot}}
    </x-flex-item>
    
    <x-flex-item>
        @include("theme.footer")
    </x-flex-item>
</x-layout-content>