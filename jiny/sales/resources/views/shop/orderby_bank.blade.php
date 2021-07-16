<x-theme>
	<x-main class="p-4">
		<x-main-content class="bg-white p-4">
			
		</x-main-content>
	</x-main>
</x-theme>

<div align="center">

<table border="0" width="1000" cellspacing="0" cellpadding="0">
	<tr>
		<td style=font-size:12px;padding:10px; width="50%">주문완료</td>
		<td style=font-size:12px;padding:10px; width="50%">
		<p align="right">01 장바구니 > 02주문서 > <b>03주문완료</b></td>
	</tr>
	<tr>
		<td style=border:1px solid #E9E9E9;font-size:12px;padding:10px; bgcolor="#FFFFFF" width="978" colspan="2">
 * 계좌이체 주문<p>입금할 금액을 확인후, 은행에 입금하여 주세요. 입금확인 완료후 배송준비가 시작됩니다. 이용해 주셔서 감사합니다.</p>
	<table border="0" width="978" cellspacing="0" cellpadding="0">
			<tr>
				<td style=font-size:12px;padding:10px; colspan="4">입금정보</td>
			</tr>
			<tr>
				<td style=font-size:12px;padding:10px; width="150">은행명:</td>
				<td style=font-size:12px;padding:10px;>{bank_name}</td>
				<td style=font-size:12px;padding:10px; width="100">{bank_swiff}</td>
				<td style=font-size:12px;padding:10px; width="200">{bank_country}</td>
				</tr>
			<tr>
				<td style=font-size:12px;padding:10px; width="150">계좌번호:</td>
				<td style=font-size:12px;padding:10px;>{bank_account}</td>
				<td style=font-size:12px;padding:10px; width="100"> </td>
				<td style=font-size:12px;padding:10px; width="200"> </td>
			</tr>
			<tr>
				<td style=font-size:12px;padding:10px; width="150">예금주명</td>
				<td style=font-size:12px;padding:10px;>{bank_user}</td>
				<td style=font-size:12px;padding:10px; width="100"> </td>
				<td style=font-size:12px;padding:10px; width="200"> </td>
			</tr>
		</table>
	<p align="center">입금완료후 "결제완료" 확인까지 판매자 및 배송업체별로 입금확인 시간에 따라 다소 시간이 걸릴 수 
	있습니다. 입금기한 내에 미입금시 주문이 자동취소됩니다.<p align="center">{bank_check}<p align="center"> </p>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;>
				주문내역</td>
			</tr>
			<tr>
				<td style=font-size:12px;padding:10px;>{list}</td>
			</tr>
		</table>
	
	<p> </td>
	</tr>
	<tr>
		<td style=font-size:12px;padding:10px; width="980" colspan="2"> </td>
	</tr>
</table>

</div>
