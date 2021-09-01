<x-theme>
	<x-main class="p-4">
		<x-main-content class="bg-white p-4">
			
		</x-main-content>
	</x-main>
</x-theme>

<div align="center">
<table border="0" width="1200" cellspacing="0" cellpadding="0">
	<tr>
		<td style="border:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF">
		
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#E9E9E9">
				회원정보</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
				&nbsp;</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
				{edit}</td>
				
			</tr>
		</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:50px;padding:10px;color:#cccccc" width="100" align="center" valign="top">
				<i class="fa fa-user"></i>
				</td>
				<td valign="top">
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
		회원 이름 :</td>
		<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">{member_name}</td>
		<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">적립금 :</td>
		<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">{members_emoney}</td>
	</tr>
	<tr>
		<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">이메일 :</td>
		<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">{member_email}</td>
		<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">포인트 :</td>
		<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">{members_point}</td>
	</tr>
</table>
				</td>
			</tr>
		</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td width="50%" valign="top">
{board_notice}</td>
				<td width="50%" valign="top">&nbsp;</td>
			</tr>
		</table>
		<p>{order_list}
		{block_title_infomation}
		</td>
	</tr>
</table>
</div>