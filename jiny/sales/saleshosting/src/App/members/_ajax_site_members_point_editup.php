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
	include "./func/members.php";


	//********** Ajax Process **********
	//echo "ajax Session :".$_SESSION['ajaxkey']."<br>";
	//echo "ajax key ====:"._formdata("ajaxkey")."<br>";
	
	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		include "./sales.php";

		$mode = _formmode();
		//echo "mode = $mode <br>";
		$uid = _formdata("uid");
		$mem = _formdata("mem");
		//echo "uid = $uid <br>";

		
		function _ajax_pagecall_script($url,$ajaxkey){
			
			echo "<script>
				$.ajax({
            		url:'".$url."?ajaxkey=".$ajaxkey."',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('.mainbody').html(data);
            		}
        		});
    			</script>";
    		
    	}		

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


		$query = "select * from `site_members` WHERE `Id`='$mem'";
		if($members_rows = _sales_query_rows($query)){	
		}


		if($mode == "delete"){
			$query = "select * from `site_members_point` where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				$query = "DELETE FROM `site_members_point` WHERE `Id`='$uid'";
    			_sales_query($query);

    			$balance = $rows->balance - $rows->point;

    			// Balance 값 조정
				$query = "select * from `site_members_point` where Id>'$uid' and email = '".$members_rows->email."'";
				if($rowss1 = _sales_query_rowss($query)){
					for($i=0;$i<count($rowss1);$i++){
						$rows1 = $rowss1[$i];
						$balance = $balance + $rows1->point;
						$query = "UPDATE `site_members_point` SET `balance`='$balance' WHERE `Id`='".$rows1->Id."'";
						//echo $query."<br>";
						_sales_query($query);
					}
				}

				$query = "UPDATE `site_members` SET point='$balance' where email='".$members_rows->email."'";
				//echo $query."<br>";
				_sales_query($query);

    		}
		} else {

			$point = _formdata("point");


		
			$query = "select * from `site_members_point` where Id='$uid'";
			if($rows = _sales_query_rows($query)){
				// 수정 

				

				$balance = $rows->balance - $rows->point;
				$balance += $point;
				
				$query = "UPDATE `site_members_point` SET ";
				$regdate = _formdata("email");	$query .= "`regdate`='$TODAYTIME' ,";
				$title = _formdata("title");	$query .= "`title`='$title' ,";
				$query .= "`point`='$point' ,";
				$query .= "`balance`='$balance' ,";			

				$query .= "WHERE `Id`='$uid'";
				$query = str_replace(",WHERE","WHERE",$query);
				//echo $query."<br>";
				_sales_query($query);

				// Balance 값 조정
				$query = "select * from `site_members_point` where Id>'$uid' and email = '".$members_rows->email."'";
				if($rowss1 = _sales_query_rowss($query)){
					for($i=0;$i<count($rowss1);$i++){
						$rows1 = $rowss1[$i];
						$balance = $balance + $rows1->point;
						$query = "UPDATE `site_members_point` SET `balance`='$balance' WHERE `Id`='".$rows1->Id."'";
						//echo $query."<br>";
						_sales_query($query);
					}
				}

				$query = "UPDATE `site_members` SET point='$balance' where email='".$members_rows->email."'";
				//echo $query."<br>";
				_sales_query($query);


			} else {
				// 삽입 

				$balance = $members_rows->point + intval($point);
				$query = "UPDATE `site_members` SET point='$balance' where email='".$members_rows->email."'";
				//echo $query."<br>";
				_sales_query($query);

				$insert_filed .= "`regdate`,";
				$insert_value .= "'$TODAYTIME',";

				$insert_filed .= "`email`,";
				$insert_value .= "'".$members_rows->email."',";

				if($title = _formdata("title")){
					$insert_filed .= "`title`,";
					$insert_value .= "'$title',";
				}

				if($point = _formdata("point")){
					$insert_filed .= "`point`,";
					$insert_value .= "'$point',";
				}

				$insert_filed .= "`balance`,";
				$insert_value .= "'$balance',";			

				$query = "INSERT INTO `site_members_point` ($insert_filed) VALUES ($insert_value)";
				$query = str_replace(",)",")",$query);
				//echo $query."<br>";
				_sales_query($query);
					
			}	

		}

		echo "<script>
				$.ajax({
            		url:'/ajax_site_members_point.php?uid=".$mem."&ajaxkey=".$ajaxkey."',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('.mainbody').html(data);
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