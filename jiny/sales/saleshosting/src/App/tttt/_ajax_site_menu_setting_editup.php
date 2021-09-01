<?
	@session_start();

	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";
		
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";
	include "./func/site.php";
	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	include "./func/error.php";
	
	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";

	include "./func/curl.php";
	
	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...	
	
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$mode = _formmode(); 		//echo "mode = $mode <br>";
		$uid = _formdata("uid");	//echo "uid = $uid <br>";

		function _menu_setting_enable($uid){
			$query = "UPDATE `site_menu_setting` SET `enable` = '' WHERE `Id` like '$uid'";		// echo $query;
			//echo $query."<br>";
			_sales_query($query);

			$msg = "메뉴코드 비활성";
			echo $msg;
		}

		function _menu_setting_disable($uid){
			$query = "UPDATE `site_menu_setting` SET `enable` = 'on' WHERE `Id` like '$uid'";	// echo $query;
			//echo $query."<br>";
			_sales_query($query);

			$msg = "메뉴코드 활성";
			echo $msg;
		}

		function _menu_setting_delete($uid){
			$query = "DELETE FROM `site_menu_setting` WHERE `Id`='$uid'";
			_sales_query($query);
			
			$msg = "삭제";
    		echo $msg;	
		}

		switch($mode){
			case 'disable':
				_menu_setting_enable($uid);
				break;
			case 'enable':
				_menu_setting_disable($uid);
				break;
			case 'delete':		
				_menu_setting_delete($uid);
				break;	
		}	
			


		if($mode == "edit"){
			// Langauge Json Save
			$code = _formdata("code");
			$query = "select * from `site_menu_setting` where Id = '$uid'";
			//echo $query."<br>";
			if($rows = _sales_query_rows($query)){	
			
    			$query = "UPDATE `site_menu_setting` SET ";
				if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";

				$query .= "`code`='$code' ,";
				$menu_type = _formdata("menu_type");	$query .= "`menu_type`='$menu_type' ,";

				$width = _formdata("width");	$query .= "`width`='$width' ,";
				$height = _formdata("height");	$query .= "`height`='$height' ,";
				$bgcolor = _formdata("bgcolor");	$query .= "`bgcolor`='$bgcolor' ,";
				$align = _formdata("align");	$query .= "`align`='$align' ,";
				$fontsize = _formdata("fontsize");	$query .= "`fontsize`='$fontsize' ,";
				$gradation = _formdata("gradation");	$query .= "`gradation`='$gradation' ,";
				$radius = _formdata("radius");	$query .= "`radius`='$radius' ,";

				$padding = _formdata("padding");	$query .= "`padding`='$padding' ,";

				$menu1_fontcolor = _formdata("menu1_fontcolor");	$query .= "`menu1_fontcolor`='$menu1_fontcolor' ,";
				$menu1_fontcolor_hover = _formdata("menu1_fontcolor_hover");	$query .= "`menu1_fontcolor_hover`='$menu1_fontcolor_hover' ,";
				$menu1_bgcolor = _formdata("menu1_bgcolor");	$query .= "`menu1_bgcolor`='$menu1_bgcolor' ,";
				$menu1_bgcolor_hover = _formdata("menu1_bgcolor_hover");	$query .= "`menu1_bgcolor_hover`='$menu1_bgcolor_hover' ,";

				$menu2_fontcolor = _formdata("menu2_fontcolor");	$query .= "`menu2_fontcolor`='$menu2_fontcolor' ,";
				$menu2_fontcolor_hover = _formdata("menu2_fontcolor_hover");	$query .= "`menu2_fontcolor_hover`='$menu2_fontcolor_hover' ,";
				$menu2_bgcolor = _formdata("menu2_bgcolor");	$query .= "`menu2_bgcolor`='$menu2_bgcolor' ,";
				$menu2_bgcolor_hover = _formdata("menu2_bgcolor_hover");	$query .= "`menu2_bgcolor_hover`='$menu2_bgcolor_hover' ,";

				$menu3_fontcolor = _formdata("menu3_fontcolor");	$query .= "`menu3_fontcolor`='$menu3_fontcolor' ,";
				$menu3_fontcolor_hover = _formdata("menu3_fontcolor_hover");	$query .= "`menu3_fontcolor_hover`='$menu3_fontcolor_hover' ,";
				$menu3_bgcolor = _formdata("menu3_bgcolor");	$query .= "`menu3_bgcolor`='$menu3_bgcolor' ,";
				$menu3_bgcolor_hover = _formdata("menu3_bgcolor_hover");	$query .= "`menu3_bgcolor_hover`='$menu3_bgcolor_hover' ,";

				if($bottom = _formdata("bottom")) $query .= "`bottom`='on' ,"; else $query .= "`bottom`='' ,";
				if($bottom_mark = _formdata("bottom_mark")) $query .= "`bottom_mark`='on' ,"; else $query .= "`bottom_mark`='' ,";
				$bottom_px = _formdata("bottom_px");	$query .= "`bottom_px`='$bottom_px' ,";
				$bottom_color = _formdata("bottom_color");	$query .= "`bottom_color`='$bottom_color' ,";

				if($html_check = _formdata("html_check")) $query .= "`html_check`='on' ,"; else $query .= "`html_check`='' ,";
				$menu_width = _formdata("menu_width");	$query .= "`menu_width`='$menu_width' ,";
				$menu_align = _formdata("menu_align");	$query .= "`menu_align`='$menu_align' ,";
				$menu_css = _formdata("menu_css");	$query .= "`menu_css`='$menu_css' ,";
				$html = _formdata("html");	$query .= "`html`='".addslashes($html)."' ,"; 

				$query .= "WHERE Id =$uid";
				$query = str_replace(",WHERE","where ",$query);
				//echo $query."<br>";
				_sales_query($query);

				echo "수정완료 <br>";

				// 코드값이 변경할 경우, menu 코드값 전체 갱신
				if($rows->code != $code){
					$query = "UPDATE `site_menu` SET `code`='$code' WHERE code = '".$rows->code."' ";
					//echo $query."<br>";
					_sales_query($query);
					echo "메뉴코드 갱신 <br>";
				}

				/*
				// 스킨파일 생성
				$dir = "./users/".$sales_db->Id."/skin";
				if(_is_path($dir)){
					$menu_body = "<div ";
					if($menu_align) $menu_body .= "align=\"".$menu_align."\" ";
					if($menu_width) $menu_body .= "width=\"".$menu_width."%\" ";
					if($menu_height) $menu_body .= "height=\"".$menu_height."%\" ";
					if($menu_css) $menu_body .= "style=\"".$menu_css."\" ";
					$menu_body .= "id=\"menu\">";
					if($html_check) $menu_body .= $menu; else $menu_body .= "{menu}";
					$menu_body .= "</div>";
					
					_file_save($dir."/menu_".$code.".html",$menu_body);
				}
				*/
				
			}

		} else if($mode == "new"){

			// 신규모드
			$insert_filed = "`regdate`,";	$insert_value = "'".$TODAYTIME."',";

			if($enable = _formdata("enable")) {
				$insert_filed .= "`enable`,";	$insert_value .= "'on',";
			}
				
			if($code = _formdata("code")) {
				$insert_filed .= "`code`,";		$insert_value .= "'$code',";
			}

			if($menu_type = _formdata("menu_type")) {
				$insert_filed .= "`menu_type`,";		$insert_value .= "'$menu_type',";
			}

			if($width = _formdata("width")) {
				$insert_filed .= "`width`,";		$insert_value .= "'$width',";
			}

			if($height = _formdata("height")) {
				$insert_filed .= "`height`,";		$insert_value .= "'$height',";
			}

			if($bgcolor = _formdata("bgcolor")) {
				$insert_filed .= "`bgcolor`,";		$insert_value .= "'$bgcolor',";
			}

			if($align = _formdata("align")) {
				$insert_filed .= "`align`,";		$insert_value .= "'$align',";
			}

			if($fontsize = _formdata("fontsize")) {
				$insert_filed .= "`fontsize`,";		$insert_value .= "'$fontsize',";
			}

			if($gradation = _formdata("gradation")) {
				$insert_filed .= "`gradation`,";		$insert_value .= "'$gradation',";
			}

			if($radius = _formdata("radius")) {
				$insert_filed .= "`radius`,";		$insert_value .= "'$radius',";
			}

			if($padding = _formdata("padding")) {
				$insert_filed .= "`padding`,";		$insert_value .= "'$padding',";
			}


			//

			if($menu1_fontcolor = _formdata("menu1_fontcolor")) {
				$insert_filed .= "`menu1_fontcolor`,";		$insert_value .= "'$menu1_fontcolor',";
			}
			if($menu1_fontcolor_hover = _formdata("menu1_fontcolor_hover")) {
				$insert_filed .= "`menu1_fontcolor_hover`,";		$insert_value .= "'$menu1_fontcolor_hover',";
			}
			if($menu1_bgcolor = _formdata("menu1_bgcolor")) {
				$insert_filed .= "`menu1_bgcolor`,";		$insert_value .= "'$menu1_bgcolor',";
			}
			if($menu1_bgcolor_hover = _formdata("menu1_bgcolor_hover")) {
				$insert_filed .= "`menu1_bgcolor_hover`,";		$insert_value .= "'$menu1_bgcolor_hover',";
			}

			//

			if($menu2_fontcolor = _formdata("menu2_fontcolor")) {
				$insert_filed .= "`menu2_fontcolor`,";		$insert_value .= "'$menu2_fontcolor',";
			}
			if($menu2_fontcolor_hover = _formdata("menu2_fontcolor_hover")) {
				$insert_filed .= "`menu2_fontcolor_hover`,";		$insert_value .= "'$menu2_fontcolor_hover',";
			}
			if($menu2_bgcolor = _formdata("menu2_bgcolor")) {
				$insert_filed .= "`menu2_bgcolor`,";		$insert_value .= "'$menu2_bgcolor',";
			}
			if($menu2_bgcolor_hover = _formdata("menu2_bgcolor_hover")) {
				$insert_filed .= "`menu2_bgcolor_hover`,";		$insert_value .= "'$menu2_bgcolor_hover',";
			}

			//

			if($menu3_fontcolor = _formdata("menu3_fontcolor")) {
				$insert_filed .= "`menu3_fontcolor`,";		$insert_value .= "'$menu3_fontcolor',";
			}
			if($menu3_fontcolor_hover = _formdata("menu3_fontcolor_hover")) {
				$insert_filed .= "`menu3_fontcolor_hover`,";		$insert_value .= "'$menu3_fontcolor_hover',";
			}
			if($menu3_bgcolor = _formdata("menu3_bgcolor")) {
				$insert_filed .= "`menu3_bgcolor`,";		$insert_value .= "'$menu3_bgcolor',";
			}
			if($menu3_bgcolor_hover = _formdata("menu3_bgcolor_hover")) {
				$insert_filed .= "`menu3_bgcolor_hover`,";		$insert_value .= "'$menu3_bgcolor_hover',";
			}



			if($bottom = _formdata("bottom")) {
				$insert_filed .= "`bottom`,";		$insert_value .= "'$bottom',";
			}
			if($bottom_mark = _formdata("bottom_mark")) {
				$insert_filed .= "`bottom_mark`,";		$insert_value .= "'$bottom_mark',";
			}
			if($bottom_px = _formdata("bottom_px")) {
				$insert_filed .= "`bottom_px`,";		$insert_value .= "'$bottom_px',";
			}
			if($bottom_color = _formdata("bottom_color")) {
				$insert_filed .= "`bottom_color`,";		$insert_value .= "'$bottom_color',";
			}
			

			if($html_check = _formdata("html_check")) {
				$insert_filed .= "`html_check`,";		$insert_value .= "'$html_check',";
			}
			if($menu_width = _formdata("menu_width")) {
				$insert_filed .= "`menu_width`,";		$insert_value .= "'$menu_width',";
			}
			if($menu_align = _formdata("menu_align")) {
				$insert_filed .= "`menu_align`,";		$insert_value .= "'$menu_align',";
			}
			if($menu_css = _formdata("menu_css")) {
				$insert_filed .= "`menu_css`,";		$insert_value .= "'$menu_acss',";
			}
			if($html = _formdata("html")) {
				$insert_filed .= "`html`,";		$insert_value .= "'{html}',";
			}


			$insert_filed .= "`domain`,";	$insert_value .= "'".$site_env_rows->domain."',";
			$insert_filed .= "`host_id`,";	$insert_value .= "'".$sales_db->Id."',";

			$query = "INSERT INTO `site_menu_setting` ($insert_filed) VALUES ($insert_value)";
			$query = str_replace(",)",")",$query);
			//echo $query."<br>";
			_sales_query($query);

			echo "신규입력 <br>";

			

			///

		} 


		// menu : 스킨파일 생성
		$dir = "./users/".$sales_db->Id."/theme";
		if(_is_path($dir)){
			if($html_check) {
				// html 선택시, 입력한 html 기간으로 테마파일 생성
				$menu_body = $html;
			} else {
				// 기본 설정만으로 테마 생성
				$menu_body = "<div ";
				if($menu_align) $menu_body .= "align=\"".$menu_align."\" ";
				if($menu_width) $menu_body .= "width=\"".$menu_width."\" ";
				if($menu_height) $menu_body .= "height=\"".$menu_height."\" ";
				if($menu_css) $menu_body .= "style=\"".$menu_css."\" ";
				$menu_body .= ">";
				$menu_body .= "{menu}";
				$menu_body .= "</div>";
			}
			
			_file_save($dir."/menu_".$code.".html",$menu_body);
		}

		// 테파마일 생성 및 curl 전송
		// Curl 방식으로, 로고파일 업로드
		/*
		if($site_env->domain){
			$curl_path = "http://".$site_env->domain."/curl_filecopy.php";
			echo $curl_path."<br>";
			$target_url = $curl_path;

			// $file = "./upload/index_title-$uid.".$files[ext];
			$file = $dir."/menu_".$code.".html";
			echo $file."<br>";

			$path = "./theme";//로고 파일 경로
			echo _curl_filecopy($curl_path,$path,$file);

			// 임시 업로드 파일 삭제
			_file_delete($file);
		} 
		*/




		echo "<script>
				$.ajax({
            		url:'/ajax_site_menu_setting.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#site_list').html(data);
            		}
        		});
    			</script>";

    			
		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}




	
?>