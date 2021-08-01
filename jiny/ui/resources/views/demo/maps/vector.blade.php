<x-jinyui-theme theme="adminkit" class="bootstrap">

    <div class="container-fluid p-0">

        <div class="mb-3">
            <h1 class="h3 d-inline align-middle">Vector Maps</h1><a class="badge bg-primary ms-2"
                href="https://adminkit.io/pricing/" target="_blank">Pro Component <i
                    class="fas fa-fw fa-external-link-alt"></i></a>
        </div>

        <div class="row">
            <div class="col-12">
                <x-card>
                    <div class="card-header">
                        <h5 class="card-title">Jsvectormap</h5>
                        <h6 class="card-subtitle text-muted">A lightweight JavaScript library for creating interactive
                            maps.</h6>
                    </div>
                    <div class="card-body py-1">
                        <ul>
                            <li><a target="_blank" rel="noreferrer noopener"
                                    href="https://github.com/themustafaomar/jsvectormap">Documentation</a>
                            </li>
                            <li><a target="_blank" rel="noreferrer noopener"
                                    href="https://github.com/themustafaomar/jsvectormap">Available maps</a>
                            </li>
                        </ul>
                    </div>
                </x-card>                
            </div>

            <x-col-6>
                <x-card>
                    <div class="card-header">
                        <h5 class="card-title mb-0">World Map</h5>
                    </div>
                    <div class="card-body">
                        @include("jinyui::demo.maps.vector.world")
                    </div>
                </x-card>
            </x-col-6>

            <x-col-6>
                <x-card>
                    <div class="card-header">
                        <h5 class="card-title mb-0">USA Map</h5>
                    </div>
                    <div class="card-body">
                        @include("jinyui::demo.maps.vector.usa")
                    </div>
                </x-card>
            </x-col-6>
        </div>

    </div>

    </x-jiny-theme>
