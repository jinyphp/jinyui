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



	$body = _theme_emptybody();
	if($code = _formdata("code")){
		$query = "select * from `site_pages` WHERE `title`='$code'";
		//echo $query."<br>";
		if($pages_rows = _mysqli_query_rows($query)){	
			$query = "select * from `site_pages_html` WHERE `pid`='".$pages_rows->Id."' and `language`='$site_language'";
			if($site_mobile == "m") $query .=" and `mobile`='m'";
			else $query .=" and `mobile`='pc'";
			//echo $query."<br>";

			if($rows = _mysqli_query_rows($query)){	

				$html = stripslashes($rows->html);

				$skin = "<table border='0' ";
				
				if($site_mobile == "m"){
					$skin .= "width='100%' ";
				} else {
					if($pages_rows->width) $skin .= "width='".$pages_rows->width."' ";
				}

				if($pages_rows->bgcolor) $skin .= "bgcolor='".$pages_rows->bgcolor."' ";
				$skin .= "cellspacing='0' cellpadding='0'><tr><td>";
				$skin .= $html;
				$skin .= "</td></tr></table>";

				if($pages_rows->align) $skin = "<div align='".$pages_rows->align."'> $skin </div";
				$body = str_replace("<!--{skin_emptybody}-->",$skin,$body);

				


			}
		} else {
			$body = str_replace("<!--{skin_emptybody}-->","<center>존재하지 않는 페이지 코드 입니다.</center>",$body);
		}

	} else {
		$body = str_replace("<!--{skin_emptybody}-->","페이지 코드가 없습니다..",$body);
	}

	echo $body;

?>