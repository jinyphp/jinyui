<x-theme theme="jinyerp" class="bootstrap">
	<x-main-content>
		<x-container>
			<b>리셀러 프로그램 : </b>체널 서비스 구성
			{new}

			{formstart}

			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="150">{country}</td>
					<td style="font-size:12px;padding:10px;">{reseller}</td>
					<td style="font-size:12px;padding:10px;" width="80">검색:</td>
					<td style="font-size:12px;padding:10px;" width="200">{search_key}</td>
					<td style="font-size:12px;padding:10px;" width="80">{search}</td>
					<td style="font-size:12px;padding:10px;" width="80">{list_num}</td>
				</tr>
			</table>

			{datalist}

			{formend}


		</x-container>
	</x-main-content>
</x-theme>
