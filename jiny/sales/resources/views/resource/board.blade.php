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
				<td style="font-size:20px;padding:10px;">
				{board_title}</td>
			</tr>
		</table>
		<p align="center">{board_list}</p>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">{list_num}</td>
				<td style="font-size:12px;padding:10px;">전체 : {total} 글</td>
				<td style="font-size:12px;padding:10px;" width="80" align="right">검색:</td>
				<td style="font-size:12px;padding:10px;" width="200">{search_key}</td>
				<td style="font-size:12px;padding:10px;" width="80">{search}</td>
				<td style="font-size:12px;padding:10px;" width="80">{new}</td>
			</tr>
		</table>
		
		<p>{formend}&nbsp;</td>
	</tr>
	</table>

</div>