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

	include ($_SERVER['DOCUMENT_ROOT']."/func/curl.php");



	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
			
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

    	$mode = _formmode();
    	$gid = _formdata("gid");
		$images = _formdata("images");
		
		if($mode == "remove"){
			$query = "select * from shop_goods WHERE `Id` = '$gid'";
			if($rows = _sales_query_rows($query)){

				$query = "UPDATE `shop_goods` SET `images$images`='' WHERE `Id`=".$gid;
				_sales_query($query);

				$images_body .="<div id=\"images$images\">
					<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
						<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\" width=\"100\" rowspan=\"2\" valign=\"top\"> 
							이미지".$images."
						</td>
						<td style=\"font-size:12px;padding:10px;\" valign=\"top\">"._form_file("userfile".$images,$css)."</td>
					</tr>
					<tr>
						<td style=\"border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;\" valign=\"top\"> </td>
					</tr>
					</table>
					</div>";
				echo _curl_post("http://".$sales_db->domain."/curl_file.php","mode=remove&file=".$rows->files);	

			}
		}

		echo $images_body;

	} else {
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
		echo "Error! can't display files ...";
	}

	
?>