<x-theme>
    <x-main class="p-4">
        <x-main-content class="bg-white p-4">

        </x-main-content>
    </x-main>
</x-theme>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
    <tr>
        <td style="border:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF">
            {formstart}
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" valign="top" width="100">
                        오버레이 </td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" valign="top">
                        html 처리{inner}</td>
                </tr>
            </table>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" valign="top" width="100">
                        가로크기 :</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="100">
                        {inner_width}</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                        &nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" valign="top" width="100">
                        세로크기 :</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="100">
                        {inner_height}</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                        &nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" valign="top" width="100">
                        세로위치 :</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="100">
                        {inner_top}</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                        &nbsp;</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" valign="top" width="100">
                        좌측위치 :</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="100">
                        {inner_left}</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                        &nbsp;</td>
                </tr>
            </table>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" valign="top" width="100">
                        제목명 :</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                        {inner_title}</td>
                </tr>
            </table>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" valign="top" width="100">
                        내용 :</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                        {inner_html}</td>
                </tr>
            </table>
            <p align="center">{form_submit}{formend}
        </td>
    </tr>
</table>
