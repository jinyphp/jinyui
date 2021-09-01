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
				function form_assamble_submit(mode,uid){
					var assamble = $('#assamble_num').val();

					if(!assamble){
						alert(\"생산/분해 수량을 입력해 주세요.\");
					} else {
					var url = \"/ajax_sales_goods_editup.php?uid=\"+uid+\"&mode=\"+mode;
					var formData = new FormData($('#data')[0]);
					$.ajax({
						url:url,
        				type: 'POST',
        				data: formData,
        				async: false,
        				success: function (data) {
        					$('#goods').html(data);
        				},
        				cache: false,
        				contentType: false,
        				processData: false
    				});
					}
					
				}



		</script>";


		$body = $script._skin_page($skin_name,"sales_goods_bom");

		$mode = _formmode();
		$uid = _formdata("uid");
		//echo "uid = $uid <br>";
		$limit = _formdata("limit");
		$ajaxkey = _formdata("ajaxkey");

		// echo $mode;
		/*
		$body=str_replace("{formstart}","<form id='data' name='goods' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>
					    				<input type='hidden' name='limit' value='$limit'>		    				
										<input type='hidden' name='uid' value='$uid'>",$body);
		$body = str_replace("{formend}","</form>",$body);
		*/


	
		$query = "select * from `sales_goods` where Id = '$uid'";
    	if($rows= _sales_query_rows($query)){
    		$body = str_replace("{form_submit}",$script."
				<input type='button' value='수정' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" > 
				<input type='button' value='삭제' onclick=\"javascript:form_delete('delete','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
    	} else {
    		$body = str_replace("{form_submit}",$script."
				<input type='button' value='저장' onclick=\"javascript:form_submit('".$mode."','".$uid."')\" style=\"".$css_btn_gray."\" >
				",$body);
    	}

		
    	//# 
    
		$form_stock_house = "<select name='stock_house' style=\"$css_textbox\" >";
		$query1 = "select * from sales_goods_house where enable ='on'";
		if($rowss1 = _sales_query_rowss($query1)){
			for($i=0;$i<count($rowss1);$i++){
				$rows1 = $rowss1[$i];
				$form_stock_house .= "<option value='".$rows1->Id."'>".$rows1->name."</option>";
			}
		}
		$form_stock_house .= "</select>";
	

		$body = str_replace("{stock_house}",$form_stock_house,$body);


		$body = str_replace("{num}","<input type='hidden' name='bom' value='$uid' id=\"bom_uid\"> <input type='number' name='assamble_num' value='' id=\"assamble_num\" style=\"".$css_textbox."\">",$body);

    	$button ="<input type='button' value='제품생산' onclick=\"javascript:form_assamble_submit('assamble','$uid')\" style=\"".$css_btn_gray."\"  >";          
		$body = str_replace("{bom_assamble}",$button,$body);

		$button ="<input type='button' value='제품분해' onclick=\"javascript:form_assamble_submit('disassamble','$uid')\" style=\"".$css_btn_gray."\"  >";          
		$body = str_replace("{bom_disassamble}",$button,$body);

		$body = str_replace("{search_key}","<input type='text' name='searchkey' value='$searchkey' style=\"".$css_textbox."\">",$body);
		$button_search ="<input type='button' value='부품추가' onclick=\"javascript:addpart('$uid')\" style=\"".$css_btn_gray."\"  >";           
		$body = str_replace("{add_part}",$button_search,$body);




		// 신규 자료 입력 
		$newdata_form = "<span id=\"newdata\">	
		<script>
			$.ajax({
            	url:'/ajax_sales_bom_newdata.php',
            	type:'post',
            	data:$('form').serialize(),
            	success:function(data){
            		$('#newdata').html(data);
            	}
        	});
    	</script>
    	</span>";
    	$body = str_replace("{newdata}",$newdata_form,$body);
		

		// =================
		//# 전표 자료 출력 
		$list_form = "<span id=\"list\">	
		<script>
			$.ajax({
            	url:'/ajax_sales_bom_list.php',
            	type:'post',
            	data:$('form').serialize(),
            	success:function(data){
            		$('#list').html(data);
            	}
        	});
    	</script>
    	</span>";
    	$body = str_replace("{list}",$list_form,$body);


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
	@session_start();
	
	
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
	
	
	if(!isset($_COOKIE[Session]) && !isset($_COOKIE[email]) ) login();    
	else { //////////////////////////////////////////
	

		$query = "select * from `sales_members` where email = '$_COOKIE[email]'";
    	$result=mysql_db_query($mysql_dbname,$query,$connect);
		if( mysql_num_rows($result) ){ 
			$MEM=mysql_fetch_array($result);
			
			//# DB부하 분산: 고객 데이터 DB 서버 정보 추출...
			$query = "select * from `sales_server` where Id = '$MEM[server]'";
    		$result=mysql_db_query($mysql_dbname,$query,$connect);
			if( mysql_num_rows($result) )	{
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
    				

    				page_back2();
    				
    				break;
    			case 'editup':
   		
	    			$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
	    			$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
	 
    			
    				if(!$company) msg_alert("오류! 회사명이 없습니다.");
    				else {

						//# 사업자 번호 중복 검사
						if($rows[biznumber]) {
							$query = "select * from sales_company_$MEM[Id] where biznumber = '$biznumber'";
							// $result=mysql_db_query($mysql_dbname,$query,$connect);
							$result=mysql_db_query($server[dbname],$query,$dbconnect);
							if( mysql_num_rows($result) ) msg_alert("중복된 사업자 번호입니다.");
						} 
					
						if($rows[email]) {
							$query = "select * from sales_company_$MEM[Id] where email = '$email'";
							// $result=mysql_db_query($mysql_dbname,$query,$connect);
							$result=mysql_db_query($server[dbname],$query,$dbconnect);
							if( mysql_num_rows($result) ) msg_alert("중복된 이메일 주소 입니다.");
						} 
					
						$query = "UPDATE `sales_company_$MEM[Id]` SET `inout`='$inout', `company`='$company', `biznumber`='$biznumber', `president`='$president', 
    						`post`='$post', `address`='$address', `subject`='$subject', `item`='$item', `comment`='$comment', `discount`='$discount', `vat`='$vat', 
    						`email`='$email', `tel`='$tel', `fax`='$fax', `phone`='$phone', `group`='$group', `manager`='$manager',
    						`country`='$country', `currency`='$currency', `limitation`='$limitation' , `vat`='$vat', `vatrate`='$vatrate' WHERE `Id`='$UID'";
    					// echo $query."<br>";
    					// mysql_db_query($mysql_dbname,$query,$connect);
    					mysql_db_query($server[dbname],$query,$dbconnect);
    					
    					$query = "UPDATE `sales_company_$MEM[Id]` SET `balance1`='$balance1', `balance2`='$balance2' WHERE `Id`='$UID'";
    					// echo $query."<br>";
    					//mysql_db_query($mysql_dbname,$query,$connect);
    					mysql_db_query($server[dbname],$query,$dbconnect);
    					
    					//# 마스터 업체목록 수정
    					if($email){
							$query = "select * from sales_company where email = '$email'";
							$result=mysql_db_query($mysql_dbname,$query,$connect);
							if( mysql_num_rows($result) ){
								// 기존 DB, Tree 정보만 갱신
								$rows = mysql_fetch_array($result);
								$tree = $rows[tree]."$MEM[Id];";
								$query="UPDATE `sales_company` SET `company`='$company', `biznumber`='$biznumber', `president`='$president', 
										`post`='$post', `address`='$address', `subject`='$subject', `item`='$item', `tel`='$tel', `fax`='$fax', `phone`='$phone',
										 `country`='$country',`email`='$email'  WHERE `email`='$email'";
    							mysql_db_query($mysql_dbname,$query,$connect);
							} else {
								// 신규추가
								$tree = "$MEM[Id];";
								$query = "INSERT INTO `sales_company` (`regdate`,  
    										`company`, `biznumber`, `president`, `post`, `address`, `subject`, `item`, 
    										`email`, `tel`, `fax`, `phone`, `country`,`currency`,`vat`,`vatrate`,`tree`) 
    								VALUES ('$TODAY', 
    								'$company', '$biznumber', '$president', '$post', '$address', '$subject', '$item', 
    								'$email', '$tel', '$fax', '$phone',  '$country', '$currency',  '$vat', '$vatrate', '$tree')";
    							mysql_db_query($mysql_dbname,$query,$connect);
							}
						}

    					//#
    					
    					
    					
    					///////////
    					
    					
					 
					}
    			
    				page_back2(); 
    			
    				break;
    			default:
    				
    			
    				
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

