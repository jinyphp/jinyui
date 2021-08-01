<x-jinyui-theme theme="adminkit" class="bootstrap">

    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Accordion</h1>

        <x-card>
            <x-card-body>
                아코디언은 collapse 기능을 좀더 응용하여 여러개의 데이터를 묽어서 접어다 펼 수 있는 ui 화면 구현 기술입니다.
            </x-card-body>
        </x-card>

        <x-row>
            <x-col-6>
                <x-card>
                    <x-card-header>
                        여러개의 아코디언 하나면 선택할 수 있습니다.
                        선택한 하나만 접어다 펼수 있는 아코디언 입니다.
                    </x-card-header>
                    <x-card-body>
                        @include("jinyui::demo.ui.accordion.toggle")
                    </x-card-body>
                </x-card>
            </x-col-6>

            <x-col-6>
                <x-card>
                    <x-card-header>
                        아코디언 각각의 항목들을 개별적으로 선택하여 접었다 펼 수 있습니다.
                    </x-card-header>
                    <x-card-body>
                        @include("jinyui::demo.ui.accordion.open")
                    </x-card-body>
                </x-card>
            </x-col-6>
        </x-row>




        


    </div>

</x-jinyui-theme>
