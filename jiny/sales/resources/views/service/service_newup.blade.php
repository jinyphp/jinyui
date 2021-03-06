<x-theme theme="jinyerp" class="bootstrap">
	<x-main-content>
		<x-container>
			<b>서비스신청 완료</b>
			{formstart}

			<p align="center">세일즈호스팅 비지니스 플렛폼 서비스를 신청해 주셔서 감사합니다. 입력해 주신 정보를 
				기반으로 간략 회원가입과 동시에 신청을 정상적으로 완료 하였습니다.</p>
				<p align="center">진행사항 및 접속은 {email}로 회원 로그인 하시면 확인을 하실 수 있습니다. 
				본 서비스는 입금확인 후 해당 계정 및 서버를 세팅해 드립니다. </p>
				<p align="center">보다 자세한 내용은 문의 : 
				010-3911-3106 직통연락처로 문의해 주세요.</p>

			입금계좌번호 안내
			<table border="0" width="500" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border-top:1px solid #E9E9E9;border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100" align="right">
					은행명 :</td>
					<td style="border-top:1px solid #E9E9E9;border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
					{bank_name}</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100" align="right">
					Swiff 코드 :</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
					{bank_swiff}</td>
					</tr>
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100" align="right">
					계좌번호 :</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
					{bank_num}</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100" align="right">
					예금주 :</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
					{bank_user}</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100" align="right">
					금액 :</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
					{amount}</td>
				</tr>
			</table>

			{form_submit}

			{formend}





		</x-container>
	</x-main-content>
</x-theme>