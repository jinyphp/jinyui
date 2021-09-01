<?php
namespace Modules;
class Theme
{
    private $country;
    private $language;
    private $mobile;

    public function __construct($args=[])
    {
        foreach ($args as $key => $value) {
            $this->$key = $value;
        }
    }

    // 모바일과 PC용을 구분합니다.
	public function emptybody(){		
		if($this->mobile == "m"){
			$body = $this->emptybody_m($skin_name);
		} else {
			$body = $this->emptybody_pc($skin_name);
		}
		return $body;
    }

    public function emptybody_pc($skin_name){
		global $site_env;

		// pc 접혹 할때만 레이아웃 저장 
		$body = _html_layout($skin_name);


		
		if($rows = _site_themeFilesHtml($site_env->theme, "layout", $this->language, $this->mobile) ){
			$_body = stripslashes($rows->html);			
		} else {
			$_body = "{header}{menu}{main}{footer}";
		}

        $_body = str_replace("{header}",_theme_header($skin_name)."\n",$_body);
		$_body = str_replace("{menu}","<div class='menu' id='menu' style='z-index:100;'>"._theme_menu($skin_name)."</div>\n",$_body);
		$_body = str_replace("{main}","<div id=\"mainbody\">"."<!--{skin_emptybody}-->"."</div>"."\n",$_body);
		$_body = str_replace("{footer}",_theme_footer($skin_name)."\n",$_body);

		$body = str_replace("</body>", $_body, $body);
   		

		return $body;
	}

	public function emptybody_m($skin_name){
		global $site_env;

		$body = _html_layout($skin_name);

		$title_header = json_decode($site_env->seo_title)->$site_language;
		if(!$title_header || $title_header == "") {
			if($site_env->code) $title_header = $site_env->code;
			else $title_header = $site_env->domain;
		}

		$code_body = "<!--{skin_emptybody}-->";
		$body = str_replace("</body>", "<div id=\"page\">
			<!-- Header Title-->
			<div class=\"header\"><a href=\"#menu\"></a>".$title_header."</div>
			"._theme_header($skin_name)."
			<div class=\"content\">
				<!-- mainbody -->
				<div id=\"mainbody\">".$code_body."</div>
				<!-- footer -->
				"._theme_footer($skin_name)."
			</div>

			<nav id=\"menu\">"._theme_menu($skin_name)."</nav>

			</div>"."\n</body>", $body);
		
		return $body;
	}
    

}