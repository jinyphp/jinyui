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
                        	<li class="breadcrumb-item active">House</li>
                    	</ol>                        
                    
        				<div class="mb-3">
                        	<h1 class="h3 d-inline align-middle">판매관리: 직원, 담당자 리스트</h1>
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
                        <a href="#" class="btn btn-success">수정</a>
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
								<x-form-label>성 </x-form-label>
								<x-form-item>{firstname}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>이름 </x-form-label>
								<x-form-item>{lastname}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>* 이메일 </x-form-label>
								<x-form-item>{email}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>* 암호</x-form-label>
								<x-form-item>{password}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>부서</x-form-label>
								<x-form-item>{parts}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>전화번호</x-form-label>
								<x-form-item>{phone}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>팩스</x-form-label>
								<x-form-item>{fax}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>메모</x-form-label>
								<x-form-item>{comment}</x-form-item>
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



