<x-theme theme="jinyerp" class="bootstrap">
	<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
		<tr>
			<td style="font-size:12px;padding:10px;" align="right"> 
			{formstart}
	
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td style="font-size:12px;padding:10px;" width="100" align="right"> 
					결제일자</td>
			<td style="font-size:12px;padding:10px;" > 
					{paydate}</td>
		</tr>
		<tr>
			<td style="font-size:12px;padding:10px;" width="100" align="right"> 
					담당자</td>
			<td style="font-size:12px;padding:10px;" > 
					{manager}</td>
			</tr>
	</table>
	<p>{list}</p>
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td style="font-size:12px;padding:10px;" align="right" width="100"> 결제방식:</td>
			<td style="font-size:12px;padding:10px;"> {payment}</td>
		</tr>
		<tr>
			<td style="font-size:12px;padding:10px;" align="right" width="100"> 금액:</td>
			<td style="font-size:12px;padding:10px;"> {money}</td>
		</tr>
		<tr>
			<td style="font-size:12px;padding:10px;" align="right" width="100"> 메모</td>
			<td style="font-size:12px;padding:10px;"> {memo}</td>
		</tr>
		</table>
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
		<tr>
			<td style="font-size:12px;padding:10px;" align="center"> {form_submit}</td>
		</tr>
	</table>
	{formend}
			
	</td>
		</tr>
	</table>
</x-theme>


