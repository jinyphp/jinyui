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
                        	<h1 class="h3 d-inline align-middle">판매관리: 거래처</h1>
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
						<x-card-header>
						
						</x-card-header>
						<x-card-body>
							{formstart}

							<x-form-hor>
								<x-form-label>활성화</x-form-label>
								<x-form-item>{enable}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>거래처 승인</x-form-label>
								<x-form-item>{auth}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>소속 사업장</x-form-label>
								<x-form-item>{business}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>거래처 구분</x-form-label>
								<x-form-item>{inout}</x-form-item>
							</x-form-hor>

							거래설정
							<x-form-hor>
								<x-form-label>거래통화</x-form-label>
								<x-form-item>{currency}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>매출 미수금</x-form-label>
								<x-form-item>{balance_sell}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>매입 미수금</x-form-label>
								<x-form-item>{balance_buy}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>미수한도</x-form-label>
								<x-form-item>{limit}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>기본 할인율</x-form-label>
								<x-form-item>{discount}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>부가세율</x-form-label>
								<x-form-item>{vat}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>% 적용 , 국가별 부가세율 보기</x-form-label>
								<x-form-item>{vatrate}</x-form-item>
							</x-form-hor>

							* 회사정보
							<x-form-hor>
								<x-form-label>그룹</x-form-label>
								<x-form-item>{group}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>관리직원</x-form-label>
								<x-form-item>{manager}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>국가</x-form-label>
								<x-form-item>{country}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>회사명</x-form-label>
								<x-form-item>{company}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>사업자번호</x-form-label>
								<x-form-item>{biznumber}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>대표자명</x-form-label>
								<x-form-item>{president}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>업태</x-form-label>
								<x-form-item>{subject}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>업종</x-form-label>
								<x-form-item>{item}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>우편번호</x-form-label>
								<x-form-item>{post}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>주소</x-form-label>
								<x-form-item>{address}</x-form-item>
							</x-form-hor>

							연락처

							<x-form-hor>
								<x-form-label>이메일</x-form-label>
								<x-form-item>{email}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>패스워드</x-form-label>
								<x-form-item>{password}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>핸드폰</x-form-label>
								<x-form-item>{phone}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>전화번호</x-form-label>
								<x-form-item>{tel}</x-form-item>
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

