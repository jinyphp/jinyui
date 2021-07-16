<x-theme>
	<x-main class="p-4">
		<x-main-content class="bg-white p-4">
			
		</x-main-content>
	</x-main>
</x-theme>

{formstart}
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">이메일 :</td>
				<td style="font-size:12px;padding:10px;">{email}</td>
			</tr>
		</table>

		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">입금 계좌 안내 :</td>
				<td style="font-size:12px;padding:10px;" width="100">은행명 :</td>
				<td style="font-size:12px;padding:10px;">{bankname}</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100"> </td>
				<td style="font-size:12px;padding:10px;" width="100">계좌번호 :</td>
				<td style="font-size:12px;padding:10px;">{banknum}</td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100"> </td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">예금주 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				{bankuser}</td>
			</tr>
		</table>

		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:2px;">
					 </td>
			</tr>
		</table>

		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">입금금액 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{emoney}</td>
				<td style="font-size:12px;padding:10px;"> </td>
			</tr>
		</table>
		<p align="center">{form_submit}{formend}</p>
