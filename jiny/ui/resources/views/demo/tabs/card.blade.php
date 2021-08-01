<style>
.tab-content>.tab-pane {
    display: none
}

.tab-content>.active {
    display: block
}
</style>
<x-jinyui-theme theme="adminkit" class="bootstrap">

        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Settings</h1>

            <div class="row">
                <div class="col-md-3 col-xl-2">

                    <x-jinyui-card>
                        <x-jinyui::card.header>
                            <h5 class="card-title mb-0">Tabs</h5>
                        </x-jinyui::card.header>

                        <x-jinyui::tab.header class="list-group list-group-flush">
                            {{ \Jiny\UI\CTab::instance()->links(
                                [
                                    'tab1'=>"Tab1", 
                                    'tab2'=>"Tab2",
                                    'tab3'=>"Tab3"
                                ],
                                "tab1") }}
                        </x-jinyui::tab.header>
                        
                    </x-jinyui-card>

                </div>

                <div class="col-md-9 col-xl-10">

                    {{-- 텝출력--}}
                    <x-jinyui::tab.content>
                        {{-- 텝 컨덴츠 생성--}}
                        <x-jinyui::tab.item class="active show" id="tab1">
                            <x-jinyui-card>
                                Tab1 Content  
                            </x-jinyui-card>
                                                    
                        </x-jinyui::tab.item>

                        {{-- 텝 컨덴츠 생성--}}
                        <x-jinyui::tab.item id="tab2">                        
                            <x-jinyui-card>
                                Tab2 Content  
                            </x-jinyui-card>
                        </x-jinyui::tab.item>

                        {{-- 텝 컨덴츠 생성--}}
                        <x-jinyui::tab.item id="tab3">                        
                            <x-jinyui-card>
                                Tab3 Content  
                            </x-jinyui-card>
                        </x-jinyui::tab.item>
                    </x-jinyui::tab.content>
                    
                    

                </div>
            </div>

        </div>


</x-jinyui-theme>   