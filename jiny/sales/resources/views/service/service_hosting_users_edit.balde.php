<x-theme theme="jinyerp" class="bootstrap">
	<x-main-content>
		<x-container>
			<b>리셀러 프로그램 :</b> 고객리스트

			{formstart}
			* 회원정보

			<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				<font size="2">활성화 :</font></td>
				<td style="font-size:12px;padding:10px;" width="100"><font size="2">{enable}</font></td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				만기일 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{expire}</td>
				<td style="font-size:12px;padding:10px;">{btn_renewal}</td>
				</tr>
		</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				이름 :</td>
				<td style="font-size:12px;padding:10px;" width="200">{name}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				이메일 : </td>
				<td style="font-size:12px;padding:10px;" width="200">{email}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
			</tr>
		</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;">
				<b>* 데이터베이스 정보</b></td>
			</tr>
		</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				분산서버 위치 :</td>
				<td style="font-size:12px;padding:10px;" width="200">{db_server}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				DB서버 IP주소 :</td>
				<td style="font-size:12px;padding:10px;" width="200">{db_address}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				DB
				아이디 :</td>
				<td style="font-size:12px;padding:10px;" width="200">{db_id}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				DB
				데이터베이스 :</td>
				<td style="font-size:12px;padding:10px;" width="200">{db_database}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				DB
				패스워드 :</td>
				<td style="font-size:12px;padding:10px;" width="200">{db_password}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
			</tr>
		</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;">
				<b>* 서비스 정보 및 제한</b></td>
			</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				서비스 리셀러 :</td>
				<td style="font-size:12px;padding:10px;" width="200">{reseller}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				연동
				도메인:</td>
				<td style="font-size:12px;padding:10px;" width="200">{domain}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				호스팅
				서비스명 :</td>
				<td style="font-size:12px;padding:10px;" width="200">
				{hostingPlan}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
			</tr>
		</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				접속 보완키 :d>
				<td style="font-size:12px;padding:10px;"><font size="2">{secure_key}</font></td>
				</tr>
		</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				사이트 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{site}</td>
				<td style="font-size:12px;padding:10px;">사이트 운영 및 개설갯수 제한</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				쇼핑몰 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{shop}</td>
				<td style="font-size:12px;padding:10px;">쇼핑몰 운영 및 개설 갯수 제한</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				판매관리 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{trans}</td>
				<td style="font-size:12px;padding:10px;">판매관리 계정 제한</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				비지니스 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{business}</td>
				<td style="font-size:12px;padding:10px;">다중 사업자 제한</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				거래처수 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{company}</td>
				<td style="font-size:12px;padding:10px;">거래처수 제한</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				전표수 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{trans}</td>
				<td style="font-size:12px;padding:10px;">월 전표수 제한</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				담당자수 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{manager}</td>
				<td style="font-size:12px;padding:10px;">담당자수 제한</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				창고수 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{house}</td>
				<td style="font-size:12px;padding:10px;">창고수 제한</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				견적서 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{quotation}</td>
				<td style="font-size:12px;padding:10px;">견적서 제한</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				계산서발행 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{taxprint}</td>
				<td style="font-size:12px;padding:10px;">세금계산서 발행 제한</td>
			</tr>
		</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				설정비용 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{setup}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				월비용 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{charge}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
			</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				설명</td>
				<td style="font-size:12px;padding:10px;">
				{description}</td>
			</tr>
		</table>

			{form_submit}
			{formend}

		</x-container>
	</x-main-content>
</x-theme>