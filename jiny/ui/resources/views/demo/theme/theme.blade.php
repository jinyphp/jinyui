<x-theme theme="adminkit">
    <x-main-content>
        <x-container>
            <!-- start page title -->
        	<x-row >
            	<x-col class="col-8">
                	<div class="page-title-box">                        
                    	<ol class="breadcrumb m-0">
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Theme</a></li>
                        	<li class="breadcrumb-item active">Theme</li>
                    	</ol>                        
                    
        				<div class="mb-3">
                        	<h1 class="h3 d-inline align-middle">Theme</h1>
                            <p>
                                지니ui는 다양한 화면구현을 위하여 커스텀 테마 기능을 지원합니다
                            </p>
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
                <x-col-12>
                    <x-card>
                        <x-card-body>
                            @markdownFile(".theme")
                            
                        </x-card-body>
                    </x-card>
                </x-col-12>                
            </x-row>

            
            <x-markdown>
                abcd-markdown
                
            </x-markdown>

            
            





        </x-container>
    </x-main-content>
</x-theme>