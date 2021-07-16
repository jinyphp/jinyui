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
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#E9E9E9">테마코드</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
                     </td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9"> </td>

                </tr>
            </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100"><font size="2">활성화 :</font></td>
                    <td style="font-size:12px;padding:10px;"><font size="2">{enable}</font></td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    테마코드 :</td>
                    <td style="font-size:12px;padding:10px;">{theme}</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    <font size="2">타이틀 :</font></td>
                    <td style="font-size:12px;padding:10px;"><font size="2">{title}</font></td>
                    </tr>
                </table>
                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    Body 가로크기:</td>
                    <td style="font-size:12px;padding:10px;" width="100">{width}</td>
                    <td style="font-size:12px;padding:10px;"> </td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    Body 배경색 :</td>
                    <td style="font-size:12px;padding:10px;" width="100">{bgcolor}</td>
                    <td style="font-size:12px;padding:10px;"> </td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    Body 정렬 :</td>
                    <td style="font-size:12px;padding:10px;" width="100">{align}</td>
                    <td style="font-size:12px;padding:10px;"> </td>
                    </tr>
            </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
                    스타일 </td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;"> </td>
                    </tr>
    </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    <font size="2">Header :</font></td>
                    <td style="font-size:12px;padding:10px;" width="200"><font size="2">{header}</font></td>
                    <td style="font-size:12px;padding:10px;"> </td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    Menu1 :</td>
                    <td style="font-size:12px;padding:10px;" width="200">{menu_code}</td>
                    <td style="font-size:12px;padding:10px;">적용 메뉴코드를
                    선택</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    <font size="2">Menu2 :</font></td>
                    <td style="font-size:12px;padding:10px;" width="200"><font size="2">{menu_code_login}</font></td>
                    <td style="font-size:12px;padding:10px;">로그인후, 메뉴를
                    다르게 운영할 수 있습니다.</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    Index :</td>
                    <td style="font-size:12px;padding:10px;" width="200">{index}</td>
                    <td style="font-size:12px;padding:10px;"> </td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    Footer :</td>
                    <td style="font-size:12px;padding:10px;" width="200">{footer}</td>
                    <td style="font-size:12px;padding:10px;"> </td>
                    </tr>
            </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" width="100">
                    테마설명:</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;"> </td>
                    </tr>
    </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;">
                    {description}</td>
                    </tr>
            </table>
            <p align="center">{form_submit}{formend} </p></td>
        </tr>
        </table>

    </div>
