<x-jiny-theme theme="adminkit" class="bootstrap">

    <x-main>
        <x-main-content>
            <div class="container-fluid p-0">

                <h1 class="h3 mb-3">Cards</h1>
                <p>card박스는 컨덴츠를 담아 출력할 수 있는 디자인 박스 입니다.</p>

                <div class="row">
                    @include("jinyui::demo.ui.cards.card-image")
                </div>

                <div class="row">
                    @include("jinyui::demo.ui.cards.card-basic")
                </div>

                <div class="row">
                    @include("jinyui::demo.ui.cards.card-tabs")
                </div>

            </div>
        </x-main-content>
    </x-main>

</x-jiny-theme>

