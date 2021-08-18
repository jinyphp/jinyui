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
                        	<h1 class="h3 d-inline align-middle">사이트: 동의서 입력</h1>
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
                        <a href="#" class="btn btn-primary">수정</a>
                    </div>
                </div>
            </div>

            <x-row>
                <x-col-6>
                    <x-card>
                        <x-card-body>
                            {formstart}

                            <x-form-hor>
								<x-form-label>활성화</x-form-label>
								<x-form-item>{enable}</x-form-item>
							</x-form-hor>

                            <x-form-hor>
								<x-form-label>필수동의</x-form-label>
								<x-form-item>{require}</x-form-item>
							</x-form-hor>

                            <x-form-hor>
								<x-form-label>코드</x-form-label>
								<x-form-item>{code}</x-form-item>
							</x-form-hor>

                            <x-form-hor>
								<x-form-label>약관</x-form-label>
								<x-form-item>{language_html}</x-form-item>
							</x-form-hor>

                            {form_submit}

                            {formend}
                        </x-card-body>
                    </x-card>
                </x-col-6>
            </x-row>
            


			
		</x-container>
	</x-main-content>
</x-theme>
