<x-theme theme="jinyerp" class="bootstrap">
	{formstart}
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td style="font-size:12px;padding:10px;" width="100" align="right"> 
<font size="2">작성일자 :</font></td>
		<td style="font-size:12px;padding:10px;" > 
		<font size="2">{transdate}</font></td>
	</tr>
	<tr>
		<td style="font-size:12px;padding:10px;" width="100" align="right"> 
<font size="2">상품명 :</font></td>
		<td style="font-size:12px;padding:10px;" > 
		<font size="2">{goodname}</font></td>
		</tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td style="font-size:12px;padding:10px;" align="right" width="100"> 규격 
		:</td>
		<td style="font-size:12px;padding:10px;"> {spec}</td>
	</tr>
	<tr>
		<td style="font-size:12px;padding:10px;" align="right" width="100"> 수량 :</td>
		<td style="font-size:12px;padding:10px;"> {num}</td>
	</tr>
	<tr>
		<td style="font-size:12px;padding:10px;" align="right" width="100"> 단가 :</td>
		<td style="font-size:12px;padding:10px;"> {prices}</td>
	</tr>
	<tr>
		<td style="font-size:12px;padding:10px;" align="right" width="100"> 공급가액 
		:</td>
		<td style="font-size:12px;padding:10px;"> {sum}</td>
	</tr>
	<tr>
		<td style="font-size:12px;padding:10px;" align="right" width="100"> 부가세 
		:</td>
		<td style="font-size:12px;padding:10px;"> {vat}</td>
	</tr>
	<tr>
		<td style="font-size:12px;padding:10px;" align="right" width="100"> 할인액 
		:</td>
		<td style="font-size:12px;padding:10px;"> {discount}</td>
	</tr>
	<tr>
		<td style="font-size:12px;padding:10px;" align="right" width="100"> 합계 :</td>
		<td style="font-size:12px;padding:10px;"> {total}</td>
	</tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td style="font-size:12px;padding:10px;" align="center"> {form_submit}</td>
	</tr>
</table>
{formend}
</x-theme>


