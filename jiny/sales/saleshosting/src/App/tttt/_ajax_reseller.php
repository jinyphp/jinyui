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
	include "./func/members.php";

	include "./func/css.php";


	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == _formdata("ajaxkey")) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		// include "./sales.php";

		// 카테고리에 대한 자바스크립트 함수 정의
		$javascript = "<script>
		function reseller_mode(mode,uid){
			var url = \"/ajax_reseller_editup.php?uid=\"+uid+\"&mode=\"+mode;
			$.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            });
		}



        function emoney_check(mode,uid){
        	/*
            var url = \"/ajax_users_emoney_edit.php?uid=\"+uid+\"&mode=\"+mode;	
            $.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            }); 
            */	
        }

        function reseller_edit(mode,uid){
            var url = \"/ajax_reseller_edit.php?uid=\"+uid+\"&mode=\"+mode;	
            $.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            }); 	
        }

        function reseller_reg(mode,uid){
        	/*
            var url = \"/ajax_service_reseller_reg.php?uid=\"+uid+\"&mode=\"+mode;	
            $.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('.mainbody').html(data);
                }
            }); 	
			*/
        }

        function orders_list(mode,uid){
        	/*
            var url = \"/ajax_service_orders.php?uid=\"+uid+\"&mode=\"+mode;	
            $.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('.mainbody').html(data);
                }
            }); 
            */	
        }

        function emoney_auth(mode,uid){
        	/*
            var url = \"/ajax_service_emoney_auth.php?uid=\"+uid+\"&mode=\"+mode;	
            $.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('.mainbody').html(data);
                }
            }); 
            */	
        }

        function emoney_list(email){
            var url = \"/ajax_users_emoney.php?users=\"+email;	
            $.ajax({
                url:url,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#mainbody').html(data);
                }
            }); 	
        }
        </script>";
		$body = $javascript._skin_page($skin_name,"service_reseller");

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

			$members = _members_rows($_COOKIE['cookie_email']); //회원 정보 

			$body = str_replace("{name}","<a href='#' onclick=\"javascript:reseller_edit('edit','".$reseller_rows->Id."')\" >".$reseller_rows->name."</a> ( <a href='#' onclick=\"javascript:reseller_edit('edit','".$reseller_rows->Id."')\" >".$reseller_rows->email."</a>  )",$body);
			$body = str_replace("{emoney}","<a href='#' onclick=\"javascript:emoney_list('".$members->email."')\" >".number_format($members->emoney,0,'.',',')."</a>원",$body);

			if($reseller_rows->auth_req){
				$button ="<input type='button' value='리셀러추가' onclick=\"javascript:reseller_edit('sub','".$reseller_rows->Id."')\" style=\"".$css_btn_gray."\" >";          
				$body = str_replace("{new}",$button,$body);
				
			} else {
				$body = str_replace("{new}","<input type='button' value='승인대기중' style=\"".$css_btn_gray."\" >",$body);
			}
		} else {
			$body = str_replace("{name}","",$body);
			$body = str_replace("{emoney}","0원",$body);
			$button ="<input type='button' value='리셀러신청' onclick=\"javascript:reseller_reg('reseller','0')\" style=\"".$css_btn_gray."\" >";          
			$body = str_replace("{new}",$button,$body);
		}

		$button ="<input type='button' value='입금승인' onclick=\"javascript:emoney_auth('in','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{in_check}",$button,$body);

		$button ="<input type='button' value='출금승인' onclick=\"javascript:emoney_auth('out','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{out_check}",$button,$body);

		$button ="<input type='button' value='연장&신규' onclick=\"javascript:orders_list('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{renewal_check}",$button,$body);

	
		///////////////////////////////


		$list = "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='30' >승인</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>리셀러(이메일)</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100' >등급</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50' >마진율</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100' >적립금</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>상태</td>";
		$list .= "</tr></table>";

		$body = str_replace("{reseller_list}",$list."{reseller_list}",$body);		


		$query = "select * from `service_reseller` where tree like '%".$_COOKIE['cookie_email']."%' order by pos desc";
		//echo $query."<br>";
		if($rowss = _mysqli_query_rowss($query)){	
			
			$list = "";
			for($i=0; $i<count($rowss); $i++){
				$reseller = $rowss[$i];

				$members = _members_rows($reseller->email); //회원 정보 

				for($LevelSpace="",$j=0;$j<$reseller->level;$j++) $LevelSpace .= "-";
				$list .= "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
				
				if($reseller->enable) $list .= "<td width='10' style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'> <a href='#' onclick=\"javascript:reseller_mode('disable','".$reseller->Id."')\">▣</a></td>";
				else $list .= "<td width='10' style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'> <a href='#' onclick=\"javascript:reseller_mode('enable','".$reseller->Id."')\">□</a></td>";
	
				//*** 트리모양 만들기
				if($reseller->level == 0) {
					$query1 = "select * from `service_reseller` where ref = '0' and pos > '".$reseller->pos."'"; 
					if( _mysqli_query_rows($query1) ) $depth = "┣"; else $depth = "┗";
								
				} else {
					$query1 = "select * from `service_reseller` where ref = '0' and pos > '".$reseller->pos."'"; 
					if( _mysqli_query_rows($query1) ) $depth = "┃"; else $depth = "&#4515;";

					for($k=0;$k<$reseller->level;$k++) $depth .= "&#4515;";
						
					$query1 = "select * from `service_reseller` where ref = '".$reseller->ref."' and pos > '".$reseller->pos."'"; 
					if( _mysqli_query_rows($query1) ) $depth .= "┣"; else $depth .= "┗";
				}
			
				$sub_new = "<a href='#' onclick=\"javascript:reseller_edit('sub','".$reseller->Id."')\" > + </a>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'> $depth $sub_new ";
				$list .= "<a href='#' onclick=\"javascript:reseller_edit('edit','".$reseller->Id."')\" >".$reseller->name." (".$reseller->email.")</a></td>";

				// $list .= "<td width='100'  style=\"$css_table_td\"> ".$reseller->tree."</td>";
				// $list .= "<td width='40'  style=\"$css_table_td\">: ".$reseller->pos."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$reseller->grade."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$reseller->margin."%</td>";

				
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>
							<a href='#' onclick=\"javascript:emoney_list('".$members->email."')\">".$members->emoney."</a></td>";

				if($reseller->auth_req){
					// 입금 승인 요청건 검사
					$query1 = "select * from `service_reseller_emoney` where email = '".$reseller->email."' and check_auth ='on'";
					if($reseller1 = _mysqli_query_rows($query1)){
						$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> <b>
									<a href='#' onclick=\"javascript:emoney_check('check','".$reseller1->Id."')\">입출금 확인</a>
								  </b> </td>";
					} else {
						$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$reseller->expire."</td>";
					}			

				} else {
					$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'> <b>승인요청</b> </td>";
				}

				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='10'>".$reseller->pos."</td>";
				$list .= "</tr></table>";

				
			}
			// echo $list;
			$body = str_replace("{reseller_list}",$list,$body);
			
		} else {
			$msg = "리셀러 목록 없습니다.";
			$body = str_replace("{reseller_list}",$msg,$body);

		}	
	
		
		echo $body;
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>