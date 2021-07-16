<x-theme theme="adminkit" class="bootstrap">

    <div class="main">
        <main class="content">
            <div class="container-fluid p-0">

                <h1 class="h3 mb-3">Tables</h1>

                <div class="row">
                    <div class="col-12 col-xl-6">
                        @include("jinyui::demo.tables.table-basic")                        
                    </div>

                    <div class="col-12 col-xl-6">
                        @include("jinyui::demo.tables.table-striped") 
                    </div>

                    <div class="col-12 col-xl-6">
                        @include("jinyui::demo.tables.table-condensed")
                    </div>

                    <div class="col-12 col-xl-6">
                        @include("jinyui::demo.tables.table-hoverable")
                    </div>

                    <div class="col-12 col-xl-6">
                        @include("jinyui::demo.tables.table-boarderd")
                    </div>

                    <div class="col-12 col-xl-6">
                        @include("jinyui::demo.tables.table-contextual")                       
                    </div>

                    <div class="col-12">
                        @include("jinyui::demo.tables.table-responsive")
                    </div>
                </div>

            </div>
        </main>
    </div>

</x-theme>   