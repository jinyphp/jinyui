
<x-jinyui-card>

    <div class="card-header">
        <x-jinyui::nav.list class="nav-pills card-header-pills pull-right">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#tab-4">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#tab-5">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" data-bs-toggle="tab" href="#tab-6">Disabled</a>
            </li>
        </x-jinyui::nav.list>
    </div>
    
    <div class="card-body">
        <x-jinyui::nav.contents>
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
        </x-jinyui::nav.contents>
    </div>

</x-jinyui-card>