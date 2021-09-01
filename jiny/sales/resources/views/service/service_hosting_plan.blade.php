<x-theme theme="jinyerp" class="bootstrap">
	<x-main-content>
		<x-container>
			<b>서비스 : </b>호스팅 플랜
			{new}

			{formstart}

			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;">체널별로 서비스 호스팅 플랜을 만들어 
					회원을 유치할 수 있습니다.</td>
					<td style="font-size:12px;padding:10px;" width="100" align="right">검색 :</td>
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