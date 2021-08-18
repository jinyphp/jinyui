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
                        	<h1 class="h3 d-inline align-middle">지점/창고 리스트</h1>
                            <p>
                                상품을 보관하는 다수의 창고를 관리할 수 있습니다.
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
								<x-form-label>지점 창고명</x-form-label>
								<x-form-item>{name}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>사업장</x-form-label>
								<x-form-item>{business}</x-form-item>
							</x-form-hor>

							

							<x-form-hor>
								<x-form-label>국가</x-form-label>
								<x-form-item>{country}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>담당자</x-form-label>
								<x-form-item>{manager}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>휴대폰</x-form-label>
								<x-form-item>{phone}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>전화</x-form-label>
								<x-form-item>{tel}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>팩스</x-form-label>
								<x-form-item>{fax}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>우편번호</x-form-label>
								<x-form-item>{post}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>주</x-form-label>
								<x-form-item>{state}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>도시</x-form-label>
								<x-form-item>{city}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>주소</x-form-label>
								<x-form-item>{address}</x-form-item>
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



