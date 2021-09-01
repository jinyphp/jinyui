<x-theme>
	<x-main class="p-4">
		<x-main-content class="bg-white p-4">
			
		</x-main-content>
	</x-main>
</x-theme>

<div align="center">

<table border="0" width="1200" cellspacing="0" cellpadding="0">
	<tr>
		<td style="border:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF">
		{formstart}<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#E9E9E9">
				<b>쇼핑몰 :</b>
				장바구니</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
				 </td>
				
			</tr>
		</table>
		
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">등록일자 :</td>
				<td style="font-size:12px;padding:10px;">{regdate}</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">장바구니 코드 :</td>
				<td style="font-size:12px;padding:10px;">{cartlog}</td>
			</tr>
		</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">판매자 :</td>
				<td style="font-size:12px;padding:10px;" colspan="2">{seller}</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100"> </td>
				<td style="font-size:12px;padding:10px;" colspan="2">{images}</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">제품명 :</td>
				<td style="font-size:12px;padding:10px;" colspan="2">{goodname}</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">가격 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{num}</td>
				<td style="font-size:12px;padding:10px;"> </td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">수량 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{prices}</td>
				<td style="font-size:12px;padding:10px;"> </td>
			</tr>
		</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">배송방법 :</td>
				<td style="font-size:12px;padding:10px;">{shipping}</td>
			</tr>
		</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">첨부파일 :</td>
				<td style="font-size:12px;padding:10px;">{attach}</td>
			</tr>
		</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">주문문구 :</td>
				<td style="font-size:12px;padding:10px;">{ordertext}</td>
			</tr>
		</table>
		<p align="center">{form_submit}<p>{formend}</td>
	</tr>
	</table>

</div>