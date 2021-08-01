<x-jinyui-theme theme="adminkit" class="bootstrap">

    <div class="container-fluid p-0">
        <!-- -->
        <h1 class="h3 mb-3">Collapse</h1>
        
        <x-card>
            <x-card-body>
                <p>jinyui는 x-collapse 테그를 이용하여 컨덴츠를 쉽게 접었다 펼수 있습니다.</p>
                <p>또한 collpas를 구현하기 위해서 유일한 id값을 생성해야 하는 불편한을 제거할 수 있습니다.</p>
            </x-card-body>
        </x-card>

        <x-row>
            <x-col-6>
                <x-card>
                    <x-card-header>
                        <h5 class="card-title">button with data-bs-target</h5>
                        <h6 class="card-subtitle text-muted">버튼 요소를 통하여 collapse를 구현합니다.</h6>
                    </x-card-header>
                    <x-card-body>
                        <div class="mb-3">
                            <x-jinyui::collapse.collapse>
                                <x-jinyui::collapse.button>
                                    button with data-bs-target
                                </x-jinyui::collapse.button>

                                <x-jinyui::collapse.body>
                                    <div class="border p-4 mt-2">
                                        Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                                    </div>
                                </x-jinyui::collapse.body>
                            </x-jinyui::collapse.collapse>

                            
                        </div>
                    </x-card-body>
                </x-card>
            </x-col-6>

            <x-col-6>
                <x-card>
                    <x-card-header>
                        <h5 class="card-title">Link with href</h5>
                        <h6 class="card-subtitle text-muted">a링크를 통하여 collapse를 구현합니다.</h6>
                    </x-card-header>
                    <x-card-body>
                        <div class="mb-3">
                            <x-jinyui::collapse.collapse>


                                <x-jinyui::collapse.link>
                                    Link with href
                                </x-jinyui::collapse.link>

                                <x-jinyui::collapse.body>
                                    <div class="border p-4 mt-2">
                                        Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                                    </div>
                                </x-jinyui::collapse.body>
                            </x-jinyui::collapse.collapse>

                            
                        </div>
                    </x-card-body>
                </x-card>
            </x-col-6>

            

        </x-row>


        <!-- -->
    </div>

</x-jiny-theme>

