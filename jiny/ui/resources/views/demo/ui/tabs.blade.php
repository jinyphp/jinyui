<script>

</script>
<x-jiny-theme theme="adminkit" class="bootstrap">
    <x-main>
        <x-main-content>

            <div class="container-fluid p-0">

                <div class="mb-3">
                    <h1 class="h3 d-inline align-middle">Tabs</h1>
                    <a class="badge bg-primary ms-2" href="https://adminkit.io/pricing/" target="_blank">Pro
                        Component <i class="fas fa-fw fa-external-link-alt"></i>
                    </a>
                </div>

                <div class="row">
                    {{--
                    @include("jinyui::demo.ui.tabs.basic")
                    @include("jinyui::demo.ui.tabs.colortab")
                    --}}
                    @include("jinyui::demo.ui.tabs.virtical")

                </div>

            </div>

        </x-main-content>
    </x-main>
</x-jiny-theme>   