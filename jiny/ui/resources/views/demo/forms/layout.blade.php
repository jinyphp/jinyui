<x-jiny-theme theme="adminkit" class="bootstrap">
    <div class="main">
        <main class="content">
            <div class="container-fluid p-0">

                <div class="mb-3">
                    <h1 class="h3 d-inline align-middle">Form Layouts</h1>
                    
                    <a class="badge bg-primary ms-2" href="https://adminkit.io/pricing/" target="_blank">Pro Component <i class="fas fa-fw fa-external-link-alt"></i></a>
                </div>

                <x-row>
                    <x-col class="col-12 col-xl-6">
                        @include("jinyui::demo.forms.layouts.basic",['form'=>CForm()])
                        {{-- @include2("layouts.basic") --}}
                    </x-col>
                    <x-col class="col-12 col-xl-6">
                        @include("jinyui::demo.forms.layouts.horizontal",['form'=>CForm()])
                        {{-- @include2("layouts.horizontal") --}}
                    </x-col>
                    <x-col class="col-md-12">
                        @include("jinyui::demo.forms.layouts.row",['form'=>CForm()])
                        {{-- @include2("layouts.row") --}}
                    </x-col>
                    <x-col class="col-md-12">
                        @include("jinyui::demo.forms.layouts.inline")
                    </x-col>

    
                </x-row>


            </div>
        </main>
    </div>
</x-jiny-theme>   