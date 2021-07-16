<?
	//* ////////////////////////////////////////////////////////////
	//* salesking 다국어 쇼핑몰 V 1.0 
	//* 2014.12.30
	//* Program By : hojin lee 
	//*
	
	@session_start();
	
	include "../dbinfo.php";
	$connect=mysql_connect($mysql_localhost,$mysql_user,$mysql_password) or die("Source database can not connect.");
	
	include "../language.php"; //# 사이트 언어, 지역 설정
	include "../mobile.php";

	include "./func_adminskin.php"; //# 스킨 레이아웃 함수들...
	
	include "../func_files.php"; 
	include "../func_datetime.php";
	include "../func_javascript.php";	
	
	include "./func_adminstring.php";
	
	////////////////////////
	
	$_SESSION['nonce'] = $nonce = md5('goodname'.microtime());   
	
	if($_COOKIE[adminemail]){ ///////////////

    	$mode = $_POST['mode']; if(!$mode) $mode = $_GET['mode'];
    	$UID = $_GET['UID']; if(!$UID) $UID = $_POST['UID'];
    	
    	switch($mode){
    		case 'del':
    			
    			$query = "DELETE FROM `shop_skingoods` WHERE `Id`='$UID'";
    			mysql_db_query($mysql_dbname,$query,$connect);
    			
    			page_back2();
    			break;
    			
    		case 'editup':
    		
    			$enable = $_POST['enable'];
    			$pageview = $_POST['pageview'];
    			
				$skin_type = $_POST['skin_type'];
				$skin_code = $_POST['skin_code'];
				$skin_cate = $_POST['skin_cate'];
				$skin_mode = $_POST['skin_mode'];
			
				$skin_rows = $_POST['skin_rows'];
				$skin_cols = $_POST['skin_cols'];
				$skin_sorting = $_POST['skin_sorting'];
			
				$skin_skin = $_POST['skin_skin']; $skin_skin = addslashes($skin_skin);
			
				$domain = str_replace("www.","",$_SERVER['HTTP_HOST']);

				$imageview = $_POST['imageview'];
				$imagesize = $_POST['imagesize'];
				
				$viewspec = $_POST['viewspec'];
				$viewsubtitle = $_POST['viewsubtitle'];
				
			
				if(!$skin_code) msg_alert("오류! 치환코드를 입력해주세요");
    			else {
					$query = "UPDATE `shop_skingoods` SET `type`='$skin_type', `code`='$skin_code', `cate`='$skin_cate',
											`mode`='$skin_mode', `rows`='$skin_rows', 
											`cols`='$skin_cols', `sorting`='$skin_sorting', `skin`='$skin_skin', `pageview`='$pageview',
											`imageview`='$imageview', `imagesize`='$imagesize',
    										`viewspec`='$viewspec', `viewsubtitle`='$viewsubtitle',
											`enable`='$enable'  WHERE `Id`='$UID'";
    				//echo $query."<br>";
    				mysql_db_query($mysql_dbname,$query,$connect);
    			}
    			page_back2();
    			
    			break;
    			
    		default:
    	
    			//# 화면 디자인 템플릿을 스킨 읽어옵니다.
    			$body = admin_shopskin("admin_skingoods_edit");		
    					
    			$result=mysql_db_query($mysql_dbname,"select * from `shop_skingoods` where Id = '$UID'",$connect);
				if( mysql_affected_rows() ){ 
		    		$rows=mysql_fetch_array($result);
    		
					$body=str_replace("{formstart}","<form name='loginenv' method='post' enctype='multipart/form-data' action='".$_SERVER['PHP_SELF']."'> 
					    				<input type='hidden' name='UID' value='$UID'>
					    				<input type='hidden' name='mode' value='editup'>",$body);
					$body = str_replace("{formend}","</form>",$body);
											
					if($rows[enable])
					$body = str_replace("{enable}","<input type='checkbox' name='enable' checked >",$body);
					else $body = str_replace("{enable}","<input type='checkbox' name='enable' >",$body);
					
					if($rows[pageview])
					$body = str_replace("{pageview}","<input type='checkbox' name='pageview' checked >",$body);
					else $body = str_replace("{pageview}","<input type='checkbox' name='pageview' >",$body);
					
					
					if($rows[imageview])
					$body = str_replace("{imageview}","<input type='checkbox' name='imageview' checked $cssFormStyle >",$body);
					else $body = str_replace("{imageview}","<input type='checkbox' name='imageview' $cssFormStyle >",$body);
					
					$body = str_replace("{imagesize}","<input type='text' name='imagesize' value='$rows[imagesize]' $cssFormStyle >",$body);
	
	
					if($rows[viewspec])
					$body = str_replace("{spec}","<input type='checkbox' name='viewspec' checked $cssFormStyle >",$body);
					else $body = str_replace("{spec}","<input type='checkbox' name='viewspec' $cssFormStyle >",$body);
					
					if($rows[viewsubtitle])
					$body = str_replace("{subtitle}","<input type='checkbox' name='viewsubtitle' checked $cssFormStyle >",$body);
					else $body = str_replace("{subtitle}","<input type='checkbox' name='viewsubtitle' $cssFormStyle >",$body);
					
					
					$body1 = "<select size='1' name='skin_type' $cssFormStyle> ";
					if($rows[type] == "goods") $body1 .= "<option value='goods' selected=\"selected\">제품출력</option>"; else $body1 .= "<option value='goods' >제품출력</option>";
					if($rows[type] == "board") $body1 .= "<option value='board' selected=\"selected\">계시판</option>"; else $body1 .= "<option value='board' >계시판</option>";
					$body1 .= "</select>";
					$body = str_replace("{type}",$body1,$body);
					
					// $body = str_replace("{type}","<input type='text' name='skin_type' value='$rows[type]' $cssFormStyle >",$body);
					$body = str_replace("{code}","<input type='text' name='skin_code' value='$rows[code]' $cssFormStyle >",$body);
			
		
					$query1 = "select * from `shop_cate` order by pos asc";
					$result1=mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    				$total1=mysql_result($result1,0,0);
		
					$result1=mysql_db_query($mysql_dbname,$query1,$connect);
					if(mysql_affected_rows()) {
						$body1 = "<select size='1' name='skin_cate' $cssFormStyle> ";
						$body1 .= "<option value='' >출력 상품 카테고리</option>";
						for($ii=0;$ii<$total1;$ii++){
							$rows1=mysql_fetch_array($result1);
				
							for($jj=0,$level="";$jj<$rows1[level];$jj++) $level .= "&nbsp;";
				
							$language = $_SESSION['language']; //해당언어 상품명, 없으면 기본이름 적용
							if($rows1[$language]) $catename = $rows1[$language]; else $catename = $rows1[catename];
				
							if($rows[cate] == $rows1[Id]) 
								$body1 .= "<option value='$rows1[Id]' selected=\"selected\">$level $catename</option>";
							else $body1 .= "<option value='$rows1[Id]' >$level $catename</option>";
						}
						$body1 .= "</select>";
						$body = str_replace("{cate}",$body1,$body);
					}
		
		
					$body = str_replace("{mode}","<input type='text' name='skin_mode' value='$rows[mode]' $cssFormStyle >",$body);
					$body = str_replace("{rows}","<input type='text' name='skin_rows' value='$rows[rows]' $cssFormStyle >",$body);
					$body = str_replace("{cols}","<input type='text' name='skin_cols' value='$rows[cols]' $cssFormStyle >",$body);
					$body = str_replace("{sorting}","<input type='text' name='skin_sorting'value='$rows[sorting]' $cssFormStyle >",$body);
		
					
					$skin = stripslashes($rows[skin]);	
					$body = str_replace("{skin}","<textarea name='skin_skin' rows='20' style='width:100%'>$skin</textarea>",$body);
					

					
					$body = str_replace("{submit}","<input type='submit' name='reg' value='수정' $css_submit >",$body);		
					$body = str_replace("{delete}","<input type='button' value='삭제' onclick='pageClick(\"admin_skingoods_edit.php?mode=del&UID=$UID\")' $css_submit>",$body);
							
					//# 번역스트링 처리
					$body = _adminstring_converting($body);
		
					echo $body;
						
				}


			
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

