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
                        	<li class="breadcrumb-item active">ToolTip</li>
                    	</ol>                        
                    
        				<div class="mb-3">
                        	<h1 class="h3 d-inline align-middle">ToolTip</h1>
                            <p></p>
                    	</div>
                	</div>
            	</x-col>
        	</x-row>  
        	<!-- end page title -->

            <x-row>
                <x-col-6>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Tooltips</h5>
                            <h6 class="card-subtitle text-muted">Examples for adding custom Bootstrap tooltips.</h6>
                        </div>
                        <div class="card-body text-center">
                            <button class="btn btn-secondary" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="" data-bs-original-title="Tooltip on left">
                                Tooltip on left
                            </button>
                            <button class="btn btn-secondary" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Tooltip on top">
                                Tooltip on top
                            </button>
                            <button class="btn btn-secondary" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-original-title="Tooltip on bottom">
                                Tooltip on bottom
                            </button>
                            <button class="btn btn-secondary" type="button" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-container="body" title="" data-bs-original-title="Tooltip on right">
                                Tooltip on right
                            </button>
                        </div>
                    </div>
                </x-col-6>

                <x-col-6>
                    <x-card>
                        <x-card-header>
                            <h5 class="card-title">Button</h5>
                            <h6 class="card-subtitle text-muted">dfasdfsaf</h6>
                        </x-card-header>
                        <x-card-body>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
                                Tooltip on top
                            </button>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="right" title="Tooltip on right">
                                Tooltip on right
                            </button>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom">
                                Tooltip on bottom
                            </button>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="left" title="Tooltip on left">
                                Tooltip on left
                            </button>
                        </x-card-body>
                    </x-card>
                </x-col-6>

                <x-col-6>
                    <x-card>
                        <x-card-header>
                            <h5 class="card-title">Button</h5>
                            <h6 class="card-subtitle text-muted"></h6>
                        </x-card-header>
                        <x-card-body>
                            <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" title="Disabled tooltip">
                                <button class="btn btn-primary" type="button" disabled>Disabled button</button>
                            </span>
                        </x-card-body>
                    </x-card>
                </x-col-6>
            </x-row>

            
        </x-container>
    </x-main-content>
</x-theme>
<script>
    window.addEventListener('load',function(){
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        })
    })
</script>
