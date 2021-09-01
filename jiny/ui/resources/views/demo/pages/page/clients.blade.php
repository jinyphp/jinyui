<x-theme theme="adminkit" class="bootstrap">
    <x-main-content>
        <x-container>
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Clients</h1>
            </div>

            <x-row>
                <x-col class="col-xl-8">
                    @include("jinyui::demo.pages.clients.list")
                </x-col>

                <x-col class="col-xl-4">
                    @include("jinyui::demo.pages.clients.info")
                </x-col>
            </x-row>

        </x-container>
    </x-main-content>

</x-theme>   