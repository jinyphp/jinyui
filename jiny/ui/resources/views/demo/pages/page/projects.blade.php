<x-jinyui-theme theme="adminkit" class="bootstrap">

    <div class="main">
        <main class="content">
            <div class="container-fluid p-0">

                <a href="#" class="btn btn-primary float-end mt-n1">
                    <i class="fas fa-plus"></i> 
                    New project
                </a>
                <div class="mb-3">
                    <h1 class="h3 d-inline align-middle">Projects</h1><a class="badge bg-primary ms-2" href="https://adminkit.io/pricing/" target="_blank">Pro Component <i class="fas fa-fw fa-external-link-alt"></i></a>
                </div>

                <div class="row">
                    <x-jinyui-layout-tile>
                        @include('jinyui::demo.pages.page.projects.task1')
                    </x-jinyui-layout-tile>
                    <div class="col-12 col-md-6 col-lg-3">
                        @include('jinyui::demo.pages.page.projects.task1')
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        @include('jinyui::demo.pages.page.projects.task2')
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        @include('jinyui::demo.pages.page.projects.task3')
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        @include('jinyui::demo.pages.page.projects.task4')
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        @include('jinyui::demo.pages.page.projects.task5')
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        @include('jinyui::demo.pages.page.projects.task6')
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        @include('jinyui::demo.pages.page.projects.task7')
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        @include('jinyui::demo.pages.page.projects.task8')
                    </div>
                </div>

            </div>
        </main>
    </div>

</x-jiny-theme>   