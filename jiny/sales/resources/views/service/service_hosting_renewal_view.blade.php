<x-theme theme="jinyerp" class="bootstrap">
	<x-main-content>
		<x-container>
			<b>호스팅 : </b>신규 및 연장

			{formstart}
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
					구분 :</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
					{type}</td>
					</tr>
			</table>

			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">
					<font size="2">신청 호스팅 plan:</font></td>
					<td style="font-size:12px;padding:10px;" width="200"><font size="2">{plan}</font></td>
					<td style="font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
				</table>
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
					서비스 코드 :</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">
					{service_code}</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
					 </td>
					</tr>
				</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
					신청자 :</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
					{email}</td>
					</tr>
	</table>
	
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">
					보유 이머니 :</td>
					<td style="font-size:12px;padding:10px;" width="100">{emoney}</td>
					<td style="font-size:12px;padding:10px;">&nbsp;</td>
					</tr>
					<tr>
					<td style="font-size:12px;padding:10px;" width="100">
					결제비용 :</td>
					<td style="font-size:12px;padding:10px;" width="100">{pay_amount}</td>
					<td style="font-size:12px;padding:10px;">&nbsp;</td>
					</tr>
				</table>
	
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
					적용 서버 :</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">
					{server}</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
					 </td>
					</tr>
	</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
					리셀러
					공급자 :</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
					{reseller}</td>
					</tr>
	</table>
	
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;">
					{description}</td>
					</tr>
			</table>

			{form_submit}
			{formend}

		</x-container>
	</x-main-content>
</x-theme>