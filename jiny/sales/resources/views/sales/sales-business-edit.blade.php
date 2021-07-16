<x-theme>
	<x-slot name="seo_title">사업장관리</x-slot>

	<x-main class="p-4">

		<x-main-content class="bg-white p-4">
			<div class="mb-3">
				<h1 class="h3 d-inline align-middle">사업장관리</h1>
			</div>

			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#E9E9E9">
					<b>사업장관리 : </b>본인 사업장 정보를 입력합니다.</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9" align="center">
					{youtube_manual}</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9" align="center">
					메뉴얼 보기</td>
					
				</tr>
			</table>

			<div class="container-fluid p-0">

                <div class="row">
					{formstart}
                    <div class="col-12 col-lg-6">
                        <div id="tabs" class="tabview" x-data="{tab:'viewTab1'}">
                            <ul class="nav">
                                <li :class="{'active' : tab === 'viewTab1'}" class="">
									<a id="tab_userTab1" @click.prevent="tab='viewTab1'" href="#viewTab1">기본정보</a>
								</li>
                                <li :class="{'active' : tab === 'viewTab2'}" class="active">
									<a id="tab_viewTab2" @click.prevent="tab='viewTab2'" href="#viewTab2">관리자</a>
								</li>
                            </ul>
                            <div x-show="tab === 'viewTab1'" id="viewTab1" style="display: none;">
                                
								<table border="0" width="100%" cellspacing="0" cellpadding="0">
									<tr>
									<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">활성화 :</td>
									<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">{enable}</td>
									<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;"> </td>
									</tr>
									<tr>
									<td style="font-size:12px;padding:10px;" width="100">국가 :</td>
									<td style="font-size:12px;padding:10px;" width="200">{country}</td>
									<td style="font-size:12px;padding:10px;">다국적 기업일 
									경우 사업장 위치를 선택해 주세요. [ <a href="/shop/shop_country.php">국가 추가 및 관리</a> ]</td>
									</tr>
									<tr>
									<td style="font-size:12px;padding:10px;" width="100">거래통화 :</td>
									<td style="font-size:12px;padding:10px;" width="200">{currency}</td>
									<td style="font-size:12px;padding:10px;"> 거래 
									기준이 되는 통화를 선택해 주세요. [ <a href="/shop/shop_currency.php">통화 추가 및 관리</a> ]</td>
									</tr>
									<tr>
									<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">부가세율 :</td>
									<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">{vatrate}</td>
									<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">% 적용 , 
									0 또는 미입력시 부가세 적용되지 않습니다.</td>
									</tr>
									</table>
									
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
													<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;"><b>* 회사정보</b></td>
												</tr>
											</table>
									
									
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
									<tr>
									<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
													<font size="2" color="#FF0000">* 회사명 :</td>
									<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">{business}</td>
									<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">필수항목, 
									회사명을 입력해 주세요</td>
									</tr>
									<tr>
									<td style="font-size:12px;padding:10px;" width="100">
													<font size="2" color="#FF0000">* 이메일 :</td>
									<td style="font-size:12px;padding:10px;" width="200">{email}</td>
									<td style="font-size:12px;padding:10px;">필수항목, 모든 회사 및 거래처를 구분하는 기준이 됩니다.</td>
									</tr>
									<tr>
									<td style="font-size:12px;padding:10px;" width="100">
													<font size="2" color="#FF0000">*핸드폰 :</td>
									<td style="font-size:12px;padding:10px;" width="200">{phone}</td>
									<td style="font-size:12px;padding:10px;"> </td>
									</tr>
									<tr>
									<td style="font-size:12px;padding:10px;" width="100">사업자번호 :</td>
									<td style="font-size:12px;padding:10px;" width="200">{biznumber}</td>
									<td style="font-size:12px;padding:10px;"> </td>
									</tr>
									<tr>
									<td style="font-size:12px;padding:10px;" width="100">대표자명 :</td>
									<td style="font-size:12px;padding:10px;" width="200">{president}</td>
									<td style="font-size:12px;padding:10px;"> </td>
									</tr>
									<tr>
									<td style="font-size:12px;padding:10px;" width="100">업태 :</td>
									<td style="font-size:12px;padding:10px;" width="200">{subject}</td>
									<td style="font-size:12px;padding:10px;"> </td>
									</tr>
									<tr>
									<td style="font-size:12px;padding:10px;" width="100">업종 :</td>
									<td style="font-size:12px;padding:10px;" width="200">{item}</td>
									<td style="font-size:12px;padding:10px;"> </td>
									</tr>
									<tr>
									<td style="font-size:12px;padding:10px;" width="100">우편번호 :</td>
									<td style="font-size:12px;padding:10px;" width="200">{post}</td>
									<td style="font-size:12px;padding:10px;"> </td>
									</tr>
									<tr>
									<td style="font-size:12px;padding:10px;" width="100">도시 :</td>
									<td style="font-size:12px;padding:10px;" width="200">{city}</td>
									<td style="font-size:12px;padding:10px;"> </td>
									</tr>
									<tr>
									<td style="font-size:12px;padding:10px;" width="100">주:</td>
									<td style="font-size:12px;padding:10px;" width="200">{state}</td>
									<td style="font-size:12px;padding:10px;"> </td>
									</tr>
									<tr>
									<td style="font-size:12px;padding:10px;" width="100">주소 :</td>
									<td style="font-size:12px;padding:10px;" width="200">{address}</td>
									<td style="font-size:12px;padding:10px;"> </td>
									</tr>
									<tr>
									<td style="font-size:12px;padding:10px;" width="100">전화번호 :</td>
									<td style="font-size:12px;padding:10px;" width="200">{tel}</td>
									<td style="font-size:12px;padding:10px;"> </td>
									</tr>
									<tr>
									<td style="font-size:12px;padding:10px;" width="100">팩스 :</td>
									<td style="font-size:12px;padding:10px;" width="200">{fax}</td>
									<td style="font-size:12px;padding:10px;"> </td>
									</tr>
									<tr>
									<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
									관리직원 :</td>
									<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">{manager}</td>
									<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;"> </td>
									</tr>
									</table>
									
									
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
									<tr>
									<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100"><b>매출 미수금</b></td>
									<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">{balance_sell}</td>
									<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;"> </td>
									</tr>
									<tr>
									<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100"><b>매입 미수금</b></td>
									<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">{balance_buy}</td>
									<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;"> </td>
									</tr>
									</table>
									
									<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
													<td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
													메모 :</td>
													<td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;">
										{comment}</td>
													</tr>
											</table>
											<p align="center">{form_submit}</p>
									
												</td>
										</tr>
									</table>


                            </div>
                            <div x-show="tab === 'viewTab2'" id="viewTab2">
                                bbb
                            </div>
                        </div>
                    </div>
					{formend}
                </div>

            </div>


        
			<table border="0" width="1200" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF">
					
					
			
			
			
		</x-main-content>    
	</x-main>    
</x-theme>
