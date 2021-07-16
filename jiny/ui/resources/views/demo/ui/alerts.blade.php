<x-jiny-theme theme="adminkit" class="bootstrap">
    <div class="main ">
        <main class="content">
            <div class="container-fluid p-0">
    
                <h1 class="h3 mb-3">Alerts</h1>
    
                <x-row>
                    <x-col class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Default alerts</h5>
                                <h6 class="card-subtitle text-muted">Alerts with contextual background color.</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    @include("jinyui::demo.ui.alert.default")
                                </div>
                            </div>
                        </div>
                    </x-col>

                    <x-col class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Icon alerts</h5>
                                <h6 class="card-subtitle text-muted">Alerts with icon and background color.</h6>
                            </div>
                            <div class="card-body">                              
                                <div class="mb-3">
                                    @include("jinyui::demo.ui.alert.icon")
                                </div>
                            </div>
                        </div>
                    </x-col>

                    <x-col class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Outline alerts</h5>
                                <h6 class="card-subtitle text-muted">Alerts with contextual icon background.</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    @include("jinyui::demo.ui.alert.outline")                                   
                                </div>
                            </div>
                        </div>
                    </x-col>

                    <x-col class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Colored outline alerts</h5>
                                <h6 class="card-subtitle text-muted">Alerts with contextual outline color.</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    @include("jinyui::demo.ui.alert.color")
                                </div>
                            </div>
                        </div>
                    </x-col>

                    <x-col class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Alerts with additonal content</h5>
                                <h6 class="card-subtitle text-muted">Alerts with large contents.</h6>
                            </div>
                            <div class="card-body">
                                @include("jinyui::demo.ui.alert.message")
                            </div>
                        </div>
                    </x-col>

                    <x-col class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Alerts with buttons</h5>
                                <h6 class="card-subtitle text-muted">Alerts with actions.</h6>
                            </div>
                            <div class="card-body">
                                @include("jinyui::demo.ui.alert.confirm")
                            </div>
                        </div>
                    </x-col>
                </x-row>    
            </div>
        </main>
    </div>
</x-jiny-theme>

