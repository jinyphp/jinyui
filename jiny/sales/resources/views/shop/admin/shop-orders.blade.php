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
		{formstart}<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#E9E9E9">
				<b>쇼핑몰 :</b>
		주문내역 확인</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
				{delete}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
				{excel}</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
				{print}</td>
				
			</tr>
		</table>
		
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" align="center">{s0}전체 | {s1}신규주문 
				| {s2}입금중 | {s3}입금요청 | {s4}입금완료 | {s5}결제완료 | {s6}결제실패 | {s7}배송준비 
				| {s8}배송중 | {s9}배송완료 | {s10}주문완료 |
				<p>{s11}취소요청 | {s12}취소승인 | {s13}환불요청 | {s14}환불완료 | {s15}분쟁중 | {s16}분쟁완료</td>
			</tr>
		</table>
		
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style="font-size:12px;padding:10px;" width="30">{checkall}</td>
				<td style="font-size:12px;padding:10px;">&nbsp;</td>
				<td style="font-size:12px;padding:10px;" width="100">{country}</td>
				<td style="font-size:12px;padding:10px;" width="100" align="right">주문 검색:</td>
				<td style="font-size:12px;padding:10px;" width="200">{search_key}</td>
				<td style="font-size:12px;padding:10px;" width="100">{search}</td>
				<td style="font-size:12px;padding:10px;" width="100">{list_num}</td>
			</tr>
		</table>
		<p>{orders_list}{formend}</td>
	</tr>
	</table>

</div>
