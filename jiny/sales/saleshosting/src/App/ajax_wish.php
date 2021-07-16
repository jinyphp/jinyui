<?php
	//*  OpenShopping V2.1
	//*  Program by : hojin lee
	//*  2016.01.11 
	//*


	// 관심 상품 

	// update : 2016.01.11 = 코드정리 

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

	include "./func/css.php";	
	include "./func/error.php";	
	
	include "./func/goods.php";
	include ($_SERVER['DOCUMENT_ROOT']."/func/shop.lib.php");


	//Wish 목록 삽입 
	$UID = _formdata("UID");
	$mode = _formmode();

	if( $mode == "wish"){
		$query = "select * from `shop_wish` WHERE `GID`='$UID' and email ='".$_COOKIE['cookie_email']."'";
		if($rows = _mysqli_query_rows($query)){	
			
			// $body = _skin_page($skin_name,"error");
			$body = _theme_page($site_env->theme,"error",$site_language,$site_mobile);

			$msg = "이미 등록된 상품입니다.";
			$body = str_replace("<!--{error_message}-->",$msg,$body);
			echo $body;
		} else {
			// $query = "select * from `shop_goods` WHERE `Id`='$UID'";		
			if($rows = _goods_rows($UID)){	
			
				// $goodname = json_decode( stripslashes( $rows->goodname ) )->$site_language;
				// if(is_null($goodname)) $goodname = $rows->name;
				$goodname = _goods_name($rows,$site_language);

					// $subtitle = json_decode( stripslashes( $rows[subtitle] ) )->$_SESSION['language'];
				$_subtitle = json_decode( $rows->subtitle );
				$subtitle = $_subtitle->$site_language;

				$query ="INSERT INTO `shop_wish` (`regdate`,`seller`,`reseller`,`GID`,`goodname`,`currency`,`prices`,`status`,`images`,`email`,`subtitle`) 
					VALUES ('$TODAYTIME','".$rows->seller."','".$rows->seller."','$UID','$goodname','".$rows->sell_currency."','".$rows->prices_sell."','wish','".$rows->images1."','".$_COOKIE['cookie_email']."','$subtitle')";
				_mysqli_query($query);	
		
			} else {
				
				//$body = _skin_page($skin_name,"error");
				$body = _theme_page($site_env->theme,"error",$site_language,$site_mobile);
		
				$msg = "오류! 존재하지 않는 상품입니다.";
				$body = str_replace("<!--{error_message}-->",$msg,$body);
				echo $body;
			}

		}
			
	} else if( $mode == "delete" ){
		
		$TID = $_POST['TID'];    					

    	for($i=0;$i<count($TID);$i++){
    		$query = "DELETE FROM `shop_wish` WHERE `Id`='$TID[$i]'";
    		//mysql_db_query($slave_mysql[dbname],$query,$slave_dbconnect);
    		_mysqli_query($query);						
       	}

       	///////////////////////////////		
	} else if( $mode == "remove" ){
		$UID = $_POST['UID']; 
		
		$query = "DELETE FROM `shop_wish` WHERE `Id`='$UID'";
    	//mysql_db_query($slave_mysql[dbname],$query,$slave_dbconnect);	
    	_mysqli_query($query);	

	} 



	
	function _listform($rows){
		$list  ="<table border='0' width='100%' cellspacing='0' cellpadding='0' id='listbar'>";
		$list .="<tr>
					<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' rowspan='2' width='100' valign='top'>
					<a href='detail.php?uid=".$rows->GID."'><img src='".$rows->images."' border=0 width='100'></a></td>
					<td style='font-size:12px;padding:10px;' valign='top' width='20'><input type='checkbox' name='TID[]' value='".$rows->Id."' checked></td>
					<td style='font-size:12px;padding:10px;' valign='top'><a href='detail.php?uid=".$rows->GID."'>".$rows->goodname."</a></td>
					<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' valign='top' width='100' rowspan='2'>".$rows->currency." : ".$rows->prices."</td>
					</tr>
					<tr>
					<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' valign='top' width='20'></td>
					<td style='font-size:12px;padding:10px;border-bottom:1px solid #E9E9E9;' valign='top'>".$rows->subtitle."</td>
					</tr>";
		$list .="</table>";
		return $list;
	}


	function _listform_m($rows){
		$list  ="<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
	<tr>
		<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"80\" rowspan=\"3\"><a href='detail.php?uid=".$rows->GID."'><img src='".$rows->images."' border=0 width='100'></a></td>
		<td style='font-size:12px;padding:10px;' width=\"20\"><input type='checkbox' name='TID[]' value='".$rows->Id."' checked></td>
		<td style='font-size:12px;padding:10px;'><a href='detail.php?uid=".$rows->GID."'>".$rows->goodname."</a></td>
	</tr>
	<tr>
		<td style='font-size:12px;padding:10px;' width=\"20\">&nbsp;</td>
		<td style='font-size:12px;padding:10px;'>".$rows->currency." : ".$rows->prices."</td>
	</tr>
	<tr>
		<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width=\"20\">&nbsp;</td>
		<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$rows->subtitle."</td>
	</tr>
</table>";
		return $list;
	}


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...

		if(isset($_COOKIE['cookie_email'])){

			// $skin_name = "default";
			// $body = _skin_page($skin_name,"wish");
			$body = _theme_page($site_env->theme,"wish",$site_language,$site_mobile);

			$ajaxkey = _formdata("ajaxkey");
			$body = str_replace("{formstart}", "<form name='wish' method='post' enctype='multipart/form-data'>
				<input type='hidden' name='ajaxkey' value='$ajaxkey'>", $body);
			$body = str_replace("{formend}","</form>",$body);

			$javascript = "<script>
			function list(limit){
           		var url = \"/ajax_wish.php?limit=\"+limit;	
            	$.ajax({
                	url:url,
                	type:'post',
                	data:$('form').serialize(),
                	success:function(data){
                    	$('#mainbody').html(data);
                	}
           		}); 	
        	}

			function wish_delete(){
     			$.ajax({
        			url:'./ajax_wish.php?mode=delete&ajaxkey=$ajaxkey',
        			type:'post',
        			data:$('form').serialize(),
        			success:function(data){
            			$('#mainbody').html(data);
        			}
    			});

			} 
			</script>";


			// 출력 갯수
			$list_num = _formdata("list_num"); if(!$list_num) $list_num = "10";
			$form_num = "<select name='list_num' id=\"listnum\">";
			if($list_num == "10") $form_num .= "<option value='10' selected>Listing 10</option>"; else $form_num .= "<option value='10'>Listing 10</option>";
			if($list_num == "20") $form_num .= "<option value='20' selected>Listing 20</option>"; else $form_num .= "<option value='20'>Listing 20</option>";
			if($list_num == "50") $form_num .= "<option value='50' selected>Listing 50</option>"; else $form_num .= "<option value='50'>Listing 50</option>";
			$form_num .= "</select>";
			$body = str_replace("{list_num}", $form_num,$body);

			// View 출력 방식 설정
			$_block_num = 10;
			$_list_num = $list_num;


			$query = "select * from `shop_wish` WHERE `email`='".$_COOKIE['cookie_email']."' ";
			$query .= "order by regdate desc ";

			$total = _mysqli_query_count($query); // 전체 또는 검색된 데이터 갯수를 얻음.

			$limit = _formdata("limit");
			if($limit) $query .= "LIMIT $limit , $_list_num"; else $query .= "LIMIT 0 , $_list_num ";// 검색된 데이터 내에서 , limit 설정 

			if($rowss = _mysqli_query_rowss($query)){	
				for($i=0,$list=""; $i<count($rowss); $i++){
					$rows = $rowss[$i];
					if($site_mobile == "m") $list .= _listform_m($rows); else $list .= _listform($rows);

				}

				$listbar = _listbar($_list_num,$_block_num,$limit,$total);

				$body = str_replace("{wish_list}",$list.$listbar,$body);
				

			} else {
				$msg = "내용이 없습니다.";
				$body = str_replace("{wish_list}",$msg,$body);
				
			}
			
			$body = str_replace("{delete}","<input type='button' name='delete' value='Delete' onclick=\"javascript:wish_delete()\" style=\"$css_btn_gray\">",$body);
			echo $javascript.$body;
		
		} else {
			echo "로그인이 필요합니다.";
		
		}

	} else {

		/*
		$body = _skin_page($skin_name,"error");		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;
		*/

		// 사이트 로그인이 안되어 있는 경우, AJAX로 로그인 처리 요청
		$login_script = "<script>"._javascript_ajax_html("#mainbody","ajax_login.php")."</script>";	
		$body =  _theme_emptybody($skin_name);
		$body = str_replace("<!--{skin_emptybody}-->",$login_script,$body);
		echo $body;	

	}	




?>