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
				<b>쇼핑몰 : </b>카테고리 설정</td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
				 </td>
				<td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
				&nbsp;</td>
				
			</tr>
		</table>
		&nbsp;<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=font-size:12px;padding:10px; width="80">활성화:</td>
				<td style=font-size:12px;padding:10px;>{enable}</td>
			</tr>
			</table>
		<p>{category_name}</p>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=font-size:12px;padding:10px; width="80">url:</td>
				<td style=font-size:12px;padding:10px;>{url}</td>
			</tr>
			<tr>
				<td style=font-size:12px;padding:10px; width="80">Alt:</td>
				<td style=font-size:12px;padding:10px;>{alt}</td>
			</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=font-size:12px;padding:10px;>*정렬방식</td>
			</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=font-size:12px;padding:10px; width="120">정렬 순서</td>
				<td style=font-size:12px;padding:10px; width="200">{orderby}</td>
				<td style=font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=font-size:12px;padding:10px;>* PC접속 출력형태</td>
			</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=font-size:12px;padding:10px; width="120">출력방식</td>
				<td style=font-size:12px;padding:10px; width="200">{cate_type}</td>
				<td style=font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=font-size:12px;padding:10px; width="120">상품 가로수</td>
				<td style=font-size:12px;padding:10px; width="80">{cate_cols}</td>
				<td style=font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			<tr>
				<td style=font-size:12px;padding:10px; width="120">상품 세로수</td>
				<td style=font-size:12px;padding:10px; width="80">{cate_rows}</td>
				<td style=font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			<tr>
				<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px; width="120">사진크기</td>
				<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px; width="80">{cate_imgsize}</td>
				<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=font-size:12px;padding:10px;>* 모바일접속 출력형태</td>
			</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=font-size:12px;padding:10px; width="120">출력방식</td>
				<td style=font-size:12px;padding:10px; width="200">{mobile_type}</td>
				<td style=font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=font-size:12px;padding:10px; width="120">상품 가로수</td>
				<td style=font-size:12px;padding:10px; width="80">{mobile_cols}</td>
				<td style=font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			<tr>
				<td style=font-size:12px;padding:10px; width="120">상품 세로수</td>
				<td style=font-size:12px;padding:10px; width="80">{mobile_rows}</td>
				<td style=font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			<tr>
				<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px; width="120">사진크기</td>
				<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px; width="80">{mobile_imgsize}</td>
				<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=font-size:12px;padding:10px;>* 출력항목 설정</td>
			</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=font-size:12px;padding:10px; width="120">회원만 표시 :</td>
				<td style=font-size:12px;padding:10px; width="80">{check_members}</td>
				<td style=font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			<tr>
				<td style=font-size:12px;padding:10px; width="120">가격(회원만) :</td>
				<td style=font-size:12px;padding:10px; width="80">{check_memprices}</td>
				<td style=font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			<tr>
				<td style=font-size:12px;padding:10px; width="120">상품명 :</td>
				<td style=font-size:12px;padding:10px; width="80">{check_goodname}</td>
				<td style=font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			<tr>
				<td style=font-size:12px;padding:10px; width="120">이미지 :</td>
				<td style=font-size:12px;padding:10px; width="80">{check_images}</td>
				<td style=font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			<tr>
				<td style=font-size:12px;padding:10px; width="120">간략설명 :</td>
				<td style=font-size:12px;padding:10px; width="80">{check_subtitle}</td>
				<td style=font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			<tr>
				<td style=font-size:12px;padding:10px; width="120">상품스팩 :</td>
				<td style=font-size:12px;padding:10px; width="80">{check_spec}</td>
				<td style=font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			<tr>
				<td style=font-size:12px;padding:10px; width="120">가격표시 :</td>
				<td style=font-size:12px;padding:10px; width="80">{check_prices}</td>
				<td style=font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			<tr>
				<td style=font-size:12px;padding:10px; width="120">USD 표시 :</td>
				<td style=font-size:12px;padding:10px; width="80">{check_usd}</td>
				<td style=font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			</table>
		<p>&nbsp;</p>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=font-size:12px;padding:10px; width="120">상품셀 배경색 : </td>
				<td style=font-size:12px;padding:10px; width="80">{cell_bgcolor}</td>
				<td style=font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			<tr>
				<td style=font-size:12px;padding:10px; width="120">외각선 두께 :</td>
				<td style=font-size:12px;padding:10px; width="80">{cell_outline_width}</td>
				<td style=font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			<tr>
				<td style=font-size:12px;padding:10px; width="120">외각선 색상 :</td>
				<td style=font-size:12px;padding:10px; width="80">{cell_outline_color}</td>
				<td style=font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			<tr>
				<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px; width="120">외각선 색상(호버) 
				:</td>
				<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px; width="80">{cell_outline_hovercolor}</td>
				<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=font-size:12px;padding:10px; width="120">할인율 배경색 :</td>
				<td style=font-size:12px;padding:10px; width="80">{discount_bgcolor}</td>
				<td style=font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			<tr>
				<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px; width="120">
				할인율 글자 :</td>
				<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px; width="80">{discount_color}</td>
				<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=font-size:12px;padding:10px; width="120">무료배송 배경색 :</td>
				<td style=font-size:12px;padding:10px; width="80">{freeshipping_bgcolor}</td>
				<td style=font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			<tr>
				<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px; width="120">무료배송 글자색 
				:</td>
				<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px; width="80">{freeshipping_color}</td>
				<td style=border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;>&nbsp;</td>
				</tr>
			</table>
		<p>&nbsp;</p>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=font-size:12px;padding:10px;>* 카테고리 디자인</td>
			</tr>
			</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=font-size:12px;padding:10px; width="80">타이틀 이미지:</td>
				<td style=font-size:12px;padding:10px;>{cate_title}</td>
			</tr>
			<tr>
				<td style=font-size:12px;padding:10px; width="80">HTML:</td>
				<td style=font-size:12px;padding:10px;>{apply_html}</td>
				</tr>
		</table>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td style=font-size:12px;padding:10px;>{html}</td>
			</tr>
			</table>
		<p align="center">{form_submit}<p>{formend}</td>
	</tr>
	</table>

</div>
