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
                    <b>홈페이지 : </b>해더설정

                    </td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
                     </td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
                     </td>

                </tr>
            </table>

    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80" valign="top">
                    활성화:</td>
                    <td style="font-size:12px;padding:10px;" valign="top">{enable}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80" valign="top">
                    제목:</td>
                    <td style="font-size:12px;padding:10px;" valign="top">{title}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80" valign="top">
                    로고파일:</td>
                    <td style="font-size:12px;padding:10px;" valign="top">{logo}</td>
                </tr>
                </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80" valign="top">
                    가로크기:</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    {width}</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    정렬 : </td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    {align}</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    배경색 : </td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="80">
                    {bgcolor}</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                     </td>
                </tr>
                </table>
            <p>버튼이미지</p>

    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80" valign="top">
                    로그인:</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="20">
                    {login_check}</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                    {login_images}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80" valign="top">
                    로그아웃:</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="20">
                    {logout_check}</td>
                    <td style="font-size:12px;padding:10px;" valign="top">{logout_images}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80" valign="top">
                    회원가입:</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="20">
                    {member_check}</td>
                    <td style="font-size:12px;padding:10px;" valign="top">{member_images}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80" valign="top">
                    회원정보:</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="20">
                    {myinfo_check}</td>
                    <td style="font-size:12px;padding:10px;" valign="top">{myinfo_images}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80" valign="top">
                    장바구니:</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="20">
                    {cart_check}</td>
                    <td style="font-size:12px;padding:10px;" valign="top">{cart_images}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80" valign="top">
                    관심상품:</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="20">
                    {wish_check}</td>
                    <td style="font-size:12px;padding:10px;" valign="top">{wish_images}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80" valign="top">
                    주문목록:</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="20">
                    {orderlist_check}</td>
                    <td style="font-size:12px;padding:10px;" valign="top">{orderlist_images}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80" valign="top">
                    모바일전환:</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="20">
                    {mobile_check}</td>
                    <td style="font-size:12px;padding:10px;" valign="top">{mobile_images}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80" valign="top">
                    PC전환:</td>
                    <td style="font-size:12px;padding:10px;" valign="top" width="20">
                    {mobilepc_check}</td>
                    <td style="font-size:12px;padding:10px;" valign="top">
                    {mobilepc_images}</td>
                </tr>
                </table>
            <p>{language_html}</p>
            <p align="center">{form_submit}</p>
            <p>{formend}</td>
        </tr>
        </table>

    </div>
