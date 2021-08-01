<x-jinyui-theme theme="jinyerp" class="bootstrap">
	
<table border="0" width="1200" cellspacing="0" cellpadding="0">
	<tr>
		<td style="border:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF">
		{formstart}<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#E9E9E9">
				<b>판매관리 :</b> 제품목록</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9" align="right">
				&nbsp;</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">&nbsp;</td>
				
			</tr>
		</table>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				상품
				활성화 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				{enable}</td>
				</tr>
			</table>


		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				상품 타입 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				{type_normal} 일반매입 상품 / {type_bom} 
				제조생산품</td>
				</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				상품명 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				{name}</td>
				</tr>
		</table>


		<table border="0" width="1178" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				상품코드 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">
				{goodcode}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				&nbsp;</td>
				</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				바코드 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">
				{barcode}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				{scan}</td>
				</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				모델명 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">
				{model}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				&nbsp;</td>
				</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				브랜드 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">
				{brand}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				&nbsp;</td>
				</tr>
		</table>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				매출가격 :</td>
				<td style="font-size:12px;padding:10px;" width="200">
				{sell_currency}</td>
				<td style="font-size:12px;padding:10px;" width="100">
	{prices_sell}</td>
				<td style="font-size:12px;padding:10px;">
	{sell_vat_on}부가세포함 / {sell_vat_off}부가세별도</td>
				</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				B2B 공급단가 :</td>
				<td style="font-size:12px;padding:10px;" width="200">
				{b2b_currency}</td>
				<td style="font-size:12px;padding:10px;" width="100">
	{prices_b2b}</td>
				<td style="font-size:12px;padding:10px;">
	{b2b_vat_on}부가세포함 / {b2b_vat_off}부가세별도</td>
				</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				매입가격 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">
	{buy_currency}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
	{prices_buy}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
	{buy_vat_on}부가세포함 / {buy_vat_off}부가세별도</td>
				</tr>
			</table>

	<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				<b>* 재고설정</b></td>
				</tr>
	</table>
	{stock_info}
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td style="font-size:12px;padding:10px;" width="120">재고부족 판매중단:</td>
			<td style="font-size:12px;padding:10px;" width="100">{stock_check}</td>
			<td style="font-size:12px;padding:10px;">재고부족시 매입/매출을 제한합니다.</td>
		</tr>
		<tr>
			<td style="font-size:12px;padding:10px;" width="120">안전 재고량 경고:</td>
			<td style="font-size:12px;padding:10px;" width="100">{stock_safe}</td>
			<td style="font-size:12px;padding:10px;">안전재고 수량 이하 발생시 경고</td>
		</tr>
	</table>

	<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				<b>* 매입 거래처 설정 및 사업장</b></td>
				</tr>
	</table>
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				사업장 :</td>
				<td style="font-size:12px;padding:10px;">{business}</td>
				</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				거래처 :</td>
				<td style="font-size:12px;padding:10px;">{company}</td>
				</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				분류
				카테고리 :</td>
				<td style="font-size:12px;padding:10px;">{cate}</td>
				</tr>
			</table>

	<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				<b>* 쇼핑몰 연동 판매</b></td>
				</tr>
	</table>
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
	쇼핑몰 연동판매 :</td>
				<td style="font-size:12px;padding:10px;">{shopping}</td>
				</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				연동 상품 :</td>
				<td style="font-size:12px;padding:10px;">{shop_uid}</td>
				</tr>
			</table>

	<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				<b>* 참고 정보</b></td>
				</tr>
	</table>
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				상품 사진 :</td>
				<td style="font-size:12px;padding:10px;">{images}</td>
				</tr>
			</table>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				*
				<font size="2">메모</font></td>
				</tr>
</table>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;">
				<font size="2">{comment}</font></td>
				</tr>
</table>
		<p align="center">{form_submit}</p>
		<p>{formend}&nbsp;</td>
	</tr>
	</table>
</x-jinyui-theme>

