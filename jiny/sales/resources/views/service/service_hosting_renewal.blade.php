<x-theme theme="jinyerp" class="bootstrap">
	<x-main-content>
		<x-container>
			<b>호스팅&nbsp; : </b>신규 및 연장
			{formstart}

			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;">&nbsp;</td>
					<td style="font-size:12px;padding:10px;" width="100" align="right">
					검색 :</td>
					<td style="font-size:12px;padding:10px;" width="200">{search_key}</td>				
					<td style="font-size:12px;padding:10px;" width="100">{search}</td>
					<td style="font-size:12px;padding:10px;" width="100">{list_num}</td>
				</tr>
			</table>

			{list}

			{formend}


		</x-container>
	</x-main-content>
</x-theme>