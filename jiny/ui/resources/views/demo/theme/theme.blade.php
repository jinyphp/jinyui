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

            <x-row>
                <x-col-6>
                    <x-card>
                        <x-card-header>
                            x-theme
                        </x-card-header>
                        <x-card-body>
                            <code>x-theme</code> 테그는 사용자 테마 폴더의 레이아웃을 이용하여 화면 UI를 배치합니다.
                            
                            사용자 테마를 지정할때에는 theme="테마명" 형태로 속성을 지정합니다.
                            이렇게 x-theme 테그를 이용하여 테마를 지정하게 되면, 지니UI는 기본적인 HTML 골격과 
                            라라벨의 reource/view/theme/테마명/layout.blade.php 파일을 읽어 결합된 코드를 생성합니다.
                            
                        </x-card-body>
                    </x-card>
                </x-col-6>

                
            </x-row>

        </x-container>
    </x-main-content>
</x-theme>