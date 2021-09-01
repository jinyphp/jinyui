<?php
include "../vendor/autoload.php";

//echo "안녕하세요.";

@session_start();
/*	
include "../conf/dbinfo.php";
include "../func/mysql.php";

include "../func/datetime.php";
include "../func/file.php";
include "../func/form.php";
include "../func/string.php";
include "../func/javascript.php";

include "../func/mobile.php";
include "../func/language.php";
include "../func/country.php";

include "../func/site.php";	// 사이트 환경 설정

include "../func/layout.php";
include "../func/header.php";
include "../func/footer.php";

include "../func/menu.php";
include "../func/category.php";
include "../func/skin.php";

include "../func/members.php";
*/
// *******************




//print_r($site_env);
/*
$index_themeFileName = _index_themeFileName($site_env);// index파일 이름
$index_body = _theme_page($site_env->theme, $index_themeFileName, $site_language, $site_mobile);




if($index_body){

    // PreFix plug 코드 처리 
    require_once("../inc_plug_prefix.php");
    
    $theme = new \Modules\Theme(['country'=>$site_country, 'language'=>$site_language, 'mobile'=>$site_mobile]);
    $body = $theme->emptybody();

    // 처리된 index body를 삽입
    $body = str_replace("<!--{skin_emptybody}-->", "<div id=\"index_body\">".$index_body."</div>", $body);

} else {
    echo $index_themeFileName."(".$site_env->theme.") 스킨=DB를 읽어 올 수 없습니다.";
}
*/


$html['header'] = skin("../theme/default/header/ko/desktop.html.php", ['header'=>new \Modules\Header]);
$html['content'] = skin("../theme/default/index/ko/desktop.html.php");
$html['footer'] = skin("../theme/default/footer/ko/desktop.html.php");
// SEO 메타코드 처리 
//require_once("../meta_seo.php");

// 최종 화면 처리.
$body = skin("../theme/default/layout/ko/desktop.html.php", $html);
echo $body;

//logsave($php_start);    // 로그정보 기록