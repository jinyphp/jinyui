<x-jinyui-theme theme="jinyerp" class="bootstrap">
	<table border="0" width="1200" cellspacing="0" cellpadding="0">
		<tr>
			<td style="border:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF">
			{formstart}
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#E9E9E9">
					<b>판매관리: </b>견적서 목록</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
					&nbsp;</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
					{delete}</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
					{print}</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
					{new}</td>
					
				</tr>
			</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0" >
				<tr>
				<td style="font-size:12px;padding:10px;" width="150">{business}</td>
				<td style="font-size:12px;padding:10px;" width="60">작성일자 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{start}</td>
				<td style="font-size:12px;padding:10px;" width="10"> ~ </td>
				<td style="font-size:12px;padding:10px;" width="100">{end}</td>
				<td style="font-size:12px;padding:10px;" width="80">{priod_search}</td>
				<td style="font-size:12px;padding:10px;" align="right">검색:</td>
				<td style="font-size:12px;padding:10px;" width="200">{search_key}</td>
				<td style="font-size:12px;padding:10px;" width="100">{search}</td>
				<td style="font-size:12px;padding:10px;" width="100">{list_num}</td>
				</tr>
			</table>
			{datalist}
			{formend}</td>
		</tr>
		</table>
</x-jinyui-theme>


