<?
	@session_start();

	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/string.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/javascript.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/mobile.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/language.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/country.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/site.php");	// 사이트 환경 설정
		
	include ($_SERVER['DOCUMENT_ROOT']."/func/layout.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/header.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/footer.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/menu.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/category.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/skin.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/butten.php");
	
	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/goods.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/curl.php");

	$javascript = "<script>
		function popup_submit(){
			// 카테고리 설정 처리 
			var url = \"ajax_shop_goods_cate_setup.php\";
			$.ajax({
           		url:url,
           		type:'post',
	           	data:$('form').serialize(),
	           	success:function(data){
               		// $('#popup_body').html(data);
           		}
          	});

			popup_close();	// 팝업창 종료
			
			var url = \"ajax_shop_goods.php\";
            ajax_html('#mainbody',url); // 갱신	
		}

        // 팝업창 닫기
    	$('#popup_close').on('click',function(){
        	popup_close();
    	});    		 

    </script>";


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...

		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");


		

        // 팝업창
        function _popup_div($title,$width){
        	$title_width = $width - 42;

        	$popup_header  = _html_div("popup_title","float:left;width:".$title_width."px; height:30px;display:table-cell;vertical-align:middle;padding:5px;",$title);
        	$popup_header .= _html_div("popup_close","width:30px;text-align:center; height:30px;display:table-cell;vertical-align:middle;","X");

        	$width = $width -2;
			return _html_div_clearfix($popup_header,"width:".$width."px;border-bottom:1px solid #E9E9E9;");
        }


        if($site_mobile == "m") $width = "300"; else $width = "800"; 

        $title = "Quick 카테고리 설정 ";
		$body = $javascript
				._html_div("popup","border:1px solid #5f5f5f;width:".$width."px",
					_popup_div($title,$width).
					_theme_page($site_env->theme,"shop_goods_cate_set",$site_language,$site_mobile));
		
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$category = _formdata("category");
		$body = str_replace("{formstart}","<form name='popup' method='post' enctype='multipart/form-data'>
								<input type='hidden' name='limit' value='$limit'>
								<input type='hidden' name='searchkey' value='$search'>
								<input type='hidden' name='category' value='$category'>	
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		
		// 상품 기본 카테고리
			function _shop_category_select($goods,$site_language){
				global $site_mobile;

				if($site_mobile == "m"){
					$css_multiselect = "width:100%; height:50px; font-size:12px; border:1px solid #d8d8d8;";
				} else {
					$css_multiselect = "width:100%; height:400px; font-size:12px; border:1px solid #d8d8d8;";
				}

				


				$query = "select * from `shop_cate` ";
				// $query .= "where code = 'default' ";
				$query .= "order by pos desc";	
				if($rowss = _sales_query_rowss($query)){

					$check = explode(";",$goods->cate);
					$cate = "<select multiple name='cate_set[]' size='30' style='$css_multiselect'>";
					
					for($i=0;$i<count($rowss);$i++){
						
						$rows= $rowss[$i];
						$cate .= "<option value='".$rows->Id."' ";
					
						for($k=0;$k<count($check); $k++){
							if($check[$k] == $rows->Id) $cate .= "selected";
						}
				
						$title = stripslashes($rows->title);
						$title_name = json_decode($title);

						for($j=0,$space="";$j<$rows->level;$j++) $space .= "&nbsp;&nbsp;└"; 

						$cate .= ">$space".$title_name->$site_language."</option>";

					}
					$cate .= "</select>";	
					
				}
				
				return $cate;
			} 

			$body = str_replace("{cate}",_shop_category_select($goods,$site_language),$body);

			// 마스터 카테고리 출력
			$master_cate = _curl_post("http://www.saleshosting.co.kr/service_goods_cate.php",$goods->master_cate);
			$body = str_replace("{main_cate}",$master_cate,$body);


		if($TID = $_POST['TID']){
			for($i=0,$amount=0;$i<count($TID);$i++){
    			// echo $TID[$i]."/ ";
				echo "<input type='hidden' name='TID[]' value='".$TID[$i]."'>";
			}
		}

		
		$body = str_replace("{form_submit}","
				<input type='button' value='저장' onclick=\"javascript:popup_submit()\" style=\"".$css_btn_gray."\" >
				",$body);		

		echo $body;
	
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	


	
?>
