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
                        	<li class="breadcrumb-item active">Card</li>
                    	</ol>                        
                    
        				<div class="mb-3">
                        	<h1 class="h3 d-inline align-middle">Navigation</h1>
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


                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center mb-4 card">
                                <div class="card-header">
                                    <div class="nav card-header-tabs nav-tabs">
                                        <div class="nav-item"><a href="#" data-rb-event-key="#" class="nav-link active"
                                                role="button">Active</a></div>
                                        <div class="nav-item"><a href="#" data-rb-event-key="#" class="nav-link"
                                                role="button">Link</a></div>
                                        <div class="nav-item"><a href="#" data-rb-event-key="#"
                                                class="nav-link disabled" role="button" tabindex="-1"
                                                aria-disabled="true">Disabled</a></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card-title h5">Special title treatment</div>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional
                                        content.</p><a href="#" class="btn btn-primary" role="button">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="text-center mb-4 card">
                                <div class="py-3 card-header">
                                    <div class="nav card-header-pills nav-pills">
                                        <div class="nav-item"><a href="#" data-rb-event-key="#" class="nav-link active"
                                                role="button">Active</a></div>
                                        <div class="nav-item"><a href="#" data-rb-event-key="#" class="nav-link"
                                                role="button">Link</a></div>
                                        <div class="nav-item"><a href="#" data-rb-event-key="#"
                                                class="nav-link disabled" role="button" tabindex="-1"
                                                aria-disabled="true">Disabled</a></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card-title h5">Special title treatment</div>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional
                                        content.</p><a href="#" class="btn btn-secondary" role="button">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </div>
            
            <x-row>
                <x-col-6>
                    <x-card>
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
                    
                    </x-card>
                </x-col-6>

                <x-col-6>
                    
<x-card>

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

</x-card>
                </x-col-6>
            </x-row>        

        </x-container>
    </x-main-content>

    

</x-theme>

