<x-jiny-theme theme="adminkit" class="bootstrap">
    <div class="main ">
        <main class="content">
            <div class="container-fluid p-0">
                <!-- -->
                <h1 class="h3 mb-3">Collapse with Bootstrap</h1>

                <x-hello></x-hello>
                <x-jinyui-hello></x-jinyui-hello>
                
                <x-row>
                    <x-col class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Link with href</h5>
                                <h6 class="card-subtitle text-muted">a링크를 통하여 collapse를 구현합니다.</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <x-jinyui::collapse.link class="btn btn-primary">
                                        <x-slot name="title">
                                            Link with href
                                        </x-slot>
                                        <!-- -->
                                        <div class="border p-4 mt-2">
                                            Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                                        </div>
                                    </x-jinyui::collapse.link>
                                </div>
                            </div>
                        </div>
                    </x-col>

                    <x-col class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">button with data-bs-target</h5>
                                <h6 class="card-subtitle text-muted">버튼 요소를 통하여 collapse를 구현합니다.</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <x-jinyui::collapse.button class="btn btn-primary">
                                        <x-slot name="title">
                                            button with data-bs-target
                                        </x-slot>
                                        <!-- -->
                                        <div class="border p-4 mt-2">
                                            Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                                        </div>
                                    </x-jinyui::collapse.button>
                                </div>
                            </div>
                        </div>
                    </x-col>
                </x-row>


                <!-- -->
            </div>
        </main>
    </div>
</x-jiny-theme>

