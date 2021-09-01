<x-theme theme="jinyerp" class="bootstrap">
	<x-main-content>
		<x-container>

			<b>리셀러&nbsp; : </b>체널 트리구조
			{regist_check}
			{renewal_check}
			{new}


			{formstart}

			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="150">{country}</td>
					<td style="font-size:12px;padding:10px;">{name}</td>
					<td style="font-size:12px;padding:10px;" width="150">적립금 :
					{emoney}</td>
					<td style="font-size:12px;padding:10px;" width="50" align="right">검색:</td>
					<td style="font-size:12px;padding:10px;" width="200">{search_key}</td>
					<td style="font-size:12px;padding:10px;" width="80">{search}</td>
					<td style="font-size:12px;padding:10px;" width="80">{list_num}</td>
				</tr>
			</table>

			{reseller_list}

			{formend}

		</x-container>
	</x-main-content>
</x-theme>