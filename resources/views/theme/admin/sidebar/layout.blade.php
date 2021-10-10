<div class="wrapper">
    <x-theme-sidebar>
        @theme(".menu")
    </x-theme-sidebar>

    <x-theme-main>
        {{$slot}}
    </x-theme-main>
</div>