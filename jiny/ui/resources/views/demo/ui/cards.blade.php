<x-jinyui-theme theme="adminkit" class="bootstrap">

    <div class="main">
        <main class="content">
            <div class="container-fluid p-0">

                <h1 class="h3 mb-3">Cards</h1>
                <p>card박스는 컨덴츠를 담아 출력할 수 있는 디자인 박스 입니다.</p>

                <x-row>
                    @include("jinyui::demo.ui.cards.card-image")
                </x-row>

                <x-row>
                    @include("jinyui::demo.ui.cards.card-basic")
                </x-row>

                <x-row>
                    <x-col-6>
                        @include("jinyui::demo.ui.cards.tabs")
                    </x-col-6>
                    <x-col-6>
                        @include("jinyui::demo.ui.cards.tabs-pill")
                    </x-col-6>

                </x-row>

            </div>
        </div>
    </div>

    

</x-jinyui-theme>

