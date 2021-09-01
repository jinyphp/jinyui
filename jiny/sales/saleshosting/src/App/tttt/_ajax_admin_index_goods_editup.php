<?

	@session_start();
	
	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/file.php";
	include "./func/form.php";
	include "./func/skin.php";
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
		//include "./sales.php";

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
		$query = "select * from `site_env` where Id = $eid";
		if($site_env_rows = _mysqli_query_rows($query)){
			$body = str_replace("{domain}",$site_env_rows->domain,$body);
		} else $body = str_replace("{domain}","도메인 환경 설정을 읽어 올 수 없습니다.",$body);


		if($mode=="edit"){

			$query = "select * from `site_index_goods` WHERE Id =$uid";
			echo $query."<br>";
			if($rows = _mysqli_query_rows($query)){
				
				// 수정모드
				
				$query = "UPDATE `site_index_goods` SET ";
				if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";
				if($code = _formdata("code")) $query .= "`code`='$code' ,"; else $query .= "`code`='' ,";

				if($cate = _formdata("cate")) $query .= "`cate`='$cate' ,"; else $query .= "`cate`='' ,";
				if($domain = _formdata("domain")) $query .= "`domain`='$domain' ,"; else $query .= "`domain`='' ,";
				if($sort = _formdata("sort")) $query .= "`sort`='$sort' ,"; else $query .= "`sort`='' ,";

				if($width = _formdata("width")) $query .= "`width`='$width' ,"; else $query .= "`width`='' ,";
				if($align = _formdata("align")) $query .= "`align`='$align' ,"; else $query .= "`align`='' ,";
				if($bgcolor = _formdata("bgcolor")) $query .= "`bgcolor`='$bgcolor' ,"; else $query .= "`bgcolor`='' ,";
			
				if($cate_rows = _formdata("cate_rows")) $query .= "`rows`='$cate_rows' ,"; else $query .= "`rows`='' ,";
				if($cate_cols = _formdata("cate_cols")) $query .= "`cols`='$cate_cols' ,"; else $query .= "`cols`='' ,";
				if($cate_type = _formdata("cate_type")) $query .= "`type`='$cate_type' ,"; else $query .= "`type`='' ,";

				/*
				$mydir="./users"; _mkdir($mydir);
				$mydir .= "/".$site_env_rows->Id; _mkdir($mydir);
				$mydir .= "/images"; _mkdir($mydir);
				if($files = _form_uploadfile("title_images","$mydir/cate_title-".$sales_db->Id."-$uid")) 
					$query .= "`title_images`='"."./images/cate_title-".$sales_db->Id."-$uid.".$files[ext]."' ,";
				*/
				// 수정모드
				$mydir="./users"; _mkdir($mydir);
				$mydir .= "/".$sales_db->Id; _mkdir($mydir);
				$mydir .= "/images"; _mkdir($mydir);
				$files = _form_uploadfile("userfile1","$mydir/cate_title-".$sales_db->Id."-$uid");
				if($files) {
					$query .= "`title_images`='/images/"."cate_title-".$sales_db->Id."-$uid.".$files[ext]."',";
				}
				


				if($cate_images_check = _formdata("cate_images_check")) $query .= "`title_images_check`='on' ,"; else $query .= "`title_images_check`='' ,"; 

				if($check_memprices = _formdata("check_memprices")) $query .= "`check_memprices`='on' ,"; else $query .= "`check_memprices`='' ,"; 
				if($check_prices = _formdata("check_prices")) $query .= "`check_prices`='on' ,"; else $query .= "`check_prices`='' ,";
				if($check_usd = _formdata("check_usd")) $query .= "`check_usd`='$check_usd' ,"; else $query .= "`check_usd`='' ,";
				if($check_goodname = _formdata("check_goodname")) $query .= "`check_goodname`='$check_goodname' ,"; else $query .= "`check_goodname`='' ,";
				if($check_subtitle = _formdata("check_subtitle")) $query .= "`check_subtitle`='$check_subtitle' ,"; else $query .= "`check_subtitle`='' ,";
				if($check_spec = _formdata("check_spec")) $query .= "`check_spec`='$check_spec' ,"; else $query .= "`check_spec`='' ,";
				if($check_images = _formdata("check_images")) $query .= "`check_images`='$check_images' ,"; else $query .= "`check_images`='' ,";
				
				if($cate_html = _formdata("cate_html")) $query .= "`html`='".addslashes($cate_html)."' ,";

				if($cate_html_apply = _formdata("cate_html_apply")) $query .= "`html_apply`='$cate_html_apply' ,"; else $query .= "`html_apply`='' ,";

				$query .= "`domain`='".$site_env_rows->domain."' ,";

				$query .= "`host_id`='".$sales_db->Id."' ,";
				


				$query .= "WHERE Id =$uid";
				$query = str_replace(",WHERE","where ",$query);
				echo $query;
				_mysqli_query($query);


			}

			echo "사이트 정보가 갱신되었습니다.";	



		} else if($mode=="new"){


				// 신규모드
				$insert_filed = "";
				$insert_value = "";

				if($enable = _formdata("enable")) {
					$insert_filed .= "`enable`,";
					$insert_value .= "'on',";
				}
				
				if($code = _formdata("code")) {
					$insert_filed .= "`code`,";
					$insert_value .= "'$code',";
				}

				if($cate = _formdata("cate")) {
					$insert_filed .= "`cate`,";
					$insert_value .= "'$cate',";
				}

				if($sort = _formdata("sort")) {
					$insert_filed .= "`sort`,";
					$insert_value .= "'$sort',";
				}

				if($domain = _formdata("domain")) {
					$insert_filed .= "`domain`,";
					$insert_value .= "'$domain',";
				}

				if($width = _formdata("width")) {
					$insert_filed .= "`width`,";
					$insert_value .= "'$width',";
				}

				if($align = _formdata("align")) {
					$insert_filed .= "`align`,";
					$insert_value .= "'$align',";
				}

				if($bgcolor = _formdata("bgcolor")) {
					$insert_filed .= "`bgcolor`,";
					$insert_value .= "'$bgcolor',";
				}

				if($cate_rows = _formdata("cate_rows")) {
					$insert_filed .= "`rows`,";
					$insert_value .= "'$cate_rows',";
				}

				if($cate_cols = _formdata("cate_cols")) {
					$insert_filed .= "`cols`,";
					$insert_value .= "'$cate_cols',";
				}

				if($cate_rows = _formdata("cate_rows")) {
					$insert_filed .= "`rows`,";
					$insert_value .= "'$cate_rows',";
				}

				if($img_size = _formdata("img_size")) {
					$insert_filed .= "`img_size`,";
					$insert_value .= "'$img_size',";
				}

				/*
				$mydir="./users"; _mkdir($mydir);
				$mydir .= "/".$site_env_rows->Id; _mkdir($mydir);
				$mydir .= "/images"; _mkdir($mydir);
				if($files = _form_uploadfile("userfile1","$mydir/cate_title-".$sales_db->Id)){
					$insert_filed .= "`title_images`,";
					$insert_value .= "'./images/"."cate_title-".$sales_db->Id.".".$files[ext]."',";
				}
				*/
				$query = "select * from `site_index_goods` order by Id desc";
				if($rows = _mysqli_query_rows($query)) $max_id = $rows->Id + 1;

				$mydir="./users"; _mkdir($mydir);
				$mydir .= "/".$sales_db->Id; _mkdir($mydir);
				$mydir .= "/images"; _mkdir($mydir);
				$files = _form_uploadfile("userfile1","$mydir/cate_title-".$sales_db->Id."-$max_id");
				
				$insert_filed .= "`title_images`,";
				$insert_value .= "'/images/"."cate_title-".$sales_db->Id."-$max_id.".$files[ext]."',";
				


				if($title_images_check = _formdata("title_images_check")) {
					$insert_filed .= "`title_images_check`,";
					$insert_value .= "'on',";
				}


				if($check_memprices = _formdata("check_memprices")) {
					$insert_filed .= "`check_memprices`,";
					$insert_value .= "'on',";
				}

				if($check_prices = _formdata("check_prices")) {
					$insert_filed .= "`check_prices`,";
					$insert_value .= "'on',";
				}

				if($check_usd = _formdata("check_usd")) {
					$insert_filed .= "`check_usd`,";
					$insert_value .= "'on',";
				}

				if($check_goodname = _formdata("check_goodname")) {
					$insert_filed .= "`check_goodname`,";
					$insert_value .= "'$check_goodname',";
				}

				if($check_subtitle = _formdata("check_subtitle")) {
					$insert_filed .= "`check_subtitle`,";
					$insert_value .= "'$check_subtitle',";
				}

				if($check_spec = _formdata("check_spec")) {
					$insert_filed .= "`check_spec`,";
					$insert_value .= "'$check_spec',";
				}

				if($check_images = _formdata("check_images")) {
					$insert_filed .= "`check_images`,";
					$insert_value .= "'$check_images',";
				}

				if($cate_html = _formdata("cate_html")) {
					$insert_filed .= "`html`,";
					$insert_value .= "'".addslashes($cate_html)."',";
				}

				if($cate_html_apply = _formdata("cate_html_apply")) {
					$insert_filed .= "`html_apply`,";
					$insert_value .= "'$cate_html_apply',";
				}

				$insert_filed .= "`domain`,";
				$insert_value .= "'".$site_env_rows->domain."',";

				
				$insert_filed .= "`host_id`,";
				$insert_value .= "'".$sales_db->Id."',";

				
				echo "사이트 정보가 추가되었습니다.";
				$query = "INSERT INTO `site_index_goods` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				_mysqli_query($query);



		} else if($mode == "delete"){
			$query = "DELETE FROM `site_index_goods` WHERE `Id`='$uid'";
				// echo $query."<br>";
			_mysqli_query($query);

			echo "사이트 정보 삭제";
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
		$error_message = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		echo $error_message;
	}

	
?>