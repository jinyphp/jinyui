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


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include ($_SERVER['DOCUMENT_ROOT']."/conf/sales.php");

		$mode = _formmode();
		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$lis_tnum = _formdata("list_num");

		


		if($mode == "delete"){
			
    		$query = "DELETE FROM sales_recruit WHERE `Id`='$uid'";
    		_sales_query($query);
    	

		} else {

			$REF = $_GET['REF']; if(!$REF) $REF = $_POST['REF'];
    			
		
			$query = "select * from sales_recruit where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				// 수정 
				$query = "UPDATE sales_recruit SET ";
					
				if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
					
				$title = _formdata("title"); $query .= "`title`='$title' ,";
				$expire = _formdata("expire"); $query .= "`expire`='$expire' ,";				
				$content = _formdata("content"); $query .= "`content`='$content' ,";

				$email = $_COOKIE['cookie_email']; $query .= "`email`='$email' ,";
					
				$query .= "WHERE `Id`='$uid'";
				$query = str_replace(",WHERE","WHERE",$query);
				_sales_query($query);

			} else {
				// 삽입 				
				$insert_filed .= "`regdate`,";
				$insert_value .= "'$TODAYTIME',";

				if($enable = _formdata("enable")){
					$insert_filed .= "`enable`,";
					$insert_value .= "'on',";
				}

				if($title = _formdata("title")){
					$insert_filed .= "`title`,";
					$insert_value .= "'$title',";
				}	

				if($expire = _formdata("expire")){
					$insert_filed .= "`expire`,";
					$insert_value .= "'$expire',";
				}				

				if($content = _formdata("content")){
					$insert_filed .= "`content`,";
					$insert_value .= "'$content',";
				}

				if($email = $_COOKIE['cookie_email']){
					$insert_filed .= "`email`,";
					$insert_value .= "'$email',";
				}					

				$query = "INSERT INTO sales_recruit ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);

				_sales_query($query);
				
			}	

			

		}

		$url = "sales_recruit.php"."?limit=$limit&searchkey=$search&list_num=".$list_num;    		
		echo "<script> location.replace('$url'); </script>";

		
	} else {
		$body = _theme_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}


	
?>

