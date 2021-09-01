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
	include "./func/orders.php";

	include "./func/css.php";


	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		// include "./sales.php";

		// 카테고리에 대한 자바스크립트 함수 정의
		$javascript = "<script>
		function reseller_mode(mode,uid){
			var url = \"/ajax_service_reseller_editup.php?uid=\"+uid+\"&mode=\"+mode;
			$.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('.mainbody').html(data);
                }
            });
		}

        function reseller_edit(mode,uid){
            var url = \"/ajax_service_reseller_edit.php?uid=\"+uid+\"&mode=\"+mode;	
            $.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('.mainbody').html(data);
                }
            }); 	
        }

        function reseller_reg(mode,uid){
            var url = \"/ajax_service_reseller_reg.php?uid=\"+uid+\"&mode=\"+mode;	
            $.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('.mainbody').html(data);
                }
            }); 	
        }


        </script>";
		$body = $javascript._skin_page($skin_name,"service_reseller_emoney");

		$mode = _formmode();
		$uid = _formdata("uid");
		$ajaxkey = _formdata("ajaxkey");
		$limit = _formdata("limit");

		$body = str_replace("{formstart}","<form name='reseller' method='post' enctype='multipart/form-data' >
						<input type='hidden' name='limit' value='$limit'>
						<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		

		
		$query = "select * from `service_reseller` where email = '".$_COOKIE['cookie_email']."'";
		if($reseller_rows = _mysqli_query_rows($query)){
			$body = str_replace("{name}","<a href='#' onclick=\"javascript:reseller_edit('edit','".$reseller_rows->Id."')\" >".$reseller_rows->name."</a> ( <a href='#' onclick=\"javascript:reseller_edit('edit','".$reseller_rows->Id."')\" >".$reseller_rows->email."</a>  )",$body);
			$body = str_replace("{emoney}",$format = number_format($reseller_rows->emoney,0,'.',',')."원",$body);

			$body = str_replace("{payout}","<input type='button' value='출금' style=\"".$css_btn_gray."\" >",$body);
			$body = str_replace("{payin}","<input type='button' value='입금' style=\"".$css_btn_gray."\" >",$body);
		} else {
			$body = str_replace("{name}","",$body);
			$body = str_replace("{emoney}","0원",$body);
			$button ="<input type='button' value='리셀러신청' onclick=\"javascript:reseller_reg('reseller','0')\" style=\"".$css_btn_gray."\" >";          
			$body = str_replace("{new}",$button,$body);

		}
	
		$list = "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50' >승인</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>리셀러(이메일)</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100' >등급</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50' >마진율</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100' >적립금</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>만료일</td>";
		$list .= "</tr></table>";

		$body = str_replace("{reseller_list}",$list."{reseller_list}",$body);		


		$query = "select * from `service_reseller_emoney` where email = '".$_COOKIE['cookie_email']."' order by regdate desc";
		if($rowss = _mysqli_query_rowss($query)){	
			
			$list = "";
			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];

				for($LevelSpace="",$j=0;$j<$rows->level;$j++) $LevelSpace .= "-";
				$list .= "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='150'>".$rows->regdate."</td>";

				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'> $depth ";
				$list .= "<a href='#' onclick=\"javascript:emoney_edit('edit','".$rows->Id."')\" >".$rows->title."</a></td>";

				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->emoney."</td>";

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
			$msg = "리셀러 목록 없습니다.";
			$body = str_replace("{emoney_list}",$msg,$body);

		}	
	
		
		echo $body;
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>