<x-theme theme="admin.sidebar">
    <x-theme-layout>
        <x-container-fluid>
            <!-- start page title -->
        	<x-row >
            	<x-col class="col-8">
                	<div class="page-title-box">                        
                    	<ol class="breadcrumb m-0">
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        	<li class="breadcrumb-item active">Form Layouts</li>
                    	</ol>                        
                    
        				<div class="mb-3">
                        	<h1 class="h3 d-inline align-middle">Form Layouts</h1>
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
                <x-col class="col-md-12">
                    @include("jinyui::demo.forms.layouts.inline")
                </x-col>
                
                <x-col class="col-md-12">
                    @include("jinyui::demo.forms.layouts.row")
                    
                </x-col>

                <x-col class="col-12 col-xl-6">
                    @include("jinyui::demo.forms.layouts.basic")
                    
                </x-col>
                <x-col class="col-12 col-xl-6">
                    @include("jinyui::demo.forms.layouts.horizontal")
                    
                </x-col>
            </x-row>

        </x-container-fluid>
    </x-theme-layout>
</x-theme>   