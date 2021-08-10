<x-theme theme="adminkit" class="bootstrap">
    <x-main-content>
        <x-container>
            <!-- start page title -->
        	<x-row >
            	<x-col class="col-8">
                	<div class="page-title-box">                        
                    	<ol class="breadcrumb m-0">
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">ui</a></li>
                        	<li class="breadcrumb-item active">Accordion</li>
                    	</ol>                        
                    
        				<div class="mb-3">
                        	<h1 class="h3 d-inline align-middle">Accordion</h1>
                            <p>
                                아코디언은 collapse 기능을 좀더 응용하여 여러개의 데이터를 묽어서 접어다 펼 수 있는 ui 화면 구현 기술입니다.
                            </p>
                    	</div>
                	</div>
            	</x-col>
        	</x-row>  
        	<!-- end page title -->

            <x-row>
                <x-col-6>
                    <x-card>
                        <x-card-header>
                            여러개의 아코디언 하나면 선택할 수 있습니다.
                            선택한 하나만 접어다 펼수 있는 아코디언 입니다.
                        </x-card-header>
                        <x-card-body>
                            @include("jinyui::demo.toggle.accordion.toggle")
                        </x-card-body>
                    </x-card>
                </x-col-6>
    
                <x-col-6>
                    <x-card>
                        <x-card-header>
                            아코디언 각각의 항목들을 개별적으로 선택하여 접었다 펼 수 있습니다.
                        </x-card-header>
                        <x-card-body>
                            @include("jinyui::demo.toggle.accordion.open")
                        </x-card-body>
                    </x-card>
                </x-col-6>
            </x-row>


        </x-container>
    </x-main-content>
</x-theme>
