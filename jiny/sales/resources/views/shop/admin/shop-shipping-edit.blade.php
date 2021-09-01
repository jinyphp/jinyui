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
				<b>쇼핑몰: 배송설정</b></td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
				 </td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9"> </td>
				
			</tr>
		</table>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" valign="top">
				다양한 배송방법에 대하여 설정할 수 있습니다.</td>
			</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100" valign="top">
				활성화 :</td>
				<td style="font-size:12px;padding:10px;" valign="top" width="200">{enable}</td>
				<td style="font-size:12px;padding:10px;" valign="top"> </td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100" valign="top">
				발송국가 :</td>
				<td style="font-size:12px;padding:10px;" valign="top" width="200">{depature_country}</td>
				<td style="font-size:12px;padding:10px;" valign="top"> </td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100" valign="top">
				수량국가 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" valign="top" width="200">{arrive_country}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" valign="top"> </td>
			</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100" valign="top">
				배송명 :</td>
				<td style="font-size:12px;padding:10px;" valign="top" width="200">{title}</td>
				<td style="font-size:12px;padding:10px;" valign="top"> </td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100" valign="top">
				배송금액 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" valign="top" width="200">{ship_cost}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" valign="top"> </td>
			</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100" valign="top">
				배송 담당자 :</td>
				<td style="font-size:12px;padding:10px;" valign="top" width="200">
				{manager}</td>
				<td style="font-size:12px;padding:10px;" valign="top"> </td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100" valign="top">
				업체 연락처 :</td>
				<td style="font-size:12px;padding:10px;" valign="top" width="200">
				{phone}</td>
				<td style="font-size:12px;padding:10px;" valign="top"> </td>
			</tr>
<tr>
				<td style="font-size:12px;padding:10px;" width="100" valign="top">
				배송국가 표시 :</td>
				<td style="font-size:12px;padding:10px;" valign="top" width="200">
				{check_country}</td>
				<td style="font-size:12px;padding:10px;" valign="top"> </td>
			</tr>
			</table>
		<p align="center">{form_submit}<p>{formend} </td>
	</tr>
	</table>

</div>
