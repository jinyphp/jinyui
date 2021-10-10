<style>
.sidemenu {

}

.sidemenu .sidebar-header {
    background: transparent;
    padding: 1.5rem 1.5rem .375rem;
    font-size: .75rem;
    color: #ced4da
}


.sidemenu .sidebar-item {
    display: block;
    padding: .625rem 1.625rem;
    font-weight: 400;
    transition: background .1s ease-in-out;
    position: relative;
    text-decoration: none;
    cursor: pointer;
    color: rgba(233, 236, 239, .5);
    background: #222e3c;
    border-left: 3px solid transparent;
}

.sidemenu .sidebar-item:focus {
    outline: 0
}

.sidemenu .sidebar-item:hover {
    background: #222e3c;
    border-left-color: transparent;
    color: rgba(233, 236, 239, .75);
}

</style>

<ul class="sidemenu">
    <x-jiny-sidebar-header>
        Pages
    </x-jiny-sidebar-header>
    
    <x-jiny-sidebar-item>
        <x-slot name="icon">
            {{-- adjustments --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
            </svg>
        </x-slot>
        AAA
    </x-jiny-sidebar-item>

    <x-jiny-sidebar-item>
        BBB
    </x-jiny-sidebar-item>

    <x-jiny-sidebar-sub>
        <x-slot name="title">CCC</x-slot>
        
        <x-jiny-sidebar-item>
            C-1
        </x-jiny-sidebar-item>
        <x-jiny-sidebar-item>
            C-2
        </x-jiny-sidebar-item>
        <x-jiny-sidebar-item>
            C-3
        </x-jiny-sidebar-item>

    </x-jiny-sidebar-sub>

    <x-jiny-sidebar-sub>
        <x-slot name="title">DDD</x-slot>
        
        <x-jiny-sidebar-item>
            D-1
        </x-jiny-sidebar-item>
        <x-jiny-sidebar-item>
            D-2
        </x-jiny-sidebar-item>
        <x-jiny-sidebar-sub>
            <x-slot name="title">D-3</x-slot>
            <x-jiny-sidebar-item>
                DD-1
            </x-jiny-sidebar-item>
            <x-jiny-sidebar-item>
                DD-2
            </x-jiny-sidebar-item>
            
        </x-jiny-sidebar-sub>

    </x-jiny-sidebar-sub>

    <x-jiny-sidebar-item>
        EEE
    </x-jiny-sidebar-item>
    <x-jiny-sidebar-item>
        FFF
    </x-jiny-sidebar-item>
</ul>