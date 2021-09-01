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

	include "./func/datetime.php";
	include "./func/goods.php";
	include "./func/orders.php";
	include "./func/butten.php";
	include "./func/css.php";

	include "./func/error.php";

	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		include "./sales.php";

		echo "cate setup <br>";
		
		// 선택한 다수의 카테고리를 체크
		if($_POST['cate'] ) foreach ($_POST['cate'] as $value){ $cate_select .= "$value;"; }
		echo $cate_select;

		// Master 카테
		if($_POST['master_cate'] ) foreach ($_POST['master_cate'] as $value){ $master_cate_select .= "$value;"; }
		$_POST['master_cate'] = $master_cate_select;


		echo "TID = ";
		if($TID = $_POST['TID']){
			for($i=0,$amount=0;$i<count($TID);$i++){
    			echo $TID[$i]."/ ";
    			$query = "UPDATE `shop_goods` SET `cate`='$cate_select',`master_cate`='$master_cate_select' where Id='".$TID[$i]."'";
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
