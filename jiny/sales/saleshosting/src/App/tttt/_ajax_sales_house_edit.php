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

	// ERP Library
	include "./lib/company.php";
	include "./lib/goods.php";
	include "./lib/trans.php";
	include "./lib/report.php";



	if(isset($_COOKIE['cookie_email'])){
		include "./sales.php";

		$script = "<script>

		</script>";


		$body = $script._skin_page($skin_name,"sales_goods_house_edit");

		$mode = _formmode();
		$uid = _formdata("uid");
		//echo "uid = $uid <br>";
		$limit = _formdata("limit");
		$ajaxkey = _formdata("ajaxkey");

		// echo $mode;
		
		$body=str_replace("{formstart}","<form id='data' name='house' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>		    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		

		$query = "select * from `sales_goods_house` where Id = '$uid'";
		// echo $query."<br>";
    	if($rows= _sales_query_rows($query)){
    		$body = str_replace("{form_submit}",$script."
				<input type='button' value='수정' onclick=\"javascript:form_house_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" > 
				<input type='button' value='삭제' onclick=\"javascript:form_house_submit('delete','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
    	} else {
    		$body = str_replace("{form_submit}",$script."
				<input type='button' value='저장' onclick=\"javascript:form_house_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
    	}	
		
		if(isset($rows->enable)) $body = str_replace("{enable}",_form_check_enable($rows->enable),$body);
			else $body = str_replace("{enable}",_form_check_enable("on"),$body);

		$body = str_replace("{name}","<input type='text' name='name'  value='".$rows->name."' style=\"$css_textbox\">",$body);
		// $body = str_replace("{manager}","<input type='text' name='manager'  value='".$rows->manager."' style=\"$css_textbox\">",$body);
		$body = str_replace("{phone}","<input type='text' name='phone'  value='".$rows->phone."' style=\"$css_textbox\">",$body);
		$body = str_replace("{fax}","<input type='text' name='fax'  value='".$rows->fax."' style=\"$css_textbox\">",$body);
		$body = str_replace("{tel}","<input type='text' name='tel'  value='".$rows->tel."' style=\"$css_textbox\">",$body);
		$body = str_replace("{post}","<input type='text' name='post'  value='".$rows->post."' style=\"$css_textbox\">",$body);
		$body = str_replace("{state}","<input type='text' name='state'  value='".$rows->state."' style=\"$css_textbox\">",$body);
		$body = str_replace("{city}","<input type='text' name='city'  value='".$rows->city."' style=\"$css_textbox\">",$body);
		$body = str_replace("{address}","<input type='text' name='address'  value='".$rows->address."' style=\"$css_textbox\">",$body);
		
		//# 사업장 선택 
		$form_business = "<select name='business' style=\"$css_textbox\" >";
		$form_business .= "<option value=''>사업장</option>";
		$query = "select * from sales_business where enable ='on'";
		if($rowss = _sales_query_rowss($query)){	
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($rows->business == $rows1->Id) $form_business .= "<option value='".$rows1->Id."' selected>".$rows1->business."</option>"; 
				else $form_business .= "<option value='".$rows1->Id."'>".$rows1->business."</option>";
			}
		}
		$form_business .= "</select>";
		$body = str_replace("{business}",$form_business,$body);

		//# 담당자 처리
		$form_manager = "<select name='manager' style=\"$css_textbox\" >";
		$form_manager .= "<option value=''>관리자</option>";
		$query = "select * from sales_manager where enable ='on'";
		if($rowss = _sales_query_rowss($query)){	
			for($i=0;$i<count($rowss);$i++){
				$rows1 = $rowss[$i];
				if($rows->manager == $rows1->Id) $form_manager .= "<option value='".$rows1->Id."' selected>".$rows1->lastname."</option>"; 
				else $form_manager .= "<option value='".$rows1->Id."'>".$rows1->lastname."</option>";
			}
		}
		$form_manager .= "</select>";
		$body = str_replace("{manager}",$form_manager,$body);


		$body = str_replace("{country}",_form_select_country("house_country","",$rows->country,$css_textbox),$body);

		$body = str_replace("{comment}",_form_textarea("comment",$comment,"20",$css_textarea),$body);	

		echo $body;	

	} else {
		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
		$body = _skin_body($skin_name,"login");
		
		$login_script = "<script>
				$.ajax({
            		url:'/ajax_login.php',
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
            			$('#mainbody').html(data);
            		}
        		});
		</script>";  

		echo $body.$login_script;
	}	
	
	/*
	include "./dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");

	include "language.php"; 
	include "mobile.php";
	
	include "./func_skin.php"; 
	include "./func_files.php"; 
	include "./func_datetime.php";
	include "./func_javascript.php";
	include "./func_log.php";
	
	include "./func_string.php";
	
	
	if(!isset($_COOKIE[Session]) && !isset($_COOKIE[email]) ) {
		$msg = "회원 로그인이 필요합니다.";
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
       			<script>
       				alert(\"$msg\");
       				location.href=\" ./sales_login.php \";
    			</script>";      
	} else { //////////////////////////////////////////
	

		$query = "select * from `sales_members` where email = '$_COOKIE[email]'";
    	$result=mysql_db_query($mysql_dbname,$query,$connect);
		if(  mysql_num_rows($result)  ){ 
			$MEM=mysql_fetch_array($result);
		
			//# DB부하 분산: 고객 데이터 DB 서버 정보 추출...
			$query = "select * from `sales_server` where Id = '$MEM[server]'";
    		$result=mysql_db_query($mysql_dbname,$query,$connect);
			if(  mysql_num_rows($result)  )	{
				$server=mysql_fetch_array($result);
				$dbconnect=mysql_connect($server[ip],$server[userid],$server[password],true) or die("user database can not connect.");
			} else {
				$dbconnect = $connect;
				$server[dbname] = $mysql_dbname;
			}

			
			//////////////////////////////////////////////////////////////////
			$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    		$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    		
    		
    		
    	
    		switch($mode){
    			case 'del':
    			
    				$query = "DELETE FROM `sales_warehouse` WHERE `Id`='$UID'";
    				mysql_db_query($server[dbname],$query,$dbconnect);
    				
    				echo "<script> history.go(-1); </script>";
    			
    				break;
    			case 'editup':
    				
					$enable = $_POST['enable'];
				
					$housename = $_POST['housename'];
    				$manager = $_POST['manager'];
    			
    				$phone = $_POST['phone']; 
    				$fax = $_POST['fax'];
    				$address = $_POST['address']; 
    			
    				$memo = $_POST['memo'];
    			
    		
    				if(!$housename) msg_alert("오류! 창고명이 없습니다.");
    				else {
    				
    					$query="UPDATE `sales_warehouse_$MEM[Id]` SET `housename`='$housename', `manager`='$manager', 
									`fax`='$fax', `phone`='$phone', `address`='$address',`memo`='$memo' WHERE `Id`='$UID' ";
    					mysql_db_query($server[dbname],$query,$dbconnect);
    						
    				}
    				echo "<script> history.go(-2); </script>";	
    			
    				
    				break;
    			default:
				
    				$query = "select * from `sales_warehouse_$MEM[Id]` where  Id = '$UID'";
    				$result=mysql_db_query($server[dbname],$query,$dbconnect);
					if(  mysql_num_rows($result)  ){ 
		    			$rows=mysql_fetch_array($result);
		    			
		    			$body = shopskin("sales_warehouse_edit");
    				
						
						$body=str_replace("{formstart}","<form name='warehouse' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
										<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
						$body = str_replace("{formend}","</form>",$body);
						
						$body = str_replace("{housename}","<input type='text' name='housename' value='$rows[housename]' $cssFormStyle placeholder='창고명'>",$body);	
			
						$query1 = "select * from sales_manager where members_id = '$MEM[Id]'";
						$result1=mysql_db_query($mysql_dbname,$query1,$connect);
						if( $total1=mysql_num_rows($result1) ) {
							$manager = "<select name='manager' $cssFormStyle >";
							for($ii=0;$ii<$total1;$ii++){
								$rows1=mysql_fetch_array($result1);
								if($rows[manager] == $rows1[Id]) $manager .= "<option value='$rows1[Id]' selected>$rows1[name]</option>"; 
								else $manager .= "<option value='$rows1[Id]'>$rows1[name]</option>";
							}
							$body = str_replace("{manager}","$manager",$body);
						} else $body = str_replace("{manager}","",$body);
			
			
						$body = str_replace("{phone}","<input type='text' name='phone' value='$rows[phone]' $cssFormStyle placeholder='전화번호'>",$body);
						$body = str_replace("{fax}","<input type='text' name='fax' value='$rows[fax]' $cssFormStyle placeholder='팩스'>",$body);
						$body = str_replace("{address}","<input type='text' name='address' value='$rows[address]' $cssFormStyle placeholder='주소'>",$body);
			
						$body = str_replace("{memo}","<textarea name='memo' rows='10' style='width:100%;margin:-3px;border:2px inset #eee' placeholder='메모'>$rows[memo]</textarea>",$body);
						
						
						$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $btn_style_blue>",$body);
									
					
						$body = str_replace("{delete}",skin_button("삭제","sales_manager_edit.php?mode=del&UID=$UID"),$body); 
						
							
						
						
					}	
					
    				break;
    		}
    		
			
			//////////////////////////////////////////////////////////////////		
		
		} else msg_alert("오류! 회원정보를 읽어 올수 없습니다.");
		
		
		//# 번역스트링 처리
		$body = _string_converting($body);
		echo $body;
	
	}
	
	mysql_close($connect);
	mysql_close($dbconnect);
	*/


?>

