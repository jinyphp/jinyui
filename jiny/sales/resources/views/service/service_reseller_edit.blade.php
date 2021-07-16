<x-theme>
	<x-main class="p-4">
		<x-main-content class="bg-white p-4">
			
		</x-main-content>
	</x-main>
</x-theme>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td style="border:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF" width="50%">
		{formstart}<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#E9E9E9">
				<b>리셀러 : </b>등록 및 수정</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
				&nbsp;</td>
				
			</tr>
		</table>


		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">활성화 :</td>
				<td style="font-size:12px;padding:10px;">{enable}</td>
				</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">가입일자 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">{regdate}</td>
			</tr>
		</table>


		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">리셀러 코드 :</td>
				<td style="font-size:12px;padding:10px;" width="200">{code}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">리셀러 이름 :</td>
				<td style="font-size:12px;padding:10px;" width="200">{name}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">이메일 :</td>
				<td style="font-size:12px;padding:10px;" width="200">{email}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">리셀링 도메인 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">{domain}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
		</table>

		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">리셀러 승인 :</td>
				<td style="font-size:12px;padding:10px;">{auth_req}</td>
				</tr>
			</table>



		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">만료일자 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{expire}</td>
				<td style="font-size:12px;padding:10px;">{renewal}</td>
				</tr>
</table>



		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">리셀러 프로그램</td>
				<td style="font-size:12px;padding:10px;" width="200">{reseller_program}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
</table>



		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">최대 서브수 :</td>
				<td style="font-size:12px;padding:10px;" width="100">{sub}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">공급 마진율(%) :</td>
				<td style="font-size:12px;padding:10px;" width="100">{margin}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">설정비용:</td>
				<td style="font-size:12px;padding:10px;" width="100">{setup}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">월유지비용 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">{charge}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				<b>*
				계좌정보:
				고객 및 리셀러로 부터 대금을 입금받을 계좌를 입력해 주세요.</b></td>
				</tr>
</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				은행명:</td>
				<td style="font-size:12px;padding:10px;" width="200">{bankname}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				swiff 코드 :</td>
				<td style="font-size:12px;padding:10px;" width="200">{bankswiff}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				계좌번호 :</td>
				<td style="font-size:12px;padding:10px;" width="200">{banknum}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				예금주 :</td>
				<td style="font-size:12px;padding:10px;" width="200">{bankuser}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
				</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
				메모 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">{description}</td>
				</tr>
		</table>
		<p align="center">{form_submit}{formend}</p></td>
	</tr>
</table>