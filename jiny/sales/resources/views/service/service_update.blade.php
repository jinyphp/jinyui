<x-theme theme="jinyerp" class="bootstrap">
	<x-main-content>
		<x-container>
			{formstart}

			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#E9E9E9">
					업데이트</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
					&nbsp;</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">&nbsp;</td>
					
				</tr>
			</table>
			<table border="0" width="1178" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="150">
					<b>* 데이터베이스</b></td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="90">
					&nbsp;</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="918">
					&nbsp;</td>
					</tr>
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="150">
					판매재고 :</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="90">
					{update_database_sales}</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="918">
					{update_database_sales_times}</td>
					</tr>
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="150">
					쇼핑몰 :</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="90">
					{update_database_shop}</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="918">
					{update_database_shop_times}</td>
					</tr>
			</table>
			<table border="0" width="1178" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="150">
					<b>* 실행파일</b></td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="90">
					&nbsp;</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="918">
					&nbsp;</td>
					</tr>
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="150">
					판매재고 :</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="90">
					{update_files_sales}</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="918">
					{update_files_sales_times}</td>
					</tr>
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="150">
					쇼핑몰 :</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="90">
					{update_files_shop}</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="918">
					{update_files_shop_times}</td>
					</tr>
			</table>

			{formend}


		</x-container>
	</x-main-content>
</x-theme>
