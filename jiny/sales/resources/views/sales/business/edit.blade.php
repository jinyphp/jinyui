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
                        	<h1 class="h3 d-inline align-middle">Business</h1>
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
							회사정보
						</x-card-header>
						<x-card-body>
							{formstart}

							<x-form-hor>
								<x-form-label>활성화</x-form-label>
								<x-form-item>{enable}</x-form-item>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>* 회사명</x-form-label>
								<x-form-item>{business}</x-form-item>
								<div>
									<p>필수항목, 
										회사명을 입력해 주세요</p>
								</div>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>* 이메일</x-form-label>
								<x-form-item>{email}</x-form-item>
								<div>
									<p>필수항목, 모든 회사 및 거래처를 구분하는 기준이 됩니다.</p>
								</div>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>*핸드폰</x-form-label>
								<x-form-item>{phone}</x-form-item>
								<div>
									<p></p>
								</div>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>*사업자번호</x-form-label>
								<x-form-item>{biznumber}</x-form-item>
								<div>
									<p></p>
								</div>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>*대표자명</x-form-label>
								<x-form-item>{president}</x-form-item>
								<div>
									<p></p>
								</div>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>*업태</x-form-label>
								<x-form-item>{subject}</x-form-item>
								<div>
									<p></p>
								</div>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>*업종</x-form-label>
								<x-form-item>{item}</x-form-item>
								<div>
									<p></p>
								</div>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>우편번호</x-form-label>
								<x-form-item>{post}</x-form-item>
								<div>
									<p></p>
								</div>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>도시</x-form-label>
								<x-form-item>{city}</x-form-item>
								<div>
									<p></p>
								</div>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>주</x-form-label>
								<x-form-item>{state}</x-form-item>
								<div>
									<p></p>
								</div>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>주소</x-form-label>
								<x-form-item>{address}</x-form-item>
								<div>
									<p></p>
								</div>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>전화번호</x-form-label>
								<x-form-item>{tel}</x-form-item>
								<div>
									<p></p>
								</div>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>팩스</x-form-label>
								<x-form-item>{fax}</x-form-item>
								<div>
									<p></p>
								</div>
							</x-form-hor>

							

							{form_submit}
	
						{formend}

						</x-card-body>
					</x-card>
				</x-col-6>
				<x-col-6>
					<x-card>
						<x-card-header>
							거래금액
						</x-card-header>
						<x-card-body>
							<x-form-hor>
								<x-form-label>매출 미수금</x-form-label>
								<x-form-item>{balance_sell}</x-form-item>
								<div>
									<p></p>
								</div>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>매입 미수금</x-form-label>
								<x-form-item>{balance_buy}</x-form-item>
								<div>
									<p></p>
								</div>
							</x-form-hor>
						</x-card-body>
					</x-card>

					<x-card>
						<x-card-header>
							회계정보
						</x-card-header>
						<x-card-body>
							<x-form-hor>
								<x-form-label>국가</x-form-label>
								<x-form-item>country</x-form-item>
								<div>
									<p>
									다국적 기업일 
								경우 사업장 위치를 선택해 주세요. [ <a href="/shop/shop_country.php">국가 추가 및 관리</a> ]</p>
								</div>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>거래통화</x-form-label>
								<x-form-item>{currency}</x-form-item>
								<div>
									<p>거래 
										기준이 되는 통화를 선택해 주세요. [ <a href="/shop/shop_currency.php">통화 추가 및 관리</a> ]</p>
								</div>
							</x-form-hor>

							<x-form-hor>
								<x-form-label>부가세율</x-form-label>
								<x-form-item>{vatratey}</x-form-item>
								<div>
									<p>% 적용 , 
										0 또는 미입력시 부가세 적용되지 않습니다.</p>
								</div>
							</x-form-hor>
						</x-card-body>
					</x-card>

					<x-card>
						<x-card-header>
							관리정보
						</x-card-header>
						<x-card-body>
							<x-form-hor>
								<x-form-label>관리직원</x-form-label>
								<x-form-item>{manager}</x-form-item>
								<div>
									<p></p>
								</div>
							</x-form-hor>

							

							<x-form-hor>
								<x-form-label>메모</x-form-label>
								<x-form-item>{comment}</x-form-item>
								<div>
									<p></p>
								</div>
							</x-form-hor>
						</x-card-body>
					</x-card>
				</x-col-6>
			</x-row>


		</x-container>
	</x-main-content>
</x-theme>

