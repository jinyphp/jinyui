<x-theme theme="adminkit" class="bootstrap">
    <x-main-content>
        <x-container>
            <!-- start page title -->
        	<x-row >
            	<x-col class="col-8">
                	<div class="page-title-box">                        
                    	<ol class="breadcrumb m-0">
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Toggle</a></li>
                        	<li class="breadcrumb-item active">Collapse</li>
                    	</ol>                        
                    
        				<div class="mb-3">
                        	<h1 class="h3 d-inline align-middle">Collapse</h1>
                            p>jinyui는 x-collapse 테그를 이용하여 컨덴츠를 쉽게 접었다 펼수 있습니다.</p>
                <p>또한 collpas를 구현하기 위해서 유일한 id값을 생성해야 하는 불편한을 제거할 수 있습니다.</p>
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
                <x-card>
                    <x-card-header>
                        <h5 class="card-title">button with data-bs-target</h5>
                        <h6 class="card-subtitle text-muted">버튼 요소를 통하여 collapse를 구현합니다.</h6>
                    </x-card-header>
                    <x-card-body>
                        <div class="mb-3">
                            <x-jinyui::collapse.collapse>
                                <x-jinyui::collapse.button>
                                    button with data-bs-target
                                </x-jinyui::collapse.button>

                                <x-jinyui::collapse.body>
                                    <div class="border p-4 mt-2">
                                        Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                                    </div>
                                </x-jinyui::collapse.body>
                            </x-jinyui::collapse.collapse>

                            
                        </div>
                    </x-card-body>
                </x-card>
            </x-col-6>

            <x-col-6>
                <x-card>
                    <x-card-header>
                        <h5 class="card-title">Link with href</h5>
                        <h6 class="card-subtitle text-muted">a링크를 통하여 collapse를 구현합니다.</h6>
                    </x-card-header>
                    <x-card-body>
                        <div class="mb-3">
                            <x-jinyui::collapse.collapse>


                                <x-jinyui::collapse.link>
                                    Link with href
                                </x-jinyui::collapse.link>

                                <x-jinyui::collapse.body>
                                    <div class="border p-4 mt-2">
                                        Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                                    </div>
                                </x-jinyui::collapse.body>
                            </x-jinyui::collapse.collapse>

                            
                        </div>
                    </x-card-body>
                </x-card>
            </x-col-6>

            

        </x-row>
        </x-container>
    </x-main-content>
</x-theme>

