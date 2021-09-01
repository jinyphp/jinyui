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
	include "./func/butten.php";

	include "./func/members.php";

	include "./func/css.php";
	
	//********** Ajax Process **********
	if(isset($_SESSION['ajaxkey']) == isset($_POST['ajaxkey'])) { // Ajax CallKey Securities Checking...
		
		// Sales 사용자 DB 접근.
		// include "./sales.php";

		$script = "<script>

				function form_submit(mode,uid){
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

				</script>";

		$body = $script._skin_page($skin_name,"service_reseller_reg");

		$ajaxkey = _formdata("ajaxkey");
		$body=str_replace("{formstart}","<form id='data' name='service' method='post' enctype='multipart/form-data'> 
					    				<input type='hidden' name='ajaxkey' value='$ajaxkey'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$css_btn_reseller_reg ="width:200px; 
		font-size:12px; 
		color:#000000; 
		font-weight:bold; 
		background-color:#f3f3f3; 
		height:28px;	
		font-size:12px;	
		border:1px solid #d8d8d8;";
		$body = str_replace("{form_submit}","
				<input type='button' value='가입신청 & 입금확인 요청' onclick=\"javascript:form_submit('regist','".$uid."')\" style=\"".$css_btn_reseller_reg."\" >
				",$body);

		$list  = "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>선택</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'> 리셀러 그레이드</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'> Sub</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>마진율%</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>가입(계약)비용</td>";
		$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>매월 유지비용</td>";
		$list .= "</tr></table>";
		$body = str_replace("{reseller_level}",$list."{reseller_level}",$body);

		$query = "select * from `service_reseller_grade` order by Id desc";
		if($rowss = _mysqli_query_rowss($query)){	
			
			$list = "";
			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];
				$from_reseller_grade = "<input type=radio name=reseller_grade value='".$rows->Id."'  id=\"reseller_grade\">";

				$list .= "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$from_reseller_grade."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;'>".$rows->title."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'> Max ".$rows->level."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='50'>".$rows->margin."%</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".number_format($rows->setup,0,'.',',')."원"."</td>";
				$list .= "<td style='border-bottom:1px solid #E9E9E9;font-size:12px;padding:10px;' width='100'>".number_format($rows->charge,0,'.',',')."원"."</td>";
				$list .= "</tr></table>";
				
			}
			// echo $list;
			$body = str_replace("{reseller_level}",$list,$body);

		} else {
			$msg = "리셀러 level 목록 없습니다.";
			$body = str_replace("{reseller_level}",$msg,$body);

		}


		


		$members_rows = _members_rows($_COOKIE['cookie_email']);
		$query = "select * from `service_reseller` WHERE `code`= '".$members_rows->reseller."' ";
		// echo $query."<br>";
		if($rows = _mysqli_query_rows($query)){	
		}
		
		$body = str_replace("{bankname}",$rows->bankname,$body);
		$body = str_replace("{bankswiff}",$rows->bankswiff,$body);
		$body = str_replace("{banknum}",$rows->banknum,$body);
		$body = str_replace("{bankuser}",$rows->bankuser,$body);

		$body = str_replace("{reseller_code}",_form_text("reseller_code","",$css_textbox)."<input type='hidden' name='reseller' value='".$rows->reseller."'>",$body);
		$body = str_replace("{code_check}","<input type='hidden' name='code_check' id=\"code_check\"><span id=\"code_message\"></span>",$body);
		$body = str_replace("{description}","<textarea name='description' rows='10' style='$css_textarea'>".stripslashes($rows->description)."</textarea>",$body);	

		echo $body;


	} else {
		$body = _skin_page($skin_name,"error");
		
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}


	
?>