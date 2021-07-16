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
                    <b>사이트: </b>정적(HTML) 페이지</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
                    &nbsp;</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100" bgcolor="#E9E9E9" align="right">{help}</td>

                </tr>
            </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    <font size="2">HTML 활성화 :</font></td>
                    <td style="font-size:12px;padding:10px;"><font size="2">{enable}</font></td>
                </tr>
                </table>
            <table border="0" width="1178" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    <font color="#FF0000">페이지
                    코드 *</font> :</td>
                    <td style="font-size:12px;padding:10px;" width="200">{code}</td>
                    <td style="font-size:12px;padding:10px;">코드는 영문으로 작성, 중복되면 안됩니다.</td>
                    </tr>
            </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    <font size="2">페이지 타이틀 :</font></td>
                    <td style="font-size:12px;padding:10px;"><font size="2">{title}</font></td>
                    </tr>
            </table>

                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100%" valign="top">*
                    페이지 스타일</td>
                </tr>
                </table>

            <table border="0" width="1178" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    <font size="2">가로크기 :</font></td>
                    <td style="font-size:12px;padding:10px;" width="100"><font size="2">{width}</font></td>
                    <td style="font-size:12px;padding:10px;">페이지 가로크기를 지정합니다. 사이트즈
                    px기준입니다. 예) 1000px , 100%</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    <font size="2">정렬방식 :</font></td>
                    <td style="font-size:12px;padding:10px;" width="100"><font size="2">{align}</font></td>
                    <td style="font-size:12px;padding:10px;">페이지 정렬 방법 지정</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    <font size="2">배경색 :</font></td>
                    <td style="font-size:12px;padding:10px;" width="100"><font size="2">{bgcolor}</font></td>
                    <td style="font-size:12px;padding:10px;">페이지 배경색</td>
                    </tr>
            </table>

                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" valign="top">
                    * 이미지등록</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100" valign="top">
                    &nbsp;</td>
                </tr>
                </table>

                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;">
                    페이지 (html)안에 들어갈 이미지를 등록할 수 있습니다.</td>
                    <td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100" align="right">
                    관련이미지 :</td>
                    <td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">
                    {html_images_upload}</td>
                    <td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
                    {upload}</td>
                </tr>
                </table>

                {images_files}

                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;" valign="top">*
                    페이지 내용을 / 언어별 / pc , 모바일 기기별로 각각 생성 추가 할 수 있습니다.</td>
                    <td style="border-top:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100" valign="top">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" valign="top">
                    [주의] HTML 코드 작성시 &lt;body&gt;&lt;/body&gt; 안에 있는 내용만 작성 해야 합니다. 잘못된 코드는 사이트의
                    전체 레이아웃 틀이 깨질수 있습니다.</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100" valign="top">&nbsp;</td>
                </tr>
                </table>

                <p>{language_html}</p>
            <p align="center">{form_submit}</p>
            <p>{formend}&nbsp;</td>
        </tr>
        </table>

    </div>
