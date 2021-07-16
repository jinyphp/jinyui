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
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				{board_title}<font size="2"> &gt; {title}</font></td>
			</tr>
		</table>
		
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:10px;padding:5px;" align="right">{regdate}&nbsp; {email}</td>
			</tr>
		</table>
		<p>{images}</p>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td style="font-size:12px;padding:10px;">{html}</td>
	</tr>
</table>

		<p>{files}</p>

		<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td style="font-size:12px;padding:10px;" width="50%">{listback}</td>
		<td style="font-size:12px;padding:10px;" width="50%" align="right">{form_submit}</td>
	</tr>
</table>

		<p>{comment}<p>{formend}</td>
	</tr>
	</table>

</div>
