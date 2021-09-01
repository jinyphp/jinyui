<x-theme>
	<x-main class="p-4">
		<x-main-content class="bg-white p-4">
			
		</x-main-content>
	</x-main>
</x-theme>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td style="border:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF" align="center">
		{formstart}<table border="0" width="100%" cellspacing="0" cellpadding="0" >
			<tr>
				<td style="font-size:12px;padding:10px;" width="110">레이아웃 상단여백 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{top_margin}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="110">레이아웃 하단여백 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{left_margin}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="110">레이아웃 배경색 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{bgcolor}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="110">레이아웃 정렬 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{align}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="110">사이트 가로크기 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{width}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
			</tr>
		</table>
		<p>{form_submit}{formend}</td>
	</tr>
	</table>