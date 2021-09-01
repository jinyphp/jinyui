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
    			$UID = $_GET['UID'];
    			
    			$query = "DELETE FROM `shop_skinbody` WHERE `Id`='$UID'";
    			mysql_db_query($mysql_dbname,$query,$connect);
    			
    			// echo "<meta http-equiv='refresh' content='0; url=admin_skinedit?code=$code.php'>";
    			page_back2();
    			break;
    			
    		case 'editup':
    		
    			$code = $_POST['code'];
    			
    			$enable = $_POST['enable'];
				$domain = $_POST['domain'];
    			$language = $_POST['language'];
    			$skin_mobile = $_POST['skin_mobile']; 
    			$skin_language = $_POST['skin_language']; 
    			$layout = $_POST['layout'];
    			
    			$html = $_POST['html']; $html = addslashes($html);
    		
    			
    			
    			if(!$code) msg_alert("오류! 스킨바디 코드값이 없습니다.");
    			else {
    				$result=mysql_db_query($mysql_dbname,"select * from `shop_skinbody` where code = '$code' and language = '$skin_language' and mobile='$skin_mobile'",$connect);
					if( mysql_affected_rows() ){ 
		    			$rows=mysql_fetch_array($result);
		    			// 업데이트
		    			
		    			$regdate = $rows[regdate];
		    		
		    			$query ="UPDATE `shop_skinbody` SET `domain`='$domain', `language`='$skin_language', `enable`='$enable', 
		    			`code`='$code', `layout`='$layout', `html`='$html', `mobile`='$skin_mobile' WHERE `code`='$code' and `regdate`='$rows[regdate]'";
		    			//echo $query."<br>";
		    			mysql_db_query($mysql_dbname,$query,$connect);
		    		} else {
		    			//신규등록
		    		
		    			$regdate = $TODAYTIME;
		    			
		    			$query = "INSERT INTO `shop_skinbody` (`regdate`, `domain`, `enable`, `code`, `layout`, `html`, `mobile`, `language`) 
		    			VALUES ('$TODAYTIME', '$domain', '$enable', '$code', '$layout', '$html', '$skin_mobile', '$skin_language');";
		    			//echo $query."<br>";
		    			mysql_db_query($mysql_dbname,$query,$connect);
		    		}
	
		    	}
		    	
		    	
		    	
		    			//*** 이미지1
    					///////////////////
				
    					if ($_FILES["userfile1"][tmp_name]){
	
   		 					if(!is_dir("../skin")) $an = mkdir("../skin");
  				
							$uploadfile1  = "../skin/".$_FILES[userfile1][name];
						
							$i=1;
							if ($_FILES["userfile".$i][tmp_name]) {
   								$ext = substr(${"uploadfile".$i}, strrpos(${"uploadfile".$i}, '.') + 1); 
   								if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit; 
   							}	
							
							if ($_FILES["userfile1"][tmp_name]) $filename1 = "../skin/$code--1";
			
    	  					if ($_FILES["userfile".$i][tmp_name]) {
    	     					move_uploaded_file($_FILES["userfile".$i][tmp_name], "../skin/$code--1.".$ext);
    	  					}
    	  						
    	  					$query = "UPDATE `shop_skinbody` SET `images1`='./skin/$code--1.".$ext."'  WHERE `code`='$code' and `regdate`='$regdate'";
    						echo $query."<br>";
    						mysql_db_query($mysql_dbname,$query,$connect); 
    	  						
							$images1 = "./skin/$code--1.".$ext;
								
    	  				} else $images1 = "";
      				
    	  				//*** 이미지2
    					///////////////////
				
    					if ($_FILES["userfile2"][tmp_name]){
	
   		 					if(!is_dir("../skin")) $an = mkdir("../skin");
  				
							$uploadfile2  = "../skin/".$_FILES[userfile2][name];
						
							$i=2;
							if ($_FILES["userfile".$i][tmp_name]) {
   								$ext = substr(${"uploadfile".$i}, strrpos(${"uploadfile".$i}, '.') + 1); 
   								if ($ext == "php" || $ext == "php3" || $ext == "php4" || $ext == "php5" || $ext == "kr") exit; 
   							}	
							
							if ($_FILES["userfile2"][tmp_name]) $filename2 = "../skin/$code--2";
			
    	  					if ($_FILES["userfile".$i][tmp_name]) {
    	     					move_uploaded_file($_FILES["userfile".$i][tmp_name], "../skin/$code--2.".$ext);
    	  					}
    	  						
    	  					$query = "UPDATE `shop_skinbody` SET `images2`='./skin/$code--2.".$ext."'  WHERE `code`='$code' and `regdate`='$regdate'";
    						echo $query."<br>";
    						mysql_db_query($mysql_dbname,$query,$connect); 
    	  						
							$images2 = "./skin/$code--2.".$ext;
								
    	  				} else $images2 = "";

		    

    			page_back2();
    			break;
    			
    		default:
				//# 화면 디자인 템플릿을 스킨 읽어옵니다.
				$body = admin_shopskin("admin_skinbody");
				
				//# 번역스트링 처리
				$body = _adminstring_converting($body);
				
				// $body = str_replace("./sales_script.js","../sales_script.js",$body);
				
				if($_GET['code']){
					$code = $_GET['code'];
    				$query = "select * from `shop_skinbody` where code = '$code' and language ='".$_SESSION['language']."' and mobile ='".$_SESSION['mobile']."'";
    			} else if($_GET['UID']){
    				$UID = $_GET['UID'];
    				$query = "select * from `shop_skinbody` where Id = '$UID'";
    			}
    			
    			$result=mysql_db_query($mysql_dbname,"$query",$connect);
				if( mysql_affected_rows() ) $rows=mysql_fetch_array($result);
    			
    			$body=str_replace("{#formstart}","<form name='skinbody' method='post' enctype='multipart/form-data' action='admin_skinbody.php'> 
					    				<input type='hidden' name='mode' value='editup'>",$body);
				$body = str_replace("{#formend}","</form>",$body);
											
				if($rows[enable])
					$body = str_replace("{#enable}","<input type='checkbox' name='enable' checked >",$body);
				else $body = str_replace("{#enable}","<input type='checkbox' name='enable' >",$body);
					
				if($rows[code]){	
					$body = str_replace("{#title}","<input type='text' name='code' value='$rows[code]' $cssFormStyle >",$body);
					// $code = $rows[code];
				}else $body = str_replace("{#title}","<input type='text' name='code' value='$code' $cssFormStyle >",$body);
				
				
				
				//* 모바일 구분
				$from_mobile .= "<table>";
				if($rows[mobile] == "pc") $from_mobile .= "<tr><td><input type='radio' name='skin_mobile' value='pc' checked> PC</td>";
				else $from_mobile .= "<tr><td><input type='radio' name='skin_mobile' value='pc'> PC</td>";
				$from_mobile .= "<td>/</td>";
				
				if($rows[mobile] == "mobile") $from_mobile .= "<td> <input type='radio' name='skin_mobile' value='mobile' checked> MOBILE</td></tr>";
				else $from_mobile .= "<td> <input type='radio' name='skin_mobile' value='mobile'> MOBILE</td></tr>";
				$from_mobile .= "</table>";
				$body = str_replace("{#mobile}",$from_mobile,$body);
				
				
				//* 언어팩 설정
				$query1 = "select * from shop_language where enable = 'on' or enable = 'checked'";
				$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    			$total1 = mysql_result($result1,0,0);
				
    			$result1=mysql_db_query($mysql_dbname,$query1,$connect);
    			if(mysql_affected_rows()){
    				$from_language = "<table><tr>";
					for($i1=1;$i1<=$total1;$i1++){
						$rows1=mysql_fetch_array($result1);
						/*
						if($rows[language] == $rows1[code]) 
						$body1 .= "<option value='$rows1[code]' selected=\"selected\">$rows1[language]</option>";
						else $body1 .= "<option value='$rows1[code]' >$rows1[language]</option>";
						*/
						
						if($rows[language] == $rows1[code]) 
						$from_language .= "<td><input type='radio' name='skin_language' value='$rows1[code]' checked>$rows1[code]</td>";
						else $from_language .= "<td><input type='radio' name='skin_language' value='$rows1[code]'>$rows1[code]</td>";
					}
					$from_language .= "</tr></table>";
				}
				$body = str_replace("{#language}",$from_language,$body);
				
				
				
				
				$body = str_replace("{#images1}","<input type='file' name='userfile1' >",$body); 
				$body = str_replace("{#images2}","<input type='file' name='userfile2' >",$body);
				$body = str_replace("{#images3}","<input type='file' name='userfile3' >",$body);
				
				
				//* 스킨 레이아웃 설정
				$query1 = "select * from shop_skin where enable = 'on' or enable = 'checked'";
				$result1 = mysql_db_query($mysql_dbname,str_replace("*","count(*)",$query1),$connect);
    			$total1 = mysql_result($result1,0,0);
				
    			$result1=mysql_db_query($mysql_dbname,$query1,$connect);
    			if(mysql_affected_rows()){
    				$body1 = "<select size='1' name='layout' $cssFormStyle> ";
    				$body1 .= "<option value='' >사이트 스킨 레이아웃 선택</option>";
					for($i1=1;$i1<=$total1;$i1++){
						$rows1=mysql_fetch_array($result1);
						if($rows[layout] == $rows1[Id]) 
						$body1 .= "<option value='$rows1[Id]' selected=\"selected\">$rows1[skinname]</option>";
						else $body1 .= "<option value='$rows1[Id]' >$rows1[skinname]</option>";
					}
					$body1 .= "</select>";
				}
				$body = str_replace("{#layout}",$body1,$body);	

				
				$html = stripslashes($rows[html]);	
				$body = str_replace("{#skinbody}","<textarea name='html' rows='20' style='width:100%'>$html</textarea>",$body);
					
		
			$body = str_replace("{#submit}","<input type='submit' name='reg' value='수정' >",$body);						
			$body = str_replace("{#delete}","<input type='button' value='삭제' onclick='pageClick(\"admin_skinbody.php?mode=del&UID=$UID\")' style='font-size:9pt'>",$body);
			
			
						
			echo $body;	
		}
	
	} else echo "<meta http-equiv='refresh' content='0; url=admin_login.php'>";
	

?>

