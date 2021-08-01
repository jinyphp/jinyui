<x-jinyui-theme theme="adminkit" class="bootstrap">
    <div class="main">
        <main class="content">
            <div class="container-fluid p-0">

                <div class="mb-3">
                    <h1 class="h3 d-inline align-middle">Clients</h1>
                    <a class="badge bg-primary ms-2" href="https://adminkit.io/pricing/" target="_blank">
                        Pro Component 
                    </a>
                </div>

                <div class="row">
                    <div class="col-xl-8">
                        @include("jinyui::demo.pages.page.clients.list")
                    </div>

                    <div class="col-xl-4">
                        @include("jinyui::demo.pages.page.clients.info")
                    </div>
                </div>

            </div>
        </main>
    </div>
</x-jiny-theme>   