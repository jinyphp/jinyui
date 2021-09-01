<?php
	//* ///////////////////////
	//* OpenShopping V2.1 
	//* Program By : hojin lee 
	//*
	
	// update : 2016.01.06 = 코드정리
	// update : 2016.01.20 font-awesome.css 추가

	




	// PC용 레이아웃 
	// 레이아웃 기본틀 템플릿을 생성하여 HTML 리턴
	function _html_layout($skin_name){
		global $site_env;  // 사이트 환경설정값

		$skinbody  ="<!doctype html>\n";	// HTML 5 로 선언!
		$skinbody .="<html>\n";
		$skinbody .="<head>\n";
		
		// 언어셋을 UTF-8로 지정
		$skinbody .= _html_meta("utf-8")."\n";

		$skinbody .= _html_head_crossbrowser()."\n";

		// 작성한 Header 파일을, 치환 형태로 코드삽입.	
		$skinbody .= _html_head()."\n";

		$skinbody .= "</head>\n";
		
		$skinbody .= _html_body($site_env->top_margin, $site_env->left_margin, "#".$site_env->bgcolor);
		$skinbody .= "</html>";				

		return $skinbody;
	}


	function _html_meta($charset){
		global $site_mobile;

		// 언어셋을 UTF-8로 지정
		$meta ="  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">\n";

		if($site_mobile == "m"){
			// 모바일 접속시 viewport 설정
			$meta .="  <meta name=\"viewport\" content=\"width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes\" />\n";
		}

		// 사이트 타이틀
		$meta .= "<!-- meta title -->\n";

		// 사이트 키워드
		$meta .= "<!-- meta keyword -->\n";

		// 사이트 설명
		$meta .= "<!-- meta description -->\n";

		return $meta;
	}

	function _html_head(){
		global $site_mobile;


		if($site_mobile == "m"){
			// 모바일 스타일로 지정
			
			$head = "<link type=\"text/css\" rel=\"stylesheet\" href=\"/css/mmenu.css\" />";
			$head .= "<link type=\"text/css\" rel=\"stylesheet\" href=\"/css/jquery.mmenu.all.css\" />";

			$head .= "<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js\"></script>";
			$head .= "<script type=\"text/javascript\" src=\"/js/jquery.mmenu.min.all.js\"></script>";

			$head .= "<script type=\"text/javascript\">
			$(function() {
				$('nav#menu').mmenu({
					extensions	: [ 'effect-slide-menu', 'pageshadow' ],
					searchfield	: true,
					counters	: true,
					navbar 		: {
						title		: 'Menu & Category'
					},
					navbars		: [
						{
							position	: 'top',
							content		: [ 'searchfield' ]
						}, {
							position	: 'top',
							content		: [
								'prev',
								'title',
								'close'
							]
						}, {
							position	: 'bottom',
							content		: [
								''
							]
						}
					]
				});
			});
					</script>";
			
		
		} else {
			// Header 부분 javascript and CSS 링크 설정
			$head  = " <script type=\"text/javascript\" src=\"//code.jquery.com/jquery-1.11.0.min.js\"></script>\n";
			$head .= " <script type=\"text/javascript\" src=\"/js/vendor/jquery-ui-1.10.3.custom.min.js\"></script>\n";
			$head .= " <script type=\"text/javascript\" src=\"/js/jquery.form.js\"></script>\n";

			// 상단 메뉴구조 CSS / Script 설정
			$head .= " <script src=\"/js/cssmenu.js\"></script>\n";
			$head .= _menu_css_db($skin_name);
			
		}	

		$head .= " <script type=\"text/javascript\" src=\"/js/jinyweb.js?cashing=".microtime()."\"></script>\n";

		$head .= "<link type=\"text/css\" rel=\"stylesheet\" href=\"/css/openshopping.css\"></link>\n";	
		$head .= "<script type=\"text/javascript\" src=\"/js/openshopping.js?cashing=".microtime()."\"></script>\n";

		// Font awsome
		$head .= "<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css\">\n";


		if(file_exists($_SERVER['DOCUMENT_ROOT']."/css/site.css")){
			$head .= "<link href='/css/site.css' rel='stylesheet' type='text/css'></link>\n";
		}
		

		// 관리자 로그인, 관리자는 PC모드에만 가능합니다. 
		// 별도 관리자 스크립트 실행 
		if($_SESSION['session_admin']){
			// 관리자 : 마우스 오른쪽 클릭 메뉴, contextMenu
			$head .= " <script src=\"/js/jquery.contextMenu.js\"></script>\n";
			$head .= "<link href='/css/jquery.contextMenu.css' rel='stylesheet' type='text/css'></link>\n";
				
			$head .= " <script src=\"/js/openshopping.admin.js\"></script>\n";

			// css 텝바
			$head .= " <link href='/css/tabbar_style.css' rel='stylesheet' type='text/css'></link>\n";

		


		}

		return $head;
	}

	function _html_head_crossbrowser(){
		$msg_old_browser = "<script> alert(\"오래된 버젼의 브라우져 입니다. 정상적인 동작을 위해서 최신 브라우져로 업그래이드후 접속해 주세요.\"); </script>";
		
		$head .= "<!--[if lt IE 9]>
					<script src=\"//html5shiv.googlecode.com/svn/trunk/html5.js\"></script>
				  <![endif]-->";
		/*		  
		$head .= "<!--[if lt IE 9]>
					<script src=\"http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js\"></script>
				<![endif]-->";
		*/

		/*
		$head .= "<!--[if lt IE 8]>
					<script src=\"http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js\"></script>		
				<![endif]-->";
			
		$head .= "<!--[if lt IE 7]>
				<script src=\"http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js\"></script>					
				<![endif]-->";	
		*/

 		return $head;			
	}


	// 파업용 마스크 Div Layer 설정
	function _html_popup_mask(){
		
		$mask  = "<div style=\"border solid 1px:#4087a1; background-color: #ffffff; position: absolute; top:100px; left: 100px; display: none; z-index:10001;\" 
						id=\"popup_body\">
					<center><img src='/images/loading.gif' border='0'></center>
				  </div>";
		$mask .= "<div id=\"popup_mask\" style=\"position:absolute;z-index:9000;background-color:#000000;display:none;left:0;top:0;\"></div>"; 		  
		// <input type=\"button\" onclick=\"popup_close();\" value=\"닫기\" />	
		return $mask;		  
	}




	function _html_body($top,$left,$bgcolor){
		$body = "<body id=\"fullbody\" ";
		if($bgcolor) $body .= "style=\"z-index:1;background:".$bgcolor.";\" ";
		$body .= "topmargin=\"".$top."\" leftmargin=\"".$left."\" >";
		$body .= _html_popup_mask();
		$body .= "<!-- body -->";

		// 관리자 로그인, 관리자는 PC모드에만 가능합니다. 
		if($_SESSION['session_admin']){
			// 레이아웃 수정모드 버튼 클릭
			$edit_mode .= "<div style=\"position:absolute;z-index:9100;background-color:#ffffff;left:0;top:0;\" id=\"layout_edit\"><i class=\"fa fa-cogs\"></i></div>";
			$edit_mode .= "<script>
				// 레이아웃 설정 버튼 위치
				var windows_width = $(window).width();
				var layout_width = $('#layout_edit').width();

				var left = windows_width - layout_width;
				$('#layout_edit').css('left',left);	
			</script>";

			$body .= $edit_mode;
		}

		$body .= "\n</body>";

		return $body;
	}




?>