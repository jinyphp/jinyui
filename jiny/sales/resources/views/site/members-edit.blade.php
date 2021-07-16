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
                    사이트: 회원</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
                     </td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
                     </td>

                </tr>
            </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="50%" valign="top">
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">
                    가입경로</td>
                    <td style="font-size:12px;padding:10px;">{regref}</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">
                    <font size="2">이메일:</font></td>
                    <td style="font-size:12px;padding:10px;"><font size="2">{email}</font></td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">
                    비밀번호:</td>
                    <td style="font-size:12px;padding:10px;">{password} </td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">
                    이름(last name):</td>
                    <td style="font-size:12px;padding:10px;">{manager}</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">
                    성(first name)</td>
                    <td style="font-size:12px;padding:10px;">{firstname}</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">
                    성별:</td>
                    <td style="font-size:12px;padding:10px;">{sex}</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">
                    전화번호:</td>
                    <td style="font-size:12px;padding:10px;">{phone}</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">
                    도시:</td>
                    <td style="font-size:12px;padding:10px;">{city}</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">
                    주(state):</td>
                    <td style="font-size:12px;padding:10px;">{state}</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">
                    우편번호:</td>
                    <td style="font-size:12px;padding:10px;">{post}</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">
                    주소:</td>
                    <td style="font-size:12px;padding:10px;">{address}</td>
                    </tr>
                </table>
                    </td>
                    <td style="font-size:12px;padding:10px;" width="50%" valign="top">
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">
                    <font size="2">회원 승인:</font></td>
                    <td style="font-size:12px;padding:10px;"><font size="2">{enable}</font></td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">
                    국가:</td>
                    <td style="font-size:12px;padding:10px;">{country}</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">
                    언어:</td>
                    <td style="font-size:12px;padding:10px;">{language}</td>
                    </tr>
                </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">이머니:</td>
                    <td style="font-size:12px;padding:10px;" width="100">{emoney}</td>
                    <td style="font-size:12px;padding:10px;"> </td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">포인트:</td>
                    <td style="font-size:12px;padding:10px;" width="100">{point}</td>
                    <td style="font-size:12px;padding:10px;"> </td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">구매 할인율:</td>
                    <td style="font-size:12px;padding:10px;" width="100">{discount}</td>
                    <td style="font-size:12px;padding:10px;">%</td>
                    </tr>
                </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">가입일자:</td>
                    <td style="font-size:12px;padding:10px;">{regdate}</td>
                    </tr>
                </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="80">마지막 접속일:</td>
                    <td style="font-size:12px;padding:10px;">{lastlog}</td>
                    </tr>
                </table>
                    </td>
                </tr>
            </table>
            <p align="center">{form_submit}{formend} </p>
                    <p> </p>
            </td>
        </tr>
        </table>

    </div>
