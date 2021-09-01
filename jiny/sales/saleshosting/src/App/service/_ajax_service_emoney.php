<?

	@session_start();
	
	include ($_SERVER['DOCUMENT_ROOT']."/conf/dbinfo.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/mysql.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/datetime.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/file.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/form.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/string.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/javascript.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/mobile.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/language.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/country.php");

	include ($_SERVER['DOCUMENT_ROOT']."/func/site.php");	// 사이트 환경 설정
		
	include ($_SERVER['DOCUMENT_ROOT']."/func/layout.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/header.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/footer.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/menu.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/category.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/skin.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/css.php");
	include ($_SERVER['DOCUMENT_ROOT']."/func/pagination.php");

	// 환경설정 
	include ($_SERVER['DOCUMENT_ROOT']."/theme/theme.php");
	include ($_SERVER['DOCUMENT_ROOT']."/login/login.php");


	//********** Ajax Process **********
	$ajaxkey = _formdata("ajaxkey");
	if(isset($_SESSION['ajaxkey']) == $ajaxkey) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		// include "./sales.php";

		// 카테고리에 대한 자바스크립트 함수 정의
		$javascript = "<script>
			function emoney_pay(mode,uid,users){
				var maskHeight = $(document).height();  
				var maskWidth = $(window).width();

				//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
				$('#popup_mask').css({'width':maskWidth,'height':maskHeight});
				
				// 팡법창 크기 계산
				//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
				// popup_size(1000,500);
				var width = 800;
				var height = 300;
				var left = ($(window).width() - width )/2;
				var top = ( $(window).height() - height )/2;			
				$('#popup_body').css({'width':width,'height':height,'left':left,'top':50}); 			  
    
    			//마스크의 투명도 처리
    			$('#popup_mask').fadeTo(\"slow\",0.8); 
				$('#popup_body').show();

				// 팝업 내용을 Ajax로 읽어옴
				var url = \"/ajax_user_emoney_edit.php?uid=\"+uid+\"&mode=\"+mode+\"&users=\"+users;
				$.ajax({
            		url:url,
            		type:'post',
            		data:$('form').serialize(),
            		success:function(data){
                		$('#popup_body').html(data);

                		var maskHeight1 = $(document).height();  
						var maskWidth1 = $(window).width();

						//마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
						$('#popup_mask').css({'width':maskWidth1,'height':maskHeight1});
            		}
        		}); 
			}


        </script>";
		$body = $javascript._skin_page($skin_name,"emoney");

		$mode = _formmode();
		$email = $_COOKIE['cookie_email'];
		$emoney = _formdata("emoney");
		//echo "mode = ".$mode."<br>";
		if($mode == "edit") {
			$uid = _formdata("uid");
			$bankname = _formdata("bankname");
			$banknum = _formdata("banknum");
			$bankuser = _formdata("bankuser");
			$query = "UPDATE `site_members_emoney` SET `emoney`='$emoney',`bankname`='$bankname',`banknum`='$banknum',`bankuser`='$bankuser' where Id='$uid'";
			//echo $query."<br>";
			_mysqli_query($query);

		} else if($mode == "payin") {
			$query = "INSERT INTO `site_members_emoney` (`regdate`, `email`, `type`, `title`, `emoney`, `balance`) 
						VALUES ('$TODAYTIME', '$email', 'payin', '입금확인', '$emoney', '');";
			//echo $query."<br>";
			_mysqli_query($query);
		} else if($mode == "payout") {
			//echo "payout";
			//$emoney = _formdata("emoney");
			$bankname = _formdata("bankname");
			$banknum = _formdata("banknum");
			$bankuser = _formdata("bankuser");

			$query = "INSERT INTO `site_members_emoney` (`regdate`, `email`, `type`, `title`, `emoney`, `balance`, `bankname`, `banknum`, `bankuser`) 
						VALUES ('$TODAYTIME', '$email', 'payout', '출금요청', '$emoney', '', 'bankname', 'banknum', 'bankuser');";
			//echo $query."<br>";
			_mysqli_query($query);
		}



		$uid = _formdata("uid");
		$limit = _formdata("limit");
		$users = _formdata("users");
		$body = str_replace("{formstart}","<form id=\"data\" name='emoney' method='post' enctype='multipart/form-data' >
						<input type='hidden' name='limit' value='$limit'>
						<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		

		
		$query = "select * from `site_members` where email = '".$users."'";
		echo $query."<br>";
		if($members = _mysqli_query_rows($query)){
			$body = str_replace("{name}",$members->name,$body);
			$body = str_replace("{emoney}",$format = number_format($members->emoney,0,'.',',')."원",$body);

			$body = str_replace("{pay_out}","<input type='button' value='출금신청' onclick=\"javascript:emoney_pay('payout','0','$users')\" style=\"".$css_btn_gray."\" >",$body);
			$body = str_replace("{pay_in}","<input type='button' value='입금확인' onclick=\"javascript:emoney_pay('payin','0','$users')\" style=\"".$css_btn_gray."\" >",$body);
		} else {
			$body = str_replace("{name}","",$body);
			$body = str_replace("{emoney}","0원",$body);
			/*
			$button ="<input type='button' value='리셀러신청' onclick=\"javascript:reseller_reg('reseller','0')\" style=\"".$css_btn_gray."\" >";          
			$body = str_replace("{new}",$button,$body);
			*/

		}
	
		$list = "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>일자</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>구분</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>항목</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>적립금</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>잔액</td>";
		$list .= "</tr></table>";

		$body = str_replace("{emoney_list}",$list."{emoney_list}",$body);		


		$query = "select * from `site_members_emoney` where email = '".$users."' order by regdate desc";
		echo $query."<br>";
		if($rowss = _mysqli_query_rowss($query)){	
			
			$list = "";
			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];

				for($LevelSpace="",$j=0;$j<$rows->level;$j++) $LevelSpace .= "-";
				$list .= "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->regdate."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->type."</td>";

				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'> $depth ";
				$list .= "<a href='#' onclick=\"javascript:emoney_pay('edit','".$rows->Id."','$users')\" >".$rows->title."</a></td>";

				if($rows->type == "in") $mark = "+"; else  $mark = "-";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>$mark".$rows->emoney."</td>";

				if($rows->check_auth){
					$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> <b>확인요청</b> </td>";
					
				} else {
					$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->balance."</td>";
					
				}

				$list .= "</tr></table>";

				
			}
			// echo $list;
			$body = str_replace("{emoney_list}",$list,$body);
			
		} else {
			$msg = "적립금 사용목록 없습니다.";
			$body = str_replace("{emoney_list}",$msg,$body);

		}	
	
		
		echo $body;
	} else {
		$body = _theme_pages($skin_name,"error");
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",_string($msg,$site_language),$body);
		echo $body;
	}

	
?>