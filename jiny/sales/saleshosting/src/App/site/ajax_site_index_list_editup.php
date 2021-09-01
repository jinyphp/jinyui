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


	if(isset($_SESSION['language'])){
		$site_language = $_SESSION['language'];
	} else {
		$site_language = "ko";
	}

	// 장바구니 섹션 존재 유무를 검사.
	if(isset($_SESSION['cartlog'])){
		$cartlog = $_SESSION['cartlog'];
	} else {
		$cartlog = md5('cartlog'.$TODAYTIME.microtime()); 
		$_SESSION['cartlog'] = $cartlog;			
	}

	if(isset($_COOKIE['cookie_email'])){
		$cookie_email = $_COOKIE['cookie_email'];
	} else {
		$cookie_email = "";
	}



	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

    	function _form_uploadfile($formname,$filename){
    		if($_FILES[$formname]['tmp_name']){
    			// 파일 확장자 검사
    			
    			$ext = substr($_FILES[$formname]['name'], strrpos($_FILES[$formname]['name'], '.') + 1); 
    			if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit;
    			else {
    				if($filename == ""){
    					// 지정한 파일명이 없는경우, 올려진 파일명 원본으로 이름을 지정
    					move_uploaded_file($_FILES[$formname]['tmp_name'], $_FILES[$formname]['name']);
    				} else {
    					
    					move_uploaded_file($_FILES[$formname]['tmp_name'], $filename.".".$ext);
    				}
    				$files['filename'] = $filename;
    				$files['name'] = $_FILES[$formname]['name'];
    				$files['ext'] = $ext;
    				return $files;
    			}  
				
    		} else return NULL;
		}


		$mode = _formmode();
		echo "mode is $mode <br>";
		$uid = _formdata("uid");
		echo "uid is $uid <br>";
		$ajaxkey = _formdata("ajaxkey");

		$eid = _formdata("eid");
		echo "eid is $eid <br>";
		$query = "select * from `site_env` where Id = $eid";
		echo $query."<br>";
		if($site_env_rows = _sales_query_rows($query)){
			$body = str_replace("{domain}",$site_env_rows->domain,$body);
		} else $body = str_replace("{domain}","도메인 환경 설정을 읽어 올 수 없습니다.",$body);



		if($mode == "delete"){
			$query = "DELETE FROM `site_index` WHERE `eid`='$eid'";
			_sales_query($query);

			$query = "DELETE FROM `site_skin_html` WHERE `eid`='$eid'";
			_sales_query($query);
			echo "index 정보 삭제";
		} else {

			$query1 = "select * from `site_language`";
			if($rowss1 = _sales_query_rowss($query1)){

				for($i=0;$i<count($rowss1);$i++){
					$rows1 = $rowss1[$i];


					$query = "select * from `site_skin_html` where `code`='index' and `eid`='$eid' and `language`='".$rows1->code."' and `mobile`='pc'";
					if(_sales_query_rows($query)){
						$desktop_html =  addslashes( _formdata($rows1->code) );
						$query1 ="UPDATE `site_skin_html` SET `html`='$desktop_html', `domain`='".$site_env_rows->domain."' where `code`='index' and `eid`='$eid' and `language`='".$rows1->code."' and `mobile`='pc' ";
		    			_sales_query($query1);
		    			echo $query1."<br>";
					} else {
						$desktop_html =  addslashes( _formdata($rows1->code) );	
		    			$query1 = "INSERT INTO `site_skin_html` (`domain`,`eid`,`code`,`language`,`mobile`,`html`) 
		    						VALUES ('".$site_env_rows->domain."','$eid','index','".$rows1->code."','pc','$desktop_html')";
		    			_sales_query($query1);
		    			echo $query1."<br>";
					}	


					$query = "select * from `site_skin_html` where `code`='index' and `eid`='$eid' and `language`='".$rows1->code."' and `mobile`='m'";
					if(_sales_query_rows($query)){
						$mobile_html =  addslashes( _formdata($rows1->code."_m") );
		    			$query1 ="UPDATE `site_skin_html` SET `html`='$mobile_html', `domain`='".$site_env_rows->domain."' where `code`='index' and `eid`='$eid' and `language`='".$rows1->code."' and `mobile`='m' ";
		    			_sales_query($query1);
		    			echo $query1."<br>";
					} else {
						$mobile_html =  addslashes( _formdata($rows1->code."_m") );
		    			$query1 = "INSERT INTO `site_skin_html` (`domain`,`eid`,`code`,`language`,`mobile`,`html`) 
		    						VALUES ('".$site_env_rows->domain."','$eid','index','".$rows1->code."','m','$mobile_html')";
		    			_sales_query($query1);
		    			echo $query1."<br>";
					}	

		    		
		
				}

				echo "초기 페이지가 저장되었습니다.";

			} else {
				echo "저장할 언어셋이 없습니다.";
			}

		}



		




		/*
		echo "<script>
				$.ajax({
            		url:'/ajax_site_index.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#site_list').html(data);
            		}
        		});
    			</script>";
		*/

    		

	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}

	
?>