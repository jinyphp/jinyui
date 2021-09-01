<x-theme theme="jinyerp" class="bootstrap">
	<x-main-content>
		<x-container>

			<b>서비스 : </b>분산 서버목록
			{new}

			{formstart}

			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;">분산서버를 구축하여 체널파트너들이 유연하게 
					서비스 scale out 환경을 구축할 수 있습니다.</td>
					<td style="font-size:12px;padding:10px;" width="100" align="right">검색 :</td>
					<td style="font-size:12px;padding:10px;" width="200">{search_key}</td>				
					<td style="font-size:12px;padding:10px;" width="100">{search}</td>
					<td style="font-size:12px;padding:10px;" width="100">{list_num}</td>
				</tr>
			</table>

			{server_list}
			{formend}
			
		</x-container>
	</x-main-content>
</x-theme>