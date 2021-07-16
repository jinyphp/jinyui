<div class="col-12 col-lg-6">
    <x-jiny-card>
        <x-jiny-card-header>

            <x-jiny-tab-header class="nav-tabs card-header-tabs">
                <x-jiny-tab-link class="active" href="#tab-1">Active</x-jiny-tab-link>
                <x-jiny-tab-link href="#tab-2">Link</x-jiny-tab-link>
                <x-jiny-tab-link class="disabled" href="#tab-3">Disabled</x-jiny-tab-link>
            </x-jiny-tab-header>

        </x-jiny-card-header>

        <x-jiny-card-body>

            <x-jiny-tab-body>
                <x-jiny-tab-content class="show active" id="tab-1">
                    <h5 class="card-title">Card with tabs</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
                    </p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </x-jiny-tab-content>

                <x-jiny-tab-content class="text-center" id="tab-2">
                    <h5 class="card-title">Card with tabs</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
                    </p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </x-jiny-tab-content>

                <x-jiny-tab-content id="tab-3">
                    <h5 class="card-title">Card with tabs</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
                    </p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </x-jiny-tab-content>

            </x-jiny-tab-body>

        </x-jiny-card-body>
    </x-jiny-card>
</div>


<div class="col-12 col-lg-6">
    <div class="card">
        <div class="card-header">

            <x-jiny-tab-header class="nav-pills card-header-pills">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#tab-4">Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#tab-5">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" data-bs-toggle="tab" href="#tab-6">Disabled</a>
                </li>
            </x-jiny-tab-header>

        </div>
        <div class="card-body">

            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-4" role="tabpanel">
                    <h5 class="card-title">Card with pills</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
                    </p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
                <div class="tab-pane fade text-center" id="tab-5" role="tabpanel">
                    <h5 class="card-title">Card with pills</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
                    </p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
                <div class="tab-pane fade" id="tab-6" role="tabpanel">
                    <h5 class="card-title">Card with pills</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.
                    </p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>
</div>