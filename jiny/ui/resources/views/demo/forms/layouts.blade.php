<x-theme theme="adminkit" class="bootstrap">
    <x-main-content>
        <x-container>
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

            <x-row>
                <x-col class="col-md-12">
                    @include("jinyui::demo.forms.layouts.inline")
                </x-col>
                
                <x-col class="col-md-12">
                    @include("jinyui::demo.forms.layouts.row")
                    {{-- @include2("layouts.row") --}}
                </x-col>

                <x-col class="col-12 col-xl-6">
                    @include("jinyui::demo.forms.layouts.basic")
                    {{-- @include2("layouts.basic") --}}
                </x-col>
                <x-col class="col-12 col-xl-6">
                    @include("jinyui::demo.forms.layouts.horizontal")
                    {{-- @include2("layouts.horizontal") --}}
                </x-col>
            </x-row>

        </x-container>
    </x-main-content>
</x-theme>   