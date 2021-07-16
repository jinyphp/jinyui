<x-theme>
	<x-main class="p-4">
		<x-main-content class="bg-white p-4">
			
		</x-main-content>
	</x-main>
</x-theme>


<div align="center">

<table border="0" width="1200" cellspacing="0" cellpadding="0">
	<tr>
		<td style="border:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF" valign="top">

		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				{board_title}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">&nbsp;</td>
			</tr>
		</table>
		
{formstart}<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td style="font-size:12px;padding:10px;" width="50" align="right">글제목 :</td>
		<td style="font-size:12px;padding:10px;" >{title}</td>
		<td style="font-size:12px;padding:10px;" width="40" align="right">비밀글:</td>
		<td style="font-size:12px;padding:10px;" width="5">{secure}</td>
		<td style="font-size:12px;padding:10px;" width="60" align="right">답장허용:</td>
		<td style="font-size:12px;padding:10px;" width="5">{reply}</td>
		<td style="font-size:12px;padding:10px;" width="70" align="right">코멘트 허용:</td>
		<td style="font-size:12px;padding:10px;" width="5">{comment}</td>
	</tr>
	</table>

		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;">
				{html}</td>
			</tr>
		</table>
		
		<p>&nbsp;</p>

		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-top:1px solid #E9E9E9;font-size:12px;" valign="top">

		{files}</td>
				<td style="border-top:1px solid #E9E9E9;font-size:12px;padding-left:10px;" width="400">

<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="100" valign="top">
			작성자(이메일) :</td>
				<td style="font-size:12px;padding:10px;" valign="top">
				<font size="2">{email}</font></td>
			</tr>
			<tr>
				<td style="font-size:12px;padding:10px;" width="100" valign="top">
			비빌번호:</td>
				<td style="font-size:12px;padding:10px;" valign="top"><font size="2">
				{password}</font></td>
			</tr>
			</table>
				</td>
			</tr>
		</table>
		
		<p align="center">{form_submit}{formend}</td>
	</tr>
	</table>

</div>