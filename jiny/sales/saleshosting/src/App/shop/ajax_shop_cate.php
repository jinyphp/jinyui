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

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");

	// 카테고리에 대한 자바스크립트 함수 정의
	$javascript = "<script>
		function mode(mode,uid){
			var url = \"ajax_shop_cate_editup.php?uid=\"+uid+\"&mode=\"+mode;
			// alert(url);

			$.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            });
		}

        function edit(mode,uid){
        	var url = \"shop_cate_edit.php?uid=\"+uid+\"&mode=\"+mode;        	
        	location.replace(url);        	
        }


    </script>";

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$body = $javascript._theme_page($site_env->theme,"shop_cate",$site_language,$site_mobile);

		// 카테고리 리스트는 // ajax 형태로 처리함.               
		$_SESSION['ajaxkey'] = $ajaxkey = md5('ajaxkey'.$_SERVER['PHP_SELF'].$TODAYTIME.microtime()); 
		$body = str_replace("{formstart}","<form id=\"data\" name='cate' method='post' enctype='multipart/form-data' >
					   <input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$button ="<input type='button' value='추가' onclick=\"javascript:edit('new','0')\" id=\"css_btn_gray\">";          
		$body = str_replace("{new}",$button,$body);


		$mode = _formmode();
		$uid = _formdata("uid");
		$ajaxkey = _formdata("ajaxkey");

		$query = "select * from `shop_cate` order by pos desc";
		if($rowss = _sales_query_rowss($query)){	
			
			$list = "";
			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];

				for($LevelSpace="",$j=0;$j<$rows->level;$j++) $LevelSpace .= "-";
				$list .= "<table border='0' cellpadding='2' cellspacing='2' width='100%'><tr>";
				
				if($rows->enable) {
					$list .= "<td width='20'> <a href='#' onclick=\"javascript:mode('disable','".$rows->Id."')\">▣</a></td>";
				} else {
					$list .= "<td width='20'> <a href='#' onclick=\"javascript:mode('enable','".$rows->Id."')\">□</a></td>";
				}

				//*** 트리모양 만들기
				if($rows->level == 0) {
					$query1 = "select * from `shop_cate` where ref = '0' and pos > '".$rows->pos."'"; 
					if( _sales_query_rows($query1) ) $depth = "┣"; else $depth = "┗";
								
				} else {
					$query1 = "select * from `shop_cate` where ref = '0' and pos > '".$rows->pos."'"; 
					if( _sales_query_rows($query1) ) $depth = "┃"; else $depth = "&#4515;";

					for($k=0;$k<$rows->level;$k++) $depth .= "&#4515;";
						
					$query1 = "select * from `shop_cate` where ref = '".$rows->ref."' and pos > '".$rows->pos."'"; 
					if( _sales_query_rows($query1) ) $depth .= "┣"; else $depth .= "┗";
				}
			
				$list .= "<td> $depth <a href='#' onclick=\"javascript:edit('sub','".$rows->Id."')\"><i class=\"fa fa-plus-square-o\"></a> ";
				$list .= "<a href='#' onclick=\"javascript:mode('up','".$rows->Id."')\">▲</a>";
				$list .= "<a href='#' onclick=\"javascript:mode('down','".$rows->Id."')\">▼</a>";
				$list .= "<a href='#' onclick=\"javascript:edit('edit','".$rows->Id."')\" >".$rows->name."</a> ".$rows->url."</td>";

				$list .= "<td width='150' id=\"table_td\"> ".$rows->tree."</td>";
			
				$list .= "<td width='80' id=\"table_td\"> POS: ".$rows->pos."</td>";
				
				$list .= "</tr></table>";
				
			}
			$body = str_replace("{datalist}",$list,$body);
		

		} else {
			$msg = "카테고리가 없습니다.";
			$body = str_replace("{datalist}",$msg ,$body);
		}
			echo $body;	


		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}

	
?>