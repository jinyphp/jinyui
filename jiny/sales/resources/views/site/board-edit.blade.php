<x-theme>
	<x-main class="p-4">
		<x-main-content class="bg-white p-4">
			
		</x-main-content>
	</x-main>
</x-theme>

<div align="center">

    <table border="0" width="1200" cellspacing="0" cellpadding="0">
        <tr>
            <td style="border:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF" valign="top">

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
                    {board_title}</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">&nbsp;</td>
                </tr>
            </table>

    {formstart}<table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="120">
                    글제목 :</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">{title}</td>
                </tr>
            </table>

            <table border="0" width="1178" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="120">
                작성자(이메일) :</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="250">
                    <font size="2">{email}</font></td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="120">
                비빌번호:</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="250"><font size="2">
                    {password}</font></td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">&nbsp;</td>
                </tr>
            </table>

            <p>&nbsp;</p>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="120">
                    비밀글:</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">{secure}</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="120">
                    답장허용:</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">{reply}</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="120">
                    코멘트 허용:</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">{comment}</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="120">
                    본문 작성자 표기 :</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
                    {view_writer}</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="120">
                    본문 작성일자 표기 :</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
                    {view_regdate}</td>
                </tr>
            </table>

            <p>&nbsp;</p>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;">
                    {html}</td>
                </tr>
            </table>

            <p>&nbsp;</p>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">
                    본문 첨부파일 이미지 표기 :</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
                    {view_images}</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">
                    첨부 이미지 최대 크기 :</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
                    {view_images_maxsize}</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">
                    첨부 이미지 출력방식 : </td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
                    {view_images_type}</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">
                    본문 첨부파일 정보 표기 :</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
                    {view_attach_view}</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">
                    본문 첨부파일 다운로드 링크 허용:</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
                    {view_attach_down}</td>
                </tr>
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="200">
                    &nbsp;</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">{files}</td>
                </tr>
            </table>

            <p align="center">{form_submit}{formend}</td>
        </tr>
        </table>

    </div>
