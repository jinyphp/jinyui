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
                    <b>홈페이지 :</b> 계시판 목록 수정</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
                    &nbsp;</td>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:2px;" width="100" bgcolor="#E9E9E9">
                    &nbsp;</td>

                </tr>
            </table>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    활성화 :</td>
                    <td style="font-size:12px;padding:10px;" width="200">{enable}</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    계시판 타입 :</td>
                    <td style="font-size:12px;padding:10px;" width="200">{type}</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    코드 :</td>
                    <td style="font-size:12px;padding:10px;" width="200">{code}</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
            </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    타이틀 HTML:</td>
                    <td style="font-size:12px;padding:10px;">{title}</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    타이틀이미지:</td>
                    <td style="font-size:12px;padding:10px;">{images}</td>
                    </tr>
                </table>
            <p align="center">&nbsp;</p>
            <p align="center">{seo_language}</p>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
                    <b>* 권한 설정</b></td>
                </tr>
            </table>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="120">
                    회원전용 :</td>
                    <td style="font-size:12px;padding:10px;">{check_login}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="120">
                    비밀글 :</td>
                    <td style="font-size:12px;padding:10px;">{view_secure}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="120">
                    답변 허용 :</td>
                    <td style="font-size:12px;padding:10px;">{check_reply}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="120">
                    답변글 보기:</td>
                    <td style="font-size:12px;padding:10px;">
                    {view_reply}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="120">
                    코멘트 허용:</td>
                    <td style="font-size:12px;padding:10px;">
                    {check_comment}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="120">
                    글쓰기 허용:</td>
                    <td style="font-size:12px;padding:10px;">
                    {check_write}</td>
                </tr>
            </table>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
                    <b>* 출력 설정</b></td>
                </tr>
            </table>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="120">
                    목록 내용보기:</td>
                    <td style="font-size:12px;padding:10px;">{view_content}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="120">
                    본문 작성자 표기 :</td>
                    <td style="font-size:12px;padding:10px;">
                    {view_writer}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="120">
                    본문 작성일자 표기 :</td>
                    <td style="font-size:12px;padding:10px;">
                    {view_regdate}</td>
                </tr>
            </table>

            <p align="center">&nbsp;</p>
            <p align="center">&nbsp;</p>
            <p align="center">&nbsp;</p>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
                    <b>* 스타일 설정</b></td>
                </tr>
            </table>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">배경색 :</td>
                    <td style="font-size:12px;padding:10px;" width="200">{bgcolor}</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">계시판 글수 :</td>
                    <td style="font-size:12px;padding:10px;" width="200">{listnum}</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
            </table>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
                    <b>* 전처리 Plug 표시설정</b></td>
                </tr>
            </table>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">글자수 제한 :</td>
                    <td style="font-size:12px;padding:10px;" width="200">{str}</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">
                    글 목록수:</td>
                    <td style="font-size:12px;padding:10px;" width="200">{index_listnum}</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
                </table>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
                    <b>* 첨부파일 설정</b></td>
                </tr>
            </table>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="200">
                    본문 첨부파일 이미지 표기 :</td>
                    <td style="font-size:12px;padding:10px;">
                    {view_images}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="200">
                    첨부 이미지 최대 크기 :</td>
                    <td style="font-size:12px;padding:10px;">
                    {view_images_maxsize}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="200">
                    첨부 이미지 출력방식 : </td>
                    <td style="font-size:12px;padding:10px;">
                    {view_images_type}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="200">
                    본문 첨부파일 정보 표기 :</td>
                    <td style="font-size:12px;padding:10px;">
                    {view_attach_view}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="200">
                    본문 첨부파일 다운로드 링크 허용:</td>
                    <td style="font-size:12px;padding:10px;">
                    {view_attach_down}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="200">
                    첨부파일 :</td>
                    <td style="font-size:12px;padding:10px;">
                    {check_attach}</td>
                </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="200">
                    첨부파일 라벨명 :</td>
                    <td style="font-size:12px;padding:10px;">
                    {attach_label}</td>
                </tr>
            </table>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
                    <b>* 관련상품 보기</b></td>
                </tr>
            </table>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">관련상품 보기 :</td>
                    <td style="font-size:12px;padding:10px;" width="200">{relation_goods}</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">관련상품 출력 :</td>
                    <td style="font-size:12px;padding:10px;" width="200">{relation_type}</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">가로 상품수 :</td>
                    <td style="font-size:12px;padding:10px;" width="200">{relation_cols}</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">세로 상품수 :</td>
                    <td style="font-size:12px;padding:10px;" width="200">{relation_rows}</td>
                    <td style="font-size:12px;padding:10px;">&nbsp;</td>
                    </tr>
            </table>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
                    <b>* 테마 파일 개별설정 (theme files 이름을 삽입해 주세요)</b></td>
                </tr>
            </table>

            <table border="0" width="1178" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">테마파일 (목록) :</td>
                    <td style="font-size:12px;padding:10px;" width="200">{themefiles_list}</td>
                    <td style="font-size:12px;padding:10px;">기본값 board</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">테마파일 (보기) :</td>
                    <td style="font-size:12px;padding:10px;" width="200">{themefiles_view}</td>
                    <td style="font-size:12px;padding:10px;">기본값 board_view</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">테마파일 (수정) :</td>
                    <td style="font-size:12px;padding:10px;" width="200">{themefiles_edit}</td>
                    <td style="font-size:12px;padding:10px;">기본값 board_edit</td>
                    </tr>
            </table>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;">
                    <b>* 스킨 설정</b></td>
                </tr>
            </table>

            <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">템플릿 스킨</td>
                    <td style="font-size:12px;padding:10px;">{skin_check} 치환코드
                    {board}</td>
                    </tr>
                <tr>
                    <td style="font-size:12px;padding:10px;" width="100">&nbsp;</td>
                    <td style="font-size:12px;padding:10px;">{skin}</td>
                    </tr>
                </table>
            <p align="center">{form_submit}</p>
            <p>{formend}&nbsp;</td>
        </tr>
        </table>

    </div>
