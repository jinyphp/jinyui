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
                        	<h1 class="h3 d-inline align-middle">판매관리 : 제품목록</h1>
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
							상품
							<x-form-hor>
								<x-form-label>활성화</x-form-label>
								<x-form-item>{enable}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>상품 타입</x-form-label>
								<x-form-item>{type_normal} 일반매입 상품 / {type_bom} 
									제조생산품</x-form-item>
							</x-form-hor>
							<x-form-hor>
								<x-form-label>상품명</x-form-label>
								<x-form-item>{name}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>상품코드</x-form-label>
								<x-form-item>{goodcode}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>바코드</x-form-label>
								<x-form-item>{barcode}{scan}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>모델명</x-form-label>
								<x-form-item>{model}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>브랜드</x-form-label>
								<x-form-item>{brand}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>매출가격</x-form-label>
								<x-form-item>{sell_currency}</x-form-item>
							</x-form-hor>
							<x-form-hor>
								<x-form-label></x-form-label>
								<x-form-item>{prices_sell}</x-form-item>
							</x-form-hor>
							<x-form-hor>
								<x-form-label></x-form-label>
								<x-form-item>{sell_vat_on}부가세포함 / {sell_vat_off}부가세별도</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>B2B 공급단가</x-form-label>
								<x-form-item>{b2b_currency}</x-form-item>
							</x-form-hor>
							<x-form-hor>
								<x-form-label></x-form-label>
								<x-form-item>{prices_b2b}</x-form-item>
							</x-form-hor>
							<x-form-hor>
								<x-form-label></x-form-label>
								<x-form-item>{b2b_vat_on}부가세포함 / {b2b_vat_off}부가세별도</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>매입가격</x-form-label>
								<x-form-item>{buy_currency}</x-form-item>
							</x-form-hor>
							<x-form-hor>
								<x-form-label></x-form-label>
								<x-form-item>{prices_buy}</x-form-item>
							</x-form-hor>
							<x-form-hor>
								<x-form-label></x-form-label>
								<x-form-item>{buy_vat_on}부가세포함 / {buy_vat_off}부가세별도</x-form-item>
							</x-form-hor>

							* 재고설정
							{stock_info}

							<x-form-hor>
								<x-form-label>재고부족 판매중단:</x-form-label>
								<x-form-item>{stock_check}</x-form-item>
								재고부족시 매입/매출을 제한합니다.
							</x-form-hor>

							<x-form-hor>
								<x-form-label>안전 재고량 경고:</x-form-label>
								<x-form-item>{stock_safe}</x-form-item>
								안전재고 수량 이하 발생시 경고
							</x-form-hor>

							* 매입 거래처 설정 및 사업장
							<x-form-hor>
								<x-form-label>사업장</x-form-label>
								<x-form-item>{business}</x-form-item>
								
							</x-form-hor>

							<x-form-hor>
								<x-form-label>거래처</x-form-label>
								<x-form-item>{company}</x-form-item>
								
							</x-form-hor>

							<x-form-hor>
								<x-form-label>분류
									카테고리</x-form-label>
								<x-form-item>{cate}</x-form-item>								
							</x-form-hor>

							* 쇼핑몰 연동 판매

							<x-form-hor>
								<x-form-label>쇼핑몰 연동판매</x-form-label>
								<x-form-item>{shopping}</x-form-item>								
							</x-form-hor>

							<x-form-hor>
								<x-form-label>연동 상품</x-form-label>
								<x-form-item>{shop_uid}</x-form-item>								
							</x-form-hor>

							* 참고 정보

							<x-form-hor>
								<x-form-label>상품 사진</x-form-label>
								<x-form-item>{images}</x-form-item>								
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

