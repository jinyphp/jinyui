<x-theme theme="adminkit">
    <x-main-content>
        <x-container-fluid>
            <!-- start page title -->
        	<x-row >
            	<x-col class="col-8">
                	<div class="page-title-box">                        
                    	<ol class="breadcrumb m-0">
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Theme</a></li>
                        	<li class="breadcrumb-item active">Layout</li>
                    	</ol>                        
                    
        				<div class="mb-3">
                        	<h1 class="h3 d-inline align-middle">Layout</h1>
                            <p>
                             
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
                <x-col-6>
                    <x-card>
                        <x-card-header>
                            reource/view/theme/테마명/layout.blade.php
                        </x-card-header>
                        <x-card-body>
                            이 파일은 사용자 UI를 구현하기 위한 기본 골격 파일입니다. layout.blade.php 파일에서 원하는 형태의 UI모양을 지정하십시요.

                            또한 본문 내용에는 한개의 slot 변수를 같이 선언해 주어야 합니다.

                            slot은 각각의 페이지들이 레이아웃과 결합하기 위한 연결 고리 입니다.
                        </x-card-body>
                    </x-card>
                </x-col-6>
            </x-row>

        </x-container-fluid>
    </x-main-content>
</x-theme>