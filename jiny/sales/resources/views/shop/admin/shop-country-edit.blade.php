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
				<b>쇼핑몰: 국가설정</b></td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
				&nbsp;</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">&nbsp;</td>
				
			</tr>
		</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="80">활성화:</td>
				<td style="font-size:12px;padding:10px;">{enable}</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="80">국가코드</td>
				<td style="font-size:12px;padding:10px;">{code}</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="80">치환코드</td>
				<td style="font-size:12px;padding:10px;">{replace_code}</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="80">기본언어:</td>
				<td style="font-size:12px;padding:10px;">{language}</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="80">화페통화:</td>
				<td style="font-size:12px;padding:10px;">{currency}</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="80">부가세(tax)</td>
				<td style="font-size:12px;padding:10px;">{tax}</td>
			</tr>
			</table>
		<p>{country_name}</p>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="80">사무실 주소:</td>
				<td style="font-size:12px;padding:10px;">{country_address}</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="80">연락처:</td>
				<td style="font-size:12px;padding:10px;">{country_phone}</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="80">팩스</td>
				<td style="font-size:12px;padding:10px;">{country_fax}</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="80">이메일</td>
				<td style="font-size:12px;padding:10px;">{country_email}</td>
			</tr>
			</table>
		<p align="center">{form_submit}<p>{formend}&nbsp;</td>
	</tr>
	</table>

</div>
