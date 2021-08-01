<x-jinyui-theme theme="adminkit" class="bootstrap">

    <div class="container-fluid p-0" jstcache="0">

        <h1 class="h3 mb-3">Google Maps</h1>

        <x-row>
            <x-col-6>
                <x-card>
                    <div class="card-header">
                        <h5 class="card-title">Default Map</h5>
                        <h6 class="card-subtitle text-muted">Displays the default road map view.</h6>
                    </div>
                    <div class="card-body">
                        @include("jinyui::demo.maps.google.default")
                    </div>
                </x-card>
            </x-col-6>

            <x-col-6>
                <x-card>
                    <div class="card-header">
                        <h5 class="card-title">Hybrid Map</h5>
                        <h6 class="card-subtitle text-muted">Displays a mixture of normal and satellite views.</h6>
                    </div>
                    <div class="card-body">
                        @include("jinyui::demo.maps.google.hybrid")
                    </div>
                </x-card>
            </x-col-6>

            <x-col-6>
                <x-card>
                    <div class="card-header">
                        <h5 class="card-title">Light Style</h5>
                        <h6 class="card-subtitle text-muted">Ligh color scheme.</h6>
                    </div>
                    <div class="card-body">
                        @include("jinyui::demo.maps.google.light")
                    </div>
                </x-card>
            </x-col-6>

            <x-col-6>
                <x-card>
                    <div class="card-header">
                        <h5 class="card-title">Dark Style</h5>
                        <h6 class="card-subtitle text-muted">Dark color scheme.</h6>
                    </div>
                    <div class="card-body">
                        @include("jinyui::demo.maps.google.dark")
                    </div>
                </x-card>
            </x-col-6>
        
            <x-col-6>
                <x-card>
                    <div class="card-header">
                        <h5 class="card-title">Streetview</h5>
                        <h6 class="card-subtitle text-muted">Panoramic 360 degree views from designated roads throughout
                            its coverage area.</h6>
                    </div>
                    <div class="card-body" jstcache="0">
                        @include("jinyui::demo.maps.google.streetview")
                    </div>
                </x-card>
            </x-col-6>

            <x-col-6>
                <x-card>
                    <div class="card-header">
                        <h5 class="card-title">Markers</h5>
                        <h6 class="card-subtitle text-muted">Identify a location on a map.</h6>
                    </div>
                    <div class="card-body">
                        @include("jinyui::demo.maps.google.markers")
                    </div>
                </x-card>
            </x-col-6>
            
        </x-row>

    </div>

</x-jinyui-theme>
