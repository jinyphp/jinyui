<x-theme theme="jinyerp" class="bootstrap">
    <x-main-content>
		<x-container>

            <!-- start page title -->
        	<x-row >
            	<x-col class="col-8">
                	<div class="page-title-box">                        
                    	<ol class="breadcrumb m-0">
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Sales</a></li>
                        	<li class="breadcrumb-item active">Business</li>
                    	</ol>                        
                    
        				<div class="mb-3">
                        	<h1 class="h3 d-inline align-middle">포인트 목록</h1>
                            <p>
                               
                            </p>
                    	</div>
                	</div>
            	</x-col>
        	</x-row>  
        	<!-- end page title -->

            {pay_in} {pay_out}

            <x-row>
                <x-col-6>
                    <x-card>
                        <x-card-body>
                            {formstart} 
                            {point_list}
                            {formend}
                        </x-card-body>
                    </x-card>
                </x-col-6>
            </x-row>
			
		</x-container>
	</x-main-content>
</x-theme>


