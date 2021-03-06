<x-theme>
	<x-main class="p-4">
		<x-main-content class="bg-white p-4">
			
		</x-main-content>
	</x-main>
</x-theme>

<div align="center">

<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td style="border:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF">
		
		{formstart}
		
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#E9E9E9" width="200">
				쇼핑몰 : 상품등록 및 수정</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding-right:10px;" bgcolor="#E9E9E9" align="right">		
				{form_submit}</td>				
			</tr>
		</table>
		
        <table border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td style="font-size:12px;padding:10px;">
		<ul class="tab-menu" id="tabMenu1">
        	<li class="menuitem1">기본정보</li>
        	<li class="menuitem2">카테고리</li>
        	<li class="menuitem3">제품명&설명</li>
        	<li class="menuitem4">가격정보</li>
        	<li class="menuitem5">상품이미지</li> 
        	<li class="menuitem6">관심상품</li>
        	<li class="menuitem7">상품입점</li>
        	<li class="menuitem8">개별스킨</li>
    	</ul>
				</td>
			</tr>
		</table>
			

		
	<div class="tab-contents">
	
		<!-- 기본자료 -->
		<div class="content" style="border-top:1px solid #E9E9E9;">
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;"><b>* 기본정보</b></td>
			</tr>
			</table>
			
			
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100" style="font-size:12px;padding:10px;">상품판매 : </td>
		<td style="font-size:12px;padding:10px;">{enable}</td>
	</tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100" style="font-size:12px;padding:10px;">판매기간 :</td>
		<td style="font-size:12px;padding:10px;" width="30">{check_priod}</td>
		<td style="font-size:12px;padding:10px;" width="100">{startselling}</td>
		<td style="font-size:12px;padding:10px;" width="10">~</td>
		<td style="font-size:12px;padding:10px;" width="100">{endselling}</td>
		<td style="font-size:12px;padding:10px;"> </td>
	</tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td style="font-size:12px;padding:10px;" width="100" >상품출력 가중치 :</td>
		<td style="font-size:12px;padding:10px;" width="100" >{pos}</td>
		<td style="font-size:12px;padding:10px;"></td>
	</tr>
	</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;"><b>* 공급 및 입고처리</b></td>
	</tr>
</table>
<table border="0" width="978" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100" style="font-size:12px;padding:10px;">입점승인:</td>
		<td style="font-size:12px;padding:10px;" width="200">{seller_auth}</td>
		<td style="font-size:12px;padding:10px;"> </td>
	</tr>
	<tr>
		<td width="100" style="font-size:12px;padding:10px;">판매/입점업체 :</td>
		<td style="font-size:12px;padding:10px;" width="200">{seller}</td>
		<td style="font-size:12px;padding:10px;"> </td>
	</tr>
	<tr>
		<td width="100" style="font-size:12px;padding:10px;">입점  지역국가 :</td>
		<td style="font-size:12px;padding:10px;" width="200">{country}</td>
		<td style="font-size:12px;padding:10px;"> </td>
	</tr>
	<tr>
		<td width="100" style="font-size:12px;padding:10px;">대리배송(입점) :</td>
		<td style="font-size:12px;padding:10px;" width="200">{seller_order}</td>
		<td style="font-size:12px;padding:10px;"> </td>
	</tr>
	<tr>
		<td width="100" style="font-size:12px;padding:10px;">무료배송 :</td>
		<td style="font-size:12px;padding:10px;" width="200">{free_shipping}</td>
		<td style="font-size:12px;padding:10px;"> </td>
	</tr>
	<tr>
		<td width="100" style="font-size:12px;padding:10px;">배송/판매 :</td>
		<td style="font-size:12px;padding:10px;" width="200">{sales_country}</td>
		<td style="font-size:12px;padding:10px;"> </td>
	</tr>
	</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;"><b>* 정보 및 가격설정</b></td>
	</tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100" style="font-size:12px;padding:10px;">상품코드 :</td>
		<td style="font-size:12px;padding:10px;" width="200">{goodcode}</td>
	
		<td style="font-size:12px;padding:10px;"> </td>
	</tr>
	<tr>
		<td width="100" style="font-size:12px;padding:10px;">모델명:</td>
		<td style="font-size:12px;padding:10px;" width="200">{model}</td>

		<td style="font-size:12px;padding:10px;"> </td>
	</tr>
	<tr>
		<td width="100" style="font-size:12px;padding:10px;">브랜드 :</td>
		<td style="font-size:12px;padding:10px;" width="200">{brand}</td>
		
		<td style="font-size:12px;padding:10px;"> </td>
	</tr>
	<tr>
		<td width="100" style="font-size:12px;padding:10px;">바코드:</td>
		<td style="font-size:12px;padding:10px;" width="200">{barcode}</td>
		
		<td style="font-size:12px;padding:10px;"> </td>
	</tr>
	</table>



