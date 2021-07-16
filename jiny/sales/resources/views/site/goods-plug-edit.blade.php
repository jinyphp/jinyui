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
                    초기페이지 : 상품진열 전처리 코드</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
                    &nbsp;</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
                    &nbsp;</td>

                </tr>
            </table>

    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" valign="top">
                    {domain} 상품진열 전처리 설정</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" valign="top" width="100">
                    &nbsp;</td>
                </tr>
                </table>

    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    활성화:</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                    {enable}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    코드:</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                    {code}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    제목 :</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                    {title}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    카테고리:</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                    {category}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    정렬</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                    {sort}</td>
                </tr>
                </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;">* PC접속 출력형태</td>
                </tr>
                </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">출력방식</td>
                    <td style="font-size:12px;padding:10px;" width="160" colspan="2">{cate_type}</td>
                    <td style="font-size:12px;padding:10px;" width="80">&nbsp;</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">상품 가로수</td>
                    <td style="font-size:12px;padding:10px;" width="80">{cate_cols}</td>
                    <td style="font-size:12px;padding:10px;" width="80">상품 세로수</td>
                    <td style="font-size:12px;padding:10px;" width="80">{cate_rows}</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">사진크기</td>
                    <td style="font-size:12px;padding:10px;" width="80">{cate_imgsize}</td>
                    <td style="font-size:12px;padding:10px;" width="80">&nbsp;</td>
                    <td style="font-size:12px;padding:10px;" width="80">&nbsp;</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
            </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;">* 모바일접속 출력형태</td>
                </tr>
                </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">출력방식</td>
                    <td style="font-size:12px;padding:10px;" width="160" colspan="2">{mobile_type}</td>
                    <td style="font-size:12px;padding:10px;" width="80">&nbsp;</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">상품 가로수</td>
                    <td style="font-size:12px;padding:10px;" width="80">{mobile_cols}</td>
                    <td style="font-size:12px;padding:10px;" width="80">상품 세로수</td>
                    <td style="font-size:12px;padding:10px;" width="80">{mobile_rows}</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">사진크기</td>
                    <td style="font-size:12px;padding:10px;" width="80">
                    {mobile_imgsize}</td>
                    <td style="font-size:12px;padding:10px;" width="80">&nbsp;</td>
                    <td style="font-size:12px;padding:10px;" width="80">&nbsp;</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
            </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;">* 진열 항목 활성화 설정</td>
                </tr>
                </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    회원가격:</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    {check_memprices}</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    상품사진:</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    {check_images}</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                    &nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    상품명:</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    {check_goodname}</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    가격:</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    {check_prices}</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                    &nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    간략설명:</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    {check_subtitle}</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    USD:</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    {check_usd}</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                    &nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    스펙:</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    {check_spec}</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    &nbsp;</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    &nbsp;</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                    &nbsp;</td>
                </tr>
                </table>
            <p>&nbsp;</p>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="120">상품셀 배경색 : </td>
                    <td style="font-size:12px;padding:10px;" width="80">{cell_bgcolor}</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="120">외각선 두께 :</td>
                    <td style="font-size:12px;padding:10px;" width="80">{cell_outline_width}</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="120">외각선 색상 :</td>
                    <td style="font-size:12px;padding:10px;" width="80">{cell_outline_color}</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="120">외각선 색상(호버)
                    :</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="80">{cell_outline_hovercolor}</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
                </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="120">할인율 배경색 :</td>
                    <td style="font-size:12px;padding:10px;" width="80">{discount_bgcolor}</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="120">
                    할인율 글자 :</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="80">{discount_color}</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
                </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="120">무료배송 배경색 :</td>
                    <td style="font-size:12px;padding:10px;" width="80">{freeshipping_bgcolor}</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="120">무료배송 글자색
                    :</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="80">{freeshipping_color}</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
                </table>
            <p>&nbsp;</p>
    <p>&nbsp;</p>
            <p>* 전처리 디자인 스타일</p>
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    타이틀이미지</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="20">
                    {cate_images_check}</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                    {cate_images}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    &nbsp;</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="20">
                    &nbsp;</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                    {cate_images_files}</td>
                </tr>
                </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    가로크기</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    {cate_width}</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    정렬방식</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    {cate_align}</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                    &nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    배경색</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    {cate_bgcolor}</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    &nbsp;</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    &nbsp;</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                    &nbsp;</td>
                </tr>
                </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    HTML</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                    {cate_html_apply} 치환코드 : <span id="site_edit">{list}</span></td>
                </tr>
                </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;">{cate_html}</td>
                </tr>
                </table>
            <p align="center">{form_submit}</p>
            <p>{formend}</td>
        </tr>
        </table>

    </div>
