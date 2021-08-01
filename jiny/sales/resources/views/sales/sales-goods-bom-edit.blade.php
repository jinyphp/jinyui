<x-jinyui-theme theme="jinyerp" class="bootstrap">
	        
<table border="0" width="1200" cellspacing="0" cellpadding="0">
	<tr>
		<td style="border:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF">
		{formstart}
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#E9E9E9">
				<b>판매관리 :</b> 생산설정</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
				&nbsp;</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
				&nbsp;</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">&nbsp;</td>
				
			</tr>
		</table>


<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100" align=right>
				<p align="left">상품명 :</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
				{goodname}</td>
			</tr>
</table>


<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100" align=right>{delete}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">&nbsp;</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100" align=right>{stock_house}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100" align=right>{assamble_num}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100" align=right>{bom_assamble}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100" align=right>{bom_disassamble}</td>
			</tr>
</table>
		
{newdata}{list}<p align="center">{form_submit}</p>
		<p>{formend}&nbsp;</td>
	</tr>
	</table>
</x-jinyui-theme>