<x-jinyui-theme theme="jinyerp" class="bootstrap">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3">판매관리: 거래처</h1>

		<div class="flex flex-row justify-between">
			<div>
				<x-jinyui::button.button class="btn-secondary">Manual</x-jinyui::button.button>
			</div>
			<div>
				<x-jinyui::button.button class="btn-primary">추가</x-jinyui::button.button>
			</div>
		</div>

	<div>

	<form>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="150">{business}</td>
				<td style="font-size:12px;padding:10px;" width="150">{country}</td>
				<td style="font-size:12px;padding:10px;" width="100">{company_type}</td>
				<td style="font-size:12px;padding:10px;"></td>
	
				<td style="font-size:12px;padding:10px;" width="50" align="right">검색:</td>
				<td style="font-size:12px;padding:10px;" width="200">{search_key}</td>
				<td style="font-size:12px;padding:10px;" width="100">{search}</td>
				<td style="font-size:12px;padding:10px;" width="100">{list_num}</td>
			</tr>
		</table>
	</form>


	<x-jinyui-card>
		<x-jinyui::table.basic>
		{datalist}
		</x-jinyui::table.basic>
	</x-jinyui-card>


	

	



</x-jinyui-theme>