<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td style="font-size:12px;padding:10px;" width="100">블로그 링크 :</td>
		<td style="font-size:12px;padding:10px;">{blog}</td>
	</tr>
</table>



<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td style="font-size:12px;padding:10px;" width="100">Youtube 동영상 :</td>
		<td style="font-size:12px;padding:10px;">{youtube}</td>
	</tr>
</table>



<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;"><b>* 출력항목 설정</b></td>
	</tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100" style="font-size:12px;padding:10px;">가격표시:</td>
		<td style="font-size:12px;padding:10px;" width="100">{check_prices}</td>
		<td style="font-size:12px;padding:10px;"> </td>
	</tr>
	<tr>
		<td width="100" style="font-size:12px;padding:10px;">회원가격전용:</td>
		<td style="font-size:12px;padding:10px;" width="100">{check_memprices}</td>
		<td style="font-size:12px;padding:10px;"> </td>
		</tr>
	<tr>
		<td width="100" style="font-size:12px;padding:10px;">USD:</td>
		<td style="font-size:12px;padding:10px;" width="100">{check_usd}</td>
		<td style="font-size:12px;padding:10px;"> </td>
		</tr>
	<tr>
		<td width="100" style="font-size:12px;padding:10px;">주문문구 :</td>
		<td style="font-size:12px;padding:10px;" width="100">{ordertext}</td>
		<td style="font-size:12px;padding:10px;"> </td>
		</tr>
	<tr>
		<td width="100" style="font-size:12px;padding:10px;">상품명:</td>
		<td style="font-size:12px;padding:10px;" width="100">{check_goodname}</td>
		<td style="font-size:12px;padding:10px;"> </td>
	</tr>
	<tr>
		<td width="100" style="font-size:12px;padding:10px;">스팩:</td>
		<td style="font-size:12px;padding:10px;" width="100">{check_spec}</td>
		<td style="font-size:12px;padding:10px;"> </td>
		</tr>
	<tr>
		<td width="100" style="font-size:12px;padding:10px;">간략설명:</td>
		<td style="font-size:12px;padding:10px;" width="100">{check_subtitle}</td>
		<td style="font-size:12px;padding:10px;"> </td>
		</tr>
	<tr>
		<td width="100" style="font-size:12px;padding:10px;">첨부파일 :</td>
		<td style="font-size:12px;padding:10px;" width="100">{attach}</td>
		<td style="font-size:12px;padding:10px;"> </td>
		</tr>
	</table>



			<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">첨부파일 라벨명:</td>
				<td style="font-size:12px;padding:10px;">{attach_label}</td>
			</tr>
			</table>

			<p> </p>




        	<p> </p>
			<p> 
		</div>
		
        <!-- 상품분류 -->
		<div class="content"  style="border-top:1px solid #E9E9E9;">
            
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100%" valign="top"><b>* 상품분류 및 카테고리</b></td>
			</tr>
			</table>
            
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td width="50%" valign="top" style="font-size:12px;padding:10px;">
            
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100%" valign="top">메인 카테고리 : ( 마스터 입점 상품 분류 입니다)</td>
			</tr>
			</table>
            
			<p>{main_cate}</p>
            
            		</td>
					<td width="50%" valign="top" style="font-size:12px;padding:10px;">
            
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100%" valign="top">Shop 카테고리 : 운영 쇼핑몰 카테고리 분류 입니다.</td>
			</tr>
			</table>
            <p>{cate}</p>
					</td>
				</tr>
			</table>
		</div>
        
        <!-- 상품설명 -->
		<div class="content"  style="border-top:1px solid #E9E9E9;">
            
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100%" valign="top"><b>* 상품설명 내용 및 언어별 설정</b></td>
			</tr>
			</table>
            
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				관련이미지 :</td>
				<td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">
				{html_images_upload}</td>
				<td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;">
				{upload}</td>
			</tr>
			</table>
			
			{images_files}
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100%" valign="top">
				{selling_language_form}</td>
			</tr>
			</table>
			
		</div>
     
		
		<!-- 가격설정 -->		
		<div class="content"  style="border-top:1px solid #E9E9E9;">
            
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100%" valign="top"><b>* 가격설정</b></td>
			</tr>
			</table>
            
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td width="100" style="font-size:12px;padding:10px;">부가세 포함가격 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{vat}</td>
				<td style="font-size:12px;padding:10px;"> </td>
			</tr>
			</table>
			
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td width="100" style="font-size:12px;padding:10px;">부가세율 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{vatrate} </td>
				<td style="font-size:12px;padding:10px;"> </td>
			</tr>
			</table>
				
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td width="100" style="font-size:12px;padding:10px;">판매가격 :</td>
				<td style="font-size:12px;padding:10px;" width="200">{sell_currency}</td>
				<td style="font-size:12px;padding:10px;" width="200">{prices_sell}</td>
				<td style="font-size:12px;padding:10px;">일반 소비자 가격입니다.</td>
			</tr>
			<tr>
				<td width="100" style="font-size:12px;padding:10px;">B2B(도매) 단가 :</td>
				<td style="font-size:12px;padding:10px;" width="200">{b2b_currency}</td>
				<td style="font-size:12px;padding:10px;" width="200">{prices_b2b}</td>
				<td style="font-size:12px;padding:10px;">도매쇼핑몰 쇼핑시 적용가격, 입점 및 납품시 적용 기준가격입니다.</td>
			</tr>
			<tr>
				<td width="100" style="font-size:12px;padding:10px;">매입가격 :</td>
				<td style="font-size:12px;padding:10px;" width="200">{buy_currency}</td>
				<td style="font-size:12px;padding:10px;" width="200">{prices_buy}</td>
				<td style="font-size:12px;padding:10px;">판매재고 / 매출계산시 적용되는 가격입니다.</td>
			</tr>
			</table>
		
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;"><b>*할인 및 가격이벤트</b></td>
			</tr>
			</table>
		
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">가격할인 : </td>
				<td style="font-size:12px;padding:10px;" width="100">{discount}</td>
				<td style="font-size:12px;padding:10px;" width="100"> </td>
				<td style="font-size:12px;padding:10px;"> </td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">할인율(%):</td>
				<td style="font-size:12px;padding:10px;" width="100">{discount_rate}</td>
				<td style="font-size:12px;padding:10px;" width="100"> </td>
				<td style="font-size:12px;padding:10px;"> </td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">할인기간 만료 :</td>
				<td style="font-size:12px;padding:10px;" width="200" colspan="2">{discount_endpriod}</td>
				<td style="font-size:12px;padding:10px;"> </td>
			</tr>
			</table>

			<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;"><b>* 재고 및 발주처리</b></td>
			</tr>
			</table>
		
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">품절처리 : </td>
				<td style="font-size:12px;padding:10px;" width="100">{soldout}</td>
				<td style="font-size:12px;padding:10px;" width="100"> </td>
				<td style="font-size:12px;padding:10px;"> </td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">재고수량 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{stock}</td>
				<td style="font-size:12px;padding:10px;" width="100"> </td>
				<td style="font-size:12px;padding:10px;"> </td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">재고 연동주문 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{stock_check}</td>
				<td style="font-size:12px;padding:10px;" width="100"> </td>
				<td style="font-size:12px;padding:10px;"> </td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">안전재고수량 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{safe_stock}</td>
				<td style="font-size:12px;padding:10px;" width="100"> </td>
				<td style="font-size:12px;padding:10px;"> </td>
			</tr>
			</table>
		</div> 
		
		
		
	
        		
		<!-- 상품 이미지 -->
		<div class="content" style="border-top:1px solid #E9E9E9;">
           
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" valign="top"><b>*상품 이미지</b></td>
			</tr>
			</table>

			<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">외각선 처리 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{images_outline}</td>
				<td style="font-size:12px;padding:10px;" width="100"> </td>
				<td style="font-size:12px;padding:10px;" width="100"> </td>
				<td style="font-size:12px;padding:10px;"> </td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">아웃라인 칼라 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{outline_color}</td>
				<td style="font-size:12px;padding:10px;" width="100">아웃라인 두께 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{outline_width}</td>
				<td style="font-size:12px;padding:10px;"> </td>
			</tr>
			</table>

			<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">이미지크기:</td>
				<td style="font-size:12px;padding:10px;" width="100">{imgsize}</td>
				<td style="font-size:12px;padding:10px;" width="100">모바일 크기:</td>
				<td style="font-size:12px;padding:10px;" width="100">{mobile_imgsize}</td>
				<td style="font-size:12px;padding:10px;"> </td>
			</tr>
			</table>

			<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">워터마크 :</td>
				<td style="font-size:12px;padding:10px;" width="500">{watermark}</td>
				<td style="font-size:12px;padding:10px;"> </td>
			</tr>
			</table>

			<p> </p>

			<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="929" valign="top"><b>* 
				이미지파일</b></td>
			</tr>
			</table>



			<p>{goods_images}</p>




			<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="929" valign="top"><b>*첨부파일</b></td>
			</tr>
			</table>



			<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100" valign="top">첨부파일1 :</td>
				<td style="font-size:12px;padding:10px;" width="265" valign="top">{filename1_upload}</td>
				<td style="font-size:12px;padding:10px;" valign="top" width="638">{filelink1}</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100" valign="top">첨부파일2 :</td>
				<td style="font-size:12px;padding:10px;" width="265" valign="top">{filename2_upload}</td>
				<td style="font-size:12px;padding:10px;" valign="top" width="638">{filelink2}</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100" valign="top">첨부파일3 :</td>
				<td style="font-size:12px;padding:10px;" width="265" valign="top">{filename3_upload}</td>
				<td style="font-size:12px;padding:10px;" valign="top" width="638">{filelink3}</td>
			</tr>
			</table>



			<p> </p>



			<p> 
		
		</div>
		
		<!-- 관련분류 -->
		<div class="content"  style="border-top:1px solid #E9E9E9;">
            
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;"><b>* 관련상품</b></td>
			</tr>
			</table>
			
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td width="100" style="font-size:12px;padding:10px;">관련 표시 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{relation_check}</td>
				<td style="font-size:12px;padding:10px;" width="100"> </td>
				<td style="font-size:12px;padding:10px;" width="100"> </td>
				<td style="font-size:12px;padding:10px;"> </td>
			</tr>
			<tr>
				<td width="100" style="font-size:12px;padding:10px;">출력방식 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{relation_type}</td>
				<td style="font-size:12px;padding:10px;" width="100">이미지 사이즈 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{relation_imgsize}</td>
				<td style="font-size:12px;padding:10px;"> </td>
			</tr>
			<tr>
				<td width="100" style="font-size:12px;padding:10px;">가로출력수 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{relation_cols}</td>
				<td style="font-size:12px;padding:10px;" width="100">세로출력수 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{relation_rows}</td>
				<td style="font-size:12px;padding:10px;"> </td>
			</tr>
			</table>
            
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">관련상품 :</td>
				<td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;">
				{relation_goods}</td>
				<td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">{relation_new}</td>
			</tr>
			</table>
			
			{relation_list}<p> </p>
			<p> 
			
		</div>
		
		<!-- 상품입점 -->
		<div class="content" style="border-top:1px solid #E9E9E9;">
            
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;"><b>* 상품입점</b></td>
			</tr>
			</table>
			
			{resales_goods}<p> </p>
			<p> 
		</div>   
	
		<!-- 디자인 스킨 -->
        <div class="content" style="border-top:1px solid #E9E9E9;">
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;"><b>* 디자인 스킨 : </b>본 상품에 
				대한 개별 디자인을 적용합니다.</td>
			</tr>
			</table>
			
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;">{html_skin}</td>
			</tr>
			</table>
		</div>
     
    </div>
    
    
		<p align="center">{form_submit}</p>
<p>{formend}

	</td>
	</tr>
	</table>

</div>