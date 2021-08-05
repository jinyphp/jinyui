<x-theme theme="adminkit" class="bootstrap">
    <x-main-content>
        <x-container>
            <h1 class="h3">Border Style Tab</h1>

            <x-row>
                <x-col-6>
                    <x-card>
                        <x-card-header>
                            <h4 class="header-title">Tabs Bordered</h4>
                            <p class="text-muted font-14 mb-3">
                                The navigation item can have a simple bottom border as well. Just specify the class <code>.nav-bordered</code>.
                            </p>
                        </x-card-header>
                        <x-card-body>
                            <x-nav class="nav-pills bg-nav-pills mb-3">
                                <x-nav-item>
                                    <a href="#bordered-tabs-preview" 
                                        data-bs-toggle="tab" aria-expanded="false" 
                                        class="nav-link rounded-0 active">
                                        Preview
                                    </a>
                                </x-nav-item>
                                <x-nav-item>
                                    <a href="#bordered-tabs-code" 
                                        data-bs-toggle="tab" aria-expanded="true" 
                                        class="nav-link rounded-0">
                                        Code
                                    </a>
                                </x-nav-item>                               
                            </x-nav>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="bordered-tabs-preview">
                                    @include("jinyui::demo.tabs.codes.border")
                                </div> <!-- end preview-->
                            
                                <div class="tab-pane" id="bordered-tabs-code">
                                    code...
                                </div> <!-- end preview code-->
                            </div> <!-- end tab-content-->
                        </x-card-body>
                    </x-card>
                </x-col-6>

                <x-col-6>
                    <x-card>
                        <x-card-header>
                            <h4 class="header-title">Tabs Bordered Justified</h4>
                            <p class="text-muted font-14 mb-3">
                                The navigation item with a simple bottom border and justified
                            </p>
                        </x-card-header>
                        <x-card-body>
                            <x-nav class="nav-pills bg-nav-pills mb-3">
                                <x-nav-item>
                                    <a href="#bordered-justified-tabs-preview" 
                                        data-bs-toggle="tab" aria-expanded="false" 
                                        class="nav-link rounded-0 active">
                                        Preview
                                    </a>
                                </x-nav-item>
                                <x-nav-item>
                                    <a href="#bordered-justified-tabs-code" 
                                        data-bs-toggle="tab" aria-expanded="true" 
                                        class="nav-link rounded-0">
                                        Code
                                    </a>
                                </x-nav-item>
                            </x-nav>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="bordered-justified-tabs-preview">
                                    @include("jinyui::demo.tabs.codes.bordered_justified")
                                </div> <!-- end preview-->
                            
                                <div class="tab-pane" id="bordered-justified-tabs-code">
                                    code...
                                </div> <!-- end preview code-->
                            </div> <!-- end tab-content-->
                        </x-card-body>
                    </x-card>
                </x-col-6>
            </x-row>
        </x-container>
    </x-main-content>
</x-theme>