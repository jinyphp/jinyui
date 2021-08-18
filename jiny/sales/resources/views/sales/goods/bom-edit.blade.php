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
                        	<li class="breadcrumb-item active">Bom</li>
                    	</ol>                        
                    
        				<div class="mb-3">
                        	<h1 class="h3 d-inline align-middle">판매관리 : 생산이력</h1>
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
						<a href="#" class="btn btn-info">{delete}</a>
						<a href="#" class="btn btn-info">{stock_house}</a>
						<a href="#" class="btn btn-info">{assamble_num}</a>
						<a href="#" class="btn btn-info">{bom_assamble}</a>
						<a href="#" class="btn btn-info">{bom_disassamble}</a>
					</div>
                    <div class="btn-group">
                        <a href="#" class="btn btn-secondary">메뉴얼</a>
                        <a href="#" class="btn btn-primary">추가</a>
                    </div>
                </div>
            </div>

			<x-row>
				<x-col-6>
					<x-card>
						<x-card-body>
							{formstart}
							<b>판매관리 :</b> 생산설정
							<x-form-hor>
								<x-form-label>상품명</x-form-label>
								<x-form-item>{goodname}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>상품명</x-form-label>
								<x-form-item>{goodname}</x-form-item>
							</x-form-hor>
		
							{newdata}
							{list}
							{form_submit}
							{formend}

						</x-card-body>
					</x-card>
				</x-col-6>
			</x-row>


		</x-container>
	</x-main-content> 	
	        
</x-theme>