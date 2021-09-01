<?php
	@session_start();

	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/datetime.php";
	include "./func/file.php";
	include "./func/form.php";
	include "./func/string.php";
	include "./func/javascript.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";

	include "./func/site.php";	// 사이트 환경 설정

	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	$javascript = "<script>
		function edit(mode,code,ajaxkey){
			var url = \"/ajax_pages_edit.php?code=\"+code+'&mode='+mode + '&ajaxkey=' + ajaxkey;
			popup_ajax(url);
        }
	</script>";

	$body =  _skin_emptybody($skin_name);
	if($code = _formdata("code")){
		
		$filename = "./pages/$code/$code.".$site_language;
		if($site_mobile == "m") $filename .= ".m.htm"; else $filename .= ".htm";
		// echo $filename."<br>";

		if(_is_file($filename)){
			// ++ page html 케싱이 있는경우, 파일로 처리
			$pages_body = "<div class=\"$code\" id=\"page_content\">"._file_load($filename)."</div>";

			if(_is_file("./pages/$code/$code.json")){
				$json = _file_load("./pages/$code/$code.json");
				$pages_rows = json_decode($json);
			} else {
				$query = "select * from site_pages WHERE `code`='$code'";
				if($pages_rows = _mysqli_query_rows($query)){
				}
			}
				
		} else {
			// 캐싱 파일이 없을경우 , db에서 읽기
			$query = "select * from site_pages WHERE `code`='$code'";
			if($pages_rows = _mysqli_query_rows($query)){

				$query = "select * from site_pages_html WHERE `code`='".$code."' and `language`='$site_language'";
				if($site_mobile == "m") $query .=" and `mobile`='m'";
				else $query .=" and `mobile`='pc'";

				if($rows = _mysqli_query_rows($query)){	
					$pages_body = "<div class=\"$code\" id=\"page_content\">".stripslashes($rows->html)."</div>";
				}
			}	
		}	


		if($pages_rows->title_enable){

			$query = "select * from `site_pages_html` WHERE `code`='".$code."' and `language`='$site_language'";
			if($site_mobile == "m") $query .=" and `mobile`='m'";
			else $query .=" and `mobile`='pc'";

			if($rows = _mysqli_query_rows($query)){	
				$pages_body = "<div class=\"$code\" id=\"page_title\">".$rows->title."</div>".$pages_body;
			}
		}

		// ++ page를 스타일에 맞추어 출력 처리함
		if($pages_body){
			
			// ++ submenu 스킨 
			
			if($submenu = _site_themeFilesHtml($site_env->theme,"submenu",$site_language,$site_mobile)){
				$submenu_body = stripslashes($submenu->html);
			} else {
				$submenu_body = "<!--{#side_menu}-->";
			}
			

			if($_SESSION['session_admin']){
				$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
				$pages_body .= $javascript."<div style=\"text-align:right;\">					
									<input type='button' name='edit' value='수정' onclick=\"javascript:edit('edit','$code','$ajaxkey')\" style=\"$css_btn_gray\">
								</div>";
			}


			if($pages_rows->sub_align == "left"){
				// ++ 서브메뉴 왼쪽
				$div ="<table border=\"0\" width='".$site_env->width."' cellspacing=\"0\" cellpadding=\"0\" >
							<tr>
								<td id=\"submenu\" width='".$pages_rows->sub_width."' valign=top> $submenu_body </td>
								<td class=\"$code\" id=\"main-content\" bgcolor=".$pages_rows->bgcolor."  valign=top> ".$pages_body." </td>
							</tr></table>";
			} else  if($pages_rows->sub_align == "right"){
				// ++ 서브메뉴 오른쪽
				$div ="<table border=\"0\" width='".$site_env->width."' cellspacing=\"0\" cellpadding=\"0\" >
							<tr>
								<td class=\"$code\" id=\"main-content\" bgcolor=".$pages_rows->bgcolor."  valign=top> ".$pages_body." </td>
								<td id=\"submenu\" width='".$pages_rows->sub_width."' valign=top> $submenu_body </td>
							</tr></table>";
			} else {
				// ++ 서브메뉴 없음.
				if($site_mobile == "m"){
					$div ="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" >
							<tr>
								<td class=\"$code\" id=\"main-content\" bgcolor=".$pages_rows->bgcolor."  valign=top> ".$pages_body." </td>
							</tr></table>";
				} else {
					$div ="<table border=\"0\" width='".$site_env->width."' cellspacing=\"0\" cellpadding=\"0\" >
							<tr>
								<td class=\"$code\" id=\"main-content\" bgcolor=".$pages_rows->bgcolor."  valign=top> ".$pages_body." </td>
							</tr></table>";
				}
				
			}

			

			/*
			$div .= "<input type='button' value='+' onclick=\"javascript:textBox()\" id=\"css_btn_new\">"; 


			$text = "<div>Edit text</div>";
			$javascript = "<script>
				
				//$('#page_content').sortable();

				

				function textBox(){					
					// $('#main-content').append(\"<div contenteditable>aaaa</div>\");
					// $('#page_content').append(\"<div>aaaa</div>\");
					$('#page_content').append($('<div contenteditable>...aaa...</div>'));
				}

				
				$('#page_content div').on('mouseover',function(event){
        			$(this).css('border','1px solid #ff0000');
        			event.stopPropagation();  // 이벤트버블링 방지
        		}).on('mouseout',function(event){
        			$(this).css('border','');
        			event.stopPropagation();  // 이벤트버블링 방지
    			});


    			// The inline editor should be enabled on an element with \"contenteditable\" attribute set to \"true\".
				// Otherwise CKEditor will start in read-only mode.
				var introduction = document.getElementById( 'page_content' );
				introduction.setAttribute( 'contenteditable', true );

		CKEDITOR.inline( 'introduction', {
			// Allow some non-standard markup that we used in the introduction.
			extraAllowedContent: 'a(documentation);abbr[title];code',
			removePlugins: 'stylescombo',
			extraPlugins: 'sourcedialog',
			// Show toolbar on startup (optional).
			startupFocus: true,

		} );


			</script>";
			$div .= "<script src=\"http://cdn.ckeditor.com/4.5.8/standard-all/ckeditor.js\"></script>"."<script src=\"//code.jquery.com/ui/1.11.4/jquery-ui.js\"></script>".$javascript;
			*/



			if($pages_rows->align) $pages_body = "<div align='".$pages_rows->align."'> $div </div>";
			$body = str_replace("<!--{skin_emptybody}-->",$pages_body,$body);

		} else {
			$msg = "페이지 내용이 없습니다. Empty!";
			$body = str_replace("<!--{skin_emptybody}-->",$msg,$body);
		}


		//$menu_code = "before";
		//$url = $_SERVER['REQUEST_URI'];
		$query = "select * from `site_menu` where enable = 'on' and code = '".$site_menuCode."' and urlmode = 'pages' and url = '".$code."' order by pos desc";
		// echo $query."<br>";
		if($subrows = _mysqli_query_rows($query)){
			$body = str_replace("<!--{#side_menu}-->", _submenu("default",$site_language,$subrows->ref),$body);
		}


		// ++ 페이지 접속 회수 카운트
		$click = $pages_rows->click + 1;
		$query = "UPDATE `site_pages` SET `click`='$click' where `code`='$code'";
		//echo $query;
		_mysqli_query($query);
	


		// page 접속 로그를 기록합니다.
		$log = $TODAYTIME.";". $_SERVER['SERVER_NAME'].";". $_SERVER['REMOTE_ADDR'].";". $site_mobile.";". $_SERVER['HTTP_REFERER']." \n";
		$file = fopen("./pages/$code/$code.log","a");
		fwrite($file, $log);
		fclose($file);

		/*
		
		*/



	} else if($url = _formdata("url")){

		// <iframe src="https://docs.google.com/document/d/103heiSY0qo-ue1eQ5KpCvyAHPV0nSdkmjMnvBsLEVxA/pub?embedded=true"></iframe>

		/*
		// $postfild = "embedded=true";

		$url = "https://docs.google.com/document/d/103heiSY0qo-ue1eQ5KpCvyAHPV0nSdkmjMnvBsLEVxA/pub?embedded=true";
		*/

		// curl로 url로 내용을 읽어와 처리
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$postfild);

		// receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec($ch);	
		curl_close($ch);

		$body = str_replace("<!--{skin_emptybody}-->", $server_output, $body);
		

	} else {
		$body = str_replace("<!--{skin_emptybody}-->","페이지 코드가 없습니다..",$body);
	}





	// ++ SEO Meta 설정
	$seo_title = json_decode($site_env->seo_title);
	$body = str_replace("<!-- meta title -->","<meta name=\"title\" content=\"".$seo_title->$site_language."\" />\n",$body);

	$seo_keyword = json_decode($site_env->seo_keyword);
	$body = str_replace("<!-- meta keyword -->","<meta name=\"keyword\" content=\"".$seo_keyword->$site_language."\" />\n",$body);

	$seo_description = json_decode($site_env->seo_description);
	$body = str_replace("<!-- meta description -->","<meta name=\"description\" content=\"".$seo_description->$site_language."\" />\n",$body);

	// ++ 완성왼 html body를 화면에 출력합니다.
	echo $body;

?>