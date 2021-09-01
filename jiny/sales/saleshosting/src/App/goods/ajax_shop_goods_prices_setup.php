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

	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		echo "cate setup <br>";
		
		$buy_currency = _formdata("buy_currency");
		$b2b_currency = _formdata("b2b_currency");
		$sell_currency = _formdata("sell_currency");

		$prices_buy = _formdata("prices_buy");
		$prices_b2b = _formdata("prices_b2b");
		$prices_sell = _formdata("prices_sell");

		echo "TID = ";
		if($TID = $_POST['TID']){
			for($i=0,$amount=0;$i<count($TID);$i++){
    			echo $TID[$i]."/ ";
    			$query = "UPDATE `shop_goods` SET `buy_currency`='$buy_currency',`b2b_currency`='$b2b_currency',`sell_currency`='$sell_currency',
    			`prices_buy`='$prices_buy',`prices_b2b`='$prices_b2b',`prices_sell`='$prices_sell' where Id='".$TID[$i]."'";
    			_sales_query($query);
    			echo $query;
			}
		}
	
	} else {
		$msg = "오류! 잘못된 접근 방법으로 상품목록 페이지에 접근 되었습니다. 시스템 관리 담당자에게 연락 바랍니다.";
		$body_error = _error_page($skin_name,$msg);
		echo $body_error;
	}	


	
?>
