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
	include "./func/butten.php";

	include "./func/css.php";


	/////////////



	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include "./sales.php";

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
				$list .= "<td width=\"100\"><img src='".$rows1->images1."' border='0' width='100'></td>";						
				$list .= "<td>$goodname  </td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> 
								<a href='#' onclick=\"javascript:relation_remove('".$rows[$i]."')\">제거</a></td>";
				$list .= "</tr></table>";					
				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' bgcolor='#e4e4e3' height='1'><tr><td></td></tr></table>";	


			}

			
    	}

    	echo $list;


    	//echo "mode = $mode <br>";
    	///////////////////////////////////////
		//# 선택 전표 삭제
		/*
		if($mode == "delete"){
			$TID = $_POST['TID'];
    		for($i=0;$i<count($TID);$i++){
    			
    			$query1 = "DELETE FROM `shop_goods_relation` WHERE `Id`='$TID[$i]'";
				_sales_query($query1);
    		}
		} 
		*/

		
		/*
    	$query = "select * from shop_goods_relation where GID = '$uid'"; 
    	//echo $query;
		if($rowss = _sales_query_rowss($query)){

			for($i=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];

				$tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";

				$rows1 = _goods_rows($rows->RID);
				$goodname = _goods_name($rows1,$site_language);

				$list .= "<table border='0' cellpadding='5' cellspacing='5' width='100%'>";
				$list .= "<tr><td width='20'>$tid</td>";
				$list .= "<td><img src='".$rows1->images1."' border='0' width='100'></td>";						
				$list .= "<td>$goodname</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> 
								<a href='#' onclick=\"javascript:relation_remove('".$rows->Id."')\">제거</a></td>";
				$list .= "</tr></table>";					
				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' bgcolor='#e4e4e3' height='1'><tr><td></td></tr></table>";	
			}
			//$body = str_replace("{relations}", $list, $body);
			echo $list;
		} else {
			$msg = "관련 상품이 없습니다.";
			// $body = str_replace("{relations}", $msg, $body);
			echo $msg;
		}
		*/
		
		// echo $body;
	} else {
		$body = _skin_page($skin_name,"error");
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>