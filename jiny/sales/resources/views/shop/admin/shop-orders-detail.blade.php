<x-theme>
	<x-main class="p-4">
		<x-main-content class="bg-white p-4">
			
		</x-main-content>
	</x-main>
</x-theme>

<div align="center">

<table border="0" width="1200" cellspacing="0" cellpadding="0">
	<tr>
		<td style="border:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF" valign="top">
		{formstart}<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#E9E9E9">
				<b>주문내역 상세</b></td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
				 </td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
					{delete}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
					{trans}</td>	
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
				{print}</td>
			</tr>
		</table>
		
		
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td	style="font-size:12px;padding-right:10px;" valign="top" width="50%">
		
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				주문일자 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				{regdate}</td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">주문코드 : </td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">{ordercode}</td>
			</tr>
			</table>
		
		
				</td>
				<td style="font-size:12px;padding-left:10px;" valign="top" width="50%">
		
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="70">
				결제방법 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="80">
				{payment}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				{payment_info}</td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="70">
				주문상태 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="80">
				{order_status}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;"> </td>
			</tr>
		</table>
		
		
				</td>
			</tr>
		</table>
		
		
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				* <b>주문자 회원 정보</b></td>
			</tr>
		</table>
		<table border="0" width="978" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" valign="top" width="100">
				이메일: </td>
				<td style="font-size:12px;padding:10px;" valign="top">
				{order_name} 
				/ {email}</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" valign="top" width="100">
				연락처 : </td>
				<td style="font-size:12px;padding:10px;" valign="top">
				{phone}</td>
			</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				* <b>주문상품</b></td>
			</tr>
		</table>
		<p>{order_detail_list}</p>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				* <b>배송정보</b></td>
			</tr>
		</table>
		
		
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td	style="font-size:12px;padding-right:10px;" valign="top" width="50%">
		
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				배송국가 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				{receive_country}</td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				도시 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				{receive_city}</td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				주 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				{receive_state}</td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				수령자명(성) :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				{receive_firstname}</td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				주령자명(이름):</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				{receive_lastname}</td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				연락처 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				{receive_phone}</td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				우편번호 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				{receive_post}</td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				주소 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				{receive_address}</td>
			</tr>
		</table>
		
		
				</td>
				<td style="font-size:12px;padding-left:10px;" valign="top" width="50%">
		
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				배송
				발송일자:</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="150">
				{shipping_datetime}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				 </td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">배송 
				대행업체:</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="150">{shipping_company}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;"> </td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				배송
				송장번호:</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="150">{shipping_invoice}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;"> </td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				배송
				담당자 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="150">{shipping_firstname}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;"> </td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100"> </td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="150">{shipping_lastname}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;"> </td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				배송업체
				연락처:</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="150">{shipping_phone}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;"> </td>
			</tr>
		</table>
		
		
		<div align="center">
			<table border="0" width="300" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="150"> </td>
					<td style="font-size:12px;padding:10px;" width="150">
					 </td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="150">{status}</td>
					<td style="font-size:12px;padding:10px;" width="150">
				{form_submit}</td>
				</tr>
			</table>
		</div>
				</td>
			</tr>
		</table>
		
		
		<p> </p>
		<p>{formend}</td>
	</tr>
	</table>

</div>
