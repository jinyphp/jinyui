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

	include "./func/error.php";


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
		$uid = _formdata("uid");
		$ajaxkey = _formdata("ajaxkey");
		if($mode == "enable"){
			$query = "UPDATE `shop_bank` SET `enable`='on' WHERE Id =$uid";
			_sales_query($query);

		} else if($mode == "disable"){
			$query = "UPDATE `shop_bank` SET `enable`='' WHERE Id =$uid";
			_sales_query($query);

		} else if($mode=="edit"){

			$query = "select * from `shop_bank` WHERE Id =$uid";
			if($rows = _sales_query_rows($query)){
				// 수정모드
				$query = "UPDATE `shop_bank` SET ";

				if($enable = _formdata("enable")) $query .= "`enable`='on' ,"; else $query .= "`enable`='' ,";

				if($country = _formdata("country")) $query .= "`country`='$country' ,";

				if($bank_name = _formdata("bank_name")) $query .= "`bankname`='$bank_name' ,";
				if($bank_user = _formdata("bank_user")) $query .= "`bankuser`='$bank_user' ,";
				if($bank_account = _formdata("bank_account")) $query .= "`banknum`='$bank_account' ,";
				if($bank_swiff = _formdata("bank_swiff")) $query .= "`swiff`='$bank_swiff' ,";

				$query .= "WHERE Id =$uid";
				$query = str_replace(",WHERE","where ",$query);
				// echo $query;
				_sales_query($query);

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

				if($country = _formdata("country")) {
					$insert_filed .= "`country`,";
					$insert_value .= "'$country',";
				}

				if($bank_name = _formdata("bank_name")) {
					$insert_filed .= "`bankname`,";
					$insert_value .= "'$bank_name',";
				}

				if($bank_account = _formdata("bank_account")) {
					$insert_filed .= "`banknum`,";
					$insert_value .= "'$bank_account',";
				}

				if($bank_user = _formdata("bank_user")) {
					$insert_filed .= "`bankuser`,";
					$insert_value .= "'$bank_user',";
				}

				if($swiff = _formdata("swiff")) {
					$insert_filed .= "`swiff`,";
					$insert_value .= "'$swiff',";
				}

				$query = "INSERT INTO `shop_bank` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				_sales_query($query);
				
				echo "사이트 정보가 추가되었습니다.";

			

		} else if($mode == "delete"){
			$query = "DELETE FROM `shop_bank` WHERE `Id`='$uid'";
				// echo $query."<br>";
			_sales_query($query);

			echo "사이트 정보 삭제";
		}




		echo "<script>
				$.ajax({
            		url:'/ajax_sales_bank.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#bank_list').html(data);
            		}
        		});
    			</script>";



	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>