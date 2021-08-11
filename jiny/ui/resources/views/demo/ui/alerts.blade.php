<x-theme theme="adminkit" class="bootstrap">
    <x-main-content>
        <x-container>
            <!-- start page title -->
        	<x-row >
            	<x-col class="col-8">
                	<div class="page-title-box">                        
                    	<ol class="breadcrumb m-0">
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">UI</a></li>
                        	<li class="breadcrumb-item active">Alerts</li>
                    	</ol>                        
                    
        				<div class="mb-3">
                        	<h1 class="h3 d-inline align-middle">Alerts</h1>
                            <p></p>
                    	</div>
                	</div>
            	</x-col>
        	</x-row>  
        	<!-- end page title -->

            <div class="relative">
                <div class="absolute bottom-4 right-0">
                    <div class="btn-group">
                        <a href="#" class="btn btn-secondary">메뉴얼</a>
                    </div>
                </div>
            </div>

            <x-row>
                <x-col class="col-12 col-lg-6">
                    <x-card>
                        <div class="card-header">
                            <h5 class="card-title">Default alerts</h5>
                            <h6 class="card-subtitle text-muted">Alerts with contextual background color.</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                @include("jinyui::demo.ui.alert.default")
                            </div>
                        </div>
                    </x-card>
                   
                </x-col>
    
                <x-col class="col-12 col-lg-6">
                    <x-card>
                        <div class="card-header">
                            <h5 class="card-title">Icon alerts</h5>
                            <h6 class="card-subtitle text-muted">Alerts with icon and background color.</h6>
                        </div>
                        <div class="card-body">                              
                            <div class="mb-3">
                                @include("jinyui::demo.ui.alert.icon")
                            </div>
                        </div>
                    </x-card>
                    
                </x-col>
    
                <x-col class="col-12 col-lg-6">
                    <x-card>
                        <div class="card-header">
                            <h5 class="card-title">Outline alerts</h5>
                            <h6 class="card-subtitle text-muted">Alerts with contextual icon background.</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                @include("jinyui::demo.ui.alert.outline")                                   
                            </div>
                        </div>
                    </x-card>
                 
                </x-col>
    
                <x-col class="col-12 col-lg-6">
                    <x-card>
                        <div class="card-header">
                            <h5 class="card-title">Colored outline alerts</h5>
                            <h6 class="card-subtitle text-muted">Alerts with contextual outline color.</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                @include("jinyui::demo.ui.alert.color")
                            </div>
                        </div>
                    </x-card>
                 
                </x-col>
    
                <x-col class="col-12 col-lg-6">
                    <x-card>
                        <div class="card-header">
                            <h5 class="card-title">Alerts with additonal content</h5>
                            <h6 class="card-subtitle text-muted">Alerts with large contents.</h6>
                        </div>
                        <div class="card-body">
                            @include("jinyui::demo.ui.alert.message")
                        </div>
                    </x-card>
                        
                  
                </x-col>
    
                <x-col class="col-12 col-lg-6">
                    <x-card>
                        <div class="card-header">
                            <h5 class="card-title">Alerts with buttons</h5>
                            <h6 class="card-subtitle text-muted">Alerts with actions.</h6>
                        </div>
                        <div class="card-body">
                            @include("jinyui::demo.ui.alert.confirm")
                        </div>
                    </x-card>
                    
                </x-col>
            </x-row> 

        </x-container>
    </x-main-content>
</x-theme>

