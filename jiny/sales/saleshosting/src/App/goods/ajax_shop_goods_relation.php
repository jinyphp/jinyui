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

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/error.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/goods.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/members.php");


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$javascript = "<script>
    	</script>"; 

    	// $body = $javascript._skin_page($skin_name,"shop_goods_relation");

    	$mode = _formmode();
    	$uid = _formdata("uid");

    	$relation = _formdata("relation_goods");
    	//echo "relation = $relation <br>";

    	$rows = explode(";",$relation);
    	//echo "count = ".count($rows)."<br>";
    	for($i=0;$i<count($rows)-1;$i++){
    		$tid = "<input type='checkbox' name='TID[]' value='".$rows[$i]."'>";
    		echo $rows[$i]."/";

    		$query = "select * from `shop_goods` WHERE `Id`='$rows[$i]'";
			if($rows1 = _sales_query_rows($query)){	
				
				// $rows1 = _goods_rows($rows[$i]);
				$goodname = _goods_name($rows1,$site_language);

				$list .= "<table border='0' cellpadding='5' cellspacing='5' width='100%'>";
				$list .= "<tr><td width='20'>$tid</td>";
				$list .= "<td width=\"100\"><img src=\"http://".$sales_db->domain.$rows1->images1."\" border='0' width='100'></td>";						
				$list .= "<td>$goodname  </td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> 
								<a href='#' onclick=\"javascript:relation_remove('".$rows[$i]."')\">제거</a></td>";
				$list .= "</tr></table>";		

				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' bgcolor='#e4e4e3' height='1'><tr><td></td></tr></table>";	


			}

			
    	}

    	echo $list;

	} else {
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
		echo "Error! can't display relation goods.";
	}

	
?>