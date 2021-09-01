<x-theme theme="jinyerp" class="bootstrap">
	<x-main-content>
		<x-container>
			<b>서비스 : </b>호스팅 플랜

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
					서비스명 :</td>
					<td style="font-size:12px;padding:10px;" width="200">{title}</td>
					<td style="font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
				</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
					<b>* 서비스 제한</b></td>
				</tr>
				</table>
			<table border="0" width="1248" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="200">
					서비스 항목</td>
					<td style="font-size:12px;padding:10px;" width="100">
					수량 제한</td>
					<td style="font-size:12px;padding:10px;">
					&nbsp;</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="200">
					사이트 운영 및 개설갯수 제한</td>
					<td style="font-size:12px;padding:10px;" width="100">
					{site}</td>
					<td style="font-size:12px;padding:10px;">
					&nbsp;</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="200">
					쇼핑몰 운영 및 개설 갯수 제한</td>
					<td style="font-size:12px;padding:10px;" width="100">
					{shop}</td>
					<td style="font-size:12px;padding:10px;">
					&nbsp;</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="200">
					판매관리 계정 제한</td>
					<td style="font-size:12px;padding:10px;" width="100">
					{trans}</td>
					<td style="font-size:12px;padding:10px;">
					&nbsp;</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="200">
					다중 사업자 제한</td>
					<td style="font-size:12px;padding:10px;" width="100">
					{business}</td>
					<td style="font-size:12px;padding:10px;">
					&nbsp;</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="200">
					거래처수 제한</td>
					<td style="font-size:12px;padding:10px;" width="100">
					{company}</td>
					<td style="font-size:12px;padding:10px;">
					&nbsp;</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="200">
					월 전표수 제한</td>
					<td style="font-size:12px;padding:10px;" width="100">
					{trans}</td>
					<td style="font-size:12px;padding:10px;">
					&nbsp;</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="200">
					담당자수 제한</td>
					<td style="font-size:12px;padding:10px;" width="100">
					{manager}</td>
					<td style="font-size:12px;padding:10px;">
					&nbsp;</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="200">
					창고수 제한</td>
					<td style="font-size:12px;padding:10px;" width="100">
					{house}</td>
					<td style="font-size:12px;padding:10px;">
					&nbsp;</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="200">
					견적서 제한</td>
					<td style="font-size:12px;padding:10px;" width="100">
					{quotation}</td>
					<td style="font-size:12px;padding:10px;">
					&nbsp;</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="200">
					세금계산서 발행 제한</td>
					<td style="font-size:12px;padding:10px;" width="100">
					{taxprint}</td>
					<td style="font-size:12px;padding:10px;">
					&nbsp;</td>
				</tr>
				</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">
					설정비용 :</td>
					<td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">{setup}</td>
					<td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">
					월 비용 :</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">{charge}</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
				</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;">
					{description}</td>
				</tr>
				</table>
			
			{form_submit}
			{formend}


			
		</x-container>
	</x-main-content>
</x-theme>
