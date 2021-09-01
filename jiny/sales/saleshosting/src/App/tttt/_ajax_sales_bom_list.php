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

    	$mode = _formmode();
    	$bom = _formdata("bom");


    	//echo "mode = $mode <br>";
    	///////////////////////////////////////
		//# 선택 전표 삭제
		if($mode == "delete"){
			$TID = $_POST['TID'];
    		for($i=0;$i<count($TID);$i++){
    			
    			$query = "select * from `sales_goods_bom` where Id = '$TID[$i]'";
				if($rows = _sales_query_rows($query)){
    					
   				// 삭제 쿼리 전송
    				$query1 = "DELETE FROM `sales_goods_bom` WHERE `Id`='$TID[$i]'";
					_sales_query($query1);
				}
    		}
		} 


    	$query = "select * from sales_goods_bom where bom = '$bom'"; //판매 전표출력
		if($rowss = _sales_query_rowss($query)){

			for($i=0;$i<count($rowss);$i++){
				$rows = $rowss[$i];

				$trans_tid = "<input type='checkbox' name='TID[]' value='".$rows->Id."'>";

				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0' style='border-right:1px solid #D2D2D2;border-bottom:1px solid #D2D2D2;border-left:1px solid #D2D2D2'>
				<tr>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:2px;' width=\"20\"> $trans_tid</td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"50\"> 부품명 :</td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:10px;' > ".$rows->goodname." </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"100\"> 필요수량 : </td>
					<td style='border-right:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"100\"> ".$rows->num."  </td>
				</tr>
				</table>";
			}
			echo $javascript.$list;	

		} else {
			echo "조합 부품목록이 없습니다.";
		}

		
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>