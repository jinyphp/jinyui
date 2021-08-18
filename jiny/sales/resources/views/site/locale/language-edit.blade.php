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
				<b>홈페이지: 언어설정</b></td>
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
				<td style="font-size:12px;padding:10px;" width="80">언어코드</td>
				<td style="font-size:12px;padding:10px;">{code}</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="80">치환코드</td>
				<td style="font-size:12px;padding:10px;">{replace_code}</td>
			</tr>
			</table>
		<p>{language_name}</p>
		<p align="center">{form_submit}<p>{formend}&nbsp;</td>
	</tr>
	</table>

</div>
