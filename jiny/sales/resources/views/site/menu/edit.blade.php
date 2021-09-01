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
                    <b>홈페이지 :</b> 메뉴구성</td>

                </tr>
            </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">활성화 :</td>
                    <td style="font-size:12px;padding:10px;" width="200">{enable}</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">메뉴코드 :</td>
                    <td style="font-size:12px;padding:10px;" width="200">{menu_code}</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                </tr>
                </table>
            <p>{menu_name}</p>
            <table border="0" width="1178" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">URL 연결방식 :</td>
                    <td style="font-size:12px;padding:10px;" width="200">{urlmode}</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">URL 값 :</td>
                    <td style="font-size:12px;padding:10px;" colspan="2">{url}</td>
                </tr>
                </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;"><b>* 권한 설정</b></td>
                </tr>
                </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">회원만 접속:</td>
                    <td style="font-size:12px;padding:10px;" width="100">{check_members}</td>
                    <td style="font-size:12px;padding:10px;" width="100">&nbsp;</td>
                    <td style="font-size:12px;padding:10px;" >&nbsp;</td>
                </tr>
                </table>
            <p align="center">{form_submit}<p>{formend}</td>
        </tr>
        </table>

    </div>
