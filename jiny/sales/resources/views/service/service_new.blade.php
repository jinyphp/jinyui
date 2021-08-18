<x-theme theme="jinyerp" class="bootstrap">
	<x-main-content>
		<x-container>
			<b>서비스신청</b>
			<p>세일즈호스팅은 판매관리 + 쇼핑몰 + 홈페이지 등 기업 비지니스에 관련한 다양한 IT 플렛폼을 호스팅 서비스를 
				제공합니다. 영업관리에 대한 인건비를 줄이고, 자동화된 솔루션으로 효율적으로 회사를 운영할 수 있습니다. </p>

			{formstart}

			<p>{hosting_plan}</p>

			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100" align="right">
					서비스 신청
					기간 :</td>
					<td style="font-size:12px;padding:10px;" width="150">
					{priod}</td>
					<td style="font-size:12px;padding:10px;" width="70" align="right">
					가입비용 :</td>
					<td style="font-size:12px;padding:10px;" width="100">
					{setup}</td>
					<td style="font-size:12px;padding:10px;" width="50" align="right">
					월비용 :</td>
					<td style="font-size:12px;padding:10px;" width="100">
					{charge}</td>
					<td style="font-size:12px;padding:10px;" width="100" align="right">
					= 결제금액 :</td>
					<td style="font-size:12px;padding:10px;" width="100">
					{amount}</td>
				</tr>
			</table>

			<table border="0" width="500" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100" align="right">
					신청아이디 :</td>
					<td style="font-size:12px;padding:10px;">
					{service_code}</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100" align="right">
					가입 이메일 :</td>
					<td style="font-size:12px;padding:10px;">
					{email}</td>
					</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100" align="right">
					비밀번호 :</td>
					<td style="font-size:12px;padding:10px;">
					{password}</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100" align="right">
					이름 :</td>
					<td style="font-size:12px;padding:10px;">
					{name}</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100" align="right">
					연락처 :</td>
					<td style="font-size:12px;padding:10px;">
					{phone}</td>
				</tr>
			</table>

			{description}

			<table border="0" width="500" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100" align="right">
					파트너코드 :</td>
					<td style="font-size:12px;padding:10px;">
					{partner}</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100" align="right">
					 </td>
					<td style="font-size:12px;padding:10px;">
					파트너를 통하여 가입할 경우, 추가 할인을 받으실 수 있습니다.</td>
				</tr>
			</table>

			{form_submit}
			{formend}



		</x-container>
	</x-main-content>
</x-theme>