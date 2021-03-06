<x-theme>
	<x-main class="p-4">
		<x-main-content class="bg-white p-4">
			
		</x-main-content>
	</x-main>
</x-theme>

<div align="center">

<table border="0" width="1200" cellspacing="0" cellpadding="0">
	<tr>
		<td style="border:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF" width="978">
		{formstart}<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#E9E9E9">
				<b>쇼핑몰 :</b>
				결제방식 설정</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
				&nbsp;</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
				&nbsp;</td>
				
			</tr>
		</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				활성화 :</td>
				<td style="font-size:12px;padding:10px;" width="100">
				{enable}</td>
				<td style="font-size:12px;padding:10px;" align=right>&nbsp;</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				테스트모드 :</td>
				<td style="font-size:12px;padding:10px;" width="100">
				{test}</td>
				<td style="font-size:12px;padding:10px;" align=right>&nbsp;</td>
			</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				코드 :</td>
				<td style="font-size:12px;padding:10px;" width="200">
				{code}</td>
				<td style="font-size:12px;padding:10px;" align=right>&nbsp;</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				결제 모듈명 :</td>
				<td style="font-size:12px;padding:10px;" width="200">
				{payment}</td>
				<td style="font-size:12px;padding:10px;" align=right>&nbsp;</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				상점 아이디 :</td>
				<td style="font-size:12px;padding:10px;" width="200">
				{pg_id}</td>
				<td style="font-size:12px;padding:10px;" align=right>&nbsp;</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				상점 비밀번호 :</td>
				<td style="font-size:12px;padding:10px;" width="200">
				{pg_password}</td>
				<td style="font-size:12px;padding:10px;" align=right>&nbsp;</td>
			</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				상점 접속키 :</td>
				<td style="font-size:12px;padding:10px;">
				{pg_key}</td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				접속 url :</td>
				<td style="font-size:12px;padding:10px;">
				{pg_url}</td>
				</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				접속 테스트 url :</td>
				<td style="font-size:12px;padding:10px;">
				{pg_url_test}</td>
				</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100">
				설명 :</td>
				<td style="font-size:12px;padding:10px;">
				{descript}</td>
			</tr>
			</table>
		<p align="center">{form_submit}</p>
		<p>{formend}</td>
	</tr>
	</table>

</div>