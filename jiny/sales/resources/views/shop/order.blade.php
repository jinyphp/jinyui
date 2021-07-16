<x-theme>
	<x-main class="p-4">
		<x-main-content class="bg-white p-4">
			
		</x-main-content>
	</x-main>
</x-theme>

<div align="center">

<table border="0" width="1000" cellspacing="0" cellpadding="0">
	<tr>
		<td style=font-size:12px;padding:10px;>상품주문</td>
	</tr>
	<tr>
		<td style=border:1px solid #E9E9E9;font-size:12px;padding:10px; bgcolor="#FFFFFF">
 {formstart}
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;>
				주문상품</td>
			</tr>
			<tr>
				<td style=font-size:12px;padding:10px;>{datalist}</td>
			</tr>
		</table>
	
	<p>* 결제 및 입금방식</p>
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px; width="300" valign="top">{payment}</td>
			<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px; valign="top">{banklist}</td>
		</tr>
	</table>
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td width="500" valign="top">
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px; colspan="2">* 배송지 및 수령정보</td>
				</tr>
				<tr>
					<td style=font-size:12px;padding:10px; width="105">배송수령 국가:</td>
					<td style=font-size:12px;padding:10px;>{delivery_country}</td>
				</tr>
				<tr>
					<td style=font-size:12px;padding:10px; width="105">배송방식:</td>
					<td style=font-size:12px;padding:10px;>{delivery_way}</td>
				</tr>
				<tr>
					<td style=font-size:12px;padding:10px; width="105">도시:</td>
					<td style=font-size:12px;padding:10px;>{city}</td>
				</tr>
				<tr>
					<td style=font-size:12px;padding:10px; width="105">주/지역:</td>
					<td style=font-size:12px;padding:10px;>{state}</td>
				</tr>
				<tr>
					<td style=font-size:12px;padding:10px; width="105">주소:</td>
					<td style=font-size:12px;padding:10px;>{address}</td>
				</tr>
				<tr>
					<td style=font-size:12px;padding:10px; width="105">우편번호 :</td>
					<td style=font-size:12px;padding:10px;>{post}</td>
				</tr>
				<tr>
					<td style=font-size:12px;padding:10px; width="105">핸드폰/연락처:</td>
					<td style=font-size:12px;padding:10px;>{phone}</td>
				</tr>
				<tr>
					<td style=font-size:12px;padding:10px; width="105">수령자 (Last name):</td>
					<td style=font-size:12px;padding:10px;>{manager}</td>
				</tr>
				<tr>
					<td style=font-size:12px;padding:10px; width="105">수령자 (First name):</td>
					<td style=font-size:12px;padding:10px;>{firstname}</td>
				</tr>
			</table>
			</td>
			<td width="50" valign="top"> </td>
			<td  style=font-size:12px; valign="top">
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px; colspan="2">* 주문자 
					정보</td>
				</tr>
				<tr>
					<td style=font-size:12px;padding:10px; width="100">주문자 이메일 :</td>
					<td style=font-size:12px;padding:10px;>{email}</td>
				</tr>
				<tr>
					<td style=font-size:12px;padding:10px; width="100">주문 비밀번호:</td>
					<td style=font-size:12px;padding:10px;>{password}</td>
				</tr>
				</table>
			<p align="center">
			<font face="바탕">☞ </font>비회원 주문일 경우 상기 주문자 정보로 자동 가입처리 합니다.<p>
			 <p align="center">
			{paynow}</td>
		</tr>
	</table>
			{formend} 
		</td>
	</tr>
	<tr>
		<td style=font-size:12px;padding:10px;> </td>
	</tr>
</table>

</div>