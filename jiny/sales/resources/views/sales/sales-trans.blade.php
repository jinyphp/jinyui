<x-jinyui-theme theme="jinyerp" class="bootstrap">
	<table border="0" width="100%" cellspacing="0" cellpadding="0" >
		<tr>
			<td style="border:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF">
			{formstart}<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#E9E9E9">전표 작성</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">{delete}</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">{pay}</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
					{export}</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">{print}</td>
					
				</tr>
			</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td width="45%" valign="top"
						style="border-left:1px solid #E9E9E9;border-right:1px solid #E9E9E9;border-bottom:1px solid #E9E9E9;">
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="50">
					작성일 :</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100">
					{transdate}</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">{trans}</td>
				</tr>
			</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="50">
					사업자</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;">
					{business}</td>
					</tr>
			</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="50">
					거래처 :</td>
					<td style="font-size:12px;padding:2px;">
					{company_search}</td>
					<td style="font-size:12px;padding:2px;" width="50" align=center>
					{search}</td>
				</tr>
			</table>
					</td>
					<td width="55%" valign="top"
						style="border-right:1px solid #E9E9E9;border-bottom:1px solid #E9E9E9;">
	
	
	
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;border-right:1px solid #E9E9E9;font-size:12px;padding:10px;" align="right">
					요약</td>
					<td style="border-bottom:1px solid #E9E9E9;border-right:1px solid #E9E9E9;font-size:12px;padding:10px;" width="80">
					매출액</td>
					<td style="border-bottom:1px solid #E9E9E9;border-right:1px solid #E9E9E9;font-size:12px;padding:10px;" width="60">부가세</td>
					<td style="border-bottom:1px solid #E9E9E9;border-right:1px solid #E9E9E9;font-size:12px;padding:10px;" width="80">
					할인액</td>
					<td style="border-bottom:1px solid #E9E9E9;border-right:1px solid #E9E9E9;font-size:12px;padding:10px;" width="80">
					결제금액</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="80">
					미수금</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;border-right:1px solid #E9E9E9;font-size:12px;padding:10px;" align="right">
					일</td>
					<td style="border-bottom:1px solid #E9E9E9;border-right:1px solid #E9E9E9;font-size:12px;padding:10px;" width="80">
					{total_d}</td>
					<td style="border-bottom:1px solid #E9E9E9;border-right:1px solid #E9E9E9;font-size:12px;padding:10px;" width="60">{vat_d}</td>
					<td style="border-bottom:1px solid #E9E9E9;border-right:1px solid #E9E9E9;font-size:12px;padding:10px;" width="80">
					{discount_d}</td>
					<td style="border-bottom:1px solid #E9E9E9;border-right:1px solid #E9E9E9;font-size:12px;padding:10px;" width="80">
					{payment_d}</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="80">
					{balance_d}</td>
				</tr>
				<tr>
					<td style="border-right:1px solid #E9E9E9;font-size:12px;padding:10px;" align="right">
					월</td>
					<td style="border-right:1px solid #E9E9E9;font-size:12px;padding:10px;" width="80">
					{total_m}</td>
					<td style="border-right:1px solid #E9E9E9;font-size:12px;padding:10px;" width="60">{vat_m}</td>
					<td style="border-right:1px solid #E9E9E9;font-size:12px;padding:10px;" width="80">
					{discount_m}</td>
					<td style="border-right:1px solid #E9E9E9;font-size:12px;padding:10px;" width="80">
					{payment_m}</td>
					<td style="font-size:12px;padding:10px;" width="80">
					 </td>
				</tr>
				</table></td>
				</tr>
			</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0" >
				<tr><td style="font-size:12px;padding:10px;" width="50">
				창고 :</td><td style="font-size:12px;padding:10px;" width="150">
					{warehouse}</td>
					<td style="font-size:12px;padding:10px;" width="50">
					담당자 :</td><td style="font-size:12px;padding:10px;" width="150">
					{manager}</td><td style="font-size:12px;padding:10px;">
				 </td><td style="font-size:12px;padding:10px;" width="100">
				통화:{currency}</td>
					<td style="font-size:12px;padding:10px;" width="100">
				부가세율:
				{tax}% </td></tr>
			</table>
			{newdata}{datalist}{formend}</td>
		</tr>
	</table>
</x-jinyui-theme>



