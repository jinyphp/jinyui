<x-theme>
	<x-main class="p-4">
		<x-main-content class="bg-white p-4">
			
		</x-main-content>
	</x-main>
</x-theme>

<div>
    <div align="center">

        <table border="0" width="1200" cellspacing="0" cellpadding="0">
            <tr>
                <td style="border:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#FFFFFF">
                {formstart}
                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;" bgcolor="#E9E9E9">
                        <b>사이트: </b>정적(HTML) 페이지</td>
                        <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
                        {delete}</td>
                        <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
                        {new}</td>

                    </tr>
                </table>
                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="font-size:12px;padding:10px;">[Tip] 회사소개, 위치, 제품설명등
                        HTML형태의 웹페이지 내용을 제작할 수 있습니다.</td>
                        <td style="font-size:12px;padding:10px;" width="80" align="right">검색:</td>
                        <td style="font-size:12px;padding:10px;" width="200">{search_key}</td>
                        <td style="font-size:12px;padding:10px;" width="100">{search}</td>
                        <td style="font-size:12px;padding:10px;" width="100">{list_num}</td>
                    </tr>
                </table>
                <p>{datalist}</p>
                <p>{formend}</td>
            </tr>
            </table>

        </div>
</div>
