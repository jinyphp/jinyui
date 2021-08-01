<x-jinyui-theme theme="jinyerp" class="bootstrap">
	<table border="0" width="1200" cellspacing="0" cellpadding="0">
		<tr>
			<td style="border:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF">
			{formstart}
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#E9E9E9">
					<b>판매관리: 직원, 담당자 리스트</b></td>
					<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
					 </td>
					
				</tr>
			</table>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">활성화 :</td>
					<td style="font-size:12px;padding:10px;" width="200">{enable}</td>
					<td style="font-size:12px;padding:10px;"> </td>
				</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100">성 :</td>
					<td style="font-size:12px;padding:10px;" width="200">{firstname}</td>
					<td style="font-size:12px;padding:10px;"> </td>
					</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100"><font size="2">이름 
					:</font></td>
					<td style="font-size:12px;padding:10px;" width="200">{lastname}</td>
					<td style="font-size:12px;padding:10px;"> </td>
					</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100"><font size="2" color="#FF0000">* 이메일 
					:</font></td>
					<td style="font-size:12px;padding:10px;" width="200">{email}</td>
					<td style="font-size:12px;padding:10px;"> </td>
					</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100"><font size="2" color="#FF0000">* 암호 
					:</font></td>
					<td style="font-size:12px;padding:10px;" width="200">{password}</td>
					<td style="font-size:12px;padding:10px;"> </td>
					</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100"><font size="2">부서 
					:</font></td>
					<td style="font-size:12px;padding:10px;" width="200">{parts}</td>
					<td style="font-size:12px;padding:10px;"> </td>
					</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100"><font size="2">전화번호 
					:</font></td>
					<td style="font-size:12px;padding:10px;" width="200">{phone}</td>
					<td style="font-size:12px;padding:10px;"> </td>
					</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100"><font size="2">팩스 
					:</font></td>
					<td style="font-size:12px;padding:10px;" width="200">{fax}</td>
					<td style="font-size:12px;padding:10px;"> </td>
					</tr>
				<tr>
					<td style="font-size:12px;padding:10px;" width="100"> </td>
					<td style="font-size:12px;padding:10px;" width="200"> </td>
					<td style="font-size:12px;padding:10px;"> </td>
					</tr>
			</table>
	
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td style="font-size:12px;padding:10px;" width="80">
					<font size="2">메모</font></td>
					<td style="font-size:12px;padding:10px;">
		<font size="2">{comment}</font></td>
					</tr>
			</table>
			<p align="center">{form_submit}</p>
			<p> {formend}</td>
		</tr>
		</table>
</x-jinyui-theme>



