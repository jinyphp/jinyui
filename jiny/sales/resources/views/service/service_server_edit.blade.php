<x-theme theme="jinyerp" class="bootstrap">
	<x-main-content>
		<x-container>

			{formstart}
			<b>서비스 : </b>분산 서버등록

			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100"><font size="2">활성화 :</font></td>
					<td style="font-size:12px;padding:10px;" width="200"><font size="2">{enable}</font></td>
					<td style="font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">리셀러 :</td>
					<td style="font-size:12px;padding:10px;" width="200">{reseller}</td>
					<td style="font-size:12px;padding:10px;">&nbsp;</td>
					</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">이름 :</td>
					<td style="font-size:12px;padding:10px;" width="200">{name}</td>
					<td style="font-size:12px;padding:10px;">&nbsp;</td>
					</tr>
				</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;">
					<b>* 서버 접속정보</b></td>
					</tr>
			</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">
					호스트 :</td>
					<td style="font-size:12px;padding:10px;" width="200">{host}</td>
					<td style="font-size:12px;padding:10px;">&nbsp;</td>
					</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">
					아이피 :</td>
					<td style="font-size:12px;padding:10px;" width="200">{ip}</td>
					<td style="font-size:12px;padding:10px;">&nbsp;</td>
					</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">
					서버 계정 :</td>
					<td style="font-size:12px;padding:10px;" width="200">{root}</td>
					<td style="font-size:12px;padding:10px;">&nbsp;</td>
					</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">
					계정 암호 :</td>
					<td style="font-size:12px;padding:10px;" width="200">{password}</td>
					<td style="font-size:12px;padding:10px;">&nbsp;</td>
					</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">
					DB 이름 :</td>
					<td style="font-size:12px;padding:10px;" width="200">{dbname}</td>
					<td style="font-size:12px;padding:10px;">&nbsp;</td>
					</tr>
			</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;">
					<b>* IDC 정보</b></td>
					</tr>
			</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">
					서버위치 :</td>
					<td style="font-size:12px;padding:10px;" width="200">{location}</td>
					<td style="font-size:12px;padding:10px;">&nbsp;</td>
					</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">
					사용자 아이디:</td>
					<td style="font-size:12px;padding:10px;" width="200">{user_id}</td>
					<td style="font-size:12px;padding:10px;">&nbsp;</td>
					</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">
					사용자 비번:</td>
					<td style="font-size:12px;padding:10px;" width="200">{user_password}</td>
					<td style="font-size:12px;padding:10px;">&nbsp;</td>
					</tr>
			</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">
					설명 :</td>
					<td style="font-size:12px;padding:10px;">
					{description}</td>
					</tr>
			</table>

			{form_submit}

			{formend}
			
		</x-container>
	</x-main-content>
</x-theme>