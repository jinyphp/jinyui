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

		// 자바스크립트 함수 정의
		$javascript = "<script>

        function order_auth(mode,uid){
            var url = \"/ajax_service_orders.php?uid=\"+uid+\"&mode=\"+mode;	
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
		$body = $javascript._skin_page($skin_name,"service_orders");

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
			$body = str_replace("{emoney}","<a href='#' onclick=\"javascript:emoney_list('list','".$reseller_rows->Id."')\" >".number_format($reseller_rows->emoney,0,'.',',')."</a>원",$body);

			if($reseller_rows->auth_req){
				$button ="<input type='button' value='리셀러추가' onclick=\"javascript:reseller_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
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

		$button ="<input type='button' value='입금승인' onclick=\"javascript:reseller_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{in_check}",$button,$body);

		$button ="<input type='button' value='출금승인' onclick=\"javascript:reseller_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{out_check}",$button,$body);

		$button ="<input type='button' value='연장&신규' onclick=\"javascript:reseller_edit('new','0')\" style=\"".$css_btn_gray."\" >";          
		$body = str_replace("{renewal_check}",$button,$body);

		//////////////////////

		$list = "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100' >타입</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100' >신청자</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>내역</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100' >금액</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>상태</td>";
		$list .= "</tr></table>";

		$body = str_replace("{order_list}",$list."{order_list}",$body);		


		$query = "select * from `service_orders` where reseller = '".$_COOKIE['cookie_email']."' order by Id desc";
		if($rowss = _mysqli_query_rowss($query)){	
			
			$list = "";

			$css_btn_auth ="width:80px; font-size:12px; color:#000000; font-weight:bold; background-color:#f3f3f3; height:20px;	font-size:12px; border:1px solid #ff0000;";
			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];

				$list .= "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
				
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->type."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$rows->email."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' >".$rows->title."</td>";

				$moeny = $rows->setup + $rows->charge;
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".$moeny."</td>";

				if($rows->order_auth){
					$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>주문취소</td>";
				} else {
					$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>
						<input type='button' value='주문승인' onclick=\"javascript:order_auth('auth','".$rows->Id."')\" style=\"".$css_btn_auth."\" >
					</td>";
				}
				$list .= "</tr></table>";

				
			}
			// echo $list;
			$body = str_replace("{order_list}",$list,$body);
			
		} else {
			$msg = "내역이 없습니다.";
			$body = str_replace("{order_list}",$msg,$body);

		}	
	
		
		echo $body;
	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>