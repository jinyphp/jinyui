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
                    <b>홈페이지: </b>테마 페이지</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
                     {files}</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">{new}</td>

                </tr>
            </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">{theme}</td>
                    <td style="font-size:12px;padding:10px;"> </td>
                    <td style="font-size:12px;padding:10px;" width="80">검색:</td>
                    <td style="font-size:12px;padding:10px;" width="200">{search_key}</td>
                    <td style="font-size:12px;padding:10px;" width="80">{search}</td>
                    <td style="font-size:12px;padding:10px;" width="80">{list_num}</td>
                </tr>
            </table>
            <p>{theme_list}</p>
            <p>{formend} </td>
        </tr>
        </table>

    </div>
