<x-theme>
	<x-main class="p-4">
		<x-main-content class="bg-white p-4">
			
		</x-main-content>
	</x-main>
</x-theme>

<div align="center">

<table border="0" width="1000" cellspacing="0" cellpadding="0">
	<tr>
		<td style=font-size:12px;padding:10px; width="50%">신용카드 : eximbay 결제</td>
		<td style=font-size:12px;padding:10px; width="50%">
		<p align="right">01 장바구니 > 02주문서 > <b>03주문결제</b></td>
	</tr>
	<tr>
		<td style=border:1px solid #E9E9E9;font-size:12px;padding:10px; bgcolor="#FFFFFF" colspan="2">
	
	{formstart}
	
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;>
				* 주문상품</td>
			</tr>
			<tr>
				<td style=font-size:12px;padding:10px;>{list}</td>
			</tr>
		</table>
	
<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;>
				*주문자 정보</td>
			</tr>
			</table>
	
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td style=font-size:12px;padding:10px; width="100">구매자 이름:</td>
			<td style=font-size:12px;padding:10px; width="300">{buyername}</td>
			<td style=font-size:12px;padding:10px; width="100">지불 통화:</td>
			<td style=font-size:12px;padding:10px;>{currency}</td>
		</tr>
		<tr>
			<td style=font-size:12px;padding:10px; width="100">구매자 전화번호:</td>
			<td style=font-size:12px;padding:10px; width="300">{buyertel}</td>
			<td style=font-size:12px;padding:10px; width="100">지불 금액:</td>
			<td style=font-size:12px;padding:10px;>{amount}</td>
		</tr>
		<tr>
			<td style=font-size:12px;padding:10px; width="100">구매자 이메일:</td>
			<td style=font-size:12px;padding:10px; width="300">{buyeremail}</td>
			<td style=font-size:12px;padding:10px; width="100"> </td>
			<td style=font-size:12px;padding:10px;> </td>
		</tr>
	</table>
		<p>* 배송지 정보</p>
	
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td style=border-top:1px solid #E9E9E9;font-size:12px;padding:10px; width="200" rowspan="9" valign="top">
			<p align="center">{payment_logo}</td>
			<td style=border-top:1px solid #E9E9E9;font-size:12px;padding:10px; width="100" valign="top">Country :</td>
			<td style=border-top:1px solid #E9E9E9;font-size:12px;padding:10px; valign="top">{dm_shipTo_country}</td>
		</tr>
		<tr>
			<td style=font-size:12px;padding:10px; width="100" valign="top">City :</td>
			<td style=font-size:12px;padding:10px; valign="top">{dm_shipTo_city}</td>
		</tr>
		<tr>
			<td style=font-size:12px;padding:10px; width="100" valign="top">State :</td>
			<td style=font-size:12px;padding:10px; valign="top">{dm_shipTo_state}</td>
		</tr>
		<tr>
			<td style=font-size:12px;padding:10px; width="100" valign="top">Street :</td>
			<td style=font-size:12px;padding:10px; valign="top">{dm_shipTo_street1}</td>
		</tr>
		<tr>
			<td style=font-size:12px;padding:10px; width="100" valign="top">Postal code 
				:</td>
			<td style=font-size:12px;padding:10px; valign="top">{dm_shipTo_postalCode}</td>
		</tr>
		<tr>
			<td style=font-size:12px;padding:10px; width="100" valign="top">Phone Number 
				:</td>
			<td style=font-size:12px;padding:10px; valign="top">{dm_shipTo_phoneNumber}</td>
		</tr>
		<tr>
			<td style=font-size:12px;padding:10px; width="100" valign="top">First Name 
				:</td>
			<td style=font-size:12px;padding:10px; valign="top">{dm_shipTo_firstName}</td>
		</tr>
		<tr>
			<td style=font-size:12px;padding:10px; width="100" valign="top">
			Last Name :</td>
			<td style=font-size:12px;padding:10px; valign="top">{dm_shipTo_lastName}</td>
		</tr>
		<tr>
			<td style=font-size:12px;padding:10px; width="100" valign="top"> </td>
			<td style=font-size:12px;padding:10px; valign="top">{pay}</td>
		</tr>
	</table>
		<p>{formend}</td>
	</tr>
	<tr>
		<td style=font-size:12px;padding:10px; colspan="2"> </td>
	</tr>
</table>

</div>
