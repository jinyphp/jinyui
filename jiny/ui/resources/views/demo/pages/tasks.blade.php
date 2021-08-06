<x-theme theme="adminkit" class="bootstrap">
    <x-main-content>
        <x-container>
            <a href="#" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New task</a>
                <div class="mb-3">
                    <h1 class="h3 d-inline align-middle">Tasks</h1>                    
                </div>

                <x-row>
                    <div class="col-12 col-lg-6 col-xl-4">
                        @include('jinyui::demo.pages.tasks.backlog')                        
                    </div>
                    <div class="col-12 col-lg-6 col-xl-4">
                        @include('jinyui::demo.pages.tasks.progress')
                    </div>
                    <div class="col-12 col-lg-6 col-xl-4">
                        @include('jinyui::demo.pages.tasks.completed')
                    </div>
                </x-row>
        
        </x-container>
    </x-main-content>
</x-theme>   