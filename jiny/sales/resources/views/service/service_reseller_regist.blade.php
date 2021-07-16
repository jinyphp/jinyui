<x-theme>
	<x-main class="p-4">
		<x-main-content class="bg-white p-4">
			
		</x-main-content>
	</x-main>
</x-theme>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td style="border:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF">
		{formstart}<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#E9E9E9">
				<b>리셀러 : </b>파트너 가입</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
				&nbsp;</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">&nbsp;</td>
				
			</tr>
		</table>
		
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				&nbsp;</td>
				</tr>
</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;">
				세일즈호스팅 파트너 프로그렘이란? 
				<p>리셀러 프로그램이란, 본 서비스를 이용함과 동시에 타인에게 
				소개 및 서비스를 대행을 통하여 수익금을 공유하는 비지니스 파트너 프로그램입니다. 리셀러 파트너로 추가 회원가입을 
				하시면, 자체적으로 세일즈호스팅과 동일한 서비스 사이트를 오픈하여 다수의 고객을 유치 서비스를 제공할 수 있습니다.
				</p>
				<p>리셀러 파트너 프로그램은 계층적 파트너 관리와 고객운영관리를 
				동시에 병행할 수 있습니다. 파트너 프로그램 구분에 따라서 계약/유지비용은 차이가 있습니다. 
				</p>
				<p>* 계약 및 
				유지비용이란 : 리셀러 파트너에게 제공하는 서비스 홈페이지 호스팅/서버 유지비용에 해당합니다. </td>
			</tr>
			</table>
		<p>{partner_program}</p>
		<p align="center">계약 및 유지비용은 하기 계좌로 입금해 주시고, 리셀러 회원승인을 요청하세요.</p>
		<p align="center">은행명 :{bankname} /
				계좌번호 : {banknum} /
				예금주 :{bankuser}</p>
		<div align="center">
		<table border="0" width="600" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				신청아이디 :</td>
				<td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">
				{service_code}</td>
				<td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;">
				{code_check}</td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				리셀러 이름 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">
				{name}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				&nbsp;</td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				운영 도메인 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">
				{domain}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				&nbsp;</td>
				</tr>
			</table>
		</div>
		<p align="center">리셀러 판매 수당 지급 또는 체널로 부터 입금받을 계좌 안내 입니다.</p>
		<div align="center">
		<table border="0" width="600" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				은행명 :</td>
				<td style="font-size:12px;padding:10px;" width="200">
				{reseller_bankname}</td>
				<td style="font-size:12px;padding:10px;">
				&nbsp;</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				은행 계좌번호 :</td>
				<td style="font-size:12px;padding:10px;" width="200">
				{reseller_banknum}</td>
				<td style="font-size:12px;padding:10px;">
				&nbsp;</td>
			</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				은행 예금주 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">
				{reseller_bankuser}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				&nbsp;</td>
			</tr>
			</table>
		</div>
		<div align="center">
		<table border="0" width="600" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;">
				{description}</td>
				</tr>
		</table>
		</div>
		<div align="center">
		&nbsp;</div>
		<p align="center">{form_submit}{formend}</p>
		<p align="center">&nbsp;</p></td>
	</tr>
</table>
