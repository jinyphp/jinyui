<x-jinyui-card>
    <div class="card-header">
        <x-jinyui::nav.list class="nav-tabs card-header-tabs pull-right">

            <x-jinyui::nav.tab-link href="#tab-1" class="active">
                Active
            </x-jinyui::nav.tab-link>

            <x-jinyui::nav.tab-link href="#tab-2">
                Link
            </x-jinyui::nav.tab-link>
        
            <li class="nav-item">
                <a class="nav-link disabled" data-bs-toggle="tab" href="#tab-3">Disabled</a>
            </li>
        </x-jinyui::nav.list>
    </div>

    <div class="card-body">
        <x-jinyui::nav.contents>
            <x-jinyui::nav.tab-item class="fade active show" id="tab-1">
                <h5 class="card-title">Card with tabs</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
                </p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </x-jinyui::nav.tab-item>

            <x-jinyui::nav.tab-item class="fade text-center" id="tab-2">
                <h5 class="card-title">Card with tabs</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
                </p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </x-jinyui::nav.tab-item>

            <x-jinyui::nav.tab-item class="fade" id="tab-3">
                <h5 class="card-title">Card with tabs</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
                </p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </x-jinyui::nav.tab-item>
            
        </x-jinyui::nav.contents>
    </div>

</x-jinyui-card>
