<?
	@session_start();

	include "./conf/dbinfo.php";
	include "./func/mysql.php";

	include "./func/datetime.php";
	include "./func/file.php";
	include "./func/form.php";
	include "./func/string.php";
	include "./func/javascript.php";
	
	include "./func/mobile.php";
	include "./func/language.php";
	include "./func/country.php";

	include "./func/site.php";	// 사이트 환경 설정

	include "./func/layout.php";
	include "./func/header.php";
	include "./func/footer.php";
	include "./func/menu.php";
	include "./func/category.php";
	include "./func/skin.php";

	include "./func/error.php";

	include "./func/goods.php";
	include "./func/members.php";

	include "./func/curl.php";


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$cookie_email = _cookie_email();
		$members = _members_rows($cookie_email);

		$mode = _formmode();	// echo "mode = ".$mode;

		$uid = _formdata("uid");		
		$limit = _formdata("limit");
		$search = _formdata("searchkey");
		$category = _formdata("category");
		$_enable = _formdata("_enable");
		$lis_tnum = _formdata("lis_tnum");
		$_soldout = _formdata("_soldout");
		
		echo "category = $category <br>";

		if($mode == "enable"){
			// 상품 판매 활성화
			$query = "UPDATE `shop_goods` SET `enable`='on' WHERE `Id`=$uid";
			_sales_query($query);
			$url = "ajax_shop_goods.php?limit=$limit&ajaxkey=$ajaxkey";    		
			echo "<script> ajax_html('#mainbody','".$url."'); </script>";

		} else if($mode == "disable"){
			// 상품 판매 비활성화
			$query = "UPDATE `shop_goods` SET `enable`='' WHERE `Id`=$uid";
			_sales_query($query);
			$url = "ajax_shop_goods.php?limit=$limit&ajaxkey=$ajaxkey";    		
			echo "<script> ajax_html('#mainbody','".$url."'); </script>";

		} else if($uid && $mode == "edit"){
			$_POST['mode'] = $mode; // GET 으로 넘겨옴 mode 값을, post 값으로 재정장

			// 상품 정보 수정 
			$query = "select * from `shop_goods` where Id='$uid'";
			if($rows = _sales_query_rows($query)){				

				// 파일 업로드
				$path = substr($rows->regdate,0,10);
				$path = explode("-",$path);
				_is_path("./goods/Y".$path[0]."/M".$path[1]."/D".$path[2]."/goods_".$rows->Id);
				$dir = "./goods/Y".$path[0]."/M".$path[1]."/D".$path[2]."/goods_".$rows->Id;

				// 이미지 파일1, 서버로 업로드 
			
				if($files = _html_form_uploadfile("userfile1",$dir."/images1-".$uid)) {
					$query .= "`images1`='".$dir."/images1-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images1-".$uid.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images1'] = '@'.$file_name_with_full_path;
				}

				if($files = _html_form_uploadfile("userfile2",$dir."/images2-".$uid)) {
					$query .= "`images2`='".$dir."/images2-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images2-".$uid.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images2'] = '@'.$file_name_with_full_path;
				}

				if($files = _html_form_uploadfile("userfile3",$dir."/images3-".$uid)) {
					$query .= "`images3`='".$dir."/images3-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images3-".$uid.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images3'] = '@'.$file_name_with_full_path;
				}

				if($files = _html_form_uploadfile("userfile4",$dir."/images4-".$uid)) {
					$query .= "`images4`='".$dir."/images4-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images4-".$uid.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images4'] = '@'.$file_name_with_full_path;
				}

				if($files = _html_form_uploadfile("userfile5",$dir."/images5-".$uid)) {
					$query .= "`images5`='".$dir."/images5-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images5-".$uid.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images5'] = '@'.$file_name_with_full_path;
				}

				if($files = _html_form_uploadfile("userfile6",$dir."/images6-".$uid)) {
					$query .= "`images6`='".$dir."/images6-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images6-".$uid.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images6'] = '@'.$file_name_with_full_path;
				}
				if($files = _html_form_uploadfile("userfile7",$dir."/images7-".$uid)) {
					$query .= "`images7`='".$dir."/images7-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images7-".$uid.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images7'] = '@'.$file_name_with_full_path;
				}
				if($files = _html_form_uploadfile("userfile8",$dir."/images8-".$uid)) {
					$query .= "`images8`='".$dir."/images8-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images8-".$uid.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images8'] = '@'.$file_name_with_full_path;
				}
				if($files = _html_form_uploadfile("userfile9",$dir."/images9-".$uid)) {
					$query .= "`images9`='".$dir."/images9-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images9-".$uid.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images9'] = '@'.$file_name_with_full_path;
				}

	



			}

			// 선택한 다수의 카테고리를 체크
			if($_POST['cate'] ) foreach ($_POST['cate'] as $value){ $cate_select .= "$value;"; }
			$_POST['cate'] = $cate_select;

			// Master 카테
			if($_POST['master_cate'] ) foreach ($_POST['master_cate'] as $value){ $master_cate_select .= "$value;"; }
			$_POST['master_cate'] = $master_cate_select;

			if($_POST['sales_country'] ) foreach ($_POST['sales_country'] as $value){ $sales_country_select .= "$value;"; }
			$_POST['sales_country'] = $sales_country_select;

			////
			$_POST['adminkey'] = $sales_db->adminkey;
			echo _curl_post("http://".$sales_db->domain."/curl_goods_editup.php",$_POST);


			$url = "shop_goods.php?limit=$limit&searchkey=$search&category=$category&_enable=$_enable&_soldout=$_soldout";    		
			echo "<script> location.replace('$url'); </script>";
			
		} else if($mode == "new"){


			$query = "select * from `shop_goods` order by Id desc";
			if($goods_rows = _sales_query_rows($query)){
				$max_id = $goods_rows->Id +1;

				$_POST['mode'] = $mode; // GET 으로 넘겨옴 mode 값을, post 값으로 재정장
				
				// 파일 업로드 경로
				$YEAR = date("Y",time());
    			$MONTH = date("m",time());
    			$DAY = date("d",time());
				$dir = "./goods/Y".$YEAR."/M".$MONTH."/D".$DAY."/goods_".$max_id;
				echo "goods path is $dir <br>";
				_is_path($dir);				

				// 이미지 파일1, 서버로 업로드
				// 임시 폴더로 업로드 후, curl로 고객 서버에 전송	
				if($files = _html_form_uploadfile("userfile1",$dir."/images1-".$max_id)) {
					//$query .= "`images1`='".$dir."/images1-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images1-".$max_id.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images1'] = '@'.$file_name_with_full_path;
				}

				if($files = _html_form_uploadfile("userfile2",$dir."/images2-".$max_id)) {
					//$query .= "`images2`='".$dir."/images2-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images2-".$max_id.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images2'] = '@'.$file_name_with_full_path;
				}

				if($files = _html_form_uploadfile("userfile3",$dir."/images3-".$max_id)) {
					//$query .= "`images3`='".$dir."/images3-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images3-".$max_id.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images3'] = '@'.$file_name_with_full_path;
				}

				if($files = _html_form_uploadfile("userfile4",$dir."/images4-".$max_id)) {
					//$query .= "`images3`='".$dir."/images3-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images4-".$max_id.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images4'] = '@'.$file_name_with_full_path;
				}

				if($files = _html_form_uploadfile("userfile5",$dir."/images5-".$max_id)) {
					//$query .= "`images3`='".$dir."/images3-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images5-".$max_id.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images5'] = '@'.$file_name_with_full_path;
				}

				if($files = _html_form_uploadfile("userfile6",$dir."/images6-".$max_id)) {
					//$query .= "`images3`='".$dir."/images3-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images6-".$max_id.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images6'] = '@'.$file_name_with_full_path;
				}

				if($files = _html_form_uploadfile("userfile7",$dir."/images7-".$max_id)) {
					//$query .= "`images3`='".$dir."/images3-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images7-".$max_id.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images7'] = '@'.$file_name_with_full_path;
				}

				if($files = _html_form_uploadfile("userfile8",$dir."/images8-".$max_id)) {
					//$query .= "`images3`='".$dir."/images3-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images8-".$max_id.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images8'] = '@'.$file_name_with_full_path;
				}

				if($files = _html_form_uploadfile("userfile9",$dir."/images9-".$max_id)) {
					//$query .= "`images3`='".$dir."/images3-".$uid.".".$files[ext]."' ,";
					$file_name_with_full_path = realpath($dir."/images9-".$max_id.".".$files[ext]); // 업로드한 실제 파일 경로
					$_POST['images9'] = '@'.$file_name_with_full_path;
				}
			

			}

			
			// 선택한 다수의 카테고리를 체크
			if($_POST['cate'] ) foreach ($_POST['cate'] as $value){ $cate_select .= "$value;"; }
			$_POST['cate'] = $cate_select;

			// Master 카테
			if($_POST['master_cate'] ) foreach ($_POST['master_cate'] as $value){ $master_cate_select .= "$value;"; }
			$_POST['master_cate'] = $master_cate_select;

			if($_POST['sales_country'] ) foreach ($_POST['sales_country'] as $value){ $sales_country_select .= "$value;"; }
			$_POST['sales_country'] = $sales_country_select;

			
			////
			$_POST['adminkey'] = $sales_db->adminkey;
			echo _curl_post("http://".$sales_db->domain."/curl_goods_editup.php",$_POST);

			_file_delete($dir."/images1-".$max_id);
			_file_delete($dir."/images2-".$max_id);
			_file_delete($dir."/images3-".$max_id);

			$url = "shop_goods.php?limit=$limit&searchkey=$search";    		
			echo "<script> location.replace('$url'); </script>";

		} else if($mode == "delete"){
			$query = "DELETE FROM `shop_goods` WHERE `Id`='$uid'";	// echo $query."<br>";
    		_sales_query($query);

    		$_POST['uid'] = $uid;
    		$_POST['mode'] = $mode; // GET 으로 넘겨옴 mode 값을, post 값으로 재정장
    		$_POST['adminkey'] = $sales_db->adminkey;
			echo _curl_post("http://".$sales_db->domain."/curl_goods_editup.php",$_POST);

			// 관련상품 연결부분 삭제

    		$url = "shop_goods.php?limit=$limit&searchkey=$search";    		
			echo "<script> location.replace('$url'); </script>";
		} 


		



		
	} else {
		include ($_SERVER['DOCUMENT_ROOT']."/site/ajax_error.php");	
	}




	
?>