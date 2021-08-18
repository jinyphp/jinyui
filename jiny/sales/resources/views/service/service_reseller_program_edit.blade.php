<x-theme theme="jinyerp" class="bootstrap">
	<x-main-content>
		<x-container>
			<b>리셀러 프로그램 : </b>체널 서비스 구성

			{formstart}

			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">
					<font size="2">활성화 :</font></td>
					<td style="font-size:12px;padding:10px;"><font size="2">{enable}</font></td>
				</tr>
				</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">
					체널 국가:</td>
					<td style="font-size:12px;padding:10px;" width="231">{country}</td>
					<td style="font-size:12px;padding:10px;"> </td>
				</tr>
				</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">
					서비스명 :</td>
					<td style="font-size:12px;padding:10px;" width="231">{title}</td>
					<td style="font-size:12px;padding:10px;"> </td>
				</tr>
				</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">
					서브수 :</td>
					<td style="font-size:12px;padding:10px;" width="100">{sub}</td>
					<td style="font-size:12px;padding:10px;"> </td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">
					마진율 :</td>
					<td style="font-size:12px;padding:10px;" width="100">{margin}</td>
					<td style="font-size:12px;padding:10px;"> </td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">
					설정비용 :</td>
					<td style="font-size:12px;padding:10px;" width="100">{setup}</td>
					<td style="font-size:12px;padding:10px;"> </td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">
					매월비용 : </td>
					<td style="font-size:12px;padding:10px;" width="100">{charge}</td>
					<td style="font-size:12px;padding:10px;"> </td>
				</tr>
				</table>

				{description}

				{form_submit}
				{formend}



		</x-container>
	</x-main-content>
</x-theme>