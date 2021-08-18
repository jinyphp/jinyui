<x-theme theme="jinyerp" class="bootstrap">
	<x-main-content>
		<x-container>
			서비스 정보

			{formstart}

			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">서비스 코드 :</td>
					<td style="font-size:12px;padding:10px;">{host_code}</td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">서비스 플랜 :</td>
					<td style="font-size:12px;padding:10px;">{hosting_plan}</td>
				</tr>
			</table>

			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">만료일자:</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">{expire}</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">{renewal}</td>
				</tr>
			</table>

			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">회원 이름:</td>
					<td style="font-size:12px;padding:10px;" width="100">{member_name}</td>
					<td style="font-size:12px;padding:10px;">{edit}</td>
				</tr>
			</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">이메일:</td>
					<td style="font-size:12px;padding:10px;">{member_email}</td>
				</tr>
			</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">적립금:</td>
					<td style="font-size:12px;padding:10px;">{members_emoney}</td>
				</tr>
			</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">포인트:</td>
					<td style="font-size:12px;padding:10px;">{members_point}</td>
				</tr>
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">도메인 :</td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">{host_domain}</td>
				</tr>
			</table>

			* 서비스 제한
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">사이트</td>
					<td style="font-size:12px;padding:10px;" width="100">{site}</td>
					<td style="font-size:12px;padding:10px;"> </td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">쇼핑몰</td>
					<td style="font-size:12px;padding:10px;" width="100">{shop}</td>
					<td style="font-size:12px;padding:10px;"> </td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">판매재고</td>
					<td style="font-size:12px;padding:10px;" width="100">{sales}</td>
					<td style="font-size:12px;padding:10px;"> </td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">사업장수</td>
					<td style="font-size:12px;padding:10px;" width="100">{business}</td>
					<td style="font-size:12px;padding:10px;"> </td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">거래처수</td>
					<td style="font-size:12px;padding:10px;" width="100">{company}</td>
					<td style="font-size:12px;padding:10px;"> </td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">전표수</td>
					<td style="font-size:12px;padding:10px;" width="100">{trans}</td>
					<td style="font-size:12px;padding:10px;"> </td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">관리자수</td>
					<td style="font-size:12px;padding:10px;" width="100">{manager}</td>
					<td style="font-size:12px;padding:10px;"> </td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">창고수</td>
					<td style="font-size:12px;padding:10px;" width="100">{house}</td>
					<td style="font-size:12px;padding:10px;"> </td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">견적건수</td>
					<td style="font-size:12px;padding:10px;" width="100">{quotation}</td>
					<td style="font-size:12px;padding:10px;"> </td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">세금발행</td>
					<td style="font-size:12px;padding:10px;" width="100">{taxprint}</td>
					<td style="font-size:12px;padding:10px;"> </td>
				</tr>
			</table>

			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding-right:10px;" width="50%" valign="top">{board_notice}</td>
					<td style="font-size:12px;padding-left:10px;" width="50%" valign="top">{board_faq}</td>
				</tr>
			</table>

			{formend}



		</x-container>
	</x-main-content>
</x-theme>
