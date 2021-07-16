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
		include "./sales.php";

		$javascript = "<script>
		function emoney_edit(mode,uid,mem){
			// alert(\"edit\");
            $.ajax({
                url:'/ajax_site_members_emoney_edit.php?uid='+uid+'&mode='+mode+'&mem='+mem,
                type:'post',
                data:$('form').serialize(),
                success:function(data){
                    $('#emoney_edit').html(data);
                }
            }); 	
        }
        </script>";        
		$body = $javascript._skin_page($skin_name,"site_members_emoney");

		$body = str_replace("{back}","<<",$body);

		$mode = _formmode();
		$uid = _formdata("uid");
		

		//$mem_rows = _members_id_rows($uid);
		$query = "select * from `site_members` WHERE `Id`='$uid'";
		//echo $query."<br>";
		if($members_rows = _sales_query_rows($query)){	
		}	

		$body = str_replace("{email}",$members_rows->email,$body);
    
		$body = str_replace("{new}","<input type='button' value='NEW' onclick=\"javascript:emoney_edit('new','0','".$uid."')\" id=\"".$css_btn_gray."\" >",$body);

		$ajaxkey = _formdata("ajaxkey");
		$body = str_replace("{formstart}","<form name='members' method='post' enctype='multipart/form-data'>
					   			<input type='hidden' name='ajaxkey' value='".$ajaxkey."'>",$body);
		$body = str_replace("{formend}","</form>",$body);

		$query = "select * from `site_members_emoney` WHERE `email`='".$members_rows->email."' order by Id desc";
		if($rowss = _sales_query_rowss($query)){	
			
			$list = "";
			for($i=0; $i<count($rowss); $i++){
				$rows = $rowss[$i];
				
				$list .= "<table border='0' width='100%' cellspacing='0' cellpadding='0'><tr>";
				$list .= "<td style='font-size:12px;padding:10px;' width=150>".$rows->regdate."</td>";
				$list .= "<td style='font-size:12px;padding:10px;'><a href='#' onclick=\"javascript:emoney_edit('edit','".$rows->Id."','".$uid."')\" >".$rows->title."</a></td>";
				$list .= "<td style='font-size:12px;padding:10px;' width=50>".$rows->emoney."</td>";
				$list .= "<td style='font-size:12px;padding:10px;' width=100>= ".$rows->balance."</td>";
				$list .= "</tr></table>";
				
			}
			// echo $list;
			$body = str_replace("{emoney_list}",$list,$body);

		} else {
			$msg = "적립금 내역이 없습니다.";
			$body = str_replace("{emoney_list}",$msg,$body);
		}	
		
		$body = str_replace("{emoney_edit}","<span id=\"emoney_edit\"></span>",$body);	

		echo $body;
	} else {
		$body = _skin_page($skin_name,"error");
		$msg = _string($msg,$site_language);
		$msg = "오류. 페이지 접근 보안키값이 일치하지 않습니다.";
		$body = str_replace("<!--{error_message}-->",$msg,$body);
		echo $body;	
	}

	
?>