<x-theme>
    <x-main class="bg-white p-4">
        <table border="0" width="1200" cellspacing="0" cellpadding="0" style="border:1px solid #E9E9E9;">
			<tr>
				<td style="font-size:12px;padding:10px;" bgcolor="#FFFFFF">
				{formstart}<table border="0" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#E9E9E9" width="50">
						보고서</td>
						<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" bgcolor="#E9E9E9" width="150">
						{business}</td>
						<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" bgcolor="#E9E9E9">&nbsp;</td>
						<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
						{mail}</td>
						<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
						{pdf}</td>
						<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
						{excel}</td>
						<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">{print}</td>
						
					</tr>
				</table>
				<table border="0" width="100%" cellspacing="0" cellpadding="0" >
					<tr><td style="font-size:12px;padding:10px;">
					{all}전체 / {buysell}매입매출 / {sell}매출 /{buy} 매입 / {pay}입출금 /{payin} 입금 / 
					{payout}출금</td>
						<td style="font-size:12px;padding:10px;" width="80">
					기간 : 시작일</td><td style="font-size:12px;padding:10px;" width="100">
					{start}</td><td style="font-size:12px;padding:10px;" width="50">
					~ 종료일</td><td style="font-size:12px;padding:10px;" width="100">
					{end}</td><td style="font-size:12px;padding:10px;" width="80">
					{priod_search}</td></tr>
				</table>
				<table border="0" width="100%" cellspacing="0" cellpadding="0" >
					<tr>
					<td style="font-size:12px;padding:10px;" width="50">
					거래처:<td style="font-size:12px;padding:10px;">
						{company_search}</td>
					<td style="font-size:12px;padding:10px;" width="50">
						{search}<td style="font-size:12px;padding:10px;" width="70">
					담당자 :</td><td style="font-size:12px;padding:10px;" width="150">
						{manager}</td>
						<td style="font-size:12px;padding:10px;" width="50">
					창고 :</td><td style="font-size:12px;padding:10px;" width="150">
						{warehouse}</td></tr>
				</table>
				{list}{formend}</td>
			</tr>
		
		</table>
    </x-main>    
</x-theme>

