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
                        	<li class="breadcrumb-item active">Popover</li>
                    	</ol>                        
                    
        				<div class="mb-3">
                        	<h1 class="h3 d-inline align-middle">Popover</h1>
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
                <x-col-6>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Example</h5>
                            <h6 class="card-subtitle text-muted"></h6>
                        </div>
                        <div class="card-body text-center">
                            <button type="button" class="btn btn-lg btn-danger" data-bs-toggle="popover" title="Popover title" data-bs-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button>
                        </div>
                    </div>
                </x-col-6>

                <x-col-6>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Four directions</h5>
                            <h6 class="card-subtitle text-muted"></h6>
                        </div>
                        <div class="card-body text-center">
                            <button type="button" class="btn btn-secondary" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Top popover">
                                Popover on top
                              </button>
                              <button type="button" class="btn btn-secondary" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="Right popover">
                                Popover on right
                              </button>
                              <button type="button" class="btn btn-secondary" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content="Bottom popover">
                                Popover on bottom
                              </button>
                              <button type="button" class="btn btn-secondary" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="left" data-bs-content="Left popover">
                                Popover on left
                              </button>


                        </div>
                    </div>
                </x-col-6>

                

                <x-col-6>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Dismiss on next click</h5>
                            <h6 class="card-subtitle text-muted"></h6>
                        </div>
                        <div class="card-body text-center">
                            <a tabindex="0" class="btn btn-lg btn-danger" role="button" data-bs-toggle="popover" data-bs-trigger="focus" title="Dismissible popover" data-bs-content="And here's some amazing content. It's very engaging. Right?">Dismissible popover</a>


                        </div>
                    </div>
                </x-col-6>

                <x-col-6>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Disabled elements</h5>
                            <h6 class="card-subtitle text-muted"></h6>
                        </div>
                        <div class="card-body text-center">
                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Disabled popover">
                                <button class="btn btn-primary" type="button" disabled>Disabled button</button>
                              </span>


                        </div>
                    </div>
                </x-col-6>

                <x-col-6>
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title"></h5>
                            <h6 class="card-subtitle text-muted"></h6>
                        </div>
                        <div class="card-body text-center">
                           


                        </div>
                    </div>
                </x-col-6>

            </x-row>

            
        </x-container>
    </x-main-content>

</x-theme>

<script>
    window.addEventListener('load',function(){
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})
    })
</script>

